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

@section('title', __('labels.backend.live_lesson_slots.title').' | '.app_name())

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.live_lesson_slots.title')</h3>
            @can('live_lesson_slot_create')
                <div class="float-right">
                    <a href="{{ route('admin.live-lesson-slots.create') }}@if(request('lesson_id')){{'?lesson_id='.request('lesson_id')}}@endif"
                       class="btn btn-success">@lang('strings.backend.general.app_add_new')</a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Start At</th>
                            <th>Course</th>
                            <th>Topic</th>
                            <th>Duration</th>
                            <th>Meeting ID</th>
                            <th>Password</th>
                            <th>Students</th>
                            <th>Start URL</th>
                            <th>@lang('strings.backend.general.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($liveLessonSlots as $liveLessonSlot)
                            <tr>
                                <td>{{ $liveLessonSlot->start_at }}</td>
                                <td>{{ $liveLessonSlot->lesson->course->title ?? '' }}</td>
                                <td>{{ $liveLessonSlot->topic }}</td>
                                <td>{{ $liveLessonSlot->duration }}</td>
                                <td>{{ $liveLessonSlot->meeting_id }}</td>
                                <td>{{ $liveLessonSlot->password }}</td>
                                <td>{{ $liveLessonSlot->lessonSlotBookings->count() }}</td>
                                <td>
                                    <a href="{{ $liveLessonSlot->start_url }}" class="btn btn-primary" target="_blank">Join Lesson</a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <!-- Adjust the permissions check as needed for Show -->
                                        @can('live_lesson_slot_show')
                                            <a href="{{ route('admin.live-lesson-slots.show', $liveLessonSlot) }}" class="btn btn-info">
                                                Show
                                            </a>
                                        @endcan

                                        @can('live_lesson_slot_edit')
                                            <a href="{{ route('admin.live-lesson-slots.edit', $liveLessonSlot) }}" class="btn btn-primary">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('live_lesson_slot_delete')
                                            <form action="{{ route('admin.live-lesson-slots.destroy', $liveLessonSlot) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('@lang('strings.backend.general.are_you_sure')')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">No live lessons available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
