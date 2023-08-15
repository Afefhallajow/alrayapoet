<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RegisterController;



Route::get('/newgenerated_link/{id}', [RegisterController::class, 'newgenerate_link_view'])->name('newgenerate_link_view');
Route::post('/newgenerated_link/{id}', [RegisterController::class, 'newgenerate_link'])->name('newgenerate_link');

Route::get('/sendss', function (){
    $data = array('memberEmail' => 'afef.h@rs4it.sa','link'=>'sadsadasd');
    Mail::send('email.evalution1', $data, function ($m) use ($data) {
        $m->to($data['memberEmail'])->subject('المتأهلين!');

    });
});

Route::get('/test11', [RegisterController::class, 'test']
);
Route::post('/test11', [RegisterController::class, 'test']
);

Route::get('/reset/{id}', [RegisteredController::class, 'resetpass'])->name('resetpass');

Route::post('/reset', [RegisteredController::class, 'resetpass1'])->name('reset');

Route::get('/test11', [RegisterController::class, 'test']
);
Route::get('/export', [RegisterController::class, 'export']
);

Route::get('/end', function () {
    return view('endRegister');
});
Route::get('/gettest', [\App\Http\Controllers\test::class, 'index']);
Route::get('/gettest/{id}', [\App\Http\Controllers\test::class, 'edit']);
Route::get('/gettest/p/{id}', [\App\Http\Controllers\test::class, 'p']);
Route::post('/store', [\App\Http\Controllers\test::class, 'store']);


Route::get('/', function () {
    return redirect('login-to-admin-control-panel');
});

