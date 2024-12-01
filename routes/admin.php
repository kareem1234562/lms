<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminPanelController;
use App\Http\Controllers\admin\CountriesController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\BranchesController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\ContractsController;
use App\Http\Controllers\admin\PaymentsController;
use App\Http\Controllers\admin\ContactMessagesController;
use App\Http\Controllers\admin\UniverisitiesController;
use App\Http\Controllers\admin\CollegesController;
use App\Http\Controllers\admin\CurriculumsController;
use App\Http\Controllers\admin\CoursesController;
use App\Http\Controllers\admin\LessonsController;
use App\Http\Controllers\admin\CoursesSectionsController;
use App\Http\Controllers\admin\GroupsController;
use App\Http\Controllers\admin\GroupsClientsController;
use App\Http\Controllers\admin\BundlesController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\InstructorsController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\CoinsQsController;
use App\Http\Controllers\admin\TransactionsRequestsController;
use App\Http\Controllers\admin\OrdersController;

use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\ChaptersController;
use App\Http\Controllers\LessonsChapterController;
use App\Http\Controllers\NewCourseController;
use App\Http\Controllers\NewInstructorController;
use App\Http\Controllers\NewLessonsController;
use App\Http\Controllers\QuestionLessonController;
use App\Http\Controllers\QuestionQuizCourse;
use App\Http\Controllers\questionseperateController;
use App\Http\Controllers\QuizCourseController;
use App\Http\Controllers\QuizLessonController;
use App\Http\Controllers\SeperateQuiz;
use App\Models\QuestionSeperate;

Route::post('/',[LessonsController::class, 'uploadChunk'])->name('admin.uploadChunck');



