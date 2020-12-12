<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable2 extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('debt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
