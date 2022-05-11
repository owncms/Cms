<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsDomainLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cms_domain_language')) {
            Schema::create('cms_domain_language', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('cms_domain_id')
                    ->unsigned()
                    ->index();
                $table->foreign('cms_domain_id')
                    ->references('id')
                    ->on('cms_domains')
                    ->onDelete('cascade');
                $table->bigInteger('cms_language_id')
                    ->unsigned()
                    ->index();
                $table->foreign('cms_language_id')
                    ->references('id')
                    ->on('cms_languages')
                    ->onDelete('cascade');
                $table->boolean('default')->default(false);

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
        Schema::dropIfExists('cms_domain_language');
    }
}
