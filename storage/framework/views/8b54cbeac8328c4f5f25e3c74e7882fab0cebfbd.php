<!-- Start of footer area
    ============================================= -->
<?php
    $footer_data = json_decode(config('footer_data'));
?>

<?php if($footer_data != ''): ?>
    <footer>


        <section id="footer-area" class="footer-area-section">
            <div class="top">
                <div class="links">
                    <div class="link">
                        <a href="#" class="fa fa-linkedin"></a>
                    </div>
                    <div class="link">
                        <a href="#" class="fa fa-facebook"></a>
                    </div>
                    <div class="link">
                        <a href="#" class="fa fa-twitter"><a>
                    </div>
                    <div class="link">
                        <a href="#" class="fa fa-instagram"></a>
                    </div>
                </div>

            </div>
            <div class="info">
                <div class="left">
                    <div class="siteNavegation">
                        <h1>Site Navigation</h1>
                        <p><a href="/courses"> Course</a></p>
                        <p><a href="/"> Margie's Magical Words</a></p>
                        <p><a href="/courses"> Pricing</a></p>
                        <p><a href="/blog"> Blogs</a></p>
                    </div>
                    <div class="custumerService">
                        <h1>Customer Service</h1>
                        <p><a href="/contact">Contact us</a></p>
                        <p><a href="/privacy-policy">Privacy Policy</a></p>
                        <p><a href="/terms-and-conditions">Terms & Conditions</a></p>
                    </div>
                    <div class="companyInformation">
                        <h1>Company Information</h1>
                        <p><a href="/courses"> About Margie</a></p>
                        <p><a href="/courses"> Courses</a></p>
                        <p><a href="/bundles"> Bundles</a></p>
                    </div>
                    <div class="yourAccount">
                        <h1>Your Account</h1>
                        <p><a href="/login"> Sign In</a></p>
                        <p style="font-weight: bold;"><a href="/login"> My account</a></p>
                    </div>
                </div>
                <div class="right">
                    <div class="secureOnlinePayments">
                        <h1>Secure Online Payments</h1>
                        <div class="ccards">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-stripe"></i>
                        </div>
                        <div class="infoFooter">
                            <p>All major credit and debit cards accepted securely online</p>
                            <p>c 2022 Margie's Magical Verbs.</p>
                            <p>All rights reserved</p>
                            <p>ABN 96 631 530 893</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="firstLine">
                    <div class="call">
                        <p>call our team:</p> <span>+34 608107295</span><i class="fa fa-phone"></i>
                    </div>
                    <div class="email">
                        <p>...or email us:</p> <span>customercare@margiesmagicalverbs.com</span>
                    </div>



                    <i class="fa fa-file"></i>
                </div>
                <div class="secondLine">

                    <p>Our lines are staffed from 9:00am to 5:00pm, Monday to Friday </p>
                    <p>Margie's Magical Verbs - Mallorca - IB - Spain</p>
                </div>
            </div>
        </section>
    </footer>
<?php endif; ?>
<!-- End of footer area
    ============================================= -->

<?php $__env->startPush('after-scripts'); ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            alertify.set('notifier', 'position', 'top-right');
        });

        function showNotice(type, message) {
            var alertifyFunctions = {
                'success': alertify.success,
                'error': alertify.error,
                'info': alertify.message,
                'warning': alertify.warning
            };

            alertifyFunctions[type](message, 10);
        }
    </script>
    <script src="<?php echo e(asset('js/wishlist.js')); ?>"></script>
    <style>
        .alertify-notifier .ajs-message {
            color: #ffffff;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\language\resources\views/frontend/layouts/partials/footer.blade.php ENDPATH**/ ?>