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
        Schema::table('thoughts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Esto crea user_id UNSIGNED BIGINT, con FK a users.id y borra en cascada
        });
    }

    public function down()
    {
        Schema::table('thoughts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
