<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FrontCompetitionController;
use App\Http\Controllers\FrontTeamsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'] )->name('home');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin',[DashboardController::class, 'dashboard'] )->name('dashboard');
    Route::get('/mark-as-read/{messageId}', [MessagesController::class,'markAsRead'])->name('markAsRead');


});







Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->name('register');;
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');



Route::get('login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->name('logout')->middleware('auth');


//AREA
Route::get('admin/area', [AreaController::class,'table'])->name('area');
Route::get('admin/area/create', [AreaController::class,'create'])->name('areaCreate');
Route::post('admin/area/store', [AreaController::class,'store'])->name('areaStore');

Route::get('admin/area/{id}/edit', [AreaController::class, 'edit'])->name('areaEdit');
Route::put('admin/area/{id}', [AreaController::class, 'update'])->name('areaUpdate');

Route::delete('admin/area/{id}', [AreaController::class, 'destroy'])->name('areaDestroy');

//COMPETITION
Route::get('admin/competition', [CompetitionController::class,'table'])->name('competition');
Route::get('admin/competition/create', [CompetitionController::class,'create'])->name('competitionCreate');
Route::post('admin/competition/store', [CompetitionController::class,'store'])->name('competitionStore');

Route::get('admin/competition/{id}/edit', [CompetitionController::class, 'edit'])->name('competitionEdit');
Route::put('admin/competition/{id}', [CompetitionController::class, 'update'])->name('competitionUpdate');

Route::delete('admin/competition/{id}', [CompetitionController::class, 'destroy'])->name('competitionDestroy');

//SEASON


Route::get('admin/season', [SeasonController::class,'table'])->name('seasons');
Route::get('admin/season/create', [SeasonController::class,'create'])->name('seasonsCreate');
Route::post('admin/season/store', [SeasonController::class,'store'])->name('seasonsStore');

Route::get('admin/season/{id}/edit', [SeasonController::class, 'edit'])->name('seasonsEdit');
Route::put('admin/season/{id}', [SeasonController::class, 'update'])->name('seasonsUpdate');

Route::delete('admin/season/{id}', [SeasonController::class, 'destroy'])->name('seasonsDestroy');


//STANDINGS

Route::get('admin/standing', [StandingController::class,'table'])->name('standings');
Route::get('admin/standing/create', [StandingController::class,'create'])->name('standingsCreate');
Route::post('admin/standing/store', [StandingController::class,'store'])->name('standingsStore');

Route::get('admin/standing/{id}/edit', [StandingController::class, 'edit'])->name('standingsEdit');
Route::put('admin/standing/{id}', [StandingController::class, 'update'])->name('standingsUpdate');

Route::delete('admin/standing/{id}', [StandingController::class, 'destroy'])->name('standingsDestroy');


//TEAMS


Route::get('admin/team', [TeamController::class,'table'])->name('teams');
Route::get('admin/team/create', [TeamController::class,'create'])->name('teamsCreate');
Route::post('admin/team/store', [TeamController::class,'store'])->name('teamsStore');

Route::get('admin/team/{id}/edit', [TeamController::class, 'edit'])->name('teamsEdit');
Route::put('admin/team/{id}', [TeamController::class, 'update'])->name('teamsUpdate');

Route::delete('admin/team/{id}', [TeamController::class, 'destroy'])->name('teamsDestroy');

//MATCHES


Route::get('admin/match', [MatchController::class,'table'])->name('matches');
Route::get('admin/match/create', [MatchController::class,'create'])->name('matchesCreate');
Route::post('admin/match/store', [MatchController::class,'store'])->name('matchesStore');

Route::get('admin/match/{id}/edit', [MatchController::class, 'edit'])->name('matchesEdit');
Route::put('admin/match/{id}', [MatchController::class, 'update'])->name('matchesUpdate');

Route::delete('admin/match/{id}', [MatchController::class, 'destroy'])->name('matchesDestroy');


//PERSON


Route::get('admin/person', [PersonController::class,'table'])->name('persons');
Route::get('admin/person/create', [PersonController::class,'create'])->name('personsCreate');
Route::post('admin/person/store', [PersonController::class,'store'])->name('personsStore');

Route::get('admin/person/{id}/edit', [PersonController::class, 'edit'])->name('personsEdit');
Route::put('admin/person/{id}', [PersonController::class, 'update'])->name('personsUpdate');

Route::delete('admin/person/{id}', [PersonController::class, 'destroy'])->name('personsDestroy');

//USERS

Route::get('admin/user', [UsersController::class,'table'])->name('users');
Route::get('admin/user/create', [UsersController::class,'create'])->name('usersCreate');
Route::post('admin/user/store', [UsersController::class,'store'])->name('usersStore');

Route::get('admin/user/{id}/edit', [UsersController::class, 'edit'])->name('usersEdit');
Route::put('admin/user/{id}', [UsersController::class, 'update'])->name('usersUpdate');

Route::delete('admin/user/{id}', [UsersController::class, 'destroy'])->name('usersDestroy');

//messages

Route::get('admin/contactMessages', [MessagesController::class,'contactMessages'])->name('contactMessages');
Route::get('/mark-as-read/{messageId}', [MessagesController::class,'markAsRead'])->name('markAsRead');























Route::get('admin/charts', function () {
    return view('admin.charts');
});

Route::get('admin/table', function () {
    return view('admin.table');
});

Route::get('admin/form', function () {
    return view('admin.form');
});



Route::get('admin/element', function () {
    return view('admin.element');
});

Route::get('admin/widget', function () {
    return view('admin.widget');
});

Route::get('admin/button', function () {
    return view('admin.button');
});


Route::get('/blog', function () {
    return view('front.blog');
});

//matches URL
Route::get('/competitions', [FrontCompetitionController::class, 'index'])->name('index');
Route::get('/competitions/{competitionId}/matches/', [FrontCompetitionController::class, 'showMatchesForCompetition'])->name('matches_show');


Route::get('/players', function () {
    return view('front.players');
});
Route::get('/single', function () {
    return view('front.single');
});

Route::get('/matches-show', function () {
    return view('front.matches_show');
});

//Teams 

Route::get('/competitions/{competitionId}/teams/', [FrontCompetitionController::class, 'showTeamsForCompetition'])->name('teams_show');

Route::get('/competitions/{competitionId}/teams/{teamId}', [FrontTeamsController::class, 'showTeamForCompetition'])->name('team_show');
Route::post('/competitions/{competitionId}/teams/{teamId}/store', [FrontTeamsController::class, 'postTeamOnFavorites'])->name('teamStore');
Route::get('/teams', [FrontTeamsController::class, 'showAllTeams'])->name('showAllTeams');
Route::post('/competitions/{competitionId}/teams/{teamId}/add-to-favorites',[FrontTeamsController::class, 'storeToFavoriteList'])->name('teamstoreToFavoriteList');
// Route::put('/competitions/{competitionId}/teams/{teamId}/{id}/update-favorites', [FrontTeamsController::class, 'updateTeamOnFavorites'])->name('updateTeamOnFavorites');
Route::delete('/competitions/{competitionId}/teams/{teamId}/{id}/delete-favorites', [FrontTeamsController::class, 'destroy'])->name('destroy');
Route::post('/competitions/{competitionId}/teams/{teamId}/comment', [FrontTeamsController::class, 'commentForTeam'])->name('commentForTeam');
Route::post('/competitions/{competitionId}/teams/{teamId}/replyComment/{commentId}', [FrontTeamsController::class, 'replyToComment'])->name('replyToComment');
Route::put('/competitions/{competitionId}/teams/{teamId}/updateComment/{commentId}', [FrontTeamsController::class, 'updateComment'])->name('updateComment');
Route::delete('/competitions/{competitionId}/teams/{teamId}/deleteComment/{commentId}', [FrontTeamsController::class, 'deleteComment'])->name('deleteComment');
Route::post('/competitions/{competitionId}/teams/{teamId}/{commentId}/likecomment', [FrontTeamsController::class, 'likeComment'])->name('likeComment');
Route::post('/competitions/{competitionId}/teams/{teamId}/{commentId}/unlikecomment', [FrontTeamsController::class, 'unlikeComment'])->name('unlikeComment');

Route::post('/competitions/{competitionId}/teams/{teamId}/like', [FrontTeamsController::class, 'storeLike'])->name('storeLike');
Route::post('/competitions/{competitionId}/teams/{teamId}/unlike', [FrontTeamsController::class, 'unlikeTeam'])->name('unlikeTeam');












//FAVORITES

Route::get('/favorites', [FavoritesController::class, 'showTeamFavorites'])->name('showTeamFavorites');

Route::put('/favorites/{id}/update-favorites', [FavoritesController::class, 'updateFavoritesName'])->name('updateFavoritesName');


 //Contact

 Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

 Route::post('/contact/post', [ContactController::class, 'contactPost'])->name('contactPost');

