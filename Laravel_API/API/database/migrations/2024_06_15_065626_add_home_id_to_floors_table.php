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
    Schema::table('floors', function (Blueprint $table) {
        $table->unsignedBigInteger('home_id')->after('id');
        // Add a foreign key constraint if necessary
        // $table->foreign('home_id')->references('id')->on('homes')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('floors', function (Blueprint $table) {
        $table->dropColumn('home_id');
        // If foreign key constraint was added
        // $table->dropForeign(['home_id']);
    });
}

};
