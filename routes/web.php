<?php

use Illuminate\Support\Facades\Route;
# use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;
use App\Http\Controllers\Company;
use App\Http\Controllers\University;
use App\Http\Controllers\HR;
use Illuminate\Support\Str;
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
    $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->get();

    $mentors = DB::table('users')
        ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
        ->join('student_company', 'company_mentor.ID', '=', 'student_company.mentor_id')
        ->select('student_company.*', 'company_mentor.*', 'users.email', 'users.name')
        ->get();

    $attendances = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', DB::raw('count(attendance.ID) as attendance'))
        ->groupBy('student.ID')
        ->get();

    $attendance = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', 'attendance', 'departure')
        ->get();
    $hours = [];
    foreach ($attendance as $attend) {
        $time = (strtotime($attend->departure) - strtotime($attend->attendance)) / 3600;
        $hours[$attend->ID][] = $time;
    }

    $times = [];
    foreach ($attendance as $attend) {
        $sum = 0;
        foreach ($hours[$attend->ID] as $hour) {
            $sum = $sum + $hour;
        }
        $times[$attend->ID] = $sum;
    }

    $links = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_link', 'student_link.student_id', '=', 'student.ID')
        ->select('student.*', DB::raw('count(student_link.ID) as link'))
        ->groupBy('student.ID')
        ->get();

    $reports = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('report', 'report.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', DB::raw('count(report.ID) as report'))
        ->groupBy('student.ID')
        ->get();

    $trainees_count = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_company', 'student.ID', '=', 'student_company.student_id')
        ->join('company_mentor', 'student_company.mentor_id', '=', 'company_mentor.ID')
        ->get();

    $years = ['2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030'];
    $departments = ['Human Resources', 'Information Technology', 'Accounts - Real Estate', 'Accounts - BTH', 'Investment'];
    $data = [];
    $dept = 0;
    foreach ($departments as $department) {
        foreach ($years as $year) {
            $i = 0;
            foreach ($trainees_count as $count) {
                if ($count->department == $department && Str::contains($count->created_at, $year)) {
                    $i++;
                }
            }
            $data[$dept][] = $i;
        }
        $dept = $dept + 1;
    }

    return view('admin.dashboard', ['students' => $students, 'mentors' => $mentors, 'links' => $links, 'times' => $times, 'attendances' => $attendances, 'reports' => $reports, 'data' => $data]);
})
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/student/dashboard', function () {
    $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->where('student.user_id', '=', Auth::user()->id)
        ->select('student.*', 'users.email', 'users.name')
        ->groupBy('student.ID')
        ->get();

    $mentors = DB::table('users')
        ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
        ->join('student_company', 'company_mentor.ID', '=', 'student_company.mentor_id')
        ->select('student_company.*', 'company_mentor.*', 'users.email', 'users.name')
        ->get();

    $attendance = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', 'attendance', 'departure')
        ->get();
    $hours = [];
    foreach ($attendance as $attend) {
        $time = (strtotime($attend->departure) - strtotime($attend->attendance)) / 3600;
        $hours[$attend->ID][] = $time;
    }

    $times = [];
    foreach ($attendance as $attend) {
        $sum = 0;
        foreach ($hours[$attend->ID] as $hour) {
            $sum = $sum + $hour;
        }
        $times[$attend->ID] = $sum;
    }

    $links = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_link', 'student_link.student_id', '=', 'student.ID')
        ->where('student.user_id', '=', Auth::user()->id)
        ->select('student.*', DB::raw('count(student_link.ID) as link'))
        ->groupBy('student.ID')
        ->get();

    $reports = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('report', 'report.student_id', '=', 'student.ID')
        ->where('student.user_id', '=', Auth::user()->id)
        ->select('student.*', 'users.email', DB::raw('count(report.ID) as report'))
        ->groupBy('student.ID')
        ->get();

    return view('student.dashboard', ['students' => $students, 'mentors' => $mentors, 'links' => $links, 'times' => $times, 'reports' => $reports]);
})
    ->middleware(['auth', 'verified'])
    ->name('student.dashboard');

