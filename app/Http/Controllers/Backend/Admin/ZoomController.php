<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonSlotBooking;
use App\Models\LiveLessonSlot;
use App\Models\UserAttendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ZoomController extends Controller {

    public function index() {
    Log::info('-----------------');
    Log::info('Zoom Controller - index');

    $userId = Auth::id();
    Log::info('User ID: ' . $userId);

    // Get all lessons booked by the user
    $bookedLessons = LessonSlotBooking::with('liveLessonSlot.lesson.course') // Eager loading relationships
        ->where('user_id', $userId)
        ->get();

    // Log the booked lessons including meeting IDs
    foreach ($bookedLessons as $lesson) {
        Log::info('Booked lesson: ' . $lesson->id . ', Meeting ID: ' . $lesson->liveLessonSlot->meeting_id);
    }

    // Check if the user has any booked lessons
    if ($bookedLessons->isEmpty()) {
        Log::info('User has no live lessons booked. Displaying appropriate blade for user type.');

        // Determine if the user is an admin or student and render the appropriate Blade view
        $isAdmin = Auth::user()->is_admin;
        return $isAdmin ? view('backend.live-lesson-slots.admin') : view('backend.live-lesson-slots.student');
    }

    // Render the appropriate Blade view based on user type
    $isAdmin = Auth::user()->is_admin;
    return $isAdmin ? view('backend.live-lesson-slots.admin', compact('bookedLessons')) : view('backend.live-lesson-slots.student', compact('bookedLessons'));
}


    public function cancelLesson($meetingId) {
        Log::info('Canceling Zoom meeting for Meeting ID: ' . $meetingId);
    
        $userId = Auth::id();
        Log::info('User ID: ' . $userId);
    
        // Find the LiveLessonSlot associated with the provided meeting ID
        $liveLessonSlot = LiveLessonSlot::where('meeting_id', $meetingId)->first();
    
        if ($liveLessonSlot) {
            // Check if the user has a booking for this LiveLessonSlot
            $booking = LessonSlotBooking::where('user_id', $userId)
                ->where('live_lesson_slot_id', $liveLessonSlot->id)
                ->first();
    
            if ($booking) {
                // Delete the LessonSlotBooking
                $booking->delete();
                Log::info('User ' . $userId . ' canceled the lesson for Meeting ID ' . $meetingId);
    
                // Decrement user_attendance count for the canceled lesson
                DB::table('user_attendance')
                    ->where('user_id', $userId)
                    ->where('lesson_id', $liveLessonSlot->lesson_id)
                    ->decrement('attendance_count', 1);
    
                // Additional actions or logging can be added here
    
                return redirect()->route('admin.zoom.index')->with('success', 'Lesson canceled successfully.');
            } else {
                Log::info('User ' . $userId . ' does not have a booking for Meeting ID ' . $meetingId);
            }
        } else {
            Log::info('Zoom meeting with ID ' . $meetingId . ' does not exist.');
        }
    
        // Redirect back with an error message
        return redirect()->route('admin.zoom.index')->with('error', 'Failed to cancel the lesson.');
    }

    private function bookLesson($userId, $lessonId){
        // Check if the user can book more meetings
        $canBookMoreMeetings = $this->userMeetingAttendance($userId, $lessonId);
    
        if ($canBookMoreMeetings) {
            // Book the lesson
            LessonSlotBooking::create([
                'user_id' => $userId,
                'lesson_id' => $lessonId,
            ]);            
    
            // Increment attendance count
            UserAttendance::updateOrCreate(
                ['user_id' => $userId, 'lesson_id' => $lessonId],
                ['attendance_count' => DB::raw('attendance_count + 1')]
            );
    
            return true;
        } else {
            // User has attended the maximum allowed meetings for this lesson
            return false;
        }
    }

    private function userMeetingAttendance($userId, $lessonId){
        // 1. Get user attendance count
        $attendanceCount = UserAttendance::where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->value('attendance_count');

        // 2. Max Meetings = 2
        $maxMeetings = 2;

        // 3. Check attendance conditions
        return $attendanceCount < $maxMeetings;
    }
}
