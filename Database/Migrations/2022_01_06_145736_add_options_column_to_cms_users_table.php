<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionsColumnToCmsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('cms_users', 'options')) {
            Schema::table('cms_users', function (Blueprint $table) {
                $table->json('options')->after('remember_token')->nullable();
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
        if (Schema::hasColumn('cms_users', 'options')) {
            Schema::table('cms_users', function (Blueprint $table) {
                $table->dropColumn('options');
            });
        }
    }
}
