<?php

use Illuminate\Support\Facades\Route;
# use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;
use App\Http\Controllers\Company;
use App\Http\Controllers\University;
use App\Http\Controllers\HR;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::controller(Admin\ProfileController::class)->group(function () {
        Route::get('/admin/profile', 'edit')->name('admin.profile.edit');
        Route::patch('/admin/profile', 'update')->name('admin.profile.update');
        Route::delete('/admin/profile', 'destroy')->name('admin.profile.destroy');
    });

    Route::controller(Student\ProfileController::class)->group(function () {
        Route::get('/student/profile', 'edit')->name('student.profile.edit');
        Route::patch('/student/profile', 'update')->name('student.profile.update');
        Route::delete('/student/profile', 'destroy')->name('student.profile.destroy');
    });

    Route::controller(Student\AttendanceController::class)->group(function () {
        Route::get('/trainee/attendance/', 'index')->name('student.attendance.index');
    });

    Route::controller(Student\LinksController::class)->group(function () {
        Route::get('/trainee/links/', 'index')->name('student.links.index');
    });

    Route::controller(Company\AttendanceController::class)->group(function () {
        Route::get('/trainee/{id}/attendance/', 'index')->name('company.attendance.index');
        Route::get('/trainee/{id}/attendance/create', 'create')->name('company.attendance.insert');
        Route::patch('/trainee/{id}/attendance/create', 'store')->name('company.attendance.store');
        Route::delete('/trainee/{id}/attendance/', 'destroy')->name('company.attendance.destroy');
        Route::get('/trainee/attendance/edit/{id}', 'edit')->name('company.attendance.edit');
        Route::post('/trainee/attendance/update/{id}', 'update')->name('company.attendance.update');
    });

    Route::controller(Company\LinksController::class)->group(function () {
        Route::get('/trainee/{id}/links/', 'index')->name('company.links.index');
         Route::get('/trainee/{id}/links/create', 'create')->name('company.links.insert');
        Route::patch('/trainee/{id}/links/create', 'store')->name('company.links.store');
      Route::delete('/trainee/{id}/links/', 'destroy')->name('company.links.destroy');
         Route::get('/trainee/links/edit/{id}/{std}', 'edit')->name('company.links.edit');
        Route::post('/trainee/links/update/{id}', 'update')->name('company.links.update');
    });

    Route::controller(Company\HREvaluationController::class)->group(function () {
        Route::get('/hr/{id}/evaluation/', 'index')->name('hr.evaluation.index');
/*         Route::get('/trainee/{id}/attendance/create', 'create')->name('company.attendance.insert');
        Route::patch('/trainee/{id}/attendance/create', 'store')->name('company.attendance.store');
        Route::delete('/trainee/{id}/attendance/', 'destroy')->name('company.attendance.destroy');
        Route::get('/trainee/attendance/edit/{id}', 'edit')->name('company.attendance.edit');
        Route::post('/trainee/attendance/update/{id}', 'update')->name('company.attendance.update'); */
    });

    Route::controller(Company\ProfileController::class)->group(function () {
        Route::get('/company_mentor/profile', 'edit')->name('company.profile.edit');
        Route::patch('/company_mentor/profile', 'update')->name('company.profile.update');
        Route::delete('/company_mentor/profile', 'destroy')->name('company.profile.destroy');
    });

    Route::controller(University\ProfileController::class)->group(function () {
        Route::get('/university_mentor/profile', 'edit')->name('university.profile.edit');
        Route::patch('/university_mentor/profile', 'update')->name('university.profile.update');
        Route::delete('/university_mentor/profile', 'destroy')->name('university.profile.destroy');
    });

    Route::controller(HR\ProfileController::class)->group(function () {
        Route::get('/hr/profile', 'edit')->name('hr.profile.edit');
        Route::patch('/hr/profile', 'update')->name('hr.profile.update');
        Route::delete('/hr/profile', 'destroy')->name('hr.profile.destroy');
    });

    Route::controller(Admin\TraineesController::class)->group(function () {
        Route::get('/admin/trainees', 'index')->name('admin.trainees.index');
        Route::get('/admin/trainees/create', 'create')->name('admin.trainees.insert');
        Route::patch('/admin/trainees/create', 'store')->name('admin.trainees.store');
        Route::delete('/admin/trainee/delete/{id}', 'destroy')->name('admin.trainees.destroy');
        Route::get('/admin/trainee/view/{id}', 'view')->name('admin.trainees.view');
        Route::get('/admin/trainee/edit/{id}', 'edit')->name('admin.trainees.edit');
        Route::post('/admin/trainee/update/{id}', 'update')->name('admin.trainees.update');
    });

    Route::controller(Admin\HRController::class)->group(function () {
        Route::get('/admin/hr', 'index')->name('admin.hr.index');
        Route::get('admin.hr.create', 'create')->name('admin.hr.create');
        Route::post('admin.hr.create', 'store');
        Route::delete('/admin/hr/delete/{id}', 'destroy')->name('admin.hr.destroy');
        Route::get('/admin/hr/view/{id}', 'view')->name('admin.hr.view');
        Route::get('/admin/hr/edit/{id}', 'edit')->name('admin.hr.edit');
        Route::post('/admin/hr/update/{id}', 'update')->name('admin.hr.update');
    });

    Route::controller(Admin\CompanyController::class)->group(function () {
        Route::get('/admin/company_mentor', 'index')->name('admin.company.index');
        Route::get('admin.company.create', 'create')->name('admin.company.create');
        Route::post('admin.company.create', 'store');
        Route::post('/admin/company_mentor/{id}/trainee/add', 'store_trainee')->name('admin.company.add_trainees');
        Route::delete('/admin/company_mentor/delete/{id}', 'destroy')->name('admin.company.destroy');
        Route::get('/admin/company_mentor/view/{id}', 'view')->name('admin.company.view');
        Route::get('/admin/company_mentor/edit/{id}', 'edit')->name('admin.company.edit');
        Route::post('/admin/company_mentor/update/{id}', 'update')->name('admin.company.update');
    });

    Route::controller(Admin\UniversityController::class)->group(function () {
        Route::get('/admin/university_mentor', 'index')->name('admin.university.index');
        Route::get('admin.university.create', 'create')->name('admin.university.create');
        Route::post('admin.university.create', 'store');
        Route::post('/admin/university_mentor/{id}/trainee/add', 'store_trainee')->name('admin.university.add_trainees');
        Route::delete('/admin/university_mentor/delete/{id}', 'destroy')->name('admin.university.destroy');
        Route::get('/admin/university_mentor/view/{id}', 'view')->name('admin.university.view');
        Route::get('/admin/university_mentor/edit/{id}', 'edit')->name('admin.university.edit');
        Route::patch('/admin/university_mentor/update/{id}', 'update')->name('admin.university.update');
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
