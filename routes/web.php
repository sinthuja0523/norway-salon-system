<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;


use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\TimeSlotController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/about', function () {
    return view('pages.abouts');
});

Route::get('/services', function () {
    return view('pages.services');
});

Route::get('/contact', function () {
    return view('pages.contacts');
});




//Route::get('pages.aboutus' ,[AboutController::class , 'aboutus']);

// Route::get('/appoint' , [AppointController::class,'appoint']);
// Route::get('/book', [AppointController::class,'create']);
Route::post('/book', [BookingController::class,'store'])->name('book.appointment');




Route::get('SendEmail' , [MailController::class , 'SendEmail']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

route::get('/home' , [HomeController::class,'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/new-appointments',[AdminController::class,'newAppointmentsView'])->name('appointment.new');
    Route::get('/rejected-appointments',[AdminController::class,'newRejectedView'])->name('rejected-new');
    Route::get('/past-appointments',[AdminController::class,'pastappointmentView'])->name('past-new');
    Route::get('/time-slots',[AdminController::class,'timeSlotsView'])->name('timeslots-new');
    Route::get('/dailyReports',[AdminController::class,'dailyReportsView'])->name('dailyreports-new');
    Route::get('/weekly-reports',[AdminController::class,'weeklyReportsView'])->name('weeklyreports-new');
    Route::get('/monthly-reports',[AdminController::class,'monthlyReportsView'])->name('monthlyreports-new');
    Route::get('/time-slots',[AdminController::class,'TimeSlotsView'])->name('timeslots-new');

    Route::post('/approve',[AdminController::class,'approveAppointment']);
    Route::post('/decline', [AdminController::class, 'declineAppointment']);

    // Admin - Services routes
    Route::get('/services',[ServiceController::class,'index'])->name('services.view');
    Route::post('/service-add', [ServiceController::class, 'storeService'])->name('services.store');
    Route::get('/service-edit/{id}', [ServiceController::class, 'editService'])->name('services.edit');
    Route::post('/service-update/{id}', [ServiceController::class, 'updateService'])->name('services.update');
    Route::delete('/service-delete/{id}', [ServiceController::class, 'deleleService']);

    // Admin - Branch routes
    Route::get('/branches',[BranchController::class,'index'])->name('branches.view');
    Route::post('/branch-add', [BranchController::class, 'storeBranch'])->name('branches.store');
    Route::get('/branch-edit/{id}', [BranchController::class, 'editBranch'])->name('branches.edit');
    Route::post('/branch-update/{id}', [BranchController::class, 'updateBranch'])->name('branches.update');
    Route::delete('/branch-delete/{id}', [BranchController::class, 'deleleBranch']);

        // Admin - Time slots routes
        Route::get('/time-slots',[TimeSlotController::class,'index'])->name('time.view');
        Route::post('/time-add', [TimeSlotController::class, 'storeTime'])->name('time.store');
        Route::post('/time-update', [TimeSlotController::class, 'updateTime'])->name('time.update');
        Route::delete('/time-delete/{id}', [TimeSlotController::class, 'deleleTime']);
});

require __DIR__.'/auth.php';
