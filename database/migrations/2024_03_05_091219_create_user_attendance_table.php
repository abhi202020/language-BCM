<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAttendanceTable extends Migration{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(){
        Schema::create('user_attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lesson_id');
            $table->unsignedInteger('attendance_count')->default(0);
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Add foreign key for lesson_id if necessary
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(){
        Schema::dropIfExists('user_attendance');
    }
}
