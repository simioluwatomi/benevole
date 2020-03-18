<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('organization_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');
            $table->string('organization_name')->nullable();
            $table->string('bio', 200)->nullable();
            $table->string('website')->nullable();
            $table->string('country', 50)->nullable();
            $table->string('certificate')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('organization_profiles');
    }
}
