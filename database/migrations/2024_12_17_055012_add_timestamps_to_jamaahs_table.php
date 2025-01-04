<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('jamaahs', function (Blueprint $table) {
            if (!Schema::hasColumn('jamaahs', 'created_at') && !Schema::hasColumn('jamaahs', 'updated_at')) {
                $table->timestamps(); // Tambahkan kolom created_at dan updated_at
            }
        });
    }

    public function down()
    {
        Schema::table('jamaahs', function (Blueprint $table) {
            if (Schema::hasColumn('jamaahs', 'created_at') && Schema::hasColumn('jamaahs', 'updated_at')) {
                $table->dropTimestamps();
            }
        });
    }
};
