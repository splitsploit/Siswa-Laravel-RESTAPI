<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index () {
        $students = Student::all();

        if ($students->count() > 0) {
            $data = [
                'status' => 200,
                'students' => $students,
            ];
            return response()->json($data, 200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Students Data Not Found!',
        ], 404);
    }
    
    public function create (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            
            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Students Created Successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Error Was Found, Check Again!',
                ], 500);
            }

        }
    }

    public function show ($id) {
        $student = Student::find($id);
            
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student,
            ],200);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Student Not Found!',
        ], 500);
    }

    public function edit ($id) {
        $student = Student::find($id);
            
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student,
            ],200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Student Not Found!',
        ], 404);
    }

    public function update (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            
            $student = Student::find($id);

            $student->update([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Students Updated Successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Such Student Were Found!',
                ], 500);
            }

        }
    }

    public function destroy ($id) {
        $student = Student::find($id);

        if ($student) {
            $student->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully',
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Student Not Found!',
        ], 404);
    }
}

