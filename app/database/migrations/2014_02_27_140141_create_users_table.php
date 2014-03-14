<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('first_name')->nullable()->default(NULL);
            $table->string('last_name')->nullable()->default(NULL);
            $table->string('location')->nullable()->default(NULL);
            $table->string('description')->nullable()->default(NULL);
            $table->string('avatar')->nullable()->default(NULL);
            $table->boolean('is_admin')->default(0);
            $table->boolean('suspended')->default(0);
            $table->string('activation_code')->nullable()->default(NULL);
            $table->boolean('activated')->default(0);
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
        Schema::drop('users');
    }

}
