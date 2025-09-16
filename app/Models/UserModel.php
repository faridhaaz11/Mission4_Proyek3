<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'email', 'password', 'role', 'full_name', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';

    // Relasi many-to-many dengan courses
    public function courses()
    {
        return $this->belongsToMany('App\Models\CourseModel', 'user_courses', 'user_id', 'course_id');
    }
}