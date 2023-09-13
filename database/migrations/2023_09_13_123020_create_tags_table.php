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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('tags_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('name')->nullable();


            $table->unsignedBigInteger('tag_id');

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tages');
        Schema::dropIfExists('tags_translations');
    }
};
