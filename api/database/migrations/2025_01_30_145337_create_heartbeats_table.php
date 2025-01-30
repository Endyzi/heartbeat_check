<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * below are the values that are requested for the mutation
     */
    public function up()
    {   
        Schema::create('heartbeats', function (Blueprint $table) {
            $table->id();
            $table->string('applications_key');
            $table->string('heartbeat_key');
            $table->integer('unhealthy_after_minutes');
            $table->timestamp('last_check_in')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('heartbeats');
    }
};
