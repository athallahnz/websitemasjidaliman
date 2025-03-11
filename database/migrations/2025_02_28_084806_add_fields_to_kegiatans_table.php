<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->enum('kategori', ['kajian', 'santunan', 'pembangunan'])->after('deskripsi');
            $table->dateTime('tanggal_kegiatan')->nullable()->after('kategori');
            $table->string('link')->nullable()->after('gambar');
        });
    }

    public function down()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'tanggal_kegiatan', 'link']);
        });
    }

};
