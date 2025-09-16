<?php
namespace App\Models;

use CodeIgniter\Model;

class TakeModel extends Model
{
    protected $table = 'takes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'course_id', 'enroll_date'];

    public function getEnrolledCourses($studentId)
    {
        $builder = $this->db->table('takes');
        $builder->select('courses.course_id, courses.course_name, courses.credits, takes.enroll_date'); // Pastikan kolom ini ada
        $builder->join('courses', 'courses.course_id = takes.course_id', 'left'); // Gunakan LEFT JOIN untuk debug
        $builder->where('takes.student_id', $studentId);
        $result = $builder->get()->getResultArray();

        // Debug: Cek isi array
        if (empty($result)) {
            log_message('debug', 'No enrolled courses found for student_id: ' . $studentId);
        } else {
            log_message('debug', 'Enrolled courses: ' . print_r($result, true));
        }

        return $result;
    }

    public function getAllCourses()
    {
        $courseModel = new \App\Models\CourseModel();
        return $courseModel->findAll();
    }

    public function enrollCourse($studentId, $courseId)
    {
        $existing = $this->where('student_id', $studentId)
                         ->where('course_id', $courseId)
                         ->first();
        if ($existing) {
            return false;
        }

        $data = [
            'student_id' => $studentId,
            'course_id' => $courseId,
            'enroll_date' => date('Y-m-d')
        ];
        return $this->insert($data);
    }
}