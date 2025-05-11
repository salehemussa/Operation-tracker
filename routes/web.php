<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OthersController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileopController;

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BiometricDeviceController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('attended/{user_id}', [AttendanceController::class, 'attended'])->name('attended');
Route::get('attended-before/{user_id}', [AttendanceController::class, 'attendedBefore'])->name('attendedBefore');
Auth::routes(['register' => false, 'reset' => false]);

// Admin Role Routes
Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {
    // Routes for admin role
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
     

    // Employees Management
    Route::resource('admin/employees', EmployeeController::class)->names([
        'index' => 'admin.employees', // Name the index route
    ]);
    
    Route::get('admin/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::post('admin/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/admin/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('admin/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Attendance and Leave Management
    Route::get('admin/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('admin/latetime', [AttendanceController::class, 'indexLatetime'])->name('indexLatetime');
    Route::get('admin/leave', [LeaveController::class, 'index'])->name('leave');
    Route::get('admin/overtime', [LeaveController::class, 'indexOvertime'])->name('indexOvertime');

    // Inventory Management
    Route::get('admin/inventory', [InventoryController::class, 'indexInventory'])->name('indexInventory');
    Route::post('admin/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::put('/operator/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');

    // Results 
    Route::get('admin/stock', [StockController::class, 'indexStock'])->name('indexStock');
    Route::post('admin/stock/store', [InventoryController::class, 'store'])->name('stock.store');
    Route::put('/admin/stock/{inventory}', [StockController::class, 'update'])->name('stock.update');

    // Resions
    Route::get('/admin/requests', [RequestController::class, 'indexRequests'])->name('indexRequests');
    Route::put('/requests/{id}/status/{status}', [RequestController::class, 'updateStatus'])->name('requests.updateStatus');

    // Operator Management
    Route::get('admin/operator', [OperatorController::class, 'indexOperator'])->name('indexOperator');
    Route::post('admin/operator/store', [OperatorController::class, 'store'])->name('admin.store');
    Route::put('/admin/operator/{operator}', [OperatorController::class, 'update'])->name('operator.update');
    Route::delete('admin/operator/{operator}', [OperatorController::class, 'destroy'])->name('operator.destroy');

    Route::get('admin/profile', [ProfileController::class, 'indexProfile'])->name('indexProfile');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('user.changePassword')->middleware('auth');



    // Schedule Management
    Route::resource('admin/schedule', ScheduleController::class)->names(['index' => 'admin.schedule']);  
    Route::get('admin/schedule/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::post('admin/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('/admin/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('admin/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');


    // Check & Reports
    Route::get('admin/check', [CheckController::class, 'index'])->name('check');
    Route::get('admin/sheet-report', [CheckController::class, 'sheetReport'])->name('sheet-report');

    
    // Fingerprint Devices
    Route::resource('/finger_device', BiometricDeviceController::class);
    Route::delete('finger_device/destroy', [BiometricDeviceController::class, 'massDestroy'])->name('finger_device.massDestroy');
    Route::get('finger_device/{fingerDevice}/employees/add', [BiometricDeviceController::class, 'addEmployee'])->name('finger_device.add.employee');
    Route::get('finger_device/{fingerDevice}/get/attendance', [BiometricDeviceController::class, 'getAttendance'])->name('finger_device.get.attendance');
    Route::get('finger_device/clear/attendance', function () {
        $midnight = \Carbon\Carbon::createFromTime(23, 50, 00);
        $diff = now()->diffInMinutes($midnight);
        dispatch(new \App\Jobs\ClearAttendanceJob())->delay(now()->addMinutes($diff));
        toast("Attendance Clearance Queue will run at 11:50 P.M.!", "success");
        return back();
    })->name('finger_device.clear.attendance');
});

//Operator in Role Routes
Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['operator']], function () {
    Route::get('/operator/dashboard', [AdminController::class, 'index'])->name('operator.dashboard');

    // Attendance and Leave Management
    Route::get('/operator/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/operator/latetime', [AttendanceController::class, 'indexLatetime'])->name('indexLatetime');
    Route::get('/operator/leave', [LeaveController::class, 'index'])->name('leave');
    Route::get('/operator/overtime', [LeaveController::class, 'indexOvertime'])->name('indexOvertime');

    // Inventory Management
    Route::get('/operator/inventory', [OthersController::class, 'indexInventoryop'])->name('indexInventoryop');
    Route::get('operator/opstock', [OthersController::class, 'indexStocks'])->name('indexStocks');
    Route::post('operator/opstock', [OthersController::class, 'store'])->name('sendrequest.store');
    Route::get('/operator/requestsop', [RequestController::class, 'indexRequestsop'])->name('indexRequestsop');
    Route::put('/operator/inventory/{inventory}', [OthersController::class, 'update'])->name('inventory.update');

    // Check & Reports
    Route::get('/operator/check', [CheckController::class, 'index'])->name('check');
    Route::post('admin/check-store', [CheckController::class, 'CheckStore'])->name('check_store');


    Route::get('operator/profileop', [ProfileopController::class, 'indexProfileop'])->name('indexProfileop');
    Route::post('/change-passwordop', [ProfileopController::class, 'changePasswordop'])->name('user.changePasswordop')->middleware('auth');

    // Schedule Management
    

    // Fingerprint Devices
    Route::resource('/finger_device', BiometricDeviceController::class);
    Route::delete('finger_device/destroy', [BiometricDeviceController::class, 'massDestroy'])->name('finger_device.massDestroy');
    Route::get('finger_device/{fingerDevice}/employees/add', [BiometricDeviceController::class, 'addEmployee'])->name('finger_device.add.employee');
    Route::get('finger_device/{fingerDevice}/get/attendance', [BiometricDeviceController::class, 'getAttendance'])->name('finger_device.get.attendance');
    Route::get('finger_device/clear/attendance', function () {
        $midnight = \Carbon\Carbon::createFromTime(23, 50, 00);
        $diff = now()->diffInMinutes($midnight);
        dispatch(new \App\Jobs\ClearAttendanceJob())->delay(now()->addMinutes($diff));
        toast("Attendance Clearance Queue will run at 11:50 P.M.!", "success");

        return back();
    })->name('finger_device.clear.attendance');
});


// Common Authenticated User Routes
Route::group(['middleware' => ['auth']], function () {
    // Add common routes for authenticated users here
});
