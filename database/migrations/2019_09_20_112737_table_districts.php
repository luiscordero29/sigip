<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDistricts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->uuid('district_id')->unique();
            $table->uuid('province_id');
            $table->uuid('user_id');
            $table->string('description');
            $table->string('observation');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('cascade'); 
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreign('province_id')->references('province_id')->on('provinces')->onDelete('no action')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->dropForeign('districts_user_id_foreign');
        });
        Schema::table('districts', function (Blueprint $table) {
            $table->dropForeign('districts_province_id_foreign');
        });
        Schema::dropIfExists('districts');
    }
}
