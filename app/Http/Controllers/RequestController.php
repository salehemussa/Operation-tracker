<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Request;
use App\Models\Role;
use App\Http\Requests\InventoryRec;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class RequestController extends Controller
{
   
    // public function indexRequests(){
    //     // Pass inventory data to the view for the dropdown
    //     return view('admin.requests')->with([
    //         'inventorys' => Request::all(), // For the dropdown
    //     ]);
    // }


    public function indexRequests()
{
    // Eager load user data with requests
    $inventorys = Request::with('user')->get();

    return view('admin.requests', compact('inventorys'));
}

    public function indexRequestsop(){
        // Pass inventory data to the view for the dropdown
        return view('operator.requestsop')->with([
            'inventorys' => Request::all(), // For the dropdown
        ]);
    }





    public function updateStatus($id, $status)
    {
        DB::transaction(function () use ($id, $status) {
            $request = \App\Models\Request::find($id);
    
            if (!$request) {
                throw new \Exception('Request not found.');
            }
    
            // Handle accept (1) status
            if ($status == 1) {
                $inventory = \App\Models\Inventory::find($request->inventory_id);
    
                if (!$inventory || $inventory->quantity < $request->quantity) {
                    throw new \Exception('Insufficient inventory to fulfill the request.');
                }
    
                // Reduce the inventory quantity
                $inventory->quantity -= $request->quantity;
                $inventory->save();
            }
    
            // Update the request status
            $request->status = $status;
            $request->save();
        });
    
        $message = $status == 1 
            ? 'Request accepted, and inventory updated successfully.' 
            : 'Request rejected successfully.';
    
        return redirect()->back()->with('success', $message);
    }
    



    
    
    public function store(InventoryRec $request)
    {
        // Validate input
        $request->validated();
    
        // Save inventory details
        $inventory = new Inventory();
        $inventory->quantity = $request->quantity; // Entered quantity
        $inventory->save();
    
        // Success message
        Alert::success('Success', 'Inventory record has been created successfully!');
        return redirect()->route('inventory.index');
    }
    

 
  public function update(InventoryRec $request, Inventory $inventory)
{
    $request->validated();

    $inventory->name = $request->name; // Ensure 'name' exists in the request
    $inventory->quantity = $request->quantity; // Update quantity
    $inventory->save(); // Save changes

    // Flash success message
    flash()->success('Success','inventory Record has been Deleted successfully !');

    // Redirect to the stock index
    return redirect()->route('indexStock')->with('success', 'Inventory updated successfully!');
}



    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        flash()->success('Success','inventory Record has been Deleted successfully !');
        return redirect()->route('inventory.index')->with('success');
    }

}
