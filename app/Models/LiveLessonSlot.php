<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\LessonSlotBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Import Log facade

class LiveLessonSlot extends Model{
    use SoftDeletes;

    // protected $dates = [
    //     'start_at',
    // ];

    protected $fillable = [
        'lesson_id', 
        'meeting_id', 
        'topic', 
        'description', 
        'start_at', 
        'duration', 
        'password', 
        'student_limit', 
        'start_url', 
        'join_url'
    ];

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function lessonSlotBookings(){
        return $this->hasMany(LessonSlotBooking::class);
    }

    public function isFullyBooked(){
        $bookedCount = $this->lessonSlotBookings()->count();
        return $bookedCount >= $this->student_limit;
    }
}
