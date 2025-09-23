<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'LoginController::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login/process', 'LoginController::process');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/dashboard', 'DashboardController::index', ['as' => 'dashboard']);

$routes->get('/manage-users', 'ManageController::users');
$routes->get('/manage-users/add', 'ManageController::addUser');
$routes->post('/manage-users/add', 'ManageController::addUser');
$routes->get('/manage-users/delete/(:num)', 'ManageController::deleteUser/$1');

$routes->get('/manage-courses', 'AdminController::manageCourses');
$routes->get('/manage-courses/add', 'AdminController::addCourseForm');
$routes->post('/manage-courses/add', 'AdminController::saveCourse');
$routes->get('/manage-courses/edit/(:num)', 'AdminController::editCourseForm/$1');
$routes->post('/manage-courses/update/(:num)', 'AdminController::updateCourse/$1'); // Perbaiki rute ini
$routes->get('/manage-courses/delete/(:num)', 'AdminController::deleteCourse/$1');

$routes->get('/mahasiswa', 'MahasiswaController::index', ['as' => 'mahasiswa']);
$routes->get('/mahasiswa/create', 'MahasiswaController::create');
$routes->post('/mahasiswa/store', 'MahasiswaController::store');
$routes->get('/mahasiswa/edit/(:any)', 'MahasiswaController::edit/$1');
$routes->post('/mahasiswa/update/(:any)', 'MahasiswaController::update/$1');
$routes->get('/mahasiswa/delete/(:any)', 'MahasiswaController::delete/$1');
$routes->get('/mahasiswa/view/(:any)', 'MahasiswaController::view/$1');

// Rute untuk mahasiswa (halaman ambil mata kuliah)
$routes->get('/mahasiswa/enroll', 'StudentController::enrollCourses');
$routes->post('/mahasiswa/enroll/store', 'StudentController::storeEnroll');

// Rute untuk menampilkan daftar mata kuliah mahasiswa
$routes->get('/mahasiswa/view-enrolled', 'StudentController::viewEnrolledCourses');
$routes->get('/student/my-courses', 'CourseController::myCourses');

$routes->get('/mahasiswa/delete-enrolled/(:num)', 'StudentController::deleteEnrolledCourse/$1');


//$routes->get('/mahasiswa/view-enrolled', 'StudentController::viewEnrolledCourses');
//$routes->get('/mahasiswa/enroll', 'StudentController::enrollCourses');
//$routes->post('/mahasiswa/enroll/store', 'StudentController::storeEnroll');

//$routes->get('view-courses', 'CourseController::index');
//$routes->get('take-course', 'CourseController::take');
//$routes->post('take-course', 'CourseController::store');
//$routes->get('enroll-course', 'CourseController::take');
//$routes->post('enroll-course', 'CourseController::store');
//$routes->get('courses/enroll/(:segment)', 'CourseController::enroll/$1');
//$routes->get('/mahasiswa/view-enrolled', 'CourseController::viewEnrolled');
//$routes->get('/student/my-courses', 'CourseController::myCourses');
