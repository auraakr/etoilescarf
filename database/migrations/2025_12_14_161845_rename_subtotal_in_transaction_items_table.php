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
        Schema::table('transaction_items', function (Blueprint $table) {
            // Mengganti nama kolom 'subtotal' menjadi 'item_subtotal'
            $table->renameColumn('subtotal', 'item_subtotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            // Mengembalikan nama kolom (jika migrasi di-rollback)
            $table->renameColumn('item_subtotal', 'subtotal');
        });
    }
};