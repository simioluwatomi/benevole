<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteerOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('volunteer_opportunities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('slug');
            $table->unsignedSmallInteger('hours_per_week');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_opportunities');
    }
}
