
## courses

- database / factories / CourseFactory.php 
- database / seeders / CourseSeed.php
- database / migrations / create_courses_table.php
- database / migrations / create_course_user_table.php
- database / migrations / create_courses_students_table.php
- database / migrations / add_rating_to_course_student_table.php
- database / migrations / create_course_timeline.php
- database / migrations / add_expire_at_column_in_courses_table.php
- database / migrations / add_column_strike_price_courses_table.php
- database / migrations / create_subscribe_courses_table.php
- database / migrations / create_user_courses_table.php
- database / migrations / add_foreign_key_to_courses.php
- database / migrations / add_free_column_in_courses.php
- app / Models / Course.php
- app / Http / Controllers / Backend / Admin / CoursesController.php
- app / Http / Controllers / CoursesController.php
- resources / views / backend / courses
- ressources / lang / en / labels.php (1424 - 1506)
- app / http / requests / admin / StoreCoursesRequests.php
- app / http / requests / admin / UpdateCoursesRequest.php



## forum 

- config / chatter.php
- resources / views / vendor / chatter / 
- resources / views / backend / forum-categories 
- resources / lang / en / labels.php (1088 - 1104)
- resources / lang / vendor /chatter / en  
- app / Http / Controllers / backend / admin / ForumController.php
- database / migrations / create_chatter_categories_table.php
- database / migrations / create_chatter_discussion_table.php
- database / migrations / create_chatter_post_table.php
- database / migrations / add_color_row_to_chatter_discussions.php
- databse / migrastions / create_chatter_user_discussion_pivot_table.php
- database / migrations / add_chatter_soft_deletes.php
- database / migrations / add_chatter_last_reply_at_discussions.php
- database / seeder / ChatterTableSEeder.php
- vendor / skyraptor / chatter / src /



## blog

- database / migrations / create_blog_module.php
- database / migrations / add_foreign_key_to_blogs.php
- database / factories / BlogFactory.php
- app / http / controllers / BlogController.php
- app / http / controllers / admin / blogController.php
- app / models / Blog.php
- app / models / BlogComment.php
no config file
- resources / views / backend / blogs / 
- resources / views / frontend / blogs / 
- routes / backend / admin.php (277 -289)
- app / http / requests / admin / StoreBlogRequests.php
- app / http / requests / admin / UpdateBlogsRequest.php
<!-- web.php routes -->
- Route::get('category/{category}/blogs', 'BlogController@getByCategory')->name('blogs.category');
- Route::get('tag/{tag}/blogs', 'BlogController@getByTag')->name('blogs.tag');
- Route::get('blog/{slug?}', 'BlogController@getIndex')->name('blogs.index');
- Route::post('blog/{id}/comment', 'BlogController@storeComment')->name('blogs.comment');
- Route::get('blog/comment/delete/{id}', 'BlogController@deleteComment')->name('blogs.comment.delete');
<!-- admin.php routes -->
- Route::group['prefix' => 'blog'], function ()
    Route::get('/create', 'Admin\BlogController@create');
    Route::post('/create', 'Admin\BlogController@store');
    Route::get('delete/{id}', 'Admin\BlogController@destroy')->name('blogs.delete');
    Route::get('edit/{id}', 'Admin\BlogController@edit')->name('blogs.edit');
    Route::post('edit/{id}', 'Admin\BlogController@update');
    Route::get('view/{id}', 'Admin\BlogController@show');
    Route::post('{id}/storecomment', 'Admin\BlogController@storeComment')->name('storeComment');
- Route::resource('blogs', 'Admin\BlogController');
- Route::get('get-blogs-data', ['uses' => 'Admin\BlogController@getData', 'as' => 'blogs.get_data']);
- Route::post('blogs_mass_destroy', ['uses' => 'Admin\BlogController@massDestroy', 'as' => 'blogs.mass_destroy']);



## bundles

- resources / views / backend / bundles
- resources / lang / en / labels.php (902 - 950)
- database / factories / BundleFactory.php
- database / migrations / create_bundles_table.php
- database / migrations / create_bundles_courses_table.php
- database / migrations / create_bundle_student_table.php
- database / migrations / add_foreign_key_to_blogs.php
- database / migrations / add_expire_at_column_in_bundles.php
- database / migrations / create_subscribe_bundles_table.php



## dashboard

- sidebar: resources / views / backend / includes / sidebar.blade.php
- resources / views / backend / dashboard.blade.php
- resources / views / backend / includes / 
- resources / views / backend / layouts / app.blade.php
- app / http / controllers / backend / DashboardController.php
- app / http / controllers / backend / admin / DashboardController.php
- resources / lang / en / label.php (748 - 785)



## icons 

- public / css / backend.css / .icon-user (20178 - 20374)



## menu manager 

