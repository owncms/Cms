<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cms_user_role')) {
            Schema::create('cms_user_role', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->index();
                $table->unsignedBigInteger('role_id')->index();

                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('cms_users')
                    ->onDelete('cascade');
                $table->foreign('role_id')
                    ->references('id')
                    ->on('cms_users_roles')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('cms_user_role');
    }
}