Route::view('/visa','form.show_Form');
// New Routes Login routes instead of default login routes
Route::get('login-to-admin-control-panel')->name('login')->uses('App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::post('login-to-admin-control-panel', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Auth::routes(['login' => false,'register' => false]);

Route::get('/evalution/{token}', [RegisterController::class, 'showevalution'])->name('showevalution');

Route::get('/re-upload/{token}', [RegisterController::class, 'reUploadView'])->name('reUploadView');
Route::post('/re-upload/{token}', [RegisterController::class, 'saveReUpload'])->name('saveReUpload');


// Home Page
Route::group( ['middleware'=>[\App\Http\Middleware\validuser::class]],function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('validuser');


Route::get('/addseason',[RegisterController::class, 'newseason'] )->name('season')->middleware('permission:add season');

Route::post('/addseason',[RegisterController::class, 'addnewseason'] )->name('addseason')->middleware('permission:add season');

Route::post('/uploadimage',[RegisteredController::class, 'uploadimage'] )->name('uploadimage');

Route::post('/uploadpoem',[RegisteredController::class, 'uploadpoem'] )->name('uploadpoem');

Route::get('/testsend',[RegisteredController::class, 'testsend'] );
    Route::post('/deleteseason',[RegisterController::class, 'deleteseason'] )->name('deleteseason')->middleware('permission:delete season');

Route::get('/test',[RegisteredController::class, 'test33'] );
    Route::get('/download/passport/{id}',[RegisteredController::class, 'passport'] )->name('passport');

Route::get('/download/poem/{id}',[RegisteredController::class, 'poem'] )->name('downloadpoem');
Route::get('/download/image/{id}',[RegisteredController::class, 'image'] )->name('downloadimage');
Route::get('/download/video/{id}',[RegisteredController::class, 'video'] )->name('downloadvideo');
    Route::get('/download/all/{id}',[RegisteredController::class, 'downloadall'] )->name('downloadall');
    Route::get('/show/video/{id}',[RegisterController::class, 'showvideo'] );
Route::get('/settings/', [RegisterController::class, 'settings'])->name('settings')->middleware('permission:view setting');
Route::post('/settings/', [RegisterController::class, 'updatsettings'])->name('updatesetting')->middleware('permission:update setting');
    Route::post('/settings/update', [RegisterController::class, 'updatsettings1'])->name('updatesetting1')->middleware('permission:update setting');
    Route::post('/settings/update1', [RegisterController::class, 'updatwhatsapp'])->name('updatewhatsapp')->middleware('permission:update setting');

Route::get('/season/{id}', [RegisterController::class, 'checkseason1']);

Route::get('/showphoto/{id}', [RegisteredController::class, 'test'])->name('showphoto');;
Route::get('/lajna/', [RegisteredController::class, 'test1'])->name('lajna');
//Route::post('/test', [RegisteredController::class, 'test']);
//Route::get('/test/{id}', [RegisteredController::class, 'test']);
Route::get('/permission/', [\App\Http\Controllers\permisionController::class, 'create'])->name('permission');
Route::post('/permission/', [\App\Http\Controllers\permisionController::class, 'store'])->name('addper');
Route::post('/permission/edit', [\App\Http\Controllers\permisionController::class, 'update'])->name('perupdate');
Route::post('/permission/delete', [\App\Http\Controllers\permisionController::class, 'destroy'])->name('perdel');
Route::post('/permission/active', [\App\Http\Controllers\permisionController::class, 'add_valide_time_to_user'])->name('active');


// Register New Applicant
Route::get('/registration-new-url', [RegisteredController::class, 'index']);
Route::post('/registration-new-url', [RegisteredController::class, 'store']);

// Check if email is exist
Route::get('checkEmail/{email}', [RegisteredController::class, 'checkEmail']);

// Upload Video
Route::post('/upload', [RegisteredController::class, 'upload'])->name('upload');;
// Route::middleware('throttle:15,1')->post('/upload', [RegisteredController::class, 'upload']);



Route::get('/link',function (){

    \Illuminate\Support\Facades\Artisan::call('make:model season -m');

});


Route::get('/generated_link/{id}', [RegisterController::class, 'generate_link_view'])->name('generate_link_view');
Route::post('/generated_link/{id}', [RegisterController::class, 'generate_link'])->name('generate_link');

// Registerd Data
Route::get('/show/{regStatus}', [RegisterController::class,'get_registered'])->name('get_registered')->middleware('permission:view register');

// DataTable
Route::get('/getAllRegistereds/{regStatus}', [RegisterController::class, 'getAllRegistereds'])->name('getAllRegistereds')->middleware('permission:view register');
Route::delete('/deleteRegistered/{id}', [RegisterController::class, 'destroyRegister'])->middleware('permission:delete register');
Route::get('/edit-registeed-status/{uid}/{status}', [RegisterController::class,'change_status'])->name('change_status')->middleware('permission:update register');

// Add New User
Route::get('/add-new-user', [HomeController::class,'add_new_user'])->name('add_new_user')->middleware('permission:view user');
Route::post('/add-new-user', [HomeController::class,'save_add_new_user'])->name('save_add_new_user')->middleware('permission:add user');

//Edit User
Route::post('/edit-user/{id}', [HomeController::class,'save_edit_user'])->name('save_edit_user')->middleware('permission:update user');

//Delete User
Route::delete('/delete-user/{id}', [HomeController::class,'delete_user'])->name('delete_user')->middleware('permission:delete user');

// DataTable
Route::get('/getAllUsers', [HomeController::class, 'getAllUsers'])->name('getAllUsers');


// Evulator
Route::get('/evaluator-show/{regStatus}', [RegisterController::class,'get_ev_reg'])->name('get_ev_reg');
// DataTable
    Route::get('/getAllEvulatorRegistereds/{regStatus}', [RegisterController::class, 'getAllEvulatorRegistereds'])->name('getAllEvulatorRegistereds');
Route::post('/evulate-user', [RegisterController::class, 'saveEvulateUser'])->name('saveEvulateUser');


// All Evaluations
Route::get('/evaluations', [RegisterController::class, 'review_evaluations'])->name('evaluations');
Route::get('/all-evaluations', [RegisterController::class, 'get_review_evaluations'])->name('all-evaluations');

// Qualified
    Route::get('/qualified/{type}', [RegisterController::class, 'qualifiedView'])->name('qualifiedView')->middleware('permission:view refree');
Route::get('/qualified-data/{type}', [RegisterController::class, 'qualifiedData'])->name('qualifiedData')->middleware('permission:view refree');

// Final
Route::post('/final/{id}', [RegisterController::class, 'saveFinal'])->name('saveFinal')->middleware('permission:add final');
Route::post('/final-del/{id}', [RegisterController::class, 'saveFinalDel'])->name('saveFinalDel')->middleware('permission:delete final');


// Referee
// Evulator
Route::get('/referee-show/{regStatus}', [RegisterController::class,'get_ref_reg'])->name('get_ref_reg');
// DataTable
Route::get('/getAllRefereeRegistereds/{regStatus}', [RegisterController::class, 'getAllRefereeRegistereds'])->name('getAllRefereeRegistereds');
Route::post('/referee-user/{id}', [RegisterController::class, 'saveRefereeUser'])->name('saveRefereeUser');
Route::post('/referee-user-delete/{id}', [RegisterController::class, 'saveRefereeUserDelete'])->name('saveRefereeUserDelete');

// All Evaluations
Route::get('/ref-evaluations', [RegisterController::class, 'review_ref_evaluations'])->name('ref-evaluations')->middleware('permission:view refree');
Route::get('/all-ref-evaluations', [RegisterController::class, 'get_review_ref_evaluations'])->name('all-ref-evaluations');


// Participants
    Route::get('/newparticipants', [RegisterController::class, 'newparticipants'])->name('newparticipants')->middleware('permission:view final');
    Route::get('/newall-participants', [RegisterController::class, 'newall_participants'])->name('newall-participants');

    Route::get('/participants', [RegisterController::class, 'participants'])->name('participants')->middleware('permission:view final');
Route::get('/all-participants', [RegisterController::class, 'all_participants'])->name('all-participants');
Route::get('/link' ,function (){
   \Illuminate\Support\Facades\Artisan::call('storage:link');
});
});
