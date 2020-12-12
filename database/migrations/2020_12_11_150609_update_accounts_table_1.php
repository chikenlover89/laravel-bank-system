<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccountsTable1 extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
