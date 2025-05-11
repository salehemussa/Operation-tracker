<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->id();  // AUTO_INCREMENT primary key
            $table->unsignedBigInteger('user_id');  // Foreign key to the users table
            $table->unsignedBigInteger('inventory_id');  // Foreign key to the inventory table
            $table->integer('quantity'); 
            $table->tinyInteger('status')->default(0); // Default to Pending (0)
            // Quantity being requested
            $table->timestamps();  // created_at and updated_at timestamps
    
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventory')->onDelete('cascade');
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
}
