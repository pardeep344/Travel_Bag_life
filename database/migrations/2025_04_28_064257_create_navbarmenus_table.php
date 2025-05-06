<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navbarmenus', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Menu name
            $table->string('url');  // URL for the menu item
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navbarmenus');
    }
};
