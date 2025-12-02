<?php
namespace App\Http\Controllers;
// namespace ?
use App\Models\Students;
use App\Models\Courses;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    public function index()
    {
        $students = Students::latest()->paginate(5);
        return view('students.index', compact('students'));
    }
    public function create()
    {
        $courses = Courses::all();
        return view('students.create', compact('courses'));
    }
    public function store(Request $request)
    {
        $request->validate([
        //request ?
            'name' => 'required',
            'email' => 'required',
            'course_id' => 'required',
        ]);
        Students::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }
    public function show(Students $student)
    {
        return view('students.show', compact('student'));
    }
    public function edit(Students $student)
    {
        $courses = Courses::all();
        return view('students.edit', compact('student', 'courses'));
    }
    public function update(Request $request, Students $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'course' => 'required',
        ]);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }
    public function destroy(Students $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}