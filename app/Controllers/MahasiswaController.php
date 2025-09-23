<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Kelola Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->findAll()
        ];

        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Mahasiswa',
            'validation' => \Config\Services::validation()
        ];

        return view('mahasiswa/create', $data);
    }

    public function store()
    {
        //dd('store masuk', $this->request->getPost());
        
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $rules = [
            'nim' => 'required|min_length[10]|max_length[10]',
            'nama_lengkap' => 'required|min_length[3]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'tanggal_lahir' => 'required|valid_date',
            'umur' => 'required|integer|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/mahasiswa/create')->withInput()->with('validation', $this->validator);
        }

        $model = new MahasiswaModel();
        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'umur' => $this->request->getPost('umur')
        ];

        $model->insert($data);

        $this->mahasiswaModel->save($data);
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit($nim)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->find($nim),
            'validation' => \Config\Services::validation()
        ];

        return view('mahasiswa/edit', $data);
    }

    public function update($nim)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'tanggal_lahir' => 'required|valid_date',
            'umur' => 'required|integer|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/mahasiswa/edit/' . $nim)->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'umur' => $this->request->getPost('umur')
        ];

        $this->mahasiswaModel->update($nim, $data);
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil diupdate.');
    }

    public function delete($nim)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $this->mahasiswaModel->delete($nim);
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    public function view($nim)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Detail Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->find($nim)
        ];

        return view('mahasiswa/view', $data);
    }
}