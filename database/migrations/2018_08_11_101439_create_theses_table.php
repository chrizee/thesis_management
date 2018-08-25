<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theses', function (Blueprint $table) {
            $table->increments('id');
            $table->text("name");
            $table->mediumText('abstract');
            $table->text("authors");
            $table->text("author_phone")->nullable();
            $table->text("author_email")->nullable();
            $table->string('tag_id');
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->integer("supervisor_id")->unsigned();
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
            $table->string('location');
            $table->year("session");
            $table->enum("published", [0,1])->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('theses');
    }
}
