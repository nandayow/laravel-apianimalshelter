<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 /*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',['uses' => 'AuthController@register','as' => 'user.register'] );

Route::post('login',['uses' => 'loginController@postSignin','as' => 'user.login'] );

Route::middleware(['auth:sanctum'])->group(function () {

// Animaltable

    Route::get('/animal/all',['uses' => 'AnimalController@getAnimalAll','as' => 'animal.getAnimalAll'] );
    Route::resource('/animal', 'AnimalController');
    Route::get('/breed',['uses' => 'AnimalController@selectbreed','as' => 'animal.selectbreed'] );
    Route::get('/selectRescuer',['uses' => 'AnimalController@selectRescuer','as' => 'animal.selectRescuer'] );
    Route::get('/selectDisease',['uses' => 'AnimalController@selectDisease','as' => 'animal.selectDisease'] );
    Route::post('/storeDisease',['uses' => 'AnimalController@storeDisease','as' => 'animal.storeDisease'] ); 
    Route::post('restoreanimal/{id}',['uses' => 'AnimalController@restore','as' => 'animal.restore']);

// Logout
    Route::post('/logout',['uses' => 'AuthController@logout','as' => 'user.logout'] );

//DiseaseInjury
Route::resource('diseaseinjury', 'AnimalDiseaseInjuryController');
Route::get('/diseaseinjury/all',['uses' => 'AnimalDiseaseInjuryController@getdiseaseAll','as' => 'disease.getdiseaseAll'] );
Route::post('restorehealth/{id}',['uses' => 'AnimalDiseaseInjuryController@restore','as' => 'disease.restore'] );

// RescuerTable
Route::resource('rescuer', 'RescuerController');
Route::post('restorerescuer/{id}',['uses' => 'RescuerController@restore','as' => 'rescuer.restore'] );

// Personnel
Route::resource('personnel', 'PersonnelController');
Route::post('restorepersonnel/{id}',['uses' => 'PersonnelController@restore','as' => 'personnel.restore'] );

//  Adopter
Route::get('/adopter_request',['uses' => 'AdopterController@index','as' => 'adopter.request'] );
Route::resource('adopter', 'AdopterController'); 


// Personnel update adopter 
Route::resource('admin','AdminController')->only('update');



// Adopting animal

Route::resource('adopted', 'AdoptedAnimalController');  
Route::resource('adopt','HomeController')->only('store');
Route::get('/adoptedchartupdate',['uses' => 'AdminController@adoptedupdate','as' => 'adoptedupdate.animal'] ); 
Route::get('/adoptedchart',['uses' => 'AdminController@adopted','as' => 'adopted.animal'] ); 

});


// comment
Route::post('postcomment',['uses' => 'CommentController@postComment','as' => 'postComment']); 
Route::resource('comment','CommentController')->only('show'); 
Route::get('/animalprofile/{id}',['uses' => 'AnimalController@show','as' => 'animal.animalprofile'] ); 
Route::post('/animal/search',['uses' => 'AnimalController@search','as' => 'animal.autocompletesearch'] );
Route::get('/adoptedindex',['uses' => 'AdoptedAnimalController@adoptedindex','as' => 'animal.adoptedindex'] ); 

