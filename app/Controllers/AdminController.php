<?php
namespace App\Controllers;

use App\Models\CourseModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $session;
    protected $courseModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->courseModel = new CourseModel();

        if (!$this->session->get('role') || $this->session->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya admin yang boleh akses.');
        }
    }

    public function manageCourses()
    {
        $data['courses'] = $this->courseModel->getAllCourses();
        return view('admin/manage_courses', $data);
    }

    public function addCourseForm()
    {
        return view('admin/add_course');
    }

    public function saveCourse()
    {
        $data = [
            'course_name' => $this->request->getPost('course_name'),
            'credits' => $this->request->getPost('credits')
        ];

        if (empty($data['course_name']) || empty($data['credits'])) {
            return redirect()->back()->with('error', 'Semua field harus diisi.');
        }

        $this->courseModel->insert($data);
        return redirect()->to('/manage-courses')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function editCourseForm($id)
    {
        $data['course'] = $this->courseModel->getCourseById($id);
        if (!$data['course']) {
            return redirect()->to('/manage-courses')->with('error', 'Course tidak ditemukan.');
        }
        return view('admin/edit_course', $data);
    }

    public function updateCourse($id)
    {
        $data = [
            'course_name' => $this->request->getPost('course_name'),
            'credits' => $this->request->getPost('credits')
        ];

        if (empty($data['course_name']) || empty($data['credits'])) {
            return redirect()->back()->with('error', 'Semua field harus diisi.');
        }

        $this->courseModel->update($id, $data);
        return redirect()->to('/manage-courses')->with('success', 'Mata kuliah berhasil diupdate.');
    }

    public function deleteCourse($id)
    {
        $this->courseModel->delete($id);
        return redirect()->to('/manage-courses')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}