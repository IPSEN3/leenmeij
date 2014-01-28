<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit')
        ->where('comment', '[0-9]+');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit')
        ->where('comment', '[0-9]+');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete')
        ->where('comment', '[0-9]+');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete')
        ->where('comment', '[0-9]+');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow')
        ->where('post', '[0-9]+');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit')
        ->where('post', '[0-9]+');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit')
        ->where('post', '[0-9]+');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete')
        ->where('post', '[0-9]+');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete')
        ->where('post', '[0-9]+');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow')
        ->where('user', '[0-9]+');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit')
        ->where('user', '[0-9]+');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete')
        ->where('user', '[0-9]+');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete')
        ->where('role', '[0-9]+');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset')
    ->where('token', '[0-9a-z]+');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset')
    ->where('token', '[0-9a-z]+');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit')
    ->where('user', '[0-9]+');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

//:: User Account Routes ::
Route::get('user/settings', 'UserController@getSettingsIndex');

//:: User Account Routes ::
Route::get('user/reservations', 'UserController@getReservationIndex');

//:: User Account Routes ::
Route::get('user/reviews', 'UserController@getReviewIndex');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

Route::get('voertuigoverzicht', function(){

    $vehicle = Vehicle::all();

    //$reviews = $vehicle->reviews()->approved()->notSpam()->orderBy('brand','desc')->paginate(10);

    Return View::make('site/multiple-car', array('vehicles'=>$vehicle));

});

# Posts - Second to last set, match slug
// Route::get('{postSlug}', 'BlogController@getView');
// Route::post('{postSlug}', 'BlogController@postView');


# Reservation steps
Route::any('reservation/edit', 'ReservationController@editDates');
Route::post('reservation', 'ReservationController@postDates');
Route::get('reservation/car', 'ReservationController@getDates');
Route::any('reservation/car/select', 'ReservationController@selectCar');
Route::get('reservation/payment', 'ReservationController@getPayment');
Route::get('reservation/overview', 'ReservationController@getOverview');
Route::get('reservation/confirm', 'ReservationController@postReservation');

#review routes
// Route that shows an individual vehicle by its ID
Route::get('vehicle/{id}', function($id)
{
  $vehicle = Vehicle::find($id);
  // Get all reviews that are not spam for the vehicle and paginate them
  $reviews = $vehicle->reviews()->with('user')->approved()->notSpam()->orderBy('created_at','desc')->paginate(10);
 
  return View::make('site/single-car', array('vehicle'=>$vehicle,'reviews'=>$reviews));
});
 
// Route that handles submission of review - rating/comment
Route::post('vehicle/{id}',  function($id)
{   
  
   $input = array(
    'comment' => Input::get('comment'),
    'rating'  => Input::get('rating')
  );
  // instantiate Rating model
  $review = new Review;
 
  // Validate that the user's input corresponds to the rules specified in the review model
  $validator = Validator::make( $input, $review->getCreateRules());
 
  // If input passes validation - store the review in DB, otherwise return to product page with error message 
  if ($validator->passes()) {
    $review->storeReviewForProduct($id, $input['comment'], $input['rating']);
    return Redirect::to('vehicle/'.$id.'#reviews-anchor')->with('review_posted',true);
  }
 
  return Redirect::to('vehicle/'.$id.'#reviews-anchor')->withErrors($validator)->withInput();

});

#misc pages
# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');
Route::get('about/leenmeij', 'BlogController@getIndex');
Route::get('contact/leenmeij', 'FrontController@getContact');

# Index Page - Last route, no matches

Route::get('/', 'FrontController@getIndex');

# route for locale
Route::get('language/{lang}', 
           array(
                  'as' => 'language.select', 
                  'uses' => 'LanguageController@select'
                 )
          );