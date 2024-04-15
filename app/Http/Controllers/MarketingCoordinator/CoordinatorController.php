<?php

namespace App\Http\Controllers\MarketingCoordinator;

use App\Models\Comment;
use App\Models\MarketingCoordinator;
use ZipArchive;
use App\Models\Idea;
use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CoordinatorController extends Controller
{
    // Login view
    public function login_view()
    {
        return view('coordinator.auth.login');
    }

    // Login submit
    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6',
        ]);

        $credenticals = [
            "email" => $request->email,
            "password" => $request->password,
        ];


        if (Auth::guard('coordinator')->attempt($credenticals)) {
            return redirect()->route('coordinator_home');
        } else {
            return redirect()->route('coordinator_login')->with('error', 'Information is not correct');
        }
    }

    // Logout
    public function logout()
    {
        Auth::guard('coordinator')->logout();
        return redirect()->route('coordinator_login');
    }

    // Homepage
    public function home()
    {
        return view('coordinator.Website.home');
    }

    // Profile view
    public function profile()
    {
        return view('coordinator.Website.profile');
    }

    // Edit Profile view
    public function edit_profile($id)
    {
        $single_coordinator = MarketingCoordinator::where('id', $id)->first();
        return view('coordinator.Website.edit_profile', compact('single_coordinator'));
    }

    // Edit profile submit
    public function edit_profile_submit(Request $request, $id)
    {
        $single_coordinator = MarketingCoordinator::where('id', $id)->first();

        $request->validate([
            'email' => 'email:rfc,dns',
        ]);
        
        if ($request->hasFile('photo')) 
        {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if (file_exists(public_path('/storage/uploads/' . $single_coordinator->photo)) and (!empty($single_coordinator->photo))) 
            {
                unlink(public_path('/storage/uploads/' . $single_coordinator->photo));
            }

            $ext = $request->file('photo')->extension();
            $photo_name = time() . '.' . $ext;

            $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);
            $single_coordinator->photo = $photo_name;
        }

        $single_coordinator->name = $request->name;
        $single_coordinator->email = $request->email;
        $single_coordinator->update();
        return redirect()->route('coordinator_edit_profile', $single_coordinator->id)->with('success', 'Update information profile successfully!');
    }

    // List faculties view
    public function list_faculties()
    {
        $faculties = Faculty::where('coordinator_id', Auth::guard('coordinator')->user()->id)->get();
        return view('coordinator.Website.list_faculties', compact('faculties'));
    }

    // List ideas view
    public function list_ideas($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        return view('coordinator.Website.list_ideas', compact('single_faculty'));
    }

    // Download file (Docx, image)
    public function download_file($file)
    {
        return response()->download(public_path('/storage/files/' . $file));
    }

    // Download file (Zip)
    // public function download_file($file)
    // {
    //     try
    //     {
    //         $zip = new ZipArchive();
    //         $fileName = 'mananger' . '.zip';

    //         if ($zip->open($fileName, ZipArchive::CREATE)) {
    //             $multi_files = File::files(public_path('/storage/files'));
    //             foreach ($multi_files as $files) 
    //             {
    //                 // $single_file = public_path("/storage/files/" . $file);
    //                 $nameInZipFile = basename($files);
    //                 $zip->addFile($files, $nameInZipFile);
    //             }

    //         }
    //         $zip->close();
    //         return response()->download($fileName);
    //         // return Storage::download($fileName);
    //     }
    //     catch (\Exception $e)
    //     {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // Comment submit
    public function comment_submit(Request $request, $id)
    {
        $request->validate([
            'content' => 'nullable'
        ]);
        $current_idea = Idea::where('id', $id)->first();
        $check_comment = Comment::where('idea_id', $id)->first();

        if ($current_idea) {
            if ($check_comment)
            {
                $check_comment->content = $request->content;
                $check_comment->idea_id = $current_idea->id;
                $check_comment->coordinator_id = Auth::guard('coordinator')->user()->id;
                $check_comment->update();

                return redirect()->route('coordinator_list_ideas', $current_idea->faculty_id)->with('success', 'Updated a comment successfully!');
            }
            $comment = new Comment;
            $comment->content = $request->content;
            $comment->idea_id = $current_idea->id;
            $comment->coordinator_id = Auth::guard('coordinator')->user()->id;
            $comment->save();
            
            return redirect()->route('coordinator_list_ideas', $current_idea->faculty_id)->with('success', 'Added a comment successfully!');
        }
    }

    // List outstanding ideas view
    public function list_outstanding_contributions()
    {
        $contributions = Idea::where('status', 1)->get();
        return view('coordinator.Website.list_outstanding_contributions', compact('contributions'));
    }

    // Choose typical idea submit
    public function choose_typical_idea($id)
    {
        $idea = Idea::where('id', $id)->first();
        if ($idea->status == 0)
        {
            $idea->status = 1;
            $idea->update();
        }
        else
        {
            return redirect()->back()->with('error', 'This idea is already in the featured ideas section!');
        }
        return redirect()->back()->with('success', 'This idea has been added to the list of featured ideas!');
    }

    // Remove typical idea submit
    public function remove_typical_idea($id)
    {
        $idea = Idea::where('id', $id)->first();
        if ($idea->status == 1)
        {
            $idea->status = 0;
            $idea->update();
        }
        return redirect()->back()->with('success', 'This idea has been removed from the list of featured ideas!');
    }
}
