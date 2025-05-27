<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);
        $student = Student::create($validated);

        return response()->json($student, 201);
    }

    public function show(string $id)
    {
        $student = Student::find($id);
        if (!$student) return response()
            ->json(['message' => 'Student Not found'], 404);
        return $student;
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student Not found'], 404);
        $validated = $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);
        $student->update($validated);
        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        
        if (!$student) return response()->json(['message' => 'Student Not found'], 404);
        
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
