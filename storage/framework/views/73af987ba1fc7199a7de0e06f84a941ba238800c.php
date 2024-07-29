

<?php $__env->startSection('title', 'Subscribe -'.$plan->name.' | '.app_name()); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('meta_keywords',''); ?>
<?php $__env->startPush('after-styles'); ?>
    <script src='https://js.stripe.com/v3/' type='text/javascript'></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">
                        <?php echo app('translator')->get('labels.subscription.plan'); ?> :<span>  <?php echo e($plan->name); ?></span><br>
                        <?php echo app('translator')->get('labels.subscription.price'); ?> : <span><?php echo e($plan->amount); ?>/ <?php echo e($plan->interval); ?></span>
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <?php if(session()->get('error')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
    <?php if(session()->get('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
    <section class="contact-page-section pricing">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="<?php echo e(route('subscription.subscribe',['plan' => $plan])); ?>"
                                method="post" id="subscribe-form">
                                <?php echo csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" data-tid="name_label"><?php echo app('translator')->get('labels.subscription.form.name'); ?></label>
                                        <input id="name" data-tid="name_placeholder" class="input form-control required" type="text"
                                               value="<?php echo e(auth()->user()->name); ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email" data-tid="email_label"><?php echo app('translator')->get('labels.subscription.form.email'); ?></label>
                                        <input id="email" data-tid="email_placeholder" class="input form-control required" type="text"
                                               placeholder="<?php echo app('translator')->get('labels.subscription.form.email'); ?>"
                                               value="<?php echo e(auth()->user()->email); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group" data-locale-reversible>
                                    <label for="address" data-tid="address_label"><?php echo app('translator')->get('labels.subscription.form.address'); ?></label>
                                    <input id="address" name="address" data-tid="address_placeholder"
                                           class="input form-control required" type="text" placeholder="<?php echo app('translator')->get('labels.subscription.form.address'); ?>" required=""
                                           autocomplete="address-line1">
                                </div>
                                <div class="form-row" data-locale-reversible>
                                    <div class="form-group col-md-3">
                                        <label for="city" data-tid="city_label"><?php echo app('translator')->get('labels.subscription.form.city'); ?></label>
                                        <input id="city" name="city" data-tid="city_placeholder" class="input form-control required"
                                               type="text" placeholder="<?php echo app('translator')->get('labels.subscription.form.city'); ?>" required=""
                                               autocomplete="address-level2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="state" data-tid="state_label"><?php echo app('translator')->get('labels.subscription.form.state'); ?></label>
                                        <input id="state" name="state" data-tid="state_placeholder"
                                               class="input form-control required" type="text" placeholder="<?php echo app('translator')->get('labels.subscription.form.state'); ?>" required=""
                                               autocomplete="address-level1">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="country_code" data-tid="country_code_label"><?php echo app('translator')->get('labels.subscription.form.country_code'); ?></label>
                                        <input id="country_code" name="country" data-tid="country_code_label"
                                               class="input empty form-control required text-uppercase" type="text" placeholder="<?php echo app('translator')->get('labels.subscription.form.country_code'); ?>"                                                      required=""  autocomplete="country">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="zip" data-tid="postal_code_label"><?php echo app('translator')->get('labels.subscription.form.zip'); ?></label>
                                        <input id="zip" name="postal_code" data-tid="postal_code_placeholder"
                                               class="input empty form-control required" type="text" placeholder="<?php echo app('translator')->get('labels.subscription.form.zip'); ?>"                                                      required=""  autocomplete="postal-code">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="field">
                                        <label for="card" data-tid="card_label"><?php echo app('translator')->get('labels.subscription.form.card'); ?></label>
                                        <div id="card" class="input"></div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 form-group d-none" id="card-errors">
                                        <div class="alert-danger alert">
                                            <?php echo app('translator')->get('labels.frontend.cart.stripe_error_message'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div  role="alert"></div>
                                <button type="submit"
                                        class="text-white genius-btn mt25 gradient-bg text-center text-uppercase  bold-font"
                                        data-tid="pay_button" id="card-button"
                                        data-secret="<?php echo e($intent->client_secret); ?>"><?php echo app('translator')->get('labels.frontend.cart.pay_now'); ?>
                                </button>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('after-scripts'); ?>
    <script>

        const stripe = Stripe('<?php echo e(config('services.stripe.key')); ?>', {locale: "<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"}); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.

        const classes = {
            base:"form-control"
        };

        /**
         * Card Element
         */
        var cardElement = elements.create("card", {
            iconStyle: "solid",
            classes:{
                base:"form-control py-2"
            }
        });
        cardElement.mount("#card");

        const cardHolderName = document.getElementById('name');
        const cardButton = document.getElementById('card-button');
        const city = document.getElementById('city');
        const state = document.getElementById('state');
        const country_code = document.getElementById('country_code');
        const zip = document.getElementById('zip');
        const address = document.getElementById('address');
        var $form = $("#subscribe-form");
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', (e) => {
            e.preventDefault();
            if(city.value == '' || state.value == '' || zip.value == '' || address.value == '' || country_code.value == ''){
                alert('Please fill Billing Address Field');
            }else{
                $('#card-button').attr('disabled', true);
                stripe.handleCardSetup(clientSecret,cardElement,{
                    payment_method_data:{
                        billing_details: {
                            name: cardHolderName.value,
                            address:{
                                city: city.value,
                                country:country_code.value,
                                line1:address.value,
                                line2:null,
                                postal_code:zip.value,
                                state:state.value
                            }
                        }
                    }
                }).then(function (result) {
                    if (result.error) {
                        $('#card-button').attr('disabled', false);
                        // Inform the user if there was an error.
                        $('#card-errors')
                            .removeClass('d-none')
                            .find('.alert')
                            .text(result.error.message);
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.setupIntent.payment_method);
                    }
                });
            }

        });

        // Submit the form with the token ID.
        function stripeTokenHandler(paymentMethod) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('subscribe-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', paymentMethod);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\subscription\form.blade.php ENDPATH**/ ?>