<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// add ... to ... table => Schema::table (alteração)

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sugestoes', function (Blueprint $table) {
            $table->timestamp('liberada_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sugestoes', function (Blueprint $table) {
            $table->dropColumn('liberada_em');
        });
    }
};
