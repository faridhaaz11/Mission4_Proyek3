<?php
namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $allowedFields = ['user_id', 'entry_year'];

    public function getStudentByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}