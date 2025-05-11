<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Schedule;
use App\Http\Requests\EmployeeRec;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
   
    public function index()
    {
        
        return view('admin.employee')->with(['employees'=> Employee::all(), 'schedules'=>Schedule::all()]);
    }

    public function store(EmployeeRec $request)
    {
        $request->validated();

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->email = $request->email;
        $employee->pin_code = bcrypt($request->pin_code);
        $employee->save();

        if($request->schedule){

            $schedule = Schedule::whereSlug($request->schedule)->first();

            $employee->schedules()->attach($schedule);
        }

        // $role = Role::whereSlug('emp')->first();

        // $employee->roles()->attach($role);

        flash()->success('Success','Employee Record has been created successfully !');

        return redirect()->route('admin.employees')->with('success');
    }

 
    public function update(EmployeeRec $request, Employee $employee)
    {
        // Validate request
        $request->validated();
    
        // Update basic employee details
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->email = $request->email;
    
      
    
        $employee->save();
    
        // Update schedule if provided
        if ($request->filled('schedule')) {
            $employee->schedules()->detach();
    
            $schedule = Schedule::whereSlug($request->schedule)->first();
    
            if ($schedule) {
                $employee->schedules()->attach($schedule);
            }
        }
    
        // Flash success message and redirect to index
        flash()->success('Success', 'Employee Record has been updated successfully!');
        return redirect()->route('admin.employees')->with('success');

    }
    

    public function destroy(Employee $employee)
    {
        $employee->delete();
        flash()->success('Success','Employee Record has been Deleted successfully !');
        return redirect()->route('admin.employees')->with('success');
    }
}
