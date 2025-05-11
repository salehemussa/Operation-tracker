<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Tool name
            $table->integer('quantity'); // Quantity of tools
            $table->timestamp('lastupdated')->nullable(); // Last updated
            $table->string('status'); // Status (e.g., Available, Out of Stock)
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}
