<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Students::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'course_id' => 'required',
        ]);
        return Students::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $student)
    {
        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $student)
    {
        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email',
            'course_id' => 'sometimes|required',
        ]);
        
        $student->update($request->all());
        return $student;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully'], 200);
    }
}
