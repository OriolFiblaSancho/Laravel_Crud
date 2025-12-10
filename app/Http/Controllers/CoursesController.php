<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Courses::latest()->paginate(5);
        return view('courses.index', compact('courses'));
    }
    public function create()
    {
        return view('courses.create');
    }
    public function store(Request $request)
    {
        $request->validate([
        //request ?
            'name' => 'required',
        ]);
        Courses::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }
    public function show(Courses $course)
    {
        return view('courses.show', compact('course'));
    }
    public function edit(Courses $course)
    {
        return view('courses.edit', compact('course'));
    }
    public function update(Request $request, Courses $course)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }
    public function destroy(Courses $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function export(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $courses = Courses::all();
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename=courses.csv',
        ];

        return response()->stream(function() use ($courses) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Created At', 'Updated At']);

            foreach ($courses as $course) {
                fputcsv($handle, [$course->id, $course->name, $course->created_at, $course->updated_at]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
