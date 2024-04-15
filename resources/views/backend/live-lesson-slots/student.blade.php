@extends('backend.layouts.app')

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/amigo-sorter/css/theme-default.css') }}">
    <style>
        /* Add your custom styles here */
        .card {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #cccccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.zoom.title')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Course</th>
                                    <th>Lesson</th> {{-- New column for lesson_id --}}
                                    <th>Meeting ID</th>
                                    <th>Password</th>
                                    <th>Duration</th>
                                    <th>Start URL</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($bookedLessons as $lessonBooking)
                                @php
                                    $liveLessonSlot = $lessonBooking->liveLessonSlot;
                                    $courseTitle = $liveLessonSlot->lesson->course->title ?? '';
                                @endphp
                                <tr>
                                    <td>{{ $liveLessonSlot->start_at }}</td>
                                    <td>{{ $courseTitle }}</td>
                                    <td>{{ $liveLessonSlot->lesson->id }}</td> {{-- Displaying lesson_id --}}
                                    <td>{{ $liveLessonSlot->meeting_id }}</td>
                                    <td>{{ $liveLessonSlot->password }}</td>
                                    <td>{{ $liveLessonSlot->duration }}</td>
                                    <td>
                                        <a href="{{ $liveLessonSlot->start_url }}" class="btn btn-primary" target="_blank">Join Lesson</a>
                                    </td>
                                    <td>
                                        <!-- Add your cancellation logic here if needed -->
                                        <form action="{{ route('admin.zoom.cancelLesson', $liveLessonSlot->meeting_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this lesson?')">Cancel Lesson</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No live lessons available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
