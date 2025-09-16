<?php
namespace App\Controllers;

use App\Models\TakeModel;
use App\Models\StudentModel;
use CodeIgniter\Controller;

class StudentController extends Controller
{
    protected $session;
    protected $takeModel;
    protected $studentModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->takeModel = new TakeModel();
        $this->studentModel = new StudentModel();

        // Proteksi: Hanya mahasiswa
        if (!$this->session->get('role') || $this->session->get('role') !== 'mahasiswa') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya mahasiswa yang boleh akses.');
        }
    }

    // Lihat Mata Kuliah (yang diambil saja)
    public function viewEnrolledCourses()
    {
        $userId = $this->session->get('user_id');
        $student = $this->studentModel->where('user_id', $userId)->first();
        if (!$student) {
            return redirect()->to('/dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $data['enrolledCourses'] = $this->takeModel->getEnrolledCourses($student['id']);
        return view('mahasiswa/view_enrolled', $data);
    }

    // Ambil Mata Kuliah (daftar semua + form enroll)
    public function enrollCourses()
    {
        $userId = $this->session->get('user_id');
        $student = $this->studentModel->where('user_id', $userId)->first();
        if (!$student) {
            return redirect()->to('/dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $data['allCourses'] = $this->takeModel->getAllCourses();
        $enrolledCourses = $this->takeModel->getEnrolledCourses($student['student_id']);
        $data['enrolledIds'] = !empty($enrolledCourses) ? array_column($enrolledCourses, 'course_id') : []; // Pastikan tidak error jika kosong
        return view('mahasiswa/enroll_courses', $data);
    }

    // Proses enroll (POST)
    public function storeEnroll()
    {
        $courseId = $this->request->getPost('course_id');
        $userId = $this->session->get('user_id');
        $student = $this->studentModel->where('user_id', $userId)->first();

        if (!$student || empty($courseId)) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        if ($this->takeModel->enrollCourse($student['id'], $courseId)) {
            return redirect()->to('/mahasiswa/enroll')->with('success', 'Mata kuliah berhasil diambil!');
        } else {
            return redirect()->back()->with('error', 'Mata kuliah sudah diambil atau error.');
        }
    }
}