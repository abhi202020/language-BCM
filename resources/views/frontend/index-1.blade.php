@extends('frontend.layouts.app' . config('theme_layout'))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')

@push('after-styles')
    <style>
        /*.address-details.ul-li-block{*/
        /*line-height: 60px;*/
        /*}*/
        .teacher-img-content .teacher-social-name {
            max-width: 67px;
        }

        .my-alert {
            position: absolute;
            z-index: 10;
            left: 0;
            right: 0;
            top: 25%;
            width: 50%;
            margin: auto;
            display: inline-block;
        }
    </style>
@endpush

<!-- export section into - resources/views/frontend/layouts/app1.blade.php -->
@section('content')
    
    @if (session()->has('alert'))
        <div class="alert alert-light alert-dismissible fade my-alert show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{ session('alert') }}</strong>
        </div>
    @endif

    <!-- section 1 - image slider -->
    @include('frontend.layouts.partials.slider')
    <!-- end section 1  -->

    @if ($sections->search_section->status == 1)
        {{-- <section id="search-course" class="search-course-section">
            <div class="container">
                <div class="section-title mb20 headline text-center ">
                    <span class="subtitle text-uppercase">@lang('labels.frontend.home.learn_new_skills')</span>
                    <h2>@lang('labels.frontend.home.search_courses')</h2>
                </div>
                <div class="search-course mb30 relative-position ">
                    <form action="{{route('search')}}" method="get">
                        <div class="input-group search-group">
                            <input class="course" name="q" type="text"
                                   placeholder="@lang('labels.frontend.home.search_course_placeholder')">
                            <select name="category" class="select form-control">
                                @if (count($categories) > 0)
                                    <option value="">@lang('labels.frontend.course.select_category')</option>
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @else
                                    <option>>@lang('labels.frontend.home.no_data_available')</option>
                                @endif
                            </select>
                            <div class="nws-button position-relative text-center  gradient-bg text-capitalize">
                                <button type="submit" value="Submit">@lang('labels.frontend.home.search_course')</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="search-counter-up">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-graduation-hat"></i>
                                </div>
                                <div class="counter-number">
                                    <span class=" bold-font">{{$total_students}}</span>
                                    <p>@lang('labels.frontend.home.students_enrolled')</p>
                                </div>
                            </div>
                        </div>
                        <!-- /counter -->

                        <div class="col-md-4 col-sm-4">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-book"></i>
                                </div>
                                <div class="counter-number">
                                    <span class=" bold-font">{{$total_courses}}</span>
                                    <p>@lang('labels.frontend.home.online_available_courses')</p>
                                </div>
                            </div>
                        </div>
                        <!-- /counter -->

                        <div class="col-md-4 col-sm-4">
                            <div class="counter-icon-number ">
                                <div class="counter-icon">
                                    <i class="text-gradiant flaticon-group"></i>
                                </div>
                                <div class="counter-number">
                                    <span class=" bold-font">{{$total_teachers}}</span>
                                    <p>@lang('labels.frontend.home.teachers')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    @endif

    <!-- section 2 - free trial -->
    <div class="update">
        <div class="text">
            <div class="section-title mb45 headline ">
                <span class="subtitle text-uppercase">Quick &amp; efficient</span>
                <h2>A new way tolearn Spanish </h2>
            </div>
            <p> Tired of repeating the same words but not actually communicating in Spanish? <br>
                Finding Spanish conjugation too difficult?</p>
            <p style="font-weight: bold;"> Learn real Spanish through my 12 Magical Verbs <br>
                Bite sized video lessons with or without live online classes. <br>
                The choice is yours!</p>
            <p> Start engaging in real daily life conversations, after just a few lessons!</p>
            <div class="bottom">
                <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font ">
                    <a href="http://margiesmagicalverbs.com/courses">Start Free Trial! <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="image">
            <img src="/images/index1.jpg" alt="">
        </div>
    </div>
    <!-- section 2 - end -->

    <!-- section 3 - why choose margie -->
    <section class="why-choose">
        <div class="jarallax  backgroud-style">
            <div class="container">
                <div class="section-title mb45 headline text-center ">
                    <span class="subtitle text-uppercase">A unique method</span>
                    <h2>Why choose Margie's Magical verbs? </h2>

                    {{-- <div class="cards carousel"  > --}}
                    <div class="cards ">
                        {{-- <div class="card carousel__item"> --}}
                        <div class="card ">
                            <div class="title">
                                <h1>Real life <br>conversations</h1>
                            </div>
                            <div class="text">
                                <p> Spanish course designed for speaking!</p>
                                <p> The 12 Magical Verbs help you build sentences without the difficult grammar.</p>
                                <p> No random words to memorize!</p>
                            </div>
                            <div class="image">
                                <img src="/images/real-life-conversations.jpg" alt="">
                            </div>
                        </div>
                        {{-- <div class="card carousel__item"> --}}
                        <div class="card ">
                            <div class="image">
                                <img src="https://images.unsplash.com/photo-1566513783362-fd923a368d6b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80" alt="">
                            </div>
                            <div class="title">
                                <h1> Explore at your <br> own pace</h1>
                            </div>
                            <div class="text">
                                <p> Watch the lessons and modules when it suits you best.</p>
                                <p> Want to go from self-studying to live classes? No problem!</p>
                                <p>Just add it on! This course is designed with 'you' in mind!</p>
                            </div>
                        </div>
                        {{-- <div class="card carousel__item"> --}}
                        <div class="card ">
                            <div class="title">
                                <h1> More choices <br> to learn</h1>
                            </div>
                            <div class="text">
                                <p> No subscritions!</p>
                                <p> Whether you just choose for the online video lessons or would like more help in live
                                    classes, Margie's Magical Verbs offers personalised learning.</p>
                                <p> Choose the option that is right for you!</p>
                            </div>
                            <div class="image">
                                <img src="/images/learn-spanish-on-the-go.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section 3 - end -->

    <!-- section 4 - reviews -->
    <section class="testimonial">
        <div class="jarallax  backgroud-style">
            <div class="container">
                <div class="section-title mb45 headline text-center ">
                    <span class="subtitle text-uppercase">A unique method</span>
                    <h2>See what other students say about the course</h2>
                    <div class="reviews">
                        <div class="videos">
                            <div class="video">
                                {{-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/KIyltIYSc6Q"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe> --}}
                                <video controls width="250" height="250">
                                    <source src="/images/r1.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="video">
                                {{-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/En7ZfL9iyRY"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe> --}}
                                <video controls width="250" height="250">
                                    <source src="/images/r2.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="video">
                                <video controls width="250" height="250">
                                    <source src="/images/r3.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="video">
                                <video controls width="250" height="250">
                                    <source src="/images/r4.mp4" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        <div class="comments">
                            <div class="comment">
                                <div class="image">
                                    <img src="/images/review1.jpg" alt="" style="width: 774px;">
                                </div>
                                <div class="text">
                                    <p> I followed a Spanish course, when living in Spain but couldn't SAY anything!
                                        Margie's Magical Verbs really
                                        allowed me to speak! Margie, you rock!
                                    </p><span style="font-weight: bold;"> Maayke – Sydney</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="image">
                                    <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=774&amp;q=80"
                                        alt="" style="width: 774px;">
                                </div>
                                <div class="text">
                                    <p> I love how Margie's Magical Verbs has taught me to speak Spanish! I could actually
                                        put sentences together! Better than any Spanish course I tried before!!</p>
                                    <span style="font-weight: bold;"> Finn – Mallorca</span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="image">

                                    <img src="/images/review2.jpg" alt="" style="width: 774px;">
                                </div>
                                <div class="text">
                                    <p> I almost gave up learning Spanish! The Spanish grammar is so complicated! Margie's
                                        Magical verbs inspired me again. Thank you Margie for giving my motivation back!</p>
                                    <span style="font-weight: bold;"> Erik – Amsterdam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section 4 - end -->

    <!-- section 5 - course options -->
    <section class="courseOptions">
        <div class="jarallax  backgroud-style">
            <div class="container">
                <div class="section-title mb45 headline text-center ">
                    <span class="subtitle text-uppercase">Margie's Magical Verbs</span>
                    <h2>Course options</h2>
                    <div class="courses">
                        <div class="description">
                            <p>41 online video lessons</p>
                            <p>Worksheets</p>
                            <p>Audio's</p>
                            <p>e-Dictionary</p>
                            <p>live group tutorials (45 min)</p>
                            <p>15 private live lessons (45 min)</p>
                        </div>

                        <div class="option1">
                            <h1>Option 1</h1>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <p>x</p>
                            <p>1</p>
                            <p>x</p>
                            <p>affordable</p>
                        </div>

                        <div class="option2">
                            <h1>Option 2</h1>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <p>10</p>
                            <p>x</p>
                            <p>Best value</p>
                        </div>

                        <div class="option3">
                            <h1>Option 3</h1>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <p>UNLIMITED</p>
                            <div class="check">
                                <i class="fa fa-check"></i>
                            </div>
                            <p>VIP</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section 5 - end -->

    {{-- @if ($sections->reasons->status != 0 || $sections->testimonial->status != 0)
        <section id="why-choose-us" class="why-choose-us-section">
            <div class="jarallax  backgroud-style">
                <div class="container"> 
                    @if ($sections->reasons->status == 1)
                        <div class="section-title mb20 headline text-cewhy-choose-us-sectionwhy-choose-us-sectionnter " style="text-align: center">
                            <span class="subtitle text-uppercase">{{env('APP_NAME')}} @lang('labels.frontend.layouts.partials.advantages')</span>
                            <h2 style="text-align: center">@lang('labels.frontend.layouts.partials.why_choose') <span>{{app_name()}}?</span></h2>
                        </div>
                        @if ($reasons->count() > 0)
                            <div id="service-slide-item" class="service-slide">
                                @foreach ($reasons as $item)
                                    <div class="service-text-icon ">
                                        <div class="service-icon float-left">
                                            <i class="text-gradiant {{$item->icon}}"></i>
                                        </div>
                                        <div class="service-text">
                                            <h3 class="bold-font">{{$item->title}}</h3>
                                            <p>{{$item->content}}.</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                    @if ($sections->testimonial->status == 1)
                        <div class="testimonial-slide">
                            <div class="section-title-2 mb65 headline text-left ">
                                <h2>@lang('labels.frontend.layouts.partials.students_testimonial')</h2>
                            </div>
                            @if ($testimonials->count() > 0)
                                <div id="testimonial-slide-item" class="testimonial-slide-area">
                                    @foreach ($testimonials as $item)
                                        <div class="student-qoute ">
                                            <p>{{$item->content}}</p>
                                            <div class="student-name-designation">
                                                <span class="st-name bold-font">{{$item->name}} </span>
                                                <span class="st-designation">{{$item->occupation}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h4>@lang('labels.general.no_data_available')</h4>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif --}}

    {{-- 
    @if ($sections->latest_news->status == 1)
        <!-- Start latest section
        ============================================= -->
        @include('frontend.layouts.partials.latest_news')
        <!-- End latest section
            ============================================= -->
    @endif --}}

    {{-- 
    @if ($sections->sponsors->status == 1)
        @if (count($sponsors) > 0)
            <!-- Start of sponsor section
        ============================================= -->
            <section id="sponsor" class="sponsor-section">
                <div class="container">
                    <div class="section-title-2 mb65 headline text-left ">
                        <h2>{{env('APP_NAME')}} <span>@lang('labels.frontend.layouts.partials.sponsors')</span></h2>
                    </div>

                    <div class="sponsor-item sponsor-1 text-center">
                        @foreach ($sponsors as $sponsor)
                            <div class="sponsor-pic text-center">
                                <a href="{{ ($sponsor->link != "") ? $sponsor->link : '#' }}">
                                    <img src={{asset("storage/uploads/".$sponsor->logo)}} alt="{{$sponsor->name}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif --}}

    {{-- @if ($sections->featured_courses->status == 1)
    @endif

    @if ($sections->teachers->status == 1)
        <section id="course-teacher" class="course-teacher-section">
            <div class="jarallax">
                <div class="container">
                    <div class="section-title mb20 headline text-center ">
                        <span class="subtitle text-uppercase">@lang('labels.frontend.home.our_professionals')</span>
                        <h2>{{env('APP_NAME')}} <span>@lang('labels.frontend.home.teachers').</span></h2>
                    </div>
                    <div class="teacher-list">
                        <div class="row justify-content-center">
                            @if (count($teachers) > 0)
                                @foreach ($teachers as $item)
                                    <div class="col-md-3">
                                        <div class="teacher-img-content ">
                                            <div class="teacher-content">
                                                <div class="teacher-social-name ul-li-block">
                                                    <ul>
                                                        <li><a href="{{'mailto:'.$item->email}}"><i class="fa fa-envelope"></i></a></li>
                                                        <li><a href="{{route('admin.messages',['teacher_id'=>$item->id])}}"><i class="fa fa-comments"></i></a></li>
                                                    </ul>
                                                    <div class="teacher-name">
                                                        <span>{{$item->full_name}}</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-img-category">
                                                    <div class="teacher-img">
                                                        <img src="{{$item->picture}}" style="height: 100%" alt="">
                                                        <div class="course-price text-uppercase text-center gradient-bg"> --}}
                                                       {{-- <span>Featured</span> --}}
                                                {{-- </div> --}}
                                                {{-- </div> --}}
                                                {{-- <div class="teacher-category float-right"> --}}
                                                {{-- <span class="st-name">{{$item->name}} </span> --}}
                                                {{-- </div> --}}
                                                {{-- </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font ">
                            <a href="https://margiesmagicalverbs.com/about-teachers">More Information<i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

    {{-- @if ($sections->course_by_category->status == 1)
        @include('frontend.layouts.partials.course_by_category')
    @endif --}}

    {{-- @if ($sections->contact_us->status == 1)
        @include('frontend.layouts.partials.contact_area')
    @endif --}}

@endsection
<!-- end export section - app1.blade.php -->

@push('after-scripts')
    <script>
        $('ul.product-tab').find('li:first').addClass('active');
    </script>
    <script>
        if (window.innerWidth < 960) {
            document.querySelectorAll(".carousel").forEach((carousel) => {
                const items = carousel.querySelectorAll(".carousel__item");
                const buttonsHtml = Array.from(items, () => {
                    return `<span class="carousel__button"></span>`;
                });

                carousel.insertAdjacentHTML(
                    "beforeend",
                    ` <div class="carousel__nav">
                        ${buttonsHtml.join("")}
                    </div> `
                );

                const buttons = carousel.querySelectorAll(".carousel__button");

                buttons.forEach((button, i) => {
                    button.addEventListener("click", () => {
                        // un-select all the items
                        items.forEach((item) =>
                            item.classList.remove("carousel__item--selected")
                        );
                        buttons.forEach((button) =>
                            button.classList.remove("carousel__button--selected")
                        );
                        items[i].classList.add("carousel__item--selected");
                        button.classList.add("carousel__button--selected");
                    });
                });

                // Select the first item on page load
                items[0].classList.add("carousel__item--selected");
                buttons[0].classList.add("carousel__button--selected");
            });
        }
    </script>
@endpush
