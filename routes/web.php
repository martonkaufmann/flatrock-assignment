<?php

use App\Http\Controllers\Admin\QuestionnaireController as AdminQuestionnaireController;
use App\Http\Controllers\Public\GuestUserController as PublicGuestUserController;
use App\Http\Controllers\Public\QuestionnaireController as PublicQuestionnaireController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('guests', PublicGuestUserController::class)->only(['create', 'store']);

Route::controller(PublicQuestionnaireController::class)->middleware('auth.guest')->name('questionnaires.')->group(function () {
    Route::get('/', 'typeList')->name('type-list');
    Route::get('questionnaires/{questionnaireType}', 'list')->name('list');
    Route::get('questionnaires/{questionnaire}/start', 'start')->name('start');
    Route::get('questionnaires/score/{score}', 'score')->name('score');
    Route::delete('questionnaires/{questionnaire}/cancel', 'cancel')->name('cancel');
    Route::get('questionnaires/{questionnaire}/question', 'nextQuestion')->name('question');
    Route::get('questionnaires/{questionnaire}/timeout', 'timeout')->name('timeout');
    Route::post('questionnaires/{questionnaire}/question/{question}/submit', 'submitAnswer')
        ->scopeBindings()
        ->name('submit')
    ;
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('questionnaires/{questionnaireType}/create', [AdminQuestionnaireController::class, 'create'])->name('questionnaires.create');
    Route::post('questionnaires/{questionnaireType}', [AdminQuestionnaireController::class, 'store'])->name('questionnaires.store');
    Route::resource('questionnaires', AdminQuestionnaireController::class)->only(['index', 'show']);
});

require __DIR__.'/auth.php';
