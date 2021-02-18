<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\VideoController;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//landing page
Route::get('/', function () {
    return view('landing-page');
});


//student path
Route::get('join-class', function () {
    return view('student/joinclass');
});

Route::get('calendar', function (){
    return view('student.mycalendar');
});

Route::get('classes', function () {
    return view('student.myclasses');
});

Route::get('tasks', function () {
    return view('student.subject-tasks');
});

Route::get('create-class', function () {
    return view('lecturer.createclass');
});

Route::post('/create_subjectcontroller', [SubjectController::class, 'create']);

Route::post('/addTask_subjectcontroller', [SubjectController::class, 'addTask']);

Route::post('/upload_videocontroller', [VideoController::class, 'videoUpload']);

Route::get('/my-class/lecturer', function() {
    $subjects = Subject::where('teacher_id', Auth::id())->get();
    return view('lecturer.myclass', ['subjects' => $subjects]);
});

Route::get('/my-class/student', function() {
    $student_id = User::find(Auth::id());
    $subjects = $student_id->subjects;

    return view('student.myclasses', ['subjects' => $subjects]);
});

Route::get('show/{subject_name}/{subject_code}', [SubjectController::class, 'showSubject']);

Route::get('tasks/{id}', [SubjectController::class, 'showTask']);

Route::get('videos/{id}', [VideoController::class, 'showVideo']);

Route::post('/edit_subjectcontroller', [SubjectController::class, 'edit']);

Route::post('/destroy_subjectcontroller', [SubjectController::class, 'destroy']);

Route::get('/myprofile', [SubjectController::class, 'findSubject']);

Route::get('login-redirect', [LoginController::class, 'index']);

Route::get('class/{subject_name}/{subject_code}', [StudentController::class, 'urlLink']);

Route::get('joinclass/{subject_id}', [StudentController::class, 'joinClass']);

Route::post('/findSubject_studentcontroller', [StudentController::class, 'findSubject']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