Route::get('/hr/dashboard', function () {
    $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->get();

    $mentors = DB::table('users')
        ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
        ->join('student_company', 'company_mentor.ID', '=', 'student_company.mentor_id')
        ->select('student_company.*', 'company_mentor.*', 'users.email', 'users.name')
        ->get();

    $attendances = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', DB::raw('count(attendance.ID) as attendance'))
        ->groupBy('student.ID')
        ->get();

    $attendance = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', 'attendance', 'departure')
        ->get();
    $hours = [];
    foreach ($attendance as $attend) {
        $time = (strtotime($attend->departure) - strtotime($attend->attendance)) / 3600;
        $hours[$attend->ID][] = $time;
    }

    $times = [];
    foreach ($attendance as $attend) {
        $sum = 0;
        foreach ($hours[$attend->ID] as $hour) {
            $sum = $sum + $hour;
        }
        $times[$attend->ID] = $sum;
    }

    $links = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_link', 'student_link.student_id', '=', 'student.ID')
        ->select('student.*', DB::raw('count(student_link.ID) as link'))
        ->groupBy('student.ID')
        ->get();

    $reports = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('report', 'report.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', DB::raw('count(report.ID) as report'))
        ->groupBy('student.ID')
        ->get();

    $trainees_count = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_company', 'student.ID', '=', 'student_company.student_id')
        ->join('company_mentor', 'student_company.mentor_id', '=', 'company_mentor.ID')
        ->get();

    $years = ['2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030'];
    $departments = ['Human Resources', 'Information Technology', 'Accounts - Real Estate', 'Accounts - BTH', 'Investment'];
    $data = [];
    $dept = 0;
    foreach ($departments as $department) {
        foreach ($years as $year) {
            $i = 0;
            foreach ($trainees_count as $count) {
                if ($count->department == $department && Str::contains($count->created_at, $year)) {
                    $i++;
                }
            }
            $data[$dept][] = $i;
        }
        $dept = $dept + 1;
    }

    return view('hr.dashboard', ['students' => $students, 'mentors' => $mentors, 'links' => $links, 'times' => $times, 'attendances' => $attendances, 'reports' => $reports, 'data' => $data]);
})
    ->middleware(['auth', 'verified'])
    ->name('hr.dashboard');

Route::get('/company/dashboard', function () {
    $mentor = DB::table('company_mentor')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

    $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_company', 'student.ID', '=', 'student_company.student_id')
        ->where('student_company.mentor_id', '=', $mentor[0]->ID)
        ->select('student.*', 'users.email', 'users.name')
        ->get();

    $mentors = DB::table('users')
        ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
        ->join('student_company', 'company_mentor.ID', '=', 'student_company.mentor_id')
        ->select('student_company.*', 'company_mentor.*', 'users.email', 'users.name')
        ->get();

    $attendances = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', DB::raw('count(attendance.ID) as attendance'))
        ->groupBy('student.ID')
        ->get();

    $attendance = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', 'attendance', 'departure')
        ->get();
    $hours = [];
    foreach ($attendance as $attend) {
        $time = (strtotime($attend->departure) - strtotime($attend->attendance)) / 3600;
        $hours[$attend->ID][] = $time;
    }

    $times = [];
    foreach ($attendance as $attend) {
        $sum = 0;
        foreach ($hours[$attend->ID] as $hour) {
            $sum = $sum + $hour;
        }
        $times[$attend->ID] = $sum;
    }

    $links = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_company', 'student.ID', '=', 'student_company.student_id')
        ->join('student_link', 'student_link.student_id', '=', 'student.ID')
        ->where('student_company.mentor_id', '=', $mentor[0]->ID)
        ->select('student.*', DB::raw('count(student_link.ID) as link'))
        ->groupBy('student.ID')
        ->get();

    $reports = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_company', 'student.ID', '=', 'student_company.student_id')
        ->join('report', 'report.student_id', '=', 'student.ID')
        ->where('student_company.mentor_id', '=', $mentor[0]->ID)
        ->select('student.*', 'users.email', DB::raw('count(report.ID) as report'))
        ->groupBy('student.ID')
        ->get();

    $trainees_count = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_company', 'student.ID', '=', 'student_company.student_id')
        ->join('company_mentor', 'student_company.mentor_id', '=', 'company_mentor.ID')
        ->where('student_company.mentor_id', '=', $mentor[0]->ID)
        ->get();

    $years = ['2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030'];

    $data = [];
    foreach ($years as $year) {
        $i = 0;
        foreach ($trainees_count as $count) {
            if (Str::contains($count->created_at, $year)) {
                $i++;
            }
        }
        $data[] = $i;
    }

    return view('company.dashboard', ['students' => $students, 'mentors' => $mentors, 'links' => $links, 'times' => $times, 'attendances' => $attendances, 'reports' => $reports, 'data' => $data]);
})
    ->middleware(['auth', 'verified'])
    ->name('company.dashboard');

