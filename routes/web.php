<?php

use App\Models\User;
use Inertia\Inertia;
use App\Events\Hello;
use App\Events\DispatchEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Notifications\RealtimeNotification;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/create', [ProfileController::class, 'create_user'])->name('profile.create_user');
    Route::post('/profile/create', [ProfileController::class, 'create_user_account'])->name('profile.create');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(App\Http\Controllers\RoleController::class)->middleware('auth')->group(function(){
    Route::get('role/create','create')->name('role.create');
    Route::get('role-with-users','index')->name('list_role');
    Route::get('role/list','list_roles');
    Route::get('role/list-simple','list');
    Route::get('role/{role}/delete/','destroy');
    Route::post('role/add','store');
    Route::post('role/{role}/update','update');
    Route::post('role/set-role-user/{user}','addRoles');
    Route::post('role/remove-role-user/{user}','removeRoles');
    Route::post('user/search','search_user');
});
Route::controller(App\Http\Controllers\DocumentController::class)->middleware('auth')->group(function(){
    Route::get('document/create','create')->name('document.create');
    Route::get('document/list','index');
    Route::get('document/destroy/{document}','destroy');
    Route::post('document/add','store');
    Route::post('document/{document}/update','update');
});

Route::controller(App\Http\Controllers\ServiceController::class)->middleware('auth')->group(function(){
    Route::get('service/list','list_service');
    Route::get('service/list-all','index');
    Route::get('service/create','create')->name('service.create');
    Route::get('service/{service}/get-doc','get_doc_service');
    Route::get('service/{service}/delete','destroy');
    Route::post('service/add','store');
    Route::post('service/{service}/update','update');
    Route::post('service/set-document-service/{service}','addDocument');
    Route::post('service/remove-document-service/{service}','removeDocument');
});
Route::controller(App\Http\Controllers\TypeCourrierController::class)->middleware('auth')->group(function(){
    Route::get('typecourrier/create','create')->name('typecourrier.create');
    Route::post('typecourrier/add','store');
    Route::get('typecourrier/list','typecourrier_list');
    Route::get('typecourrier/list-all','index');
    Route::post('typecourrier/{typecourrier}/update','update');
});
Route::controller(App\Http\Controllers\CourrierController::class)->middleware('auth')->group(function(){
    Route::get('download/{id}','downloadFile');
    Route::get('courrier/create','create')->name('courrier.create');
    // Route::get('courrier-dispatch','dispatch');
    Route::get('courrier/list','index')->name('courrier.list');
    Route::get('courrier/list-dipatch','list_courrier_to_dispatch');
    Route::get('courrier/list-validation','courrier_where_has_note');
    Route::get('courrier/validation','courrier_where_has_note_page')->name('courrier.listValidation');
    Route::get('courrier/list-protocole','list_courrier_protocol')->name('courrier.listProtocole');
    Route::get('courrier/dispatch','dispatch')->name('courrier.dispatch');
    Route::get('courrier/dispatches-page','courrier_dispatches_page')->name('courrier.dispatches');
    Route::get('courrier/dispatches','courrier_dispatches');
    Route::post('courrier/add','store');
    Route::post('courrier/{courrier}/update','update');
    Route::post('courrier/set-courrier-user/{user}','addCourrier');
    Route::post('courrier/remove-courrier-user/{user}','removeCourrier');
    Route::get('courrier/user','mes_courrier');
    Route::get('courrier-user','mes_courrier_page')->name('courrier.mesCourriers');
    Route::post('courrier/cloture/{courrier}','clotureCourrier');
    Route::get('courrier/new-number','new_number');
    Route::get('courrier/statistique','statistique_courrier');
    Route::get('courrier/statistique','statistique_courrier');
    Route::post('courrier/response/{courrier}','response_courrier');
    Route::post('courrier/search','search');
    Route::get('courrier/search-page','search_page');
    Route::get('testmail','sendMail');
});
Route::controller(App\Http\Controllers\CourrierSortantController::class)->middleware('auth')->group(function(){
    Route::get('courrier-sortant/create','create')->name('courrier_sortant.create');
    Route::get('courrier-sortant/new','newNumber');
    Route::get('courrier-sortant/list','index');
    Route::get('courrier-sortant','list_page')->name('courrier_sortant.list');
    Route::post('courrier-sortant/add','store');
    Route::post('courrier-sortant/{courrierSortant}/update','update');
});
Route::controller(App\Http\Controllers\CommentaireCourrierController::class)->middleware('auth')->group(function(){
    Route::post('commentaire-courrier/add','store');
});
Route::controller(App\Http\Controllers\NoteTechniqueController::class)->middleware('auth')->group(function(){

    Route::post('note-technique/add','store');
    Route::post('note-technique/update/{noteTechnique}','update');
    Route::post('note-technique/valider/{noteTechnique}','valider');
    Route::post('note-technique/inValider/{noteTechnique}','inValider');
    Route::get('note-technique/list','my_technical_notes');
    Route::get('note-technique/myList','my_technical_notes_page')->name('note_technique.mes_Notes');
    Route::get('note-technique/secretariat','noteTechniqueForSecretaria');
    Route::get('note-technique/sec','noteTechniqueForSecretaria_page')->name('note_technique.secretariat');
});
Route::controller(App\Http\Controllers\NoteTechniqueInterneController::class)->middleware('auth')->group(function(){

    Route::post('note-technique-interne/add','store');
    Route::get('note-technique-interne/create','create')->name('note_technique_interne.create');
    Route::post('note-technique-interne/update/{noteTechnique}','update');
    Route::post('note-technique-interne/valider/{noteTechnique}','valider');
    Route::post('note-technique-interne/inValider/{noteTechnique}','inValider');
    Route::get('note-technique-interne/list','my_technical_notes');
    Route::get('note-technique-interne/myList','my_technical_notes_page')->name('note_technique_interne.page');
    Route::get('note-technique-interne/secretariat','noteTechniqueForSecretaria');
    Route::get('note-technique-interne/sec','noteTechniqueForSecretaria_page')->name('note_technique_interne.secretariat');
});
Route::controller(App\Http\Controllers\CommentaireNoteInterneController::class)->middleware('auth')->group(function(){

    Route::post('commentaire-note-interne/add','store');
});
Route::controller(App\Http\Controllers\CommentaireNoteTechniqueController::class)->middleware('auth')->group(function(){

    Route::post('commentaire-note-technique/add','store');
});
Route::controller(App\Http\Controllers\AnnexeCourrierController::class)->middleware('auth')->group(function(){

    Route::post('annexe-courrier/add','store');
});
Route::controller(App\Http\Controllers\AnnexeNoteTechniqueController::class)->middleware('auth')->group(function(){

    Route::post('annexe-note/add','store');
});
Route::controller(App\Http\Controllers\AnnexeNoteTechniqueInterneController::class)->middleware('auth')->group(function(){

    Route::post('annexe-note-interne/add','store');
});
Route::controller(App\Http\Controllers\AudienceController::class)->middleware('auth')->group(function(){

    Route::get('audience/create','create')->name('audience.create');
    Route::get('audience/list','index');
    Route::get('audience/list-accept','my_accepted_audiences');
    Route::get('audience/boss/list-accept','accepted_audiences_boss');
    Route::get('audience/myList','myList');
    Route::get('audience/list-protocole','list_protocole')->name('audience.listProtocole');
    Route::get('audience/mes-audiences','mes_audiences')->name('audience.mesAudiences');
    Route::post('audience/add','store');
    Route::post('audience/{audience}/transfert','transfert');
    Route::post('audience/{audience}/accept','accept');
    Route::post('audience/{audience}/refuse','refuse');
    Route::post('audience/close/{audience}','close');
    
    Route::get('audience/statistique','statistique_audience');

});
Route::controller(App\Http\Controllers\RendezvousAudienceController::class)->middleware('auth')->group(function(){
    Route::post('rendezvous/add','store');
    Route::get('rendezvous/create','create')->name('rendezvous.mesRendezvous');
    Route::get('rendezvous/create-protocole','create_for_the_boss')->name('rendezvous.rendezvous_du_boss');
    Route::post('rendezvous/update/{rendezvousAudience}','update');
    Route::get('rendezvous/list','mes_rendezvous');
    Route::get('rendezvous/list-protocol','rendezvous_protocole');
    Route::get('rendezvous/list-protocole','mes_rendezvous_page_protocole')->name('rendezvous.rendez_vous_aujourdhui');
    Route::post('rendezvous/set-rendezvous-user/{user}','addRendezvous');
    Route::post('rendezvous/remove-rendezvous-user/{user}','removeRendezvous');
    Route::get('rendezvous/mes-reunions','mes_reunion');
});
Route::controller(App\Http\Controllers\TaskController::class)->middleware('auth')->group(function(){
    Route::get('task','task_dashbord')->name('task');
    Route::get('task/dashbord','dashbord');
    Route::get('task/create','create')->name('task.create');
    Route::get('task/list-all','task_list')->name('task.all');
    Route::get('task-list','task_list_created_by')->name('task.list');
    Route::get('task-attrib-group','task_attrib_role')->name('task.attrib_group');
    Route::post('task-save','store');
    Route::post('task-update/{task}','update');
    Route::post('set-task-role','addRoleTask');
    Route::post('remove-task-role','removeRoleTask');
    Route::post('set-task-user','addUserTask');
    Route::post('remove-task-user','removeUserTask');
    Route::get('role-user-task','role_user_tasks')->name('task.attrib_user');
    Route::get('task/my-tasks','my_tasks_page')->name('task.mes_taches');
    Route::get('user/{user}/task','getMyTasks');
    Route::get('user/task','getMyTasksweb');
    Route::get('statistic/task','getStatistic');
});

