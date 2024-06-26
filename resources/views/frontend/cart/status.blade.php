@extends('frontend.layouts.app'.config('theme_layout'))
@section('title', trans('labels.frontend.cart.payment_status').' | '.app_name())

@push('after-styles')
    <style>
        input[type="radio"] {
            display: inline-block !important;
        }
    </style>
@endpush

@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">@lang('labels.frontend.cart.your_payment_status')</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->
    <section id="checkout" class="checkout-section">
        <div class="container">
            <div class="section-title mb45 headline text-center">
            @if(Session::has('success'))
                <div class="section-title mb45 headline text-center">
                    <h2>{{ session('success') }}</h2>
                    <h3>@lang('labels.frontend.cart.success_message') <a href="{{ route('admin.dashboard') }}" style="color: blue;">your</a> course</h3>
                    <h4><a href="{{ route('courses.all') }}">@lang('labels.frontend.cart.see_more_courses')</a></h4>

                </div>
            @endif
            @if(Session::has('failure'))
                <div class="section-title mb45 headline text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h2>{{ session('failure') }}</h2>
                    <h4><a href="{{ route('cart.index') }}">@lang('labels.frontend.cart.go_back_to_cart')</a></h4>
                </div>
            @endif
            </div>
        </div>
    </section>
@endsection