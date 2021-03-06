<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/*
 |--------------------------------------------------------------------------
 | My Custom Defines and Variables FOR VIEWS
 |--------------------------------------------------------------------------
 */
 //SESSION CONSTANTS

 //LOGIN VIEWS CONSTANTS
defined('LOGIN_VIEW') || define('LOGIN_VIEW', 'login/loginView');

 //DOCTOR VIEWS CONSTANTS
 defined('DR_HEADER_VIEW') || define('DR_HEADER_VIEW', 'doctor/templates/header');
defined('DR_FOOTER_VIEW') || define('DR_FOOTER_VIEW', 'doctor/templates/footer');
defined('DR_DASHBOARD') || define('DR_DASHBOARD', 'doctor/dashboard/dashboardView');
defined('DR_PROFILE') || define('DR_PROFILE', 'doctor/dr_profile/profileView');
defined('CREATE_EXAM') || define('CREATE_EXAM', 'doctor/exam/createExam');
defined('CREATE_QUESTION') || define('CREATE_QUESTION', 'doctor/exam/question/createQuestions');
defined('SHOW_EXAM') || define('SHOW_EXAM', 'doctor/exam/showExams');
defined('SHOW_Questions') || define('SHOW_Questions', 'doctor/exam/question/showQuestions');
defined('EDIT_EXAM') || define('EDIT_EXAM', 'doctor/exam/editExam');
defined('EDIT_QUESTION') || define('EDIT_QUESTION', 'doctor/exam/question/editQuestion');


 //ADMIN VIEWS CONSTANTS
 defined('ADMIN_ID') || define('ADMIN_ID', 'admin_id');
defined('ADMIN_HEADER_VIEW') || define('ADMIN_HEADER_VIEW', 'admin/templates/header');
defined('ADMIN_FOOTER_VIEW') || define('ADMIN_FOOTER_VIEW', 'admin/templates/footer');
defined('ADMIN_DASHBOARD') || define('ADMIN_DASHBOARD', 'admin/dashboardView');
defined('ADMIN_CURRENT_EXAM') || define('ADMIN_CURRENT_EXAM', 'admin/currentExam');
//defined('ADMIN_VERIFY_EXAM') || define('ADMIN_VERIFY_EXAM', 'admin/verifyExam/verifyExams');
defined('ADMIN_PROFILE') || define('ADMIN_PROFILE', 'admin/profileView');



//$GLOBALS['footer'] = 'templates/footer';



//Wael CONSTANTS------------------------------------
//STUDENT VIEWS CONSTANTS
// defined('STU_HEADER') || define('STU_HEADER', 'student/templates/header.php');
// defined('STU_FOOTER') || define('STU_FOOTER', 'student/templates/footer.php');


defined('stu_courses') || define('stu_courses', 'student/courses');
defined('stu_exams') || define('stu_exams', 'student/exams');
defined('stu_exam') || define('stu_exam', 'student/exam');
defined('stu_exam_info') || define('stu_exam_info', 'student/exam_info');
defined('stu_report') || define('stu_report', 'student/report');
defined('stu_profile') || define('stu_profile', 'student/profile');
defined('stu_edit_profile') || define('stu_edit_profile', 'student/edit_profile');
defined('stu_resetpassword') || define('stu_resetpassword', 'student/resetpassword');
defined('stu_welcome_message') || define('stu_welcome_message', 'student/welcome_message.php');



