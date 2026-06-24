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
         Schema::table('points', function (Blueprint $table) {
            $table->renameColumn('status_infrastruktur', 'status');
        });
         Schema::table('polylines', function (Blueprint $table) {
            $table->renameColumn('status_jalan', 'status');
        });
         Schema::table('polygons', function (Blueprint $table) {
            $table->renameColumn('status_area', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('points', function (Blueprint $table) {
            $table->renameColumn('status', 'status_infrastruktur');
        });
          Schema::table('polylines', function (Blueprint $table) {
            $table->renameColumn('status', 'status_jalan');
        });
          Schema::table('polygons', function (Blueprint $table) {
            $table->renameColumn('status', 'status_area');
        });
    }
};
