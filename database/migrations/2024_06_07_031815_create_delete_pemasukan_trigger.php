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
        DB::unprepared('
        CREATE TRIGGER pemasukan_stokdelete
        BEFORE DELETE ON pemasukan
        FOR EACH ROW
        BEGIN
            UPDATE barang
            SET barang.stok = barang.stok - OLD.qty_masuk
            WHERE barang.id = OLD.barang_id;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS pemasukan_stokdelete');
    }
};
