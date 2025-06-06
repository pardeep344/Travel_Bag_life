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
        Schema::create('footer_editable_contents', function (Blueprint $table) {
            $table->id();
            $table->string('Image');
            $table->text('Text');
            $table->string('TelPhone');
            $table->string('Phone');
            $table->string('Email');
            $table->string('Copyright');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
