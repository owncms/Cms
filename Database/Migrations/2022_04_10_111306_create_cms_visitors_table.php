<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_visitors', function (Blueprint $table) {
            $table->id();

            $table->string('class_type')->index();
            $table->unsignedBigInteger('model_id')->index();
            $table->string('ip', 255);
            $table->text('user_agent')->nullable();
            $table->unsignedInteger('clicks')->default(1);
            $table->unsignedBigInteger('cms_user_id')->nullable();
            $table->json('params')->nullable();

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
        Schema::dropIfExists('cms_visitors');
    }
}
