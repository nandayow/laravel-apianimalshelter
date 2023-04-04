<?php

use Illuminate\Support\Facades\Route;
 

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
 /*

Route::group(['middleware'=>'web'],function()
{
  Route::resource('animalbreed', 'AnimalBreedController', ['names' => [ 'create' => 'animalbreed.create' ]]);
  Route::resource('animaldisease_injury', 'AnimalDiseaseInjuryController');
  Route::post('restoremai/{id}',['uses' => 'MailController@restore','as' => 'mail.restore']);
  Route::post('restoreanimal/{id}',['uses' => 'AnimalController@restore','as' => 'animal.restore']);
  Route::post('restorerescuer/{id}',['uses' => 'RescuerController@restore','as' => 'rescuer.restore']);
  Route::post('restorepersonnel/{id}',['uses' => 'PersonnelController@restore','as' => 'personnel.restore']);
  Route::post('restoreadopter/{id}',['uses' => 'AdopterController@restore','as' => 'adopter.restore']);
  Route::post('restoreconditions/{id}',['uses' => 'AnimalDiseaseInjuryController@restore','as' => 'condition.restore']);
  Route::post('read/{id}',['uses' => 'MailController@read','as' => 'mail.read']);
  Route::get('rescuerdetail/{id}',['uses' => 'RescuerController@rescuershow','as' => 'rescuer.detail']);
  Route::get('animaltrash',['uses' => 'AnimalController@indexTrash','as' => 'animal.trash']);
  Route::get('rescuertrash',['uses' => 'RescuerController@indexTrash','as' => 'rescuer.trash']);
  Route::get('personneltrash',['uses' => 'PersonnelController@indexTrash','as' => 'personnel.trash']);
  Route::get('adopterltrash',['uses' => 'AdopterController@indexTrash','as' => 'adopter.trash']);
  Route::get('animalinjury',['uses' => 'AnimalDiseaseInjuryController@index2','as' => 'injury.index']);
 
});
 
Route::group(['middleware' => 'role:admin,employee,veterinarian'], function() {
      
  Route::resource('animal', 'AnimalController',
   ['names' => [ 'create' => 'animal.create' ]]); 
  Route::get('animaladopted',['uses' => 'AnimalController@indexadopted','as' => 'animal.adopted']);
  Route::resource('email', 'MailController')->except(['create', 'store']); 

  Route::resource('adopter', 'AdopterController'); 
  Route::resource('rescuer', 'RescuerController');
  Route::resource('personnel', 'PersonnelController')->except(['create', 'store']);


});
//admin
Route::group(['middleware' => 'role:admin'], function() {
   Route::get('admin/dashboard',['uses' => 'AdminController@dashboard','as' => 'admin.dashboard']);    
   Route::get('myadmin',['uses' => 'ProfileController@getAdmin','as' => 'admin.profile']);
   Route::resource('admin','AdminController')->only('update');
   Route::resource('updateadopted','AdoptedAnimalController')->only('update');
   Route::resource('destroyadopted', 'AdoptedAnimalController')->only(['destroy']);  


});

 //allroles
 Route::group(['middleware' => 'role:admin,employee,veterinarian,rescuer,adopter'], function() {
  Route::get('profile',['uses' => 'loginController@getProfile','as' => 'profile']);    
  Route::get('user/{id}/edit',['uses' => 'ProfileController@edit','as' => 'user.edit']);
  Route::resource('user','ProfileController')->only('update');
  
});
//veterinarian
Route::group(['middleware' => 'role:veterinarian'], function() {
   Route::get('vet',['uses' => 'ProfileController@newindex','as' => 'vet.profile']);
});
//rescuer
Route::group(['middleware' => 'role:rescuer'], function() {
  Route::get('rescuerprofile',['uses' => 'ProfileController@getRescue','as' => 'rescuer.profile']);

});
//adopter
Route::group(['middleware' => ['role:adopter' ,'verified']], function() {
  Route::get('myadopter',['uses' => 'ProfileController@getAdopter','as' => 'adopter.profile']);
  Route::resource('adopted', 'AdoptedAnimalController')->except(['update','destroy']);  

});

#general
  Route::get('search',['uses' => 'SearchController@search','as' => 'animal.search']);
  Route::get('animalshow/{id}',['uses' => 'AnimalController@animnalshow','as' => 'animalshow']);
  Route::post('signin',['uses' => 'loginController@postSignin','as' => 'personnel.loginnow']);
  Route::get('adopteraccount',['uses' => 'AdopterController@myaccount','as' => 'adopter.myaaccount']);
  Route::get('signup',['uses' => 'PersonnelController@create','as' => 'personnel.create']);
  Route::post('signup',['uses' => 'PersonnelController@store','as' => 'personnel.store']);
  Route::get('send',['uses' => 'MailController@create','as' => 'email.create']);
  Route::post('send',['uses' => 'MailController@store','as' => 'email.store']);
#Home
  Route::resource('/', 'HomeController'); 
  Route::prefix('/')->group(function ()
   {
    Route::get('signin',['uses' => 'loginController@loginpage','as' => 'user.login']);
    Route::get('logout', [
      'uses' => 'loginController@logout',
      'as' => 'user.logout',
      'middleware'=>'auth'
      ]);
      
    // Route::get('/logoutadopter',function()
    // { 
    //   Session::forget('adopter');
    //   return view('adopter/adopter_create');
    // });
});
// CommentController
Route::post('postcomment',['uses' => 'CommentController@postComment','as' => 'postComment']);

Auth::routes(['verify' => true]);
 

Route::get('/mustverify', function () {
  return view('auth.verify');
});
Route::fallback(function () {

  return view("404");

});
*/ 
Route::resource('/', 'HomeController'); 

Route::fallback(function () {

  return view("404");

});

// Route::get('search',['uses' => 'SearchController@search','as' => 'animal.search']);
// Route::get('animalshow/{id}',['uses' => 'AnimalController@animnalshow','as' => 'animalshow']);
