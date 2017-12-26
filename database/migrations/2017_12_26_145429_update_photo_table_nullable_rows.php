<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePhotoTableNullableRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photo', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->string('thumbnail')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photo', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change();
            $table->string('thumbnail')->nullable(false)->change();
        });
    }
}
