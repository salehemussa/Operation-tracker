<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

        // Define the relationship with the Request model
        public function requests()
        {
            return $this->hasMany(Request::class, 'inventory_id');
        }

    // Specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'inventory';

    // Define fillable properties for mass assignment
    protected $fillable = ['name', 'quantity', 'lastupdated', 'status'];
}
