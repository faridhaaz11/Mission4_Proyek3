<?php
namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id'; // Sesuaikan dengan primary key di tabelmu
    protected $allowedFields = ['course_name', 'credits'];

    public function getAllCourses()
    {
        return $this->findAll();
    }

    public function getCourseById($id)
    {
        return $this->find($id);
    }
}