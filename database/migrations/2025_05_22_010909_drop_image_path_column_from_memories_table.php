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
    Schema::table('memories', function (Blueprint $table) {
        $table->dropColumn('image_path');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('memories', function (Blueprint $table) {
        $table->string('image_path')->nullable(); // or notNullable if needed
    });
}

};
