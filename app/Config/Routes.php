<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
 
$routes->setDefaultNamespace('App\Controllers');
 
 
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
//Add Routes Here
//$routes->add('URL ', 'ClassName::FunctionName');
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
//if you didn't set the functionName the default function will be index

//Login Routes
$routes->add('Login', 'Login', ['filter' => 'noauth']);
$routes->add('Login/index', 'Login::index', ['filter' => 'noauth']);
$routes->add('Logout', 'Login::logout');

//Doctor Routes
$routes->add('Doctor', 'Doctor::courses', ['filter' => 'auth']);
$routes->add('Doctor/courses', 'Doctor::courses', ['filter' => 'auth']);
$routes->add('Doctor/edit', 'Doctor::editProfile', ['filter' => 'auth']);
$routes->add('Doctor/profile', 'Doctor::profile', ['filter' => 'auth']);
$routes->add('Doctor/createexam', 'Doctor::createExam', ['filter' => 'auth']);
$routes->add('Doctor/exam', 'Doctor::exam', ['filter' => 'auth']);
$routes->add('Doctor/exam/(:any)', 'Doctor::question/$1', ['filter' => 'auth']);
$routes->add('Doctor/exam-edit', 'Doctor::examEdit', ['filter' => 'auth']);
$routes->add('Doctor/question-edit', 'Doctor::editQuestion', ['filter' => 'auth']);

//Admin Routes
$routes->add('Admin', 'Admin', ['filter' => 'auth']);


//Weal Routes
$routes->get('student', 'Student::index',['filter' => 'auth']);
$routes->get('student/home', 'Student::home',['filter' => 'auth']);
$routes->match(['get','post'],'student/update','Student::update',['filter' => 'auth']);
$routes->match(['get','post'],'student/resetpassword','Student::resetpassword',['filter' => 'auth']);
$routes->post('student/update_pic','Student::update_pic',['filter' => 'auth']);

$routes->get('student/courses', 'Student::courses',['filter' => 'auth']);
$routes->get('student/exams', 'Student::exams',['filter' => 'auth']);
$routes->get('student/report', 'Student::report',['filter' => 'auth']);
$routes->get('student/profile', 'Student::profile',['filter' => 'auth']);
//-------------
//$routes->get('logout', 'Login::logout');
//$routes->get('/login', 'Login::index', ['filter' => 'noauth']);
//$routes->get('/login/index', 'Login::index', ['filter' => 'noauth']);
//$routes->get('/(:any)', 'NOT FOUND');
//END Weal Routes

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
