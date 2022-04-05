<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todolist', function (Blueprint $table) {
            $table->bigInteger('creator_id')->default(null)->after('done');
            $table->bigInteger('affectedTo_id')->default(null)->after('creator_id');
            $table->bigInteger('affectedBy_id')->default(null)->after('affectedTo_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todolist', function (Blueprint $table) {
            $table->dropColumn('creator_id');
            $table->dropColumn('affectedTo_id');
            $table->dropColumn('affectedBy_id');
        });
    }
};
