<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Backend\LiveLesson\TeacherMeetingSlotMail;
use App\Models\Auth\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LiveLesson;
use App\Models\LiveLessonSlot;
use App\Models\LessonSlotBooking;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Jubaer\Zoom\Zoom;

class LiveLessonSlotController extends Controller{

    // Display a listing of the resource.
    public function index(){
        // Get all live lesson slots
        $liveLessonSlots = LiveLessonSlot::with('lesson.course')
            ->get();
    
        return view('backend.live-lesson-slots.index', compact('liveLessonSlots'));
    }    
    
    // Show the form for creating a new resource.
    public function create(){
        if (!Gate::allows('live_lesson_slot_create')) {
            return abort(401);
        }
        $lessons = Lesson::ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        return view('backend.live-lesson-slots.create', compact('lessons'));
    }

    // update database with zoom variables
    private function saveLiveLessonSlot(Request $request){
        Log::info('-----------------------------------');
        Log::info('saveLiveLessonSlot');
    
        try {
            // Validate the form data (customize as per your requirements)
            $validatedData = $request->validate([
                'lesson_id' => 'required',
                'topic' => 'required',
                'description' => 'required',
                'start_at' => 'required',
                'duration' => 'required',
                'password' => 'required',
                'student_limit' => 'required',
            ]);
            Log::info('Validated form data:', $validatedData);
     
            // Create a new LiveLessonSlot instance
            $liveLessonSlot = new LiveLessonSlot();
            Log::info('LiveLessonSlot instance.');
    
            // Populate the instance with form data
            $liveLessonSlot->lesson_id = $validatedData['lesson_id'];
            $liveLessonSlot->topic = $validatedData['topic'];
            $liveLessonSlot->description = $validatedData['description'];
            $liveLessonSlot->start_at = $validatedData['start_at'];
            $liveLessonSlot->duration = $validatedData['duration'];
            $liveLessonSlot->password = $validatedData['password'];
            $liveLessonSlot->student_limit = $validatedData['student_limit'];
    
            // Log the time being saved
            $savingStartTime = $liveLessonSlot->start_at;
            Log::info('Start Time Before Saving:', ['start_at' => $savingStartTime]);
    
            // Save the live lesson slot to the database
            $saved = $liveLessonSlot->save();
            Log::info('Time After Saving:', ['start_at' => $liveLessonSlot->start_at]);
    
            if ($saved) {
                Log::info('Saved LiveLessonSlot to the database.');
                return $liveLessonSlot;
            } else {
                Log::warning('Failed to save LiveLessonSlot to the database.');
                throw new \Exception('Failed to save LiveLessonSlot to the database.');
            }
        } catch (\Exception $e) {
            Log::error('Error saving live lesson slot: ' . $e->getMessage());
            throw $e;
        }
    }

    // createZoomMeeting function
   private function createZoomMeeting($liveLessonSlot) {
    try {
        Log::info('createZoomMeeting function');

        $timezone = config('app.timezone');
        $meetingData = [
            "agenda" => $liveLessonSlot->agenda,
            "topic" => $liveLessonSlot->topic,
            "type" => 2, // 2 => scheduled meeting
            "duration" => $liveLessonSlot->duration,
            "timezone" => $timezone,
            "password" => $liveLessonSlot->password,
            "start_time" => $liveLessonSlot->start_at,
            "student_limit" => $liveLessonSlot->student_limit,
            "settings" => [
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => false,
                'waiting_room' => false,
                'audio' => 'both',
                'auto_recording' => 'none',
                'approval_type' => 0,
            ],
        ];
        $zoom = app('Zoom');
        $zoomMeeting = $zoom::createMeeting($meetingData);
        // Log the complete response for debugging
        Log::info('Connected to Zoom API:', ['response' => $zoomMeeting]);

        // Check if the meeting was created successfully
        if ($zoomMeeting && isset($zoomMeeting['status']) && $zoomMeeting['status']) {
                // Get the meeting details
                $meetingId = $zoomMeeting['data']['id'];
               
                $meetingData['meeting_id'] = $zoomMeeting['data']['id'];
                $meetingData['start_url'] = $zoomMeeting['data']['start_url'];
                // $liveLesson->start_url = $meetingData['start_url'];

                Log::info('Meeting ID:', ['id' => $meetingId]);
                Log::info('Meeting Start URL:', ['start_url' => $meetingData['start_url']]);
// echo "meetingId".$meetingId;die();
                return $meetingData;
            }
        return null;

    } catch (\Exception $e) {
        Log::error('Error creating Zoom meeting: ' . $e->getMessage());
        throw $e;
    }
}