Route::controller(App\Http\Controllers\TaskCommentController::class)->middleware('auth')->group(function(){
  
    Route::post('taks/comment/add','store');
    Route::post('task/update/comment/{taskComment}','update');
});


Route::controller(App\Http\Controllers\TimesheetController::class)->middleware('auth')->group(function(){
  
    Route::post('timesheet','store');
    Route::get('task/timesheet/{tache}','getMyTimesheetsForTask');
    Route::get('task/timesheet/user/{tache}','getTimesheetsForTask');
    Route::post('timesheet/{timesheet}/update','update');
});

Route::controller(App\Http\Controllers\BatimentController::class)->middleware('auth')->group(function(){
    Route::post('batiment/add','store');
    Route::post('batiment/{batiment}/update','update');
    Route::get('batiment/list','index');
    Route::get('batiment/create','create')->name('batiment.create');
});

Route::controller(App\Http\Controllers\BureauController::class)->middleware('auth')->group(function(){
    Route::post('bureau/add','store');
    Route::post('bureau/{bureau}/update','store');
    Route::get('bureau/list','index');
    Route::get('bureau/{bureau}/delete','destroy');
    Route::get('bureau/liste','list_bureau');
    Route::get('bureau/create','create')->name('bureau.create');
    
    Route::post('bureau/set-bureau-user/{user}','addBureau');
    Route::post('bureau/remove-bureau-user/{user}','removeBureau');
});
Route::controller(App\Http\Controllers\MenuController::class)->middleware('auth')->group(function(){
    Route::post('menu/add','store');
    Route::post('menu/{menu}/update','update');
    Route::get('menu/list','index');
    Route::get('menu/{menu}/delete','destroy');
    Route::get('menu/user','get_menu_user');
    Route::get('menu/create','create')->name('menu.create');
    Route::post('menu/set-menu-user/{user}','addMenu');
    Route::post('menu/remove-menu-user/{user}','removeMenu');

    Route::post('menu/set-menu-role/{role}','addMenuToRole');
    Route::post('menu/remove-menu-role/{role}','removeMenuToRole');
   
});
// Route::controller(App\Http\Controllers\ReunionController::class)->middleware('auth')->group(function(){
//     Route::get('reunion/create','create');
//     Route::post('reunion/add','store');
   
// });
Route::controller(App\Http\Controllers\ReunionController::class)->middleware('auth')->group(function(){
    Route::get('reunion/create','create');
    Route::get('reunion/newID','getNewID');
    Route::get('reunion/list-orateur','list_orateur');
    Route::post('reunion/add','store');
   
});




Route::get('/linkstorage', function () {
	$targetFolder = base_path().'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($targetFolder, $linkFolder); 
});

Route::get('/notifications', function(){
    return Auth::user()->unreadNotifications  ;
})->middleware('auth');

Route::get('testEvent',function(){

    

    // $user_one = User::first();
    // $user_one->notify(new RealtimeNotification('Un courrier vient d\'etre dispatcher 😄'));
            
    
    //  broadcast( new Hello(1));
     broadcast( new DispatchEvent('Rostand'));
    return 'okok0';
});

require __DIR__.'/auth.php';
