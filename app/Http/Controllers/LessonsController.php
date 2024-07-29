<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestsResult;
use App\Models\Question;
use App\Models\QuestionsOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    private $path;

    public function __construct()
    {
        $path = 'frontend';
        if (session()->has('display_type')) {
            if (session('display_type') == 'rtl') {
                $path = 'frontend-rtl';
            } else {
                $path = 'frontend';
            }
        } else if (config('app.display_type') == 'rtl') {
            $path = 'frontend-rtl';
        }
        $this->path = $path;
    }

    public function show($course_id, $lesson_slug)
    {
        $test_result = "";
        $completed_lessons = "";
        $test_pass = "";
        $total_questions = "";
        $percentage = "";

        $lesson = Lesson::where('slug', $lesson_slug)
            ->where('course_id', $course_id)
            ->where('published', '=', 1)
            ->first();

        // Handle case where lesson is actually a test
        if (!$lesson) {
            $lesson = Test::where('slug', $lesson_slug)
                ->where('course_id', $course_id)
                ->where('published', '=', 1)
                ->firstOrFail();
            $lesson->full_text = $lesson->description;

            $test_result = TestsResult::where('test_id', $lesson->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($lesson && $test_result) {
                $total_questions = $lesson->questions->count();
                $percentage = $test_result->test_result / $total_questions * 100;
                $test_pass = ($percentage < $lesson->passing_score) ? "Failed" : "Pass";
            }
        }

        // Optionally, handle lesson timer logic here

        // Retrieve all lessons and tests for the course
        $course_lessons = $lesson->course->lessons->pluck('id')->toArray();
        $course_tests = $lesson->course->tests ? $lesson->course->tests->pluck('id')->toArray() : [];
        $course_lessons = array_merge($course_lessons, $course_tests);

        // Retrieve previous and next lessons/tests based on sequence
        $previous_lesson = $lesson->course->courseTimeline()
            ->where('sequence', '<', $lesson->courseTimeline->sequence)
            ->whereIn('model_id', $course_lessons)
            ->orderBy('sequence', 'desc')
            ->first();

        $next_lesson = $lesson->course->courseTimeline()
            ->whereIn('model_id', $course_lessons)
            ->where('sequence', '>', $lesson->courseTimeline->sequence)
            ->orderBy('sequence', 'asc')
            ->first();

        // Retrieve all lessons/tests for the course based on sequence
        $lessons = $lesson->course->courseTimeline()
            ->whereIn('model_id', $course_lessons)
            ->orderby('sequence', 'asc')
            ->get();

        // Check if user has purchased the course
        $purchased_course = $lesson->course->students()->where('user_id', Auth::id())->count() > 0;

        // Determine if current lesson is a test
        $test_exists = ($lesson instanceof Test);

        // Retrieve completed lessons for the user
        $completed_lessons = Auth::user()->chapters()
            ->where('course_id', $lesson->course->id)
            ->get()
            ->pluck('model_id')
            ->toArray();

        return view($this->path . '.courses.lesson', compact('lesson', 'previous_lesson', 'next_lesson', 'test_result',
            'purchased_course', 'test_exists', 'lessons', 'completed_lessons', 'test_pass', 'percentage', 'total_questions'));
    }

    // Implement other methods such as test, retest, videoProgress, courseProgress, bookSlot as needed
}