    // store function
    public function store(Request $request) {
        Log::info('-----------------------------------');
        Log::info('store');

        try {
            $liveLessonSlot = $this->saveLiveLessonSlot($request);
           
            $meetingData = $this->createZoomMeeting($liveLessonSlot);
            
            $meetingId = $meetingData["meeting_id"];

            if ($meetingId) {
            $liveLessonSlot->start_url = $meetingData["start_url"];
                // Update the LiveLessonSlot with the meeting ID
                $liveLessonSlot->meeting_id = $meetingId;

                Log::info('Start Time: ' . Carbon::parse($liveLessonSlot->start_at)->setTimezone(config('app.timezone'))->toDateTimeString());
                Log::info('Start URL:', ['start_url' => $liveLessonSlot->start_url]);

                $liveLessonSlot->save();
                Log::info('Meeting ID added to LiveLessonSlot: ' . $meetingId);

                // Redirect back or perform other actions
                return redirect()->route('admin.live-lesson-slots.index', ['lesson_id' => $liveLessonSlot->lesson_id])
                ->with('success', 'Live Lesson Slot created successfully with Zoom meeting ID: ' . $meetingId);            
            } else {
                // Handle the case where Zoom meeting creation was not successful
                return redirect()->back()->with('error', 'An error occurred while creating the Live Lesson Slot.');
            }
        } catch (\Exception $e) {
            Log::error('Error storing live lesson slot with Zoom meeting: ' . $e->getMessage());
            // You can handle the error here, redirect with an error message, or return a response
            // For simplicity, let's redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while creating the Live Lesson Slot.');
        }
    }

    // Display the specified resource.
    public function show(LiveLessonSlot $liveLessonSlot){
        if(!Gate::allows('live_lesson_slot_view')){
            return abort(401);
        }
        return view('backend.live-lesson-slots.show', compact('liveLessonSlot'));
    }

