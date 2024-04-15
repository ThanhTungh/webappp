<?php

namespace App\Http\Controllers\Admin;

use App\Models\Idea;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\MarketingManager;
use App\Http\Controllers\Controller;
use App\Models\MarketingCoordinator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Login view
    public function login_view()
    {
        return view('admin.auth.login');
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


        if (Auth::guard('admin')->attempt($credenticals)) {
            return redirect()->route('admin_home');
        } else {
            return redirect()->route('admin_login')->with('error', 'Information is not correct');
        }
    }

    // Register submit
    public function register_submit()
    {
        $admin = Admin::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            return redirect()->route('admin_login');
        } else {
            $new_admin = new Admin();
            $new_admin->name = 'Admin';
            $new_admin->email = 'admin@gmail.com';
            $p = '123456';
            $new_admin->password = Hash::make($p);
            $new_admin->save();
            return redirect()->route('admin_login');
        }
    }

    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    /* ----------------------------------------------*/

    // Profile view
    public function profile()
    {
        return view('admin.Website.profile');
    }

    /* ----------------------------------------------*/

    // Homepage view
    public function home()
    {
        return view('admin.Website.home');
    }

    /* ----------------------------------------------*/

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
        return view('admin.Website.dashboard', compact('num_managers', 'num_coordinators', 'num_students', 
                                                    'num_ideas', 'num_faculties', 'num_ideasStatus', 
                                                    'num_comments', 'faculties'));
    }

    /* ----------------------------------------------*/

    // List Accounts view
    public function list_accounts()
    {
        $managers = MarketingManager::get();
        $coordinators = MarketingCoordinator::get();
        $students = Student::get();
        return view('admin.Website.list_accounts', compact('managers', 'coordinators', 'students'));
    }

    // Add account view
    public function add_account()
    {
        return view('admin.Website.add_account');
    }

    // Add account submit
    public function add_account_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6',
        ]);

        $select_role = $request->input('role');

        if ($select_role == 'Marketing Manager') {
            $current_managers = MarketingManager::where('email', $request->email)->first();
            if ($current_managers) {
                return redirect()->route('admin_add_account')->with('error', 'This email already exists!');
            } else {
                $manager = new MarketingManager();
                $manager->name = $request->name;
                $manager->email = $request->email;
                $manager->password = Hash::make($request->password);

                if ($request->hasFile('photo')) {
                    $request->validate([
                        'photo' => 'image|mimes:jpg,jpeg,png,gif',
                    ]);

                    $ext = $request->file('photo')->extension();
                    $photo_name = time() . '.' . $ext;

                    $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);

                    $manager->photo = $photo_name;
                }
                $manager->save();
            }

        }

        if ($select_role == 'Marketing Coordinator') {
            $current_coordinators = MarketingCoordinator::where('email', $request->email)->first();
            if ($current_coordinators) {
                return redirect()->route('admin_add_account')->with('error', 'This email already exists!');
            } else {
                $coordinator = new MarketingCoordinator();
                $coordinator->name = $request->name;
                $coordinator->email = $request->email;
                $coordinator->password = Hash::make($request->password);

                if ($request->hasFile('photo')) {
                    $request->validate([
                        'photo' => 'image|mimes:jpg,jpeg,png,gif',
                    ]);

                    $ext = $request->file('photo')->extension();
                    $photo_name = time() . '.' . $ext;

                    $request->file('photo')->move(public_path('storage/uploads/'), $photo_name);

                    $coordinator->photo = $photo_name;
                }
                $coordinator->save();
            }

        }

        if ($select_role == 'Student') {
            $current_students = Student::where('email', $request->email)->first();
            if ($current_students) {
                return redirect()->route('admin_add_account')->with('error', 'This email already exists!');
            } else {
                $student = new Student();
                $student->name = $request->name;
                $student->email = $request->email;
                $student->password = Hash::make($request->password);

                if ($request->hasFile('photo')) {
                    $request->validate([
                        'photo' => 'image|mimes:jpg,jpeg,png,gif',
                    ]);

                    $ext = $request->file('photo')->extension();
                    $photo_name = time() . '.' . $ext;

                    $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);

                    $student->photo = $photo_name;
                }
                $student->save();
            }

        }

        return redirect()->route('admin_add_account')->with('success', 'Added an account successfully!');
    }

    // edit account manager view
    public function edit_account_manager($id)
    {
        $single_manager = MarketingManager::where('id', $id)->first();
        return view('admin.Website.edit_account_manager', compact('single_manager'));
    }

    // edit account manager submit
    public function edit_account_manager_submit(Request $request, $id)
    {
        $current_single_manager = MarketingManager::where('id', $id)->first();

        $request->validate([
            'email' => 'email:rfc,dns',
            'password' => 'nullable|min:6',
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if (file_exists(public_path('/storage/uploads/' . $current_single_manager->photo)) and (!empty($current_single_manager->photo))) {
                unlink(public_path('/storage/uploads/' . $current_single_manager->photo));
            }

            $ext = $request->file('photo')->extension();
            $photo_name = time() . '.' . $ext;

            $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);
            $current_single_manager->photo = $photo_name;
        }

        $current_single_manager->name = $request->name;
        if (!empty($request->password)) {
            $current_single_manager->password = Hash::make($request->password);
        } else {
            unset($current_single_manager->password);
        }
        $current_single_manager->email = $request->email;

        $current_single_manager->update();

        return redirect()->back()->with('success', 'Updated an Marketing Manager account successfully!');

    }

    // Delete a Marketing Manager account
    public function delete_account_manager_submit($id)
    {
        $single_manager = MarketingManager::where('id', $id)->first();
        if (file_exists(public_path('/storage/uploads/' . $single_manager->photo)) and (!empty($single_manager->photo))) {
            unlink(public_path('/storage/uploads/' . $single_manager->photo));
        }
        $single_manager->delete();

        return redirect()->route('admin_list_accounts')->with('success', 'Deleted an Marketing Manager account successfully!');
    }

    // edit account coordinator view
    public function edit_account_coordinator($id)
    {
        $single_coordinator = MarketingCoordinator::where('id', $id)->first();
        return view('admin.Website.edit_account_coordinator', compact('single_coordinator'));
    }

    // edit account coordinator submit
    public function edit_account_coordinator_submit(Request $request, $id)
    {
        $current_single_coordinator = MarketingCoordinator::where('id', $id)->first();

        $request->validate([
            'email' => 'email:rfc,dns',
            'password' => 'nullable|min:6',
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if (file_exists(public_path('/storage/uploads/' . $current_single_coordinator->photo)) and (!empty($current_single_coordinator->photo))) {
                unlink(public_path('/storage/uploads/' . $current_single_coordinator->photo));
            }

            $ext = $request->file('photo')->extension();
            $photo_name = time() . '.' . $ext;

            $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);
            $current_single_coordinator->photo = $photo_name;
        }

        $current_single_coordinator->name = $request->name;
        if (!empty($request->password)) {
            $current_single_coordinator->password = Hash::make($request->password);
        } else {
            unset($current_single_coordinator->password);
        }
        $current_single_coordinator->email = $request->email;

        $current_single_coordinator->update();

        return redirect()->back()->with('success', 'Updated an Marketing Coordinator account successfully!');

    }

    // Delete a Marketing Coordinator account
    public function delete_account_coordinator_submit($id)
    {
        $single_coordinator = MarketingCoordinator::where('id', $id)->first();
        if (file_exists(public_path('/storage/uploads/' . $single_coordinator->photo)) and (!empty($single_coordinator->photo))) {
            unlink(public_path('/storage/uploads/' . $single_coordinator->photo));
        }
        $single_coordinator->delete();

        return redirect()->route('admin_list_accounts')->with('success', 'Deleted an Marketing Coordinator account successfully!');
    }

    // edit account student view
    public function edit_account_student($id)
    {
        $single_student = Student::where('id', $id)->first();
        return view('admin.Website.edit_account_student', compact('single_student'));
    }

    // edit account student submit
    public function edit_account_student_submit(Request $request, $id)
    {
        $current_single_student = Student::where('id', $id)->first();

        $request->validate([
            'email' => 'email:rfc,dns',
            'password' => 'nullable|min:6',
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if (file_exists(public_path('/storage/uploads/' . $current_single_student->photo)) and (!empty($current_single_student->photo))) {
                unlink(public_path('/storage/uploads/' . $current_single_student->photo));
            }

            $ext = $request->file('photo')->extension();
            $photo_name = time() . '.' . $ext;

            $request->file('photo')->move(public_path('/storage/uploads/'), $photo_name);
            $current_single_student->photo = $photo_name;
        }

        $current_single_student->name = $request->name;
        if (!empty($request->password)) {
            $current_single_student->password = Hash::make($request->password);
        } else {
            unset($current_single_student->password);
        }

        $current_single_student->email = $request->email;

        $current_single_student->update();

        return redirect()->back()->with('success', 'Updated an Student account successfully!');

    }

    // Delete a Student account
    public function delete_account_student_submit($id)
    {
        $single_student = Student::where('id', $id)->first();
        if (file_exists(public_path('/storage/uploads/' . $single_student->photo)) and (!empty($single_student->photo))) {
            unlink(public_path('/storage/uploads/' . $single_student->photo));
        }

        $idea_student = Idea::where('student_id', $single_student->id)->first();
        if ($idea_student)
        {
            $idea_student->delete();
        }
        
        $single_student->delete();

        return redirect()->route('admin_list_accounts')->with('success', 'Deleted an Student account successfully!');
    }

    /* ----------------------------------------------*/

    // List faculties
    public function list_faculties()
    {
        $faculties = Faculty::get();
        return view('admin.Website.list_faculties', compact('faculties'));
    }

    // Add faculty view
    public function add_faculty()
    {
        $coordinators = MarketingCoordinator::get();
        return view('admin.Website.add_faculty', compact('coordinators'));
    }

    // Add faculty submit
    public function add_faculty_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        $exist_faculty = Faculty::where('name', $request->name)->first();
        if ($exist_faculty) {
            return redirect()->route('admin_add_faculty')->with('error', 'This Faculty already exists!');
        } else {
            $new_faculty = new Faculty();
            $new_faculty->name = $request->name;
            $new_faculty->description = $request->description;
            $new_faculty->date_start = $request->date_start;
            $new_faculty->date_end = $request->date_end;

            $select_coordinator = $request->input('coordinator');
            if ($select_coordinator == '...') {
                $new_faculty->coordinator_id = 0;
            } else {
                $coordinator = MarketingCoordinator::where('name', $select_coordinator)->first();
                if (!$coordinator) {
                    $new_faculty->coordinator_id = 0;
                } else {
                    $check_current_coordinator = Faculty::where('coordinator_id', $coordinator->id)->first();
                    if ($check_current_coordinator) {
                        return redirect()->route('admin_add_faculty')->with('error', 'This teacher was in charge of another faculty!');
                    } else {
                        $new_faculty->coordinator_id = $coordinator->id;
                    }
                }
            }


            $new_faculty->save();
        }
        return redirect()->route('admin_add_faculty')->with('success', 'Added a faculty successfully!');
    }

    // Edit faculty view
    public function edit_faculty($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        $coordinators = MarketingCoordinator::get();
        $students = Student::get();
        return view('admin.Website.edit_faculty', compact('single_faculty', 'coordinators', 'students'));
    }

    // Edit faculty submit
    public function edit_faculty_submit(Request $request, $id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        $single_faculty->name = $request->name;
        $single_faculty->description = $request->description;
        $single_faculty->date_start = $request->date_start;
        $single_faculty->date_end = $request->date_end;

        $select_coordinator = $request->input('coordinator');
        if ($select_coordinator == '...') {
            $single_faculty->coordinator_id = 0;
            $single_faculty->update();
        } else {
            $coordinator = MarketingCoordinator::where('name', $select_coordinator)->first();
            if ($single_faculty->coordinator_id == $coordinator->id) {
                $single_faculty->coordinator_id = $coordinator->id;
            } else {
                $check_current_coordinator = Faculty::where('coordinator_id', $coordinator->id)->first();
                if ($check_current_coordinator) {
                    return redirect()->route('admin_edit_faculty', $single_faculty->id)->with('error', 'This teacher was in charge of another faculty!');
                } else {
                    $single_faculty->coordinator_id = $coordinator->id;
                }
            }
        }

        $select_student = $request->input('student');
        if ($select_student == '...') {
            $single_faculty->update();
        } else {
            $student = Student::where('name', $select_student)->first();

            if ($student->faculty_id != 0) {
                $student->update();
                return redirect()->route('admin_edit_faculty', $single_faculty->id)->with('error', 'This student has already taken this faculty!');
            } else {
                $student->faculty_id = $single_faculty->id;
                $student->update();
            }


        }

        $delete_student = $request->input('delete_student');
        if ($delete_student == '...') {
            $single_faculty->update();
        } else {
            $student = Student::where('name', $delete_student)->first();
            $student->faculty_id = 0;
            $student->update();
        }


        $single_faculty->update();

        return redirect()->route('admin_edit_faculty', $single_faculty->id)->with('success', 'Updated a faculty successfully!');
    }

    // Delete faculty submit
    public function delete_faculty_submit($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        $remove_idea = Idea::where('faculty_id', $single_faculty->id);

        if ($single_faculty) {
            $students = Student::where('faculty_id', $single_faculty->id)->get();
            foreach ($students as $student) {
                $student->faculty_id = 0;
                $student->update();
            }
            
        }

        $remove_idea->delete();
        $single_faculty->delete();

        return redirect()->route('admin_faculties')->with('success', 'Deleted a faculty successfully!');
    }

    /* ----------------------------------------------*/

    // List ideas
    public function list_ideas($id)
    {
        $single_faculty = Faculty::where('id', $id)->first();
        return view('admin.Website.list_ideas', compact('single_faculty'));
    }


    /* ----------------------------------------------*/

}
