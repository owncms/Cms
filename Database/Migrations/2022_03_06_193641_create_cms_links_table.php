<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cms_links')) {
            Schema::create('cms_links', function (Blueprint $table) {
                $table->id();
                $table->json('slug')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->string('class_type')->nullable();
                $table->unsignedBigInteger('model_id')->nullable();
                $table->string('action')->nullable();
                $table->json('final_path')->nullable();
                $table->json('params')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['class_type', 'model_id']);
//                $table->unique(['final_path'], 'UNIQUE_FULL_PATH');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_links');
    }
}
