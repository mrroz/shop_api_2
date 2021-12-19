<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {

            $table->string('delete')->nullable();


            $table->id();

            $table->string('title_fa');
            $table->string('info_fa');
            $table->string('province_fa');
            $table->string('country_fa');
            $table->string('continent_fa');

            $table->string('image')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('year')->nullable();
            $table->integer('made_in_iran');

            $table->string('title_en');
            $table->string('info_en')->nullable();
            $table->string('province_en')->nullable();
            $table->string('country_en')->nullable();
            $table->string('continent_en')->nullable();


            $table->softDeletes();
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
        Schema::dropIfExists('brands');
    }
}



