<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Request;
use App\Models\Role;
use App\Http\Requests\InventoryRec;
use RealRashid\SweetAlert\Facades\Alert;

class OthersController extends Controller
{
   
    public function indexStocks(){
        // Pass inventory data to the view for the dropdown
        return view('operator.opstock')->with([
            'inventorys' => Inventory::all(), // For the dropdown
        ]);
    }
    
    public function store(InventoryRec $request)
    {
        // Validate the input (already done)
        $request->validated();
    
        // Retrieve the inventory item by a unique identifier (e.g., name)
        $inventory = \App\Models\Inventory::where('name', $request->name)->first();
    
        if (!$inventory) {
            // If inventory not found, return an error response
            flash()->error('Error', 'Inventory item not found!');
            return redirect()->back();
        }
    
        // Create a new request record
        $newRequest = new \App\Models\Request();
        $newRequest->user_id = auth()->id(); // ID of the authenticated user
        $newRequest->inventory_id = $inventory->id; // ID of the retrieved inventory item
        $newRequest->name = $request->name; // Inventory name
        $newRequest->quantity = $request->quantity; // Requested quantity
        $newRequest->save();
    
        // Success message
        flash()->success('Success', 'Request record has been created successfully!');
        return redirect()->route('indexStocks');
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
