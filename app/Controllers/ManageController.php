<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CourseModel;

class ManageController extends BaseController
{
    protected $userModel;
    protected $courseModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->courseModel = new CourseModel();
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
    }

    // Manage Users
    public function users()
    {
        $data = [
            'users' => $this->userModel->findAll(),
            'title' => 'Kelola Pengguna'
        ];
        return view('manage_users', $data);
    }


    
    public function enrollCourse()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $userId = session()->get('user_id');
    $courseId = $this->request->getGet('course_id');

    if ($courseId) {
        $user = $this->userModel->find($userId);
        $course = $this->courseModel->find($courseId);

        if ($user && $course && !$user->courses()->where('course_id', $courseId)->first()) {
            $user->courses()->attach($courseId);
            return redirect()->to('/view-courses')->with('success', 'Berhasil mendaftar mata kuliah.');
        } else {
            return redirect()->to('/view-courses')->with('error', 'Gagal mendaftar atau sudah terdaftar.');
        }
    }

    $data = [
        'courses' => $this->courseModel->findAll(),
        'title' => 'Daftar Mata Kuliah'
    ];
    return view('enroll_course', $data);
}
}