- resources / views / vendor / wmenu / menu-html.blade.php
- app / http / controllers / backend / MenuController.php
- resources / views / backend / menu-manager / index.blade.php
- vendor / harimayco / laravel-menu / src / routes.php
- config / menu.php
- routes / web.php (167 - 177)
- resources / lang / en / menu.php 
- resources / lang / en / custom-menu.php 
- vendor / harimayco / laravel-menu / config / menu.php 
- vendor / harimayco / laravel-menu / src / views / menu-html.blade.php
- vendor / harimayco / laravel-menu / src / controllers / MenuController.php
- vendor / harimayco / laravel-menu / src / WMenu.php
- database / migrations / create_menus_wp_table.php
- database / migrations / create_menu_items_wp_table.php
- database / seeder / MenuImportSeeder.php
- databsae / seeder / MenuSeeder.php
- vendor / harimayco / laravel-menu / src / models / Menus.php
- vendor / harimayco / laravel-menu / src / models / MenuItems.php
- vendor / harimayco / laravel-menu / migrations / add-role-id-to-menu-items-table.php
- vendor / harimayco / laravel-menu / migrations / create_menus_wp_table.php
- vendor / harimayco / laravel-menu / migrations / create_menu_items_wp_table.php



## checkout - stripe / paypal

- app / Models / Stripe / 
- app / Helpers / Payments / Stripe / StripeWrapper.php 
- config / cashier.php
- config / services.php
- app / http / controllers / backend / admin / stripe / stripePlanController.php
- .env (98-103)
- resources / lang /en / labels.php (1216 - 1245)
- resources / views / frontend / cart / checkout.blade.php
- route / web.php (132 - 164)



## lessons 

- app / Http / Controllers / Backend / LiveLessonSlotController.php
- app / Http / Controllers / Backend / LiveLessonController.php
- app / Http / Controllers / LessonsController.php
- app / Models / Lesson.php
- app / Models / LessonSlotBooking.php
- app / Models / LiveLessonSlot.php
- app / Http / Requests / Admin / UpdateLessosnRequest.php
- routes / channels.php
- config / broadcasting.php
- vendor / macsidigital / laravel-api-client / src / Support / Builder.php:248
- resources / views / backend / lessons
- resources / views / backend / live-lesson-slots 
- resources / views / backend / live-lessons



## zoom

- vendor / macisdigital / laravel-zoon 
- config / zoom.php
- _ide_helper.php (19655 - 19779)
- routes / backend / admin.php (54 + 55)


## invoices 

- resources / views / backend / invoices / index.blade.php
- resources / views / backend / invoices / default.blade.php
- config / invoices.php
- app / models / invoice.php
- app / http / controllers / backend / admin / InvoiceController.php
- app / helpers.php (241 - 293)
- app / http / controllers / CartController.php
- app / http / controllers / traits / InvoiceGenerator.php
- routes / backend / admin.php (268 - 270)



## file storage

- config/lfm.php
- app / http / controller / traits / fileUploadTrait.php
- vendor / symfony / http-foundation / file / file.php



## email invoice 

- app / http / controllers / cartController.php
- app / mail / InvoiceConfirmation.php
- app / helpers.php (241 - 293)
- config / mail.php
- .env (54)
- config / access.php (65)
- resources / views / vendor / invoices / userOrderConfirmation.blade.php
- app / http / controllers / traits / InvoiceGenerator.php
- logo: config/invoices.php (61)



## mail 

- .env (31-38)
- app / mail / backend / liveLesson / TeacherMeetingSlotMail.php
- app / mail / frontend / AdminOrderMail.php
- app / mail / frontend / Auth / AdminRegistered.php
- app / mail / frontend / Contact / SendContact.php
- app / mail / frontend / LiveLesson / StudentMeetingSlotMail.php
- app / mail / InvoiceConfirmation.php
- app / mail / OfflineOrderMail.php
- config / mail.php
- resources / views / emails / adminOrderMail.blade.php
- resources / views / emails / adminRegisteredMail.blade.php
- resources / views / emails / contact_mail.blade.php
- resources / views / emails / offlineOrderMail.blade.php
- resources / views / emails / studentMeetingSlotMail.blade.php
- resources / views / emails / teacherMeetingSlotMail.blade.php
- resources / views / frontend / mail / contact-text.blade.php
- resources / views / frontend / mail / contact.blade.php
- vendor / swiftmailer / swiftmailer / lib / classes / swift.php
- vendor / swiftmailer / swiftmailer / lib / classes / swift / 



## email confirmation on registration

- resources / views / frontend / auth / register.blade.php
- routes / frontend / auth.php (52)
- app / Http / Controllers / frontend / auth / RegisterController.php
- app / Notifications / UserConfirmation.php
- app / listeners / frontend / auth / UserEventListener.php
- app / providers / EventServiceProvider.php



## pages

- Home: resources / views / frontend / layouts / app1.blade.php (242 import)
- Home layout: resources / views / frontend / index-1.blade.php
- Blogs: 
- Courses: 
- Bundles: 
- Contact: resources / views / frontend / contact.blade.php
- Forum: resources / views / vendor / chatter / home.blade.php
- Dashboard: 
- Footer: resources / views / frontend / layouts / partials / footer.blade.php



## homepage image slider

- Homepage: resources / views / frontend / layouts / app1.blade.php 
    - imported into homepage - resources / views / frontend index-1.blade.php
        - image slider: resources / views / frontend / layout / partials / slider.blade.php
        - buttons in database - slider table



## 