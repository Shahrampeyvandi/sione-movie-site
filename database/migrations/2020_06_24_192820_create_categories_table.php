<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('latin');
            $table->string('image')->nullable();
            
        });
        DB::table('categories')->insert([
            ['name' => 'درام'],
            ['name' => 'مهیج'],
            ['name' => 'اکشن و ماجراجویی'],
            ['name' => 'انیمیشن'],
            ['name' => 'بهترین فیلم های IMDB'],
            ['name' => 'بهترین فیلم های سال 2019'],
            ['name' => 'تاریخی'],
            ['name' => 'ترسناک'],
            ['name' => 'جنایی'],
            ['name' => 'جنگ'],
            ['name' => 'خانوادگی'],
            ['name' => 'دسته‌بندی نشده'],
            ['name' => 'رمزآلود'],
            ['name' => 'علمی تخیلی'],
            ['name' => 'علمی تخیلی فانتزی'],
            ['name' => 'فانتزی'],
            ['name' => 'فیلم های دوبله فارسی'],
            ['name' => 'کمدی'],
            ['name' => 'ماجراجویی'],
            ['name' => 'مستند'],
            ['name' => 'موزیکال'],
            ['name' => 'وحشت'],
             ['name' => 'وسترن'],
        



        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