Route::get('/university/dashboard', function () {

    $mentor = DB::table('university_mentor')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

    $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_university', 'student.ID', '=', 'student_university.student_id')
        ->where('student_university.mentor_id', '=', $mentor[0]->ID)
        ->select('student.*', 'users.email', 'users.name')
        ->get();

    $mentors = DB::table('users')
        ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
        ->join('student_company', 'company_mentor.ID', '=', 'student_company.mentor_id')
        ->select('student_company.*', 'company_mentor.*', 'users.email', 'users.name')
        ->get();

    $attendance = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->leftJoin('attendance', 'attendance.student_id', '=', 'student.ID')
        ->select('student.*', 'users.email', 'users.name', 'attendance', 'departure')
        ->get();
    $hours = [];
    foreach ($attendance as $attend) {
        $time = (strtotime($attend->departure) - strtotime($attend->attendance)) / 3600;
        $hours[$attend->ID][] = $time;
    }

    $times = [];
    foreach ($attendance as $attend) {
        $sum = 0;
        foreach ($hours[$attend->ID] as $hour) {
            $sum = $sum + $hour;
        }
        $times[$attend->ID] = $sum;
    }

    $links = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_university', 'student.ID', '=', 'student_university.student_id')
        ->join('student_link', 'student_link.student_id', '=', 'student.ID')
        ->where('student_university.mentor_id', '=', $mentor[0]->ID)
        ->select('student.*', DB::raw('count(student_link.ID) as link'))
        ->groupBy('student.ID')
        ->get();

    $reports = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_university', 'student.ID', '=', 'student_university.student_id')
        ->join('report', 'report.student_id', '=', 'student.ID')
        ->where('student_university.mentor_id', '=', $mentor[0]->ID)
        ->select('student.*', 'users.email', DB::raw('count(report.ID) as report'))
        ->groupBy('student.ID')
        ->get();

    return view('university.dashboard', ['students' => $students, 'mentors' => $mentors, 'links' => $links, 'times' => $times, 'reports' => $reports]);
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
        Route::get('/trainee/{id}/attendance/export', 'export')->name('student.attendance.export');
    });

    Route::controller(Student\LinksController::class)->group(function () {
        Route::get('/trainee/links/', 'index')->name('student.links.index');
    });

    Route::controller(Student\PlanController::class)->group(function () {
        Route::get('/trainee/plan/', 'index')->name('student.plan.index');
    });

    Route::controller(HR\AttendanceController::class)->group(function () {
        Route::get('/hr/trainee/{id}/attendance/', 'index')->name('hr.attendance.index');
    });

    Route::controller(Admin\AttendanceController::class)->group(function () {
        Route::get('/admin/trainee/{id}/attendance/', 'index')->name('admin.attendance.index');
    });

    Route::controller(University\AttendanceController::class)->group(function () {
        Route::get('/university/trainee/{id}/attendance/', 'index')->name('university.attendance.index');
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

    Route::controller(Company\PlanController::class)->group(function () {
        Route::get('/trainee/{id}/plan/', 'index')->name('company.plan.index');
        Route::get('/trainee/{id}/plan/create', 'create')->name('company.plan.insert');
        Route::post('/trainee/{id}/plan/create', 'store')->name('company.plan.store');
        Route::delete('/trainee/{id}/plan/', 'destroy')->name('company.plan.destroy');
    });

    Route::controller(University\PlanController::class)->group(function () {
        Route::get('/university/{id}/plan/', 'index')->name('university.plan.index');
    });

    Route::controller(Company\EvaluationController::class)->group(function () {
        Route::get('/company/{id}/evaluation/', 'index')->name('company.evaluation.index');
        Route::get('/company/{id}/evaluation/create', 'create')->name('company.evaluation.insert');
        Route::post('/company/{id}/evaluation/create', 'store')->name('company.evaluation.store');
        Route::delete('/company/{id}/evaluation/', 'destroy')->name('company.evaluation.destroy');
    });

    Route::controller(University\EvaluationController::class)->group(function () {
        Route::get('/university/{id}/evaluation/', 'index')->name('university.evaluation.index');
    });

    Route::controller(Student\ReportController::class)->group(function () {
        Route::get('/trainee/report/', 'index')->name('student.report.index');
        Route::get('/trainee/{id}/report/create', 'create')->name('student.report.insert');
        Route::post('/trainee/{id}/report/create', 'store')->name('student.report.store');
        Route::delete('/trainee/{id}/report/', 'destroy')->name('student.report.destroy');
        Route::get('/trainee/report/edit/{id}/{std}', 'edit')->name('student.report.edit');
        Route::post('/trainee/report/update/{id}', 'update')->name('student.report.update');
    });

    Route::controller(University\ReportController::class)->group(function () {
        Route::get('/university/{id}/report/', 'index')->name('university.report.index');
    });

    Route::controller(University\LinkController::class)->group(function () {
        Route::get('/university/{id}/links/', 'index')->name('university.links.index');
    });

    Route::controller(Company\ReportController::class)->group(function () {
        Route::get('/company/{id}/report/', 'index')->name('company.report.index');
        Route::get('/company/report/edit/{id}/{std}', 'edit')->name('company.report.edit');
        Route::post('/company/report/update/{id}', 'update')->name('company.report.update');
    });

    Route::controller(HR\PlanController::class)->group(function () {
        Route::get('/hr/trainee/{id}/plan/', 'index')->name('hr.plan.index');
    });

    Route::controller(Admin\PlanController::class)->group(function () {
        Route::get('/admin/trainee/{id}/plan/', 'index')->name('admin.plan.index');
    });

    Route::controller(Company\HREvaluationController::class)->group(function () {
        Route::get('/hr/{id}/evaluation/', 'index')->name('hr.evaluation.index');
        Route::post('/hr/{id}/attendance/create', 'store')->name('hr.evaluation.store');
    });

    Route::controller(HR\HREvaluationController::class)->group(function () {
        Route::get('/hr/{id}/hr-evaluation/', 'index')->name('hr.hr-evaluation.index');
        Route::get('/hr/{id}/hr-evaluation/print/', 'print')->name('hr.hr-evaluation.print');
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

    Route::controller(HR\TraineesController::class)->group(function () {
        Route::get('/hr/trainee/view/{id}', 'view')->name('hr.trainees.view');
    });

    Route::controller(Company\TraineesController::class)->group(function () {
        Route::get('/company/trainee/view/{id}', 'view')->name('company.trainees.view');
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
        Route::post('/admin/university_mentor/update/{id}', 'update')->name('admin.university.update');
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
