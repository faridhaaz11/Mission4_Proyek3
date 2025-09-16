<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\TakeModel;
use App\Models\StudentModel;
use CodeIgniter\Controller;

class CourseController extends Controller
{
    protected $courseModel;
    protected $takeModel;
    protected $studentModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->takeModel = new TakeModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $data['courses'] = $this->courseModel->findAll();
        return view('courses/index', $data);
    }

    public function take()
    {
        $data['courses'] = $this->courseModel->findAll();
        return view('courses/take', $data);
    }

    public function store()
    {
        $userId = session()->get('user_id');
        $student = $this->studentModel->getStudentByUserId($userId);
        if (!$student) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan. Hubungi admin.');
        }

        $this->takeModel->insert([
            'student_id' => $student['student_id'],
            'course_id'  => $this->request->getPost('course_id'),
            'enroll_date' => date('Y-m-d')
        ]);
        return redirect()->to('/student/my-courses')->with('success', 'Mata kuliah berhasil diambil'); // Arahkan ke halaman baru
    }

    public function enroll($courseId)
    {
        $userId = session()->get('user_id');
        $student = $this->studentModel->getStudentByUserId($userId);
        if (!$student) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan. Hubungi admin.');
        }

        $this->takeModel->insert([
            'student_id'  => $student['student_id'],
            'course_id'   => $courseId,
            'enroll_date' => date('Y-m-d'),
        ]);

        return redirect()->to('/student/my-courses')->with('success', 'Mata kuliah berhasil diambil.');
    }

    public function viewEnrolled()
    {
        $userId = session()->get('user_id');
        $student = $this->studentModel->getStudentByUserId($userId);
        if (!$student) {
            return redirect()->to('/dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $enrolledCourses = $this->takeModel->getEnrolledCourses($student['student_id']);
        $data['enrolledCourses'] = $enrolledCourses;
        return view('courses/view_enrolled', $data);
    }

    public function myCourses()
    {
        $userId = session()->get('user_id');
        $student = $this->studentModel->getStudentByUserId($userId);
        if (!$student) {
            return redirect()->to('/dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $enrolledCourses = $this->takeModel->getEnrolledCourses($student['student_id']);
        $data['enrolledCourses'] = $enrolledCourses;
        return view('student/my_courses', $data); // Gunakan file baru
    }
}