    // Show the form for editing the specified resource.
    public function edit(LiveLessonSlot $liveLessonSlot){
        if(!Gate::allows('live_lesson_slot_edit')){
            return abort(401);
        }
        $lessons = Lesson::ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');
        return view('backend.live-lesson-slots.edit', compact('lessons','liveLessonSlot'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, LiveLessonSlot $liveLessonSlot){
        try {
            // Validate the form data (customize as per your requirements)
            $request->validate([
                'lesson_id' => 'required',
                'topic' => 'required',
                'description' => 'required',
                'start_at' => 'required',
                'duration' => 'required',
                'password' => 'required',
                'student_limit' => 'required',
            ]);
    
            // Get the form variables
            $formVariables = $request->only([
                'lesson_id',
                'topic',
                'description',
                'start_at',
                'duration',
                'password',
                'student_limit',
            ]);
    
            // Update LiveLessonSlot with new variables
            $liveLessonSlot->update($formVariables);
    
            // Save the updated LiveLessonSlot to the database
            $liveLessonSlot->save();
    
            return redirect()->route('admin.live-lesson-slots.index', ['lesson_id' => $liveLessonSlot->lesson_id])
            ->with('success', 'Live Lesson Slot updated successfully');        
        } catch (\Exception $e) {
            // Handle the error (e.g., log it, redirect with an error message)
            return redirect()->back()->with('error', 'An error occurred while updating the Live Lesson Slot.');
        }
    }    

    public function destroy(LiveLessonSlot $liveLessonSlot) {
        Log::info('-----------------------------------');
        if (!Gate::allows('live_lesson_slot_delete')) {
            return abort(401);
        }
        try {
            // Step 1: Get the meeting ID from LiveLessonSlot
            $meetingId = $liveLessonSlot->meeting_id;
    
            // Check if the meeting ID exists before attempting to delete
            if ($meetingId) {
                // Fetch the LiveLessonSlot instance by meeting ID
                $relatedLessonSlot = LiveLessonSlot::where('meeting_id', $meetingId)->first();
    
                if ($relatedLessonSlot) {
                    // Access Zoom meeting details from the related LiveLessonSlot instance
                    $meetingDetails = [
                        'start_url' => $relatedLessonSlot->start_url,
                        // Add other Zoom meeting details as needed
                    ];
    
                    // Log the meeting details for debugging
                    Log::info('Zoom Meeting Details:', $meetingDetails);
                    
                    // Now, you can perform actions with the Zoom meeting details
                    // For example, delete the Zoom meeting
                    // $deleteMeetingResponse = Zoom::deleteMeeting($meetingId);
                }
            }
    
            // Step 2: Remove the LiveLessonSlot from the database
            $liveLessonSlot->forceDelete();
    
            // Log that the LiveLessonSlot was removed
            Log::info('LiveLessonSlot removed:', ['liveLessonSlot' => $liveLessonSlot]);
    
            // Step 3: Redirect with success message
            return redirect()->route('admin.live-lesson-slots.index')->withFlashSuccess(__('alerts.backend.general.deleted'));
        } catch (\Exception $e) {
            // Step 4: Handle any errors that might occur during deletion
            Log::error('Error during LiveLessonSlot deletion: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the Live Lesson Slot.');
        }
    }    

    private function meetingCreateOrUpdate(Request $request, $update = false, $meetingId = null){
        $user = Zoom::user()->get()->first();
        $meetingData = [
            'topic' => $request->topic,
            'type' => 2,
            'agenda' => $request->description,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_at,
            'timezone' => config('zoom.timezone')
        ];

        if($update){
            $meeting = Zoom::meeting()->find($meetingId);
            $meeting->update($meetingData);
        }else {
            $meeting = Zoom::meeting()->make($meetingData);
        }

        $meeting->settings()->make([
            'join_before_host' => $request->change_default_setting ? ($request->join_before_host ? true: false) : (config('zoom.join_before_host')? true: false),
            'host_video' => $request->change_default_setting ? ($request->host_video ? true: false) : (config('zoom.host_video') ? true : false),
            'participant_video' => $request->change_default_setting ? ($request->participant_video ? true: false) : (config('zoom.participant_video') ? true : false),
            'mute_upon_entry' => $request->change_default_setting ? ($request->participant_mic_mute ? true: false) : (config('zoom.mute_upon_entry') ? true : false),
            'waiting_room' => $request->change_default_setting ? ($request->waiting_room ? true: false) : (config('zoom.waiting_room') ? true : false),
            'approval_type' => $request->change_default_setting ? $request->approval_type : config('zoom.approval_type'),
            'audio' => $request->change_default_setting ? $request->audio_option : config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);

        return $user->meetings()->save($meeting);
    }   

    private function meetingMail($liveLessonSlot){
        foreach ($liveLessonSlot->lesson->course->teachers as $teacher){
            $content = [
                'name' => $teacher->name,
                'course' => $liveLessonSlot->lesson->course->title,
                'lesson' => $liveLessonSlot->lesson->title,
                'meeting_id' => $liveLessonSlot->meeting_id,
                'password' => $liveLessonSlot->password,
                'start_at' => $liveLessonSlot->start_at,
                'start_url' => $liveLessonSlot->start_url
            ];
            \Mail::to($teacher->email)->send(new TeacherMeetingSlotMail($content));
        }
    }

    public function bookSlot($slotId){
        Log::info('-----------------------------------');
        Log::info('book slot function');
    
        try {
            $user = auth()->user()->refresh(); // Refresh user information
            Log::info('User ' . $user->id . ' is attempting to book slot ' . $slotId);
    
            $slot = LiveLessonSlot::findOrFail($slotId);
            Log::info('Course ID:' . $slot->lesson->course_id);
            Log::info('Student limit for slot ID ' . $slotId . ': ' . $slot->student_limit);
    
            // get course_student table here
            $purchasedCourses = $this->getPurchasedCourses($user->id);
            Log::info('List of purchased courses for user ' . $user->id . ': ' . json_encode($purchasedCourses));
    
            // Get the list of current attendees
            $currentAttendees = $slot->lessonSlotBookings;
            Log::info('List of current attendees for slot ID ' . $slotId . ': ' . json_encode($currentAttendees));
    
            // Calculate available slots
            $availableSlots = $slot->student_limit - count($currentAttendees);
            Log::info('Available slots for slot ID ' . $slotId . ': ' . $availableSlots);
    
            // Check if there are no available slots
            if ($availableSlots <= 0) {
                Log::info('No available slots for slot ID ' . $slotId);
                return redirect()->back()->with('error', 'No available slots for this slot.');
            }
    
            // Check if the user can book more meetings
            if ($this->canUserBookLiveLesson($user->id, $slot->lesson_id)) {
                Log::info('User ' . $user->id . ' can book more meetings for lesson ID ' . $slot->lesson_id);
    
                // Call the function to add the user to the meeting
                $this->addUserToMeeting($slot, $user);
    
                return redirect()->back()->with('success', 'Slot booked successfully.');
            } else {
                Log::info('User ' . $user->id . ' has attended the maximum allowed meetings for lesson ID ' . $slot->lesson_id);
                return redirect()->back()->with('error', 'You have attended the maximum allowed meetings for this lesson.');
            }
        } catch (\Exception $e) {
            Log::error('Error booking slot with ID ' . $slotId . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while booking the slot.');
        }
    }

    // courses user has purchased
    private function getPurchasedCourses($userId) {
        Log::info('get purchased courses function');
        $purchasedCourses = DB::table('course_student')
            ->where('user_id', $userId)
            ->pluck('course_id')
            ->toArray();
        return $purchasedCourses;
    }

    private function updateUserAttendance($userId, $lessonId) {
        Log::info('Updating user attendance for user ' . $userId . ' and lesson ' . $lessonId);
    
        try {
            // Increment attendance count
            DB::table('user_attendance')
                ->where('user_id', $userId)
                ->where('lesson_id', $lessonId)
                ->increment('attendance_count');
    
            // Retrieve updated attendance count
            $attendanceCount = DB::table('user_attendance')
                ->where('user_id', $userId)
                ->where('lesson_id', $lessonId)
                ->value('attendance_count');
    
            Log::info('User attendance updated. Updated count: ' . $attendanceCount);
    
            // Log executed SQL queries
            Log::info('SQL Queries: ' . json_encode(DB::getQueryLog()));
        } catch (\Exception $e) {
            Log::error('Error updating user attendance: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    private function addUserToMeeting(LiveLessonSlot $slot, User $user) {
        Log::info('add user to meeting function');
        
        try {
            // Create a new LessonSlotBooking record for the user
            $booking = new LessonSlotBooking([
                'user_id' => $user->id,
                'live_lesson_slot_id' => $slot->id,
                'lesson_id' => $slot->lesson_id,
            ]);

            // Save the booking to the database
            $booking->save();

            // Check if the user is already attending the meeting
            if ($this->isUserAttendingMeeting($user->id, $slot->id, $booking->id)) {
                Log::info('User ' . $user->id . ' is already attending the meeting for slot ID ' . $slot->id);
                return redirect()->back()->with('error', 'You are already attending this meeting.');
            }

            // Update user_attendance table
            $this->updateUserAttendance($user->id, $slot->lesson_id);

            // Log the updated attendance count
            $attendanceCount = DB::table('user_attendance')
                ->where('user_id', $user->id)
                ->where('lesson_id', $slot->lesson_id)
                ->value('attendance_count');
            Log::info('Updated attendance count: ' . $attendanceCount);

            Log::info('User ' . $user->id . ' added to the meeting for slot ID ' . $slot->id);

            return redirect()->back()->with('success', 'Slot booked successfully.');
        } catch (\Exception $e) {
            Log::error('Error adding user to meeting for slot ID ' . $slot->id . ': ' . $e->getMessage());
            // You may want to handle the error accordingly (e.g., throw an exception, log, etc.)
            return redirect()->back()->with('error', 'An error occurred while booking the slot.');
        }
    }

    private function isUserAttendingMeeting($userId, $slotId) {
        Log::info('is user attending meeting function');
        
        return LessonSlotBooking::where('user_id', $userId)
            ->where('live_lesson_slot_id', $slotId)
            ->exists();
    }

    private function canUserBookLiveLesson($userId, $lessonId) {
        Log::info('can user book live lesson function');
    
        $attendanceCount = DB::table('user_attendance')
            ->where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->value('attendance_count');
    
        if ($attendanceCount === null) {
            // Handle the case where the record is missing (e.g., create a new record)
            // You can customize this part based on your application's needs.
            $this->createUserAttendanceRecord($userId, $lessonId);
            $attendanceCount = 0; // Assuming the default value is 0 after creating a new record.
        }
    
        Log::info('Current attendance count for lesson ID ' . $lessonId . ': ' . $attendanceCount);
    
        $maxMeetings = 2;
        Log::info('Maximum allowed meetings: ' . $maxMeetings);
    
        $canBook = $attendanceCount < $maxMeetings;
        Log::info('Can the user book more meetings? ' . ($canBook ? 'Yes' : 'No'));
    
        return $canBook;
    }
    
    private function createUserAttendanceRecord($userId, $lessonId) {
        // Create a new record in the user_attendance table
        DB::table('user_attendance')->insert([
            'user_id' => $userId,
            'lesson_id' => $lessonId,
            'attendance_count' => 0, // Assuming the default value is 0
        ]);
    
        Log::info('User attendance record created for user ' . $userId . ' and lesson ' . $lessonId);
    }
}