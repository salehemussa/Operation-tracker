<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRec;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class OperatorController extends Controller
{
    // Display all operators
    public function indexOperator()
    {
        // Fetch all users (if you have a flag to mark operators, adjust the query accordingly)
        $operators = User::all();

        // Return the view with the list of operators
        return view('admin.operator')->with(['operators' => $operators]);
    }

    public function store(UserRec $request)
    {
        // Start a transaction to ensure data integrity
        DB::beginTransaction();
        try {
            // Create a new operator in the users table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password), // Encrypt the password
            ]);
            // Define the role ID (e.g., role ID for "Operator" is 2)
            $roleId = 2;
            // Insert into the role_users table
            DB::table('role_users')->insert([
                'user_id' => $user->id,
                'role_id' => $roleId,
            ]);
            // Commit the transaction
            DB::commit();
            // Redirect back with success message
            return redirect()->route('indexOperator')->with('success', 'Operator added successfully!');
            }catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'Failed to add operator. Please try again.']);
        }
    }

    // Update operator
    public function update(UserRec $request, User $operator){
        // Update the operator's details
        $operator->update([
            'name' => $request->name,
            'roles' => $request->roles,
            'email' => $request->email
        ]);
        // Redirect back with success message
        return redirect()->route('indexOperator')->with('success', 'Operator updated successfully!');
    }


    // Delete operator
    public function destroy(User $operator){
        // Delete the operator
        $operator->delete();
        // Redirect back with success message
        return redirect()->route('indexOperator')->with('success', 'Operator deleted successfully!');
    }


    public function profile()
    {
        // Fetch all users (if you have a flag to mark operators, adjust the query accordingly)
        $users = User::all();

        // Return the view with the list of operators
        return view('user.profile');
    }



    public function changePassword(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the current password is correct
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update the user's password
        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

}
