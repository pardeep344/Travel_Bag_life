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
        // Rename the table from 'logoimg' to 'logoimgs'
        Schema::rename('logoimg', 'logoimgs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the table name change (rename back from 'logoimgs' to 'logoimg')
        Schema::rename('logoimgs', 'logoimg');
    }
};