Route::group(['prefix'=>'newcourse'], function(){

Route::get('/',[NewCourseController::class, 'index'])->name('admin.newCourse');
Route::post('/store',[NewCourseController::class, 'store'])->name('admin.newCourse.store');
Route::get('/delete/{id}',[NewCourseController::class,'delete'])->name('admin.newCourse.delete');
Route::post('/update/{id}',[NewCourseController::class,'update'])->name('admin.courses2.update');
Route::get('/showinstructor/{id}',[NewCourseController::class,'showinstructor'])->name('admin.courses2.showinstructor');

Route::group(['prefix'=>'seperate_quiz'],function(){

Route::get('/quiz',[SeperateQuiz::class,'index'])->name('newcourse.quizes_seperate.show');
Route::get('/{id}/delete',[SeperateQuiz::class,'delete'])->name('newcourse.quizes_seperate.delete');
Route::post('/store',[SeperateQuiz::class,'store'])->name('newcourse.quizes_seperate.store');
Route::post('/{id}/update',[SeperateQuiz::class,'update'])->name('newcourse.quizes_seperate.update');


Route::group(['prefix'=>'question_seperate'],function(){
Route::get('/{id}/question',[questionseperateController::class,'index'])->name('newcourse.question_seperate.show');
Route::get('/{id}/delete',[questionseperateController::class,'delete'])->name('newcourse.question_seperate.delete');
Route::post('/{id}/store',[questionseperateController::class,'store'])->name('newcourse.question_seperate.store');
Route::post('/{id}/update',[questionseperateController::class,'update'])->name('newcourse.question_seperate.update');

});
});



Route::group(['prefix'=>'quizes'],function(){
Route::get('/{id}/quiz',[QuizCourseController::class,'index'])->name('newcourse.quizes.show');
Route::get('/{id}/delete',[QuizCourseController::class,'delete'])->name('newcourse.quizes.delete');
Route::post('/{id}/store',[QuizCourseController::class,'store'])->name('newcourse.quizes.store');
Route::post('/{id}/update',[QuizCourseController::class,'update'])->name('newcourse.quizes.update');

Route::group(['prefix'=>'question'],function(){
    Route::get('/{id}/question',[QuestionQuizCourse::class,'index'])->name('newcourse.quizes.question.show');
    Route::get('/{id}/delete',[QuestionQuizCourse::class,'delete'])->name('newcourse.quizes.question.delete');
    Route::post('/{id}/store',[QuestionQuizCourse::class,'store'])->name('newcourse.quizes.question.store');
    Route::post('/{id}/update',[QuestionQuizCourse::class,'update'])->name('newcourse.quizes.question.update');


    });


    Route::group(['prefix'=>'lesson_quiz'],function(){
        Route::get('/{id}/lesson_quiz',[QuizLessonController::class,'index'])->name('newcourse.quizes.lesson_quiz2.index');
        Route::post('/{id}/store',[QuizLessonController::class,'store'])->name('newcourse.quizes.lesson_quiz2.store');
        Route::get('/{id}/delete',[QuizLessonController::class,'delete'])->name('newcourse.quizes.lesson_quiz2.delete');
        Route::post('/{id}/update',[QuizLessonController::class,'update'])->name('newcourse.quizes.lesson_quiz2.update');

Route::group(['prefix'=>'question'],function(){
    Route::get('/{id}/lesson_question',[QuestionLessonController::class,'index'])->name('newcourse.quizes.lesson_question.index');
    Route::post('/{id}/store',[QuestionLessonController::class,'store'])->name('newcourse.quizes.lesson_question.store');
    Route::get('/{id}/delete',[QuestionLessonController::class,'delete'])->name('newcourse.quizes.lesson_question.delete');
    Route::post('/{id}/update',[QuestionLessonController::class,'update'])->name('newcourse.quizes.lesson_question.update');

});

    });

});




Route::group(['prefix'=>'chapters'], function(){
Route::get('/{id}/chapters',[ChaptersController::class, 'index'])->name('admin.courses.chapters');
Route::post('/store/{id}',[ChaptersController::class, 'store'])->name('admin.courses.chapters.store');
Route::post('/update/{id}',[ChaptersController::class, 'update'])->name('admin.chapter.update');
Route::get('/delete/{id}',[ChaptersController::class, 'delete'])->name('admin.chapter.delete');


Route::group(['prefix'=>'lessons'],function(){
Route::get('/{id}/lessons',[NewLessonsController::class, 'index'])->name('admin.courses2.lessons');
Route::post('/store/{id}',[NewLessonsController::class, 'store'])->name('admin.courses2.lessons.store');
Route::post('/update/{id}',[NewLessonsController::class, 'update'])->name('admin.courses2.lessons.update');
Route::get('/delete/{id}',[NewLessonsController::class, 'delete'])->name('admin.courses2.lessons.delete');

});

Route::group(['prefix'=>'lessons_chapters'],function(){
    Route::get('/{id}/lessonschapter',[LessonsChapterController::class, 'index'])->name('admin.courses.chapter.lessons');
    Route::post('/store/{id}',[LessonsChapterController::class, 'store'])->name('admin.courses.chapter.lessons.store');
    Route::post('/update/{id}',[LessonsChapterController::class, 'update'])->name('admin.courses.chapter.lessons.update');
    Route::get('/delete/{id}',[LessonsChapterController::class, 'delete'])->name('admin.courses.chapter.lessons.delete');
});
});


Route::group(['prefix'=>'instructors'], function(){
    Route::get('/',[NewInstructorController::class, 'index'])->name('admin.newCourse.instructors');
    Route::post('/store',[NewInstructorController::class, 'store'])->name('admin.courses.instructors.store');
    Route::post('/update/{id}',[NewInstructorController::class, 'update'])->name('admin.courses.instructors.update');
    Route::get('/delete/{id}',[NewInstructorController::class, 'delete'])->name('admin.courses.instructors.delete');

});
});

