<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cms_domains')) {
            Schema::create('cms_domains', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->unique();
                $table->string('url', 100)->default('*')->unique();
                $table->json('options')->nullable();
                $table->boolean('active')->default(0)->nullable(false);
                $table->boolean('default')->default(0)->nullable(false);
                $table->softDeletes();
                $table->timestamps();

                $table->index('url');
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
        Schema::dropIfExists('cms_domains');
    }
}
