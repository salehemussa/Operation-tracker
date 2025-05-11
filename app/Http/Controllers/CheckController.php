<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;

class CheckController extends Controller
{
    public function index()
    {
        return view('admin.check')->with(['employees' => Employee::all()]);
    }
    public function CheckStore(Request $request)
    {
        if (isset($request->attd)) {
            foreach ($request->attd as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = \App\Models\Employee::find($key)) {
                        if (
                            !\App\Models\Attendance::where('attendance_date', $keys)
                                ->where('emp_id', $key)
                                ->where('type', 0)
                                ->exists()
                        ) {
                            $data = new \App\Models\Attendance();
    
                            $data->emp_id = $key;
                            $data->attendance_date = $keys;
                            $data->attendance_time = date('H:i:s', strtotime($employee->schedules->first()->time_in));
                            $data->arrive = now()->format('H:i:s'); // Set arrive to the current time
    
                            // Calculate status: 1 for "On Time", 0 for "Late"
                            $data->status = (strtotime($data->arrive) <= strtotime($data->attendance_time)) ? 1 : 0;
    
                            $data->save();
                        }
                    }
                }
            }
        }        if (isset($request->leave)) {
            foreach ($request->leave as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Employee::whereId(request('emp_id'))->first()) {
                        if (
                            !Leave::whereLeave_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(1)
                                ->first()
                        ) {
                            $data = new Leave();
                            $data->emp_id = $key;
                            $emp_req = Employee::whereId($data->emp_id)->first();
                            $data->leave_time = $emp_req->schedules->first()->time_out;
                            $data->leave_date = $keys;
                            // if ($employee->schedules->first()->time_out <= $data->leave_time) {
                            //     $data->status = 1;
                                
                            // }
                            // 
                            $data->save();
                        }
                    }
                }
            }
        }
    
        flash()->success('Success', 'Attendance records have been successfully submitted!');
        return back();
    }
    
    
    public function sheetReport()
    {

    return view('admin.sheet-report')->with(['employees' => Employee::all()]);
    }
}
