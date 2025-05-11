<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Role;
use App\Http\Requests\InventoryRec;
use RealRashid\SweetAlert\Facades\Alert;

class InventoryController extends Controller
{
   
    public function indexInventory()
    {
        // Pass inventory data to the view for the dropdown
        return view('admin.inventory')->with([
            'inventorys' => Inventory::all(), // For the dropdown
        ]);
    }
    
    public function store(InventoryRec $request)
    {
        // Validate input
        $request->validated();
    
        // Save inventory details
        $inventory = new Inventory();
        $inventory->name = $request->name; // Selected name from dropdown
        $inventory->quantity = $request->quantity; // Entered quantity
        $inventory->save();
    
        // Success message
        return redirect()->route('indexInventory');
    }
    

 
    public function update(InventoryRec $request, Inventory $inventory)
    {
        $request->validated();

        $inventory->name = $request->name;
        $inventory->quantity = $request->quantity;
        $inventory->save();

     

        flash()->success('Success','inventory Record has been Updated successfully !');

        return redirect()->route('indexInventory')->with('success');
    }


    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        flash()->success('Success','inventory Record has been Deleted successfully !');
        return redirect()->route('inventory.index')->with('success');
    }
}
