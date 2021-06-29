<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class ManageController extends Controller
{
    public function menu()
    {

        return view('pages.admin.management.menu');
    }

    public function users()
    {
        $users = User::all();
        return view('pages.admin.management.users')->with([
            'users' => $users
        ]);
    }

    public function user_delete(Request $request)
    {
        User::where('id', $request->user_id)->delete();
        return response()->json([
            'msg' => 'success'
        ]);
    }

    public function state_change(Request $request)
    {
        User::where('id', $request->user_id)->update([
            'state'=>$request->state
        ]);

        return response()->json([
            'msg' => 'updated'
        ]);
    }

    public function universities()
    {
        $universities = University::all();
        return view('pages.admin.management.universities')->with('universities', $universities);
    }

    public function university_save(Request $request)
    {
        $name = $request->name;
        $location = $request->location;
        $founded_date = $request->founded_date;
        $description = $request->description;
        $faculties_cnt = $request->faculties_cnt;
        $professors_cnt = $request->professors_cnt;
        $students_cnt = $request->students_cnt;
        // die(print_r($description));
        if ($request->hasFile('university_image')) {
            $filenameWithExtension = $request->file('university_image')->getClientOriginalName();
            $filenameWithoutExtension = $name;
            $extension = $request->file('university_image')->getClientOriginalExtension();
            $filenameToStore = $filenameWithoutExtension.'.'.$extension;
            // Storing The Image
            $path = $request->file('university_image')->storeAs('upload/universities', $filenameToStore);
        }

        $university_id = $request->university_id;
        if($university_id != null)
        {
            University::where('id', $university_id)->update([
                'name' => $name,
                'location' => $location,
                'founded_date' => $founded_date,
                'description' => $description,
                'photo' => $path,
                'faculties_cnt' => $faculties_cnt,
                'professors_cnt' => $professors_cnt,
                'students_cnt' => $students_cnt
            ]);

            $alert = 'Successfully updated!';
        } else {
            University::create([
                'name' => $name,
                'location' => $location,
                'founded_date' => $founded_date,
                'description' => $description,
                'photo' => $path,
                'faculties_cnt' => $faculties_cnt,
                'professors_cnt' => $professors_cnt,
                'students_cnt' => $students_cnt
            ]);

            $alert = 'Successfully saved!';
        }

        return redirect()->back()->withErrors([
            'alert' => $alert
        ]);
    }

    public function university_delete(Request $request)
    {
        University::where('id', $request->university_id)->delete();

        return response()->json([
            'msg' => 'success'
        ]);
    }

    public function get_university(Request $request)
    {
        $university = University::where('id', $request->university_id)->first();

        return response()->json([
            'university' => $university
        ]);
    }


    public function faculties()
    {
        $faculties = DB::table('faculties')->join('universities', 'faculties.university_id', '=', 'universities.id')
                        ->select('faculties.*', 'universities.name as university_name')->get();
        $universities = University::all();
        return view('pages.admin.management.faculties')->with([
            'faculties' => $faculties,
            'universities' => $universities
        ]);
    }

    public function faculty_save(Request $request)
    {
        $name = $request->name;
        $university = $request->university;
        $departments_cnt = $request->departments_cnt;
        $professors_cnt = $request->professors_cnt;
        $students_cnt = $request->students_cnt;
        $description = $request->description;
        if ($request->hasFile('faculty_image')) {
            $filenameWithExtension = $request->file('faculty_image')->getClientOriginalName();
            $filenameWithoutExtension = $name;
            $extension = $request->file('faculty_image')->getClientOriginalExtension();
            $filenameToStore = $filenameWithoutExtension.'.'.$extension;
            // Storing The Image
            $path = $request->file('faculty_image')->storeAs('upload/faculties', $filenameToStore);
        }

        $faculty_id = $request->faculty_id;

        if($faculty_id != null)
        {
            Faculty::where('id', $faculty_id)->update([
                'name' => $name,
                'university_id' => $university,
                'departments_cnt' => $departments_cnt,
                'professors_cnt' => $professors_cnt,
                'students_cnt' => $students_cnt,
                'description' => $description,
                'photo' => $path
            ]);
            $alert = 'Successfully updated!';
        } else {
            Faculty::create([
                'name' => $name,
                'university_id' => $university,
                'departments_cnt' => $departments_cnt,
                'professors_cnt' => $professors_cnt,
                'students_cnt' => $students_cnt,
                'description' => $description,
                'photo' => $path
            ]);
            $alert = 'Successfully saved!';
        }

        return redirect()->back()->withErrors([
            'alert' => $alert
        ]);
    }

    public function get_faculty(Request $request)
    {
        $faculty = Faculty::where('id', $request->faculty_id)->first();

        return response()->json([
            'faculty' => $faculty
        ]);
    }

    public function faculty_delete(Request $request)
    {
        Faculty::where('id', $request->faculty_id)->delete();

        return response()->json([
            'msg' => 'success'
        ]);
    }

    public function departmens()
    {
        $departments = DB::table('departments')->join('universities', 'departments.university_id', '=', 'universities.id')
                        ->join('faculties', 'departments.faculty_id', '=', 'faculties.id')
                        ->select('departments.*', 'universities.name as university_name', 'faculties.name as faculty_name')->get();

        $universities = University::all();
        if(count($universities) > 0) {
            $faculties = Faculty::where('university_id', $universities[0]->id)->get();
        } else {
            $faculties = [];
        }

        return view('pages.admin.management.departments')->with([
            'departments' => $departments,
            'universities' => $universities,
            'faculties' => $faculties
        ]);
    }

    public function get_faculty_in_department(Request $request)
    {
        $faculties = Faculty::where('university_id', $request->university_id)->get();

        return response()->json([
            'faculties' => $faculties
        ]);
    }

    public function add_course(Request $request)
    {
        $department_id = DB::select("SHOW TABLE STATUS LIKE 'departments'");
        $course = Course::create([
            'name' => $request->course_name,
            'content' => $request->course_content,
            'department_id' => $department_id[0]->Auto_increment
        ]);

        return response()->json([
            'course' => $course
        ]);
    }

    public function delete_course(Request $request)
    {
        Course::where('id', $request->course_id)->delete();

        return response()->json([
            'msg' => 'delete'
        ]);
    }

    public function department_save(Request $request)
    {
        $name = $request->name;
        $university = $request->university;
        $faculty = $request->faculty;
        $professors_cnt = $request->professors_cnt;
        $students_cnt = $request->students_cnt;
        $description = $request->description;
        $department_id = $request->department_id;

        if($department_id == null){
            Department::create([
                'name' => $name,
                'university_id' => $university,
                'faculty_id' => $faculty,
                'professors_cnt' => $professors_cnt,
                'students_cnt' => $students_cnt,
                'description' => $description
            ]);
            $alert = 'Successfully saved!';
        } else {
            Department::where('id', $department_id)->update([
                'name' => $name,
                'university_id' => $university,
                'faculty_id' => $faculty,
                'professors_cnt' => $professors_cnt,
                'students_cnt' => $students_cnt,
                'description' => $description
            ]);
            $alert = 'Successfully updated!';
        }

        return redirect()->back()->withErrors([
            'alert' => $alert
        ]);
    }

    public function get_department(Request $request)
    {
        $department = Department::where('id', $request->department_id)->first();

        return response()->json([
            'department' => $department
        ]);
    }

    public function department_delete(Request $request)
    {
        Department::where('id', $request->department_id)->delete();
        Course::where('department_id', $request->department_id)->delete();
        return response()->json([
            'msg' => 'delete'
        ]);
    }

    public function volunteers()
    {
        $volunteers = DB::table('employees')
                        ->join('universities', 'employees.university_id', '=', 'universities.id')
                        ->join('faculties', 'employees.faculty_id', '=', 'faculties.id')
                        ->join('departments', 'employees.faculty_id', '=', 'departments.id')
                        ->where('employees.emp_type', 'student')
                        ->select('employees.*', 'universities.name as university_name', 'faculties.name as faculty_name', 'departments.name as department_name')->get();

        $universities = University::all();
        if(count($universities) > 0) {
            $faculties = Faculty::where('university_id', $universities[0]->id)->get();
        } else {
            $faculties = [];
        }

        if(count($faculties) > 0 )
        {
            $departments = Department::where('faculty_id', $faculties[0]->id)->get();
        } else {
            $departments = [];
        }

        return view('pages.admin.management.volunteers')->with([
            'volunteers' => $volunteers,
            'universities' => $universities,
            'faculties' => $faculties,
            'departments' => $departments
        ]);
    }

    public function volunteer_save(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $website = $request->website;
        $university_id = $request->university;
        $faculty_id = $request->faculty;
        $department_id = $request->department;
        $major = $request->major;
        $birthday = $request->birthday;
        $volunteer_id = $request->volunteer_id;
        $description = $request->description;
        if ($request->hasFile('volunteer_image')) {
            $filenameWithExtension = $request->file('volunteer_image')->getClientOriginalName();
            $filenameWithoutExtension = $name;
            $extension = $request->file('volunteer_image')->getClientOriginalExtension();
            $filenameToStore = $filenameWithoutExtension.'.'.$extension;
            // Storing The Image
            $path = $request->file('volunteer_image')->storeAs('upload/volunteers', $filenameToStore);
        } else {
            $path = '';
        }

        if($volunteer_id == null)
        {
            Employee::create([
                'fullname' => $name,
                'email' => $email,
                'phone' => $phone,
                'website' => $website,
                'birthday' => $birthday,
                'university_id' => $university_id,
                'faculty_id' => $faculty_id,
                'department_id' => $department_id,
                'majors' => $major,
                'emp_type' => 'student',
                'photo' => $path,
                'description' => $description
            ]);
            $alert = 'Successfully saved!';
        } else {
            Employee::where('id', $volunteer_id)->update([
                'fullname' => $name,
                'email' => $email,
                'phone' => $phone,
                'website' => $website,
                'birthday' => $birthday,
                'university_id' => $university_id,
                'faculty_id' => $faculty_id,
                'department_id' => $department_id,
                'majors' => $major,
                'emp_type' => 'student',
                'photo' => $path,
                'description' => $description
            ]);
            $alert = 'Successfully updated!';
        }
        return redirect()->back()->withErrors([
            'alert' => $alert
        ]);
    }

    public function get_volunteer(Request $request)
    {
        $volunteer = Employee::where('id', $request->volunteer_id)->first();

        return response()->json([
            'volunteer' => $volunteer
        ]);
    }

    public function get_faculty_department_in_volunteer(Request $request)
    {
        $faculties = Faculty::where('university_id', $request->university_id)->get();
        if(count($faculties) > 0)
        {
            $departments = Department::where('faculty_id', $faculties[0]->id)->get();
        } else {
            $departments = [];
        }

        // die(print_r($departments));
        return response()->json([
            'departments' => $departments,
            'faculties' => $faculties
        ]);
    }

    public function get_department_in_volunteer(Request $request)
    {
        $departments = Department::where('faculty_id', $request->faculty_id)->get();

        return response()->json([
            'departments' => $departments
        ]);
    }

    public function volunteer_delete(Request $request)
    {
        Employee::where('id', $request->volunteer_id)->delete();

        return response()->json([
            'msg' =>'delete'
        ]);
    }

    public function professors()
    {
        $professors = DB::table('employees')
                        ->join('universities', 'employees.university_id', '=', 'universities.id')
                        ->join('faculties', 'employees.faculty_id', '=', 'faculties.id')
                        ->join('departments', 'employees.faculty_id', '=', 'departments.id')
                        ->where('employees.emp_type', 'professor')
                        ->select('employees.*', 'universities.name as university_name', 'faculties.name as faculty_name', 'departments.name as department_name')
                        ->get();
        // die(print_r($professors));
        $universities = University::all();
        if(count($universities) > 0) {
            $faculties = Faculty::where('university_id', $universities[0]->id)->get();
        } else {
            $faculties = [];
        }

        if(count($faculties) > 0 )
        {
            $departments = Department::where('faculty_id', $faculties[0]->id)->get();
        } else {
            $departments = [];
        }

        return view('pages.admin.management.professors')->with([
            'professors' => $professors,
            'universities' => $universities,
            'faculties' => $faculties,
            'departments' => $departments
        ]);
    }

    public function professor_save(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $website = $request->website;
        $university_id = $request->university;
        $faculty_id = $request->faculty;
        $department_id = $request->department;
        $major = $request->major;
        $birthday = $request->birthday;
        $professor_id = $request->professor_id;
        $description = $request->description;
        if ($request->hasFile('professor_image')) {
            $filenameWithExtension = $request->file('professor_image')->getClientOriginalName();
            $filenameWithoutExtension = $name;
            $extension = $request->file('professor_image')->getClientOriginalExtension();
            $filenameToStore = $filenameWithoutExtension.'.'.$extension;
            // Storing The Image
            $path = $request->file('professor_image')->storeAs('upload/professors', $filenameToStore);
        } else {
            $path = '';
        }

        if($professor_id == null)
        {
            Employee::create([
                'fullname' => $name,
                'email' => $email,
                'phone' => $phone,
                'website' => $website,
                'birthday' => $birthday,
                'university_id' => $university_id,
                'faculty_id' => $faculty_id,
                'department_id' => $department_id,
                'majors' => $major,
                'emp_type' => 'professor',
                'photo' => $path,
                'description' => $description
            ]);
            $alert = 'Successfully saved!';
        } else {
            Employee::where('id', $professor_id)->update([
                'fullname' => $name,
                'email' => $email,
                'phone' => $phone,
                'website' => $website,
                'birthday' => $birthday,
                'university_id' => $university_id,
                'faculty_id' => $faculty_id,
                'department_id' => $department_id,
                'majors' => $major,
                'emp_type' => 'professor',
                'photo' => $path,
                'description' => $description
            ]);
            $alert = 'Successfully updated!';
        }
        return redirect()->back()->withErrors([
            'alert' => $alert
        ]);
    }

    public function get_professor(Request $request)
    {
        $professor = Employee::where('id', $request->professor_id)->first();

        return response()->json([
            'professor' => $professor
        ]);
    }

    public function professor_delete(Request $request)
    {
        Employee::where('id', $request->professor_id)->delete();

        return response()->json([
            'msg' =>'delete'
        ]);
    }

}
