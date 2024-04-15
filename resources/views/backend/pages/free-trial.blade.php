@extends('frontend.layouts.app' . config('theme_layout'))



@push('after-styles')
    <style>
        .content img {
            margin: 10px;
        }

        .about-page-section ul {
            padding-left: 20px;
            font-size: 20px;
            color: #333333;
            font-weight: 300;
            margin-bottom: 25px;
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
                    <h2 class="breadcrumb-head black bold"> <span>Margie's Magical Verbs</span></h2>
                </div>
            </div>
        </div>
    </section>

    <section class="how-its-work">
        <div class="jarallax  backgroud-style">
            <div class="container">
                <div class="section-title mb45 headline text-center ">

                    <h2 style="
    margin: 20px;
">Free trial</h2>


                    <div class="content-image">
                        <div class="content" style="
    flex: 1;
        margin: 10px;
">

                            <h3>How does the 30-day free trial work?</h3>
                            <br>
                            <p>The 30-day free trial gives you the chance to follow 5 Spanish lessons for free, with no
                                pressure to decide if you want to continue with the paid course after the free trial ends.
                            </p>
                            <p>You'll need to create a Margie's Magical Verbs account and you will receive a link to the
                                free trial.</p>
                            <p>If you like what you see, you go to the library' and add any video's you want.
                                We do have a sequence, to make it easier for you to learn and speak real life
                                Spanish fast.</p>




                        </div>
                        <div class="content" style="
    flex: 1;
        margin: 10px;
">

                            <h3>Why is this course different?</h3>
                            <br>
                            <p>Most of the language courses require a paid subscription to access the course.
                                Margie's Magical Verbs is different. You pay separately for all 3 options.</p>
                            <p>No need to pay a monthly fee for years which ends up to be very expensive.</p>
                            <p>Take a free trial of our Spanish course to discover how Margie's Magical Verbs is all about!
                                Once you are signed up, you'll have access to 5 sample lessons.</p>
                            <p>You are less than 30 seconds away from getting started!</p>



                        </div>

                    </div>
                    <div class="bottom">


                        <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font ">
                            <a href="http://margiesmagicalverbs.com/courses">Start Free Trial! <i
                                    class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                    <br>
                    <p>Join us in the course now. I am looking forward to jumping in so we can start this journey together!
                        I am determined to teach you the secrets of my 'Magical Verbs' and all I know about this beautiful
                        language.</p>

                    <p>I hope you'll give me a chance to help you too!</p>

                    <p>Hasta pronto! Margie</p>
                </div>
            </div>
    </section>
    <section class="how-its-work">
        <div class="jarallax  backgroud-style">
            <div class="container">
                <div class="section-title mb45 headline text-center "
                    style="
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
">

                    <h2 style="
    margin-bottom: 20px;
">Online Spanish lessons</h2>


                    <div class="content-image">
                        <div class="image" style="
    flex: 1;
">
                            <img src="/images/ft1.png" alt="" style="
    height: 100%;
    object-fit: cover;
">
                        </div>
                        <div class="content"
                            style="
    flex: 1;
        display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    text-align: left;
    margin: 20px;
">


                            <p> <b>Lesson 1:</b> What is masculine or feminine? In Spanish all nouns have a gender. Every
                                word for a
                                person, place, thing is either masculine or feminine. This lesson will demonstrate what
                                determines whether a word is feminine or masculine.</p>
                            <p> <b>Lesson 2: </b> How to spell in Spanish? This lesson will explain you how to spell every
                                word in
                                the Spanish alphabet. This is a very useful lesson, as you need to know the Spanish alphabet
                                to be able to spell your name, address, email address and much more.</p>
                            <p> <b> Lesson 3:</b> Everything you need to know about email address. Your email address is a
                                common
                                address you will use in Spanish. How to you say your email address?</p>
                            <p> <b> Lesson 4:</b> First grammar lesson. Learning the rules of Spanish can be difficult.
                                Sometimes
                                even boring...I will show you some aspect of the language you need to know.</p>
                            <p> <b> Lesson 5:</b> Some people say that grammar - though the most important aspect of the
                                grammar -
                                can be boring. But wait, now I will teach you how learning conjugation for some verbs can be
                                exciting. <b> Let the 'magic' begin!</b></p>




                        </div>

                    </div>




                </div>
            </div>
    </section>
@endsection