Route::group(['prefix'=>'extension=mbstring','middleware'=>['isAdmin','auth']], function(){
    Route::get('/',[AdminPanelController::class, 'index'])->name('admin.index');

    Route::get('/read-all-notifications',[AdminPanelController::class, 'readAllNotifications'])->name('admin.notifications.readAll');
    Route::get('/notification/{id}/details',[AdminPanelController::class, 'notificationDetails'])->name('admin.notification.details');

    Route::get('/my-salary',[AdminPanelController::class, 'mySalary'])->name('admin.mySalary');

    Route::get('/my-profile',[AdminPanelController::class, 'EditProfile'])->name('admin.myProfile');
    Route::post('/my-profile',[AdminPanelController::class, 'UpdateProfile'])->name('admin.myProfile.update');
    Route::get('/my-password',[AdminPanelController::class, 'EditPassword'])->name('admin.myPassword');
    Route::post('/my-password',[AdminPanelController::class, 'UpdatePassword'])->name('admin.myPassword.update');
    Route::get('/notifications-settings',[AdminPanelController::class, 'EditNotificationsSettings'])->name('admin.notificationsSettings');
    Route::post('/notifications-settings',[AdminPanelController::class, 'UpdateNotificationsSettings'])->name('admin.notificationsSettings.update');

    Route::group(['prefix'=>'admins'], function(){
        Route::get('/',[AdminUsersController::class, 'index'])->name('admin.adminUsers');
        Route::get('/create',[AdminUsersController::class, 'create'])->name('admin.adminUsers.create');
        Route::post('/create',[AdminUsersController::class, 'store'])->name('admin.adminUsers.store');
        Route::get('/{id}/block/{action}',[AdminUsersController::class, 'blockAction'])->name('admin.adminUsers.block');
        Route::get('/{id}/resetIP',[AdminUsersController::class, 'resetIP'])->name('admin.adminUsers.resetIP');
        Route::get('/{id}/edit',[AdminUsersController::class, 'edit'])->name('admin.adminUsers.edit');
        Route::post('/{id}/edit',[AdminUsersController::class, 'update'])->name('admin.adminUsers.update');
        Route::get('/{id}/hrProfile',[AdminUsersController::class, 'hrProfile'])->name('admin.adminUsers.hrProfile');
        Route::post('/{id}/hrProfile',[AdminUsersController::class, 'updateHRProfile'])->name('admin.adminUsers.updateHRProfile');
        Route::get('/{id}/delete',[AdminUsersController::class, 'delete'])->name('admin.adminUsers.delete');
        Route::get('/{id}/DeletePhoto/{photo}/{X}', [AdminUsersController::class, 'DeleteuserPhoto'])->name('admin.users.deletePhoto');
    });

    Route::group(['prefix'=>'clients'], function(){
        Route::get('/',[AdminUsersController::class, 'clients'])->name('admin.clients');
    });
    Route::group(['prefix'=>'instructors'], function(){
		Route::get('/', [AdminUsersController::class, 'instructors'])->name('admin.courses.instructors');
    });
    Route::group(['prefix'=>'roles'], function(){
        Route::post('/CreatePermission',[RolesController::class, 'CreatePermission'])->name('admin.CreatePermission');

        Route::get('/',[RolesController::class, 'index'])->name('admin.roles');
        Route::post('/create',[RolesController::class, 'store'])->name('admin.roles.store');
        Route::post('/{id}/edit',[RolesController::class, 'update'])->name('admin.roles.update');
        Route::get('/{id}/delete',[RolesController::class, 'delete'])->name('admin.roles.delete');
    });


    Route::group(['prefix'=>'settings'], function(){
        Route::get('/',[SettingsController::class, 'generalSettings'])->name('admin.settings.general');
        Route::post('/',[SettingsController::class, 'updateSettings'])->name('admin.settings.update');
        Route::get('/{key}/deletePhoto',[SettingsController::class, 'deleteSettingPhoto'])->name('admin.settings.deletePhoto');
    });

    Route::get('/getCoursesOrBundles', [CoursesController::class, 'getCoursesOrBundles'])->name('admin.getCoursesOrBundles');
    Route::get('/getGroupsSchedule', [CoursesController::class, 'getGroupsSchedule'])->name('admin.getGroupsSchedule');

    Route::post('/new_reservation', [CoursesController::class, 'new_reservation'])->name('admin.new_reservation');
    Route::get('/add_client_reservation', [CoursesController::class, 'add_client_reservation'])->name('admin.add_client_reservation');
    Route::post('/add_client_reservation', [CoursesController::class, 'add_client_reservation_submit'])->name('admin.add_client_reservation.submit');
    Route::get('/add_only_reservation/{client_id}', [CoursesController::class, 'add_only_reservation'])->name('admin.add_only_reservation');
    Route::post('/add_only_reservation', [CoursesController::class, 'add_only_reservation_submit'])->name('admin.add_only_reservation.submit');
    Route::get('reservations/{id}/Delete', [EventsController::class, 'deleteReservation'])->name('admin.reservations.delete');



    Route::group(['prefix' => 'countries'], function () {
        Route::get('/', [CountriesController::class, 'index'])->name('admin.countries.index');
        Route::post('/create', [CountriesController::class, 'store'])->name('admin.countries.store');
        Route::post('/{id}/edit', [CountriesController::class, 'update'])->name('admin.countries.update');
        Route::get('/{id}/delete', [CountriesController::class, 'delete'])->name('admin.countries.delete');

        Route::group(['prefix' => '{countryId}/univerisities'], function () {
            Route::get('/', [UniverisitiesController::class, 'index'])->name('admin.univerisities');
            Route::post('/create', [UniverisitiesController::class, 'store'])->name('admin.univerisities.store');
            Route::post('/{UniId}/edit', [UniverisitiesController::class, 'update'])->name('admin.univerisities.update');
            Route::get('/{UniId}/delete', [UniverisitiesController::class, 'delete'])->name('admin.univerisities.delete');

            Route::group(['prefix' => '{UniId}/colleges'], function () {
                Route::get('/', [CollegesController::class, 'index'])->name('admin.colleges');
                Route::post('/create', [CollegesController::class, 'store'])->name('admin.colleges.store');
                Route::post('/{collegeId}/edit', [CollegesController::class, 'update'])->name('admin.colleges.update');
                Route::get('/{collegeId}/delete', [CollegesController::class, 'delete'])->name('admin.colleges.delete');


                Route::group(['prefix' => '{collegeId}/curriculums'], function () {
                    Route::get('/', [CurriculumsController::class, 'index'])->name('admin.curriculums');
                });
            });
        });
    });


    Route::get('/schedule', [CoursesController::class, 'schedule'])->name('admin.courses.schedule');
    Route::group(['prefix'=>'coursesSections'], function(){
		Route::get('/', [CoursesSectionsController::class, 'index'])->name('admin.courses.sections');
		Route::post('/', [CoursesSectionsController::class, 'store'])->name('admin.coursesSections.store');
		Route::post('/{id}/Edit', [CoursesSectionsController::class, 'update'])->name('admin.coursesSections.update');
		Route::get('/{id}/Delete', [CoursesSectionsController::class, 'delete'])->name('admin.coursesSections.delete');
    });

    Route::group(['prefix'=>'courses'], function(){
		Route::get('/', [CoursesController::class, 'index'])->name('admin.courses.');
		Route::get('/', [CoursesController::class, 'index'])->name('admin.courses');
		Route::post('/', [CoursesController::class, 'store'])->name('admin.courses.store');
		Route::post('/{id}/Edit', [CoursesController::class, 'update'])->name('admin.courses.update');
		Route::get('/{id}/Delete', [CoursesController::class, 'delete'])->name('admin.courses.delete');

        Route::group(['prefix'=>'{courseId}/lessons'], function(){
            Route::get('/', [LessonsController::class , 'index'])->name('admin.courses.lessons');
            Route::post('/', [LessonsController::class , 'store'])->name('admin.courses.lessons.store');
            Route::post('/{lesson_id}/Edit', [LessonsController::class , 'update'])->name('admin.courses.lessons.update');
            Route::get('/{lesson_id}/Delete', [LessonsController::class , 'delete'])->name('admin.courses.lessons.delete');
            Route::get('/{lesson_id}/deleteVideo', [LessonsController::class , 'deleteVideo'])->name('admin.courses.lessons.deleteVideo');
            Route::get('/{lesson_id}/deleteFile', [LessonsController::class , 'deleteFile'])->name('admin.courses.lessons.deleteFile');

            Route::post('/sections', [LessonsController::class , 'sectionsStore'])->name('admin.courses.sections.store');
            Route::post('/{section_id}/sectionsUpdate', [LessonsController::class , 'sectionsUpdate'])->name('admin.courses.sections.update');
            Route::get('/{section_id}/sectionsDelete', [LessonsController::class , 'sectionsDelete'])->name('admin.courses.sections.delete');
        });
        // Route::group(['prefix'=>'{id}/groups'], function(){
        //     Route::get('/', [GroupsController::class , 'index'])->name('admin.courses.groups');
        //     Route::post('/', [GroupsController::class , 'store'])->name('admin.courses.groups.store');
        //     Route::post('/{group_id}/Edit', [GroupsController::class , 'update'])->name('admin.courses.groups.update');
        //     Route::get('/{group_id}/Delete', [GroupsController::class , 'delete'])->name('admin.courses.groups.delete');
        //     Route::group(['prefix'=>'{group_id}/clients'], function(){
        //         Route::get('/', [GroupsClientsController::class, 'index'])->name('admin.courses.groups.clients');
        //         Route::post('/', [GroupsClientsController::class, 'store'])->name('admin.courses.groups.clients.store');
        //         Route::post('/{group_client_id}/Edit', [GroupsClientsController::class, 'update'])->name('admin.courses.groups.clients.update');
        //         Route::get('/{group_client_id}/Delete', [GroupsClientsController::class, 'delete'])->name('admin.courses.groups.clients.delete');
        //     });
        // });
	});
    Route::group(['prefix'=>'bundles'], function(){
		Route::get('/', [BundlesController::class, 'index'])->name('admin.courses.bundles');
		Route::post('/', [BundlesController::class, 'store'])->name('admin.courses.bundles.store');
		Route::post('/{id}/Edit', [BundlesController::class, 'update'])->name('admin.courses.bundles.update');
		Route::get('/{id}/Delete', [BundlesController::class, 'delete'])->name('admin.courses.bundles.delete');
	});

	Route::group(['prefix'=>'reports'], function(){
		Route::get('/userFollowUpsReport', [ReportsController::class, 'userFollowUpsReport'])->name('admin.userFollowUpsReport');
		Route::get('/teamFollowUpsReport', [ReportsController::class, 'teamFollowUpsReport'])->name('admin.teamFollowUpsReport');
		Route::get('/branchFollowUpsReport', [ReportsController::class, 'branchFollowUpsReport'])->name('admin.branchFollowUpsReport');
		Route::get('/accountsReport', [ReportsController::class, 'accountsReport'])->name('admin.accountsReport');
	});

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [PagesController::class, 'index'])->name('admin.pages.index');
        Route::post('/create', [PagesController::class, 'store'])->name('admin.pages.store');
        Route::post('/{id}/edit', [PagesController::class, 'update'])->name('admin.pages.update');
        Route::get('/{id}/delete', [PagesController::class, 'delete'])->name('admin.pages.delete');
    });

    Route::group(['prefix' => 'coins_questions'], function () {
        Route::get('/', [CoinsQsController::class, 'index'])->name('admin.coins_questions.index');
        Route::post('/create', [CoinsQsController::class, 'store'])->name('admin.coins_questions.store');
        Route::post('/{id}/edit', [CoinsQsController::class, 'update'])->name('admin.coins_questions.update');
        Route::get('/{id}/delete', [CoinsQsController::class, 'delete'])->name('admin.coins_questions.delete');
    });

    Route::group(['prefix' => 'contact-messages'], function () {
        Route::get('/', [ContactMessagesController::class, 'index'])->name('admin.contactmessages');
        Route::get('/{id}/details', [ContactMessagesController::class, 'details'])->name('admin.contactmessages.details');
        Route::get('/{id}/delete', [ContactMessagesController::class, 'delete'])->name('admin.contactmessages.delete');
    });

    Route::group(['prefix' => 'transactionsRequests'], function () {
        Route::get('/', [TransactionsRequestsController::class, 'index'])->name('admin.transactionsRequests');
        Route::get('/{id}/details', [TransactionsRequestsController::class, 'details'])->name('admin.transactionsRequests.details');
        Route::get('/{id}/confirm', [TransactionsRequestsController::class, 'confirm'])->name('admin.transactionsRequests.confirm');
        Route::get('/{id}/delete', [TransactionsRequestsController::class, 'delete'])->name('admin.transactionsRequests.delete');
    });
    Route::group(['prefix'=>'orders'], function(){
        Route::get('/',[OrdersController::class, 'index'])->name('admin.orders');
        Route::get('/{id}/details', [OrdersController::class, 'details'])->name('admin.orders.details');
        Route::get('/{id}/confirm', [OrdersController::class, 'confirm'])->name('admin.orders.confirm');
        Route::get('/{id}/delete', [OrdersController::class, 'delete'])->name('admin.orders.delete');
    });

});

