<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('rooms', function (Blueprint $table) {
        $table->integer('building_id')->unsigned();
        $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('rooms', function (Blueprint $table) {
        $table->dropForeign(['building_id']);
        $table->dropColumn('building_id');
    });
}
};
