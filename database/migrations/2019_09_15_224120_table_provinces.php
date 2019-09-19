<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableProvinces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->uuid('province_id')->unique();
            $table->uuid('region_id');
            $table->uuid('user_id');
            $table->string('description');
            $table->string('observation');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::table('provinces', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('cascade'); 
        });

        Schema::table('provinces', function (Blueprint $table) {
            $table->foreign('region_id')->references('region_id')->on('regions')->onDelete('no action')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropForeign('provinces_user_id_foreign');
        });
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropForeign('provinces_region_id_foreign');
        });
        Schema::dropIfExists('provinces');
    }
}
