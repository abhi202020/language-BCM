<?php

namespace App\Models;

use App\Models\Auth\User;
use App\Models\Lesson;
use App\Models\LiveLessonSlot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;

class LessonSlotBooking extends Model{
    protected $fillable = ['live_lesson_slot_id', 'user_id', 'lesson_id'];

    protected static function booted(){
        static::created(function ($booking) {
            Log::info('Booking created for User ID ' . $booking->user_id . ' and Lesson ID ' . $booking->lesson_id);
    
            try {
                // Increment attendance_count in user_attendance table
                $updatedAttendanceCount = DB::table('user_attendance')
                    ->where('user_id', $booking->user_id)
                    ->where('lesson_id', $booking->lesson_id)
                    ->increment('attendance_count');
    
                Log::info('Attendance count incremented for User ID ' . $booking->user_id . ' and Lesson ID ' . $booking->lesson_id . ': ' . $updatedAttendanceCount);
            } catch (\Exception $e) {
                Log::error('Error incrementing attendance count for User ID ' . $booking->user_id . ' and Lesson ID ' . $booking->lesson_id . ': ' . $e->getMessage());
            }
        });
    }
    

    public function liveLessonSlot(){
        return $this->belongsTo(LiveLessonSlot::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    // Add this method to enforce the unique constraint
    public static function boot(){
        parent::boot();

        static::saving(function ($model) {
            // Check if there is already a booking with the same user_id and live_lesson_slot_id
            $existingBooking = LessonSlotBooking::where('user_id', $model->user_id)
                ->where('live_lesson_slot_id', $model->live_lesson_slot_id)
                ->first();

            if ($existingBooking) {
                // Cancel the saving process if the user has already booked this lesson slot
                return false;
            }
        });
    }
}
