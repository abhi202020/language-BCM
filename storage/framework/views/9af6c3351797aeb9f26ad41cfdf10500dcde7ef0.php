

<?php $__env->startSection('title', trans('labels.frontend.home.title') . ' | ' . app_name()); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('meta_keywords', ''); ?>

<?php $__env->startPush('after-styles'); ?>
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
<?php $__env->stopPush(); ?>

<!-- export section into - resources/views/frontend/layouts/app1.blade.php -->
<?php $__env->startSection('content'); ?>
    
    <?php if(session()->has('alert')): ?>
        <div class="alert alert-light alert-dismissible fade my-alert show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo e(session('alert')); ?></strong>
        </div>
    <?php endif; ?>

    <!-- section 1 - image slider -->
    <?php echo $__env->make('frontend.layouts.partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- end section 1  -->

    <?php if($sections->search_section->status == 1): ?>
        
    <?php endif; ?>

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

                    
                    <div class="cards ">
                        
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
                                
                                <video controls width="250" height="250">
                                    <source src="/images/r1.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="video">
                                
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

    

    

    

    
                                                       
                                                
                                                
                                                
                                                
                                                
                                                

    

    

<?php $__env->stopSection(); ?>
<!-- end export section - app1.blade.php -->

<?php $__env->startPush('after-scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app' . config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/frontend/index-1.blade.php ENDPATH**/ ?>