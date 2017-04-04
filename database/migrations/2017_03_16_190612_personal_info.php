<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//Migration for personla_info table

class PersonalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_info', function (Blueprint $table) {
		$table->integer('user_id');
		$table->string('date_of_birth');
		$table->integer('gender');
		$table->string('country');
		$table->string('home_town');
		$table->string('address');
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
