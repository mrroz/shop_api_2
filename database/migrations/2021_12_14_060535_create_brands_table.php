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
            $table->id();

            $table->string('title_fa');
            $table->string('info_fa');
            $table->string('ostan_fa');
            $table->string('country_fa');
            $table->string('continent_fa');

            $table->string('image');
            $table->double('rate');
            $table->integer('yer');
            $table->boolean('made_in_iran');



            $table->string('title_en');
            $table->string('info_en');
            $table->string('ostan_en');
            $table->string('country_en');
            $table->string('continent_en');


            $table->boolean('isUpdated');





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
