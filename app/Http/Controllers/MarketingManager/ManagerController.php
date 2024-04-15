<?php

namespace App\Http\Controllers\MarketingManager;

use App\Models\Comment;
use ZipArchive;
use App\Models\Idea;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\MarketingManager;
use App\Http\Controllers\Controller;
use App\Models\MarketingCoordinator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ManagerController extends Controller
{
    // Login view
    public function login_view()
    {
        return view('manager.auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:5',
        ]);

        $credenticals = [
            "email" => $request->email,
            "password" => $request->password,
        ];


        if (Auth::guard('manager')->attempt($credenticals)) {
            return redirect()->route('manager_home');
        } else {
            return redirect()->route('manager_login')->with('error', 'Information is not correct');
        }
    }

    // Homepage view
    public function home()
    {
        return view('manager.Website.home');
    }

    // Profile view
    public function profile()
    {
        return view('manager.Website.profile');
    }

    // Edit Profile view
    public function edit_profile($id)
    {
        $single_manager = MarketingManager::where('id', $id)->first();
        return view('manager.Website.edit_profile', compact('single_manager'));
    }

    // Edit profile submit
    public function edit_profile_submit(Request $request, $id)
    {
        $single_manager = MarketingManager::where('id', $id)->first();

        $request->validate([
            'email' => 'email:rfc,dns',
        ]);
        
        if ($request->hasFile('photo')) 
        {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if (file_exists(public_path('/storage/uploads/' . $single_manager->photo)) and (!empty($single_manager->photo))) 
            {
                unlink(public_path('/storage/uploads/' . $single_manager->photo));
            }

            $ext = $request->file('photo')->extension();
            $photo_name = time() . '.' . $ext;

            $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);
            $single_manager->photo = $photo_name;
        }

        $single_manager->name = $request->name;
        $single_manager->email = $request->email;
        $single_manager->update();
        return redirect()->route('manager_edit_profile', $single_manager->id)->with('success', 'Update information profile successfully!');
    }

    // Logout
    public function logout()
    {
        Auth::guard('manager')->logout();
        return redirect()->route('manager_login');
    }

    // Dashboard view
    public function dashboard()
    {
        $num_managers = MarketingManager::count();
        $num_coordinators = MarketingCoordinator::count();
        $num_students = Student::count();
        $num_ideas = Idea::count();
        $num_faculties = Faculty::count();
        $num_ideasStatus = Idea::where('status', 1)->count();
        $num_comments = Comment::count();
        

        $faculties = Faculty::get();
        return view('manager.Website.dashboard', compact('num_managers', 'num_coordinators', 'num_students', 
                                                        'num_ideas', 'num_faculties', 'num_ideasStatus', 
                                                        'num_comments', 'faculties'));
    }

    // List faculties
    public function list_faculties()
    {
        $faculties = Faculty::get();
        return view('manager.Website.list_faculties', compact('faculties'));
    }

    // List ideas
    public function list_ideas($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        return view('manager.Website.list_ideas', compact('single_faculty'));
    }

    // Download file (Zip)
    public function download_file($id)
    {
        try {
            $ideas = Idea::where('faculty_id', $id)->get();
            $faculty = Faculty::where('id', $id)->first();

            $fileName = 'faculty_' . $faculty->name . '.zip';
            $zip = new ZipArchive();
            if ($zip->open(public_path('/storage/files/' . $fileName), ZipArchive::CREATE)) {
                foreach ($ideas as $item) {
                    $nameInZipFile = basename($item->file);
                    $zip->addFile(public_path('/storage/files/' . $item->file), $nameInZipFile);
                }
            }
            $zip->close();
            return response()->download(public_path('/storage/files/' . $fileName));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
