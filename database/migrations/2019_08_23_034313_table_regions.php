<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->uuid('region_id')->unique();
            $table->uuid('user_id');
            $table->string('description');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropForeign('regions_user_id_foreign');
        });
        Schema::dropIfExists('regions');
    }
}
