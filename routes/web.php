<?php

use App\Http\Controllers\TeachingController;
use App\Http\Controllers\VideoUploadController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Admin Dashboard ==========/
Route::get('dashboard', function() {
    return Inertia::render("Admin/Dashboard");
})->name("admin");


// Admin Teachings ===================/
Route::resource('teachings', TeachingController::class);



// // Video Upload ================== /

Route::post('teaching_upload_video', [VideoUploadController::class, 'teaching_upload_video'])->name("teaching_upload_video");

Route::post('upload_video_yt', [VideoUploadController::class, 'upload_video_yt'])->name("upload_video_yt");



Route::get('phpinfo', function() {
    return phpinfo();
});



Route::get('/', function() {
    return Inertia::render("Homepage");
})->name("home");

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';
