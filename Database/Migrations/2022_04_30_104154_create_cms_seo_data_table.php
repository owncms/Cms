<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsSeoDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_seo_data', function (Blueprint $table) {
            $table->id();
            $table->string('class_type')->index();
            $table->unsignedBigInteger('model_id')->index();
            $table->json('params')->nullable();

            $table->index(['class_type', 'model_id']);

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
        Schema::dropIfExists('cms_seo_data');
    }
}
