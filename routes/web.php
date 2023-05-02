<?php

use Illuminate\Support\Facades\Route;
# use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('student.dashboard');

Route::get('/hr/dashboard', function () {
    return view('hr.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('hr.dashboard');

Route::get('/company/dashboard', function () {
    return view('company.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('company.dashboard');

Route::get('/university/dashboard', function () {
    return view('university.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('university.dashboard');

Route::get('/admin/trainees/insert', function () {
    return view('admin.trainee.insert');
})
    ->middleware(['auth', 'verified'])
    ->name('admin.trainees.insert');

Route::get('/admin/company_mentor/insert', function () {
    return view('admin.company.insert');
})
    ->middleware(['auth', 'verified'])
    ->name('admin.company.insert');

Route::get('/admin/university_mentor/insert', function () {
    return view('admin.university.insert');
})
    ->middleware(['auth', 'verified'])
    ->name('admin.university.insert');

Route::get('/admin/hr/insert', function () {
    return view('admin.hr.insert');
})
    ->middleware(['auth', 'verified'])
    ->name('admin.hr.insert');

Route::middleware('auth')->group(function () {
    /*     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */
    Route::controller(Admin\ProfileController::class)->group(function () {
        Route::get('/admin/profile', 'edit')->name('admin.profile.edit');
        Route::patch('/admin/profile', 'update')->name('admin.profile.update');
        Route::delete('/admin/profile', 'destroy')->name('admin.profile.destroy');
    });
    Route::controller(Admin\TraineesController::class)->group(function () {
        Route::get('/admin/trainees', 'index')->name('admin.trainees.index');
        Route::get('admin.trainees.create', 'create')->name('admin.trainees.create');
        Route::post('admin.trainees.create', 'store');
        Route::delete('/admin/trainee/delete/{id}', 'destroy')->name('admin.trainees.destroy');
    });

    Route::controller(Admin\HRController::class)->group(function () {
        Route::get('/admin/hr', 'index')->name('admin.hr.index');
        Route::get('admin.hr.create', 'create')->name('admin.hr.create');
        Route::post('admin.hr.create', 'store');
        Route::delete('/admin/hr/delete/{id}', 'destroy')->name('admin.hr.destroy');
    });

    Route::controller(Admin\CompanyController::class)->group(function () {
        Route::get('/admin/company_mentor', 'index')->name('admin.company.index');
        Route::get('admin.company.create', 'create')->name('admin.company.create');
        Route::post('admin.company.create', 'store');
        Route::post('/admin/company_mentor/{id}/trainee/add', 'store_trainee')->name('admin.company.add_trainees');
        Route::delete('/admin/company_mentor/delete/{id}', 'destroy')->name('admin.company.destroy');
    });

    Route::controller(Admin\CompanyController::class)->group(function () {
        Route::get('/admin/university_mentor', 'index')->name('admin.university.index');
        Route::get('admin.university.create', 'create')->name('admin.university.create');
        Route::post('admin.university.create', 'store');
        Route::post('/admin/university_mentor/{id}/trainee/add', 'store_trainee')->name('admin.university.add_trainees');
        Route::delete('/admin/university_mentor/delete/{id}', 'destroy')->name('admin.university.destroy');
    });
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})
    ->middleware(['auth'])
    ->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})
    ->middleware(['auth'])
    ->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})
    ->middleware(['auth'])
    ->name('buttons.text-icon');

require __DIR__ . '/auth.php';
