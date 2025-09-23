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
        $data['enrolledIds'] = !empty($enrolledCourses) ? array_column($enrolledCourses, 'course_id') : [];
        
        return view('mahasiswa/enroll_courses', $data);
    }

    // Proses enroll (POST)
    public function storeEnroll()
    {
        $courseIds = $this->request->getPost('course_id');
        $userId = $this->session->get('user_id');
        $student = $this->studentModel->where('user_id', $userId)->first();

        if (!$student || empty($courseIds)) {
            return redirect()->back()->with('error', 'Pilih setidaknya satu mata kuliah.');
        }

        $successCount = 0;
        $errorMessages = [];
        
        foreach ($courseIds as $courseId) {
            if ($this->takeModel->enrollCourse($student['student_id'], $courseId)) {
                $successCount++;
            } else {
                // Tambahkan pesan error ke array
                $errorMessages[] = "Mata kuliah dengan ID {$courseId} sudah diambil.";
            }
        }
        
        $finalMessage = '';
        if ($successCount > 0) {
            $finalMessage .= "Berhasil mengambil {$successCount} mata kuliah.";
        }
        
        if (!empty($errorMessages)) {
            // Gabungkan pesan error dengan pesan sukses (jika ada)
            $finalMessage .= (!empty($finalMessage) ? '<br>' : '') . implode('<br>', $errorMessages);
            return redirect()->to('/mahasiswa/enroll')->with('error', $finalMessage);
        } else {
            return redirect()->to('/mahasiswa/enroll')->with('success', $finalMessage);
        }
    }

    public function deleteEnrolledCourse($courseId)
{
    $userId = $this->session->get('user_id');
    $student = $this->studentModel->where('user_id', $userId)->first();

    if (!$student) {
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    $this->takeModel->where('student_id', $student['student_id'])
                    ->where('course_id', $courseId)
                    ->delete();

    return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus.');
}
}