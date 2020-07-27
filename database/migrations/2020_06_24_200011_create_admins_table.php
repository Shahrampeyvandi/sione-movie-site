<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('level',['admin','writer']);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('admins')->insert([
               'first_name' => 'user',
                'last_name' => 'user',
                'mobile' => '09911041242',
                'password' => Hash::make('1234'),
                'level' => 'admin',
                'created_at' => Carbon::now()
          ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
