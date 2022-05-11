<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cms_languages')) {
            Schema::create('cms_languages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 100);
                $table->string('locale', 10);
                $table->string('date_format', 100)->nullable();
                $table->boolean('is_rtl')->default(false);
                $table->json('options')->nullable();

                $table->softDeletes();
                $table->timestamps();
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
        Schema::dropIfExists('cms_languages');
    }
}
