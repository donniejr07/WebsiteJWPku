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
        Schema::table('requests', function (Blueprint $table) {
            // Add new columns
            $table->unsignedBigInteger('layanan_id')->nullable()->after('id');
            $table->string('perusahaan')->nullable()->after('telepon');
            
            // Rename existing columns
            $table->renameColumn('layanan', 'layanan_temp');
            $table->renameColumn('deskripsi', 'pesan');
            
            // Add foreign key constraint
            $table->foreign('layanan_id')->references('id')->on('layanan')->onDelete('set null');
        });
        
        // Drop the temporary column in a separate statement
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('layanan_temp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            // Add back the old columns
            $table->string('layanan')->after('telepon');
            $table->renameColumn('pesan', 'deskripsi');
            
            // Drop new columns
            $table->dropForeign(['layanan_id']);
            $table->dropColumn(['layanan_id', 'perusahaan']);
        });
    }
};
