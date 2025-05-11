<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Role;
use App\Http\Requests\InventoryRec;
use RealRashid\SweetAlert\Facades\Alert;

class StockController extends Controller
{
   
    public function indexStock(){
        // Pass inventory data to the view for the dropdown
        return view('admin.stock')->with([
            'inventorys' => Inventory::all(), // For the dropdown
        ]);
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
