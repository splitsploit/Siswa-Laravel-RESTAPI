<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
