<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/course/{id}', [App\Http\Controllers\CourseController::class, 'index']);
Route::post('/courses/image-upload', [App\Http\Controllers\CoursesController::class, 'imageUploadPost']);
Route::post('/courses', [App\Http\Controllers\CoursesController::class, 'coursesPost']);
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/room', [App\Http\Controllers\RoomController::class, 'index'])->name('room');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/groups', [App\Http\Controllers\GroupsController::class, 'index'])->name('groups');
Route::post('/groups', [App\Http\Controllers\GroupsController::class, 'groupsPost'])->name('groups.post');
Route::get('/group/{id}', [App\Http\Controllers\GroupController::class, 'index'])->name('group');
Route::delete('/group/{id}', [App\Http\Controllers\GroupController::class, 'delete']);
Route::post('/group/{id}/students', [App\Http\Controllers\GroupController::class, 'manageStudents'])->name('group.post');
Route::get('/group/{id}/users/download', [App\Http\Controllers\GroupController::class, 'downloadUsersList']);

Route::get('/teams', [App\Http\Controllers\TeamsController::class, 'index'])->name('teams');
Route::post('/teams', [App\Http\Controllers\TeamsController::class, 'teamsPost'])->name('teams.post');
Route::get('/team/{id}', [App\Http\Controllers\TeamController::class, 'index'])->name('team');
Route::delete('/team/{id}', [App\Http\Controllers\TeamController::class, 'delete']);
Route::post('/team/{id}/students', [App\Http\Controllers\TeamController::class, 'manageStudents'])->name('team.post');
Route::get('/team/{id}/users/download', [App\Http\Controllers\TeamController::class, 'downloadUsersList']);

Route::post('team/{team_id}/student/{id}/rating', [App\Http\Controllers\TeamController::class, 'rateStudent']);

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::get('/professors', [App\Http\Controllers\ProfessorsController::class, 'index'])->name('professors');
Route::post('/professors', [App\Http\Controllers\ProfessorsController::class, 'uploadProfessors'])->name('professors.post');
Route::delete('/professors/professor/{id}', [App\Http\Controllers\ProfessorsController::class, 'delete']);
Route::get('/professors/download', [App\Http\Controllers\ProfessorsController::class, 'downloadProfessorsList']);
Route::post('/file-upload', [App\Http\Controllers\FileUploadController::class, 'fileUploadPost'])->name('file.upload.post');

Route::post('/room/student/{id}/project/{project_id}', [App\Http\Controllers\RoomController::class, 'assignProject']);
Route::delete('/room/student/{id}/project/{project_id}', [App\Http\Controllers\RoomController::class, 'deleteAssignedProject']);
Route::delete('/room/student/{id}', [App\Http\Controllers\RoomController::class, 'delete']);
Route::get('/room/students/download', [App\Http\Controllers\RoomController::class, 'downloadStudentsList'])->name('download.students.list');

Route::get('/forum/t/{id}/like', [App\Http\Controllers\ForumThreadLikeController::class, 'index']);
Route::post('/forum/t/{id}/like', [App\Http\Controllers\ForumThreadLikeController::class, 'likeForumThread']);
Route::delete('/forum/t/{id}/like', [App\Http\Controllers\ForumThreadLikeController::class, 'deleteLikeForumThread']);