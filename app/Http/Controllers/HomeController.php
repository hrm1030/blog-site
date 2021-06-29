<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $universities = University::all();
        return view('pages.home')->with([
            'universities' => $universities
        ]);
    }

    public function welcome()
    {
        $universities = University::all();
        return view('welcome')->with([
            'universities' => $universities
        ]);
    }

    public function faculties($university_id)
    {
        $faculties = DB::table('faculties')->join('universities', 'faculties.university_id', '=', 'universities.id')
                    ->where('faculties.university_id', $university_id)->select('faculties.*', 'universities.name as university_name')->get();

        return view('pages.faculties')->with([
            'faculties' => $faculties
        ]);
    }

    public function departments($faculty_id)
    {
        $departments = DB::table('departments')->join('universities', 'departments.university_id', '=', 'universities.id')
                        ->join('faculties', 'departments.faculty_id', '=', 'faculties.id')
                        ->where('departments.faculty_id', $faculty_id)
                        ->select('departments.*', 'universities.name as university_name', 'faculties.name as faculty_name')->get();

        return view('pages.departments')->with([
            'departments' => $departments
        ]);
    }

    public function department($department_id)
    {
        $department = Department::where('id', $department_id)->first();
        $courses = Course::where('department_id', $department_id)->get();

        return view('pages.course')->with([
            'department' => $department,
            'courses' => $courses
        ]);
    }

    public function university_search(Request $request)
    {
        $name = $request->keyword;
        $universities = University::whereRaw('LOWER(`name`) LIKE ?', '%'.strtolower($name))
                                    ->orWhereRaw('LOWER(`name`) LIKE ?', '%'.strtolower($name).'%')
                                    ->orWhereRaw('LOWER(`name`) LIKE ?', strtolower($name).'%')->get();

        return view('pages.home')->with([
            'universities' => $universities
        ]);
    }

    public function faculty_search(Request $request)
    {
        $name = $request->keyword;
        $faculties = DB::table('faculties')->join('universities', 'faculties.university_id', '=', 'universities.id')
                                    ->whereRaw('LOWER(faculties.`name`) LIKE ?', '%'.strtolower($name))
                                    ->orWhereRaw('LOWER(faculties.`name`) LIKE ?', '%'.strtolower($name).'%')
                                    ->orWhereRaw('LOWER(faculties.`name`) LIKE ?', strtolower($name).'%')
                                    ->select('faculties.*', 'universities.name as university_name')->get();

        return view('pages.faculties')->with([
            'faculties' => $faculties
        ]);
    }

    public function department_search(Request $request)
    {
        $name = $request->keyword;
        $departments = DB::table('departments')->join('universities', 'departments.university_id', '=', 'universities.id')
                                    ->join('faculties', 'departments.faculty_id', '=', 'faculties.id')
                                    ->whereRaw('LOWER(departments.`name`) LIKE ?', '%'.strtolower($name))
                                    ->orWhereRaw('LOWER(departments.`name`) LIKE ?', '%'.strtolower($name).'%')
                                    ->orWhereRaw('LOWER(departments.`name`) LIKE ?', strtolower($name).'%')
                                    ->select('departments.*', 'universities.name as university_name', 'faculties.name as faculty_name')->get();

        return view('pages.departments')->with([
            'departments' => $departments
        ]);
    }

    public function volunteers()
    {
        $volunteers = DB::table('employees')
                        ->join('universities', 'employees.university_id', '=', 'universities.id')
                        ->join('faculties', 'employees.faculty_id', '=', 'faculties.id')
                        ->join('departments', 'employees.faculty_id', '=', 'departments.id')
                        ->where('emp_type', 'student')
                        ->select('employees.*', 'universities.name as university_name', 'faculties.name as faculty_name', 'departments.name as department_name')->get();

        return view('pages.volunteers')->with([
            'volunteers' => $volunteers,
        ]);
    }

    public function volunteers_search(Request $request)
    {
        $name = $request->keyword;
        $volunteers = DB::table('employees')
                        ->join('universities', 'employees.university_id', '=', 'universities.id')
                        ->join('faculties', 'employees.faculty_id', '=', 'faculties.id')
                        ->join('departments', 'employees.faculty_id', '=', 'departments.id')
                        ->whereRaw('LOWER(employees.`fullname`) LIKE ?', '%'.strtolower($name))
                        ->orWhereRaw('LOWER(employees.`fullname`) LIKE ?', '%'.strtolower($name).'%')
                        ->orWhereRaw('LOWER(employees.`fullname`) LIKE ?', strtolower($name).'%')
                        ->where('emp_type', 'student')
                        ->select('employees.*', 'universities.name as university_name', 'faculties.name as faculty_name', 'departments.name as department_name')->get();

        return view('pages.volunteers')->with([
            'volunteers' => $volunteers,
        ]);
    }

    public function professors()
    {
        $professors = DB::table('employees')
                        ->join('universities', 'employees.university_id', '=', 'universities.id')
                        ->join('faculties', 'employees.faculty_id', '=', 'faculties.id')
                        ->join('departments', 'employees.faculty_id', '=', 'departments.id')
                        ->where('emp_type', 'professor')
                        ->select('employees.*', 'universities.name as university_name', 'faculties.name as faculty_name', 'departments.name as department_name')->get();

        return view('pages.professors')->with([
            'professors' => $professors,
        ]);
    }

    public function professors_search(Request $request)
    {
        $name = $request->keyword;
        $professors = DB::table('employees')
                        ->join('universities', 'employees.university_id', '=', 'universities.id')
                        ->join('faculties', 'employees.faculty_id', '=', 'faculties.id')
                        ->join('departments', 'employees.faculty_id', '=', 'departments.id')
                        ->whereRaw('LOWER(employees.`fullname`) LIKE ?', '%'.strtolower($name))
                        ->orWhereRaw('LOWER(employees.`fullname`) LIKE ?', '%'.strtolower($name).'%')
                        ->orWhereRaw('LOWER(employees.`fullname`) LIKE ?', strtolower($name).'%')
                        ->where('emp_type', 'professor')
                        ->select('employees.*', 'universities.name as university_name', 'faculties.name as faculty_name', 'departments.name as department_name')->get();

        return view('pages.professors')->with([
            'professors' => $professors,
        ]);
    }

    public function support()
    {
        return view('pages.support');
    }

    public function support_save(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $content = $request->content;

        $supporter_email = '';

        $data = [
            'subject' => 'support',
            'email' => $request->email,
            'content' => $request->content
        ];

        Mail::send('pages.email', $data, function($message) use ($data) {
        $message->to($data['email'])
        ->subject($data['subject']);
        });
        return redirect()->back()->withErrors([
            'alert' =>'Supported successfully.'
        ]);
    }
}
