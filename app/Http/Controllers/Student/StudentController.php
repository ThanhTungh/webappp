<?php

namespace App\Http\Controllers\Student;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // Login view
    public function login_view()
    {
        return view('student.auth.login');
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


        if (Auth::guard('student')->attempt($credenticals)) {
            return redirect()->route('student_home');
        } else {
            return redirect()->route('student_login')->with('error', 'Information is not correct');
        }
    }

    // Logout
    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student_login');
    }

    // Homepage
    public function home()
    {
        return view('student.Website.home');
    }

    // Profile view
    public function profile()
    {
        return view('student.Website.profile');
    }

    // Edit Profile
    public function edit_profile($id)
    {
        $single_student = Student::where('id', $id)->first();
        return view('student.Website.edit_profile', compact('single_student'));
    }

    // Edit profile submit
    public function edit_profile_submit(Request $request, $id)
    {
        $single_student = Student::where('id', $id)->first();

        $request->validate([
            'email' => 'email:rfc,dns',
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if (file_exists(public_path('/storage/uploads/' . $single_student->photo)) and (!empty($single_student->photo))) {
                unlink(public_path('/storage/uploads/' . $single_student->photo));
            }

            $ext = $request->file('photo')->extension();
            $photo_name = time() . '.' . $ext;

            $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);
            $single_student->photo = $photo_name;
        }

        $single_student->name = $request->name;
        $single_student->email = $request->email;
        $single_student->update();
        return redirect()->route('student_edit_profile', $single_student->id)->with('success', 'Update information profile successfully!');
    }


    // Dashboard
    public function dashboard()
    {
        return view('student.Website.dashboard');
    }

    // List faculties
    public function list_faculties()
    {
        $faculties = Faculty::where('id', Auth::guard('student')->user()->faculty_id)->get();
        return view('student.Website.list_faculties', compact('faculties'));
    }

    // Current faculty view
    public function current_faculty($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        return view('student.Website.submit_idea', compact('single_faculty'));
    }

    // Submit idea 
    public function submit_idea(Request $request, $id)
    {
        $request->validate([
            'topic' => 'required',
            'tag' => 'required',
            // 'file' => 'required|mimes:docx,jpg,jpeg,png,gif',
            'file' => 'required|file',
        ]);

        $single_faculty = Faculty::where('id', $id)->first();
        $student = Student::where('id', $request->student_id)->first();

        $file = $request->file;
        $filename = $student->name . '.' . $file->getClientOriginalExtension();
        // $filename = Str::slug($file->getClientOriginalName());
        $request->file->move(public_path('/storage/files/'), $filename); 

        // $filename_temp = $student->name . '.' . 'pdf';
        // $request->file->move(public_path('/storage/pdf/'), $filename_temp);

        $new_idea = new Idea();
        $new_idea->topic = $request->topic;
        $new_idea->tag = $request->tag;
        $new_idea->file = $filename;
        $new_idea->faculty_id = $single_faculty->id;
        $new_idea->student_id = $student->id;

        $new_idea->save();

        return redirect()->route('student_edit_submit_idea_view', $single_faculty->id)->with('success', 'Add new successful ideas!');
        // return redirect()->back()->with('success', 'Add new successful ideas!');
    }

    // Download file
    public function download_file($file)
    {
        return response()->download(public_path('/storage/files/' . Auth::guard('student')->user()->idea->file));
    }

    // View edit submit idea
    public function edit_submit_idea_view($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        $current_student = Student::where('id', Auth::guard('student')->user()->id)->first();
        return view('student.Website.edit_submit_idea', compact('single_faculty', 'current_student'));
    }

    // Submit edit idea
    public function edit_submit_idea(Request $request, $id)
    {
        $request->validate([
            // 'file' => 'required|mimes:docx,jpg,jpeg,png,gif',
            'file' => 'required|file',
        ]);

        $student = Student::where('id', $request->student_id)->first();
        if (file_exists(public_path('/storage/files/' . Auth::guard('student')->user()->idea->file)) and (!empty(Auth::guard('student')->user()->idea->file))) {
            unlink(public_path('/storage/files/' . Auth::guard('student')->user()->idea->file));
        }

        $file = $request->file;
        $filename = $student->name . '.' . $file->getClientOriginalExtension();
        // $filename = Str::slug($file->getClientOriginalName());
        $request->file->move(public_path('/storage/files/'), $filename);

        $single_idea = Idea::where('id', $id)->first();
        $single_idea->topic = $request->topic;
        $single_idea->tag = $request->tag;
        $single_idea->file = $filename;
        $single_idea->update();

        return redirect()->route('student_edit_submit_idea_view', $single_idea->faculty_id)->with('success', 'Edit idea successfully!');
    }
}
