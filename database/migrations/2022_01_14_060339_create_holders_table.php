<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holders', function (Blueprint $table) {
            $table->id();
            $table->string('policy');
            $table->string('name');
            $table->string('joining_date');
            $table->string('address');
            $table->string('photo')->nullable();
            $table->string('balance')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default(STATUS_ON);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holders');
    }
}
