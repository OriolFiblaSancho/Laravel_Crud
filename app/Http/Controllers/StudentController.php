<?php
namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Courses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
class StudentController extends Controller
{
    public function index()
    {
        $students = Students::with('course')->paginate(5);
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

    public function export(): StreamedResponse
    {
        $students = Students::all();
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename=students.csv',
        ];

        return response()->stream(function() use ($students) {
            $handle = fopen('php://output', 'w');
            // Add BOM to fix UTF-8 in Excel
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            // Header row
            fputcsv($handle, ['ID', 'Name', 'Email', 'Course ID', 'Created At', 'Updated At']);
            // Data rows
            foreach ($students as $student) {
                fputcsv($handle, [
                    $student->id,
                    $student->name,
                    $student->email,
                    $student->course_id,
                    $student->created_at,
                    $student->updated_at,
                ]);
            }
            fclose($handle);
        }, 200, $headers);

    }
    public function destroy(Students $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}