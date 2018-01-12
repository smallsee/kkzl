<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('index');
});

Route::get('/anime/mysql','AnimeController@mysql');
Route::get('/movie/mysql','MovieController@mysql');
Route::get('/tv/mysql','TvController@mysql');



Route::get('/wx/login','WxController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {


        //公司管辖
        $api->resource('xcx','XcxController');
        $api->resource('brtank','BrtankController');
        $api->resource('brfloor','BrfloorController');

        //自己的
        $api->get('home','HomeController@index');
        $api->post('user/login','AuthController@authenticate');
        $api->post('user/register','AuthController@register');
        $api->post('user/info/thumb','UserController@thumb');
        $api->patch('user/info/update','UserController@update');

        $api->post('image/','ImageController@upload');
        $api->post('image/mote','ImageController@uploadMote');
        $api->post('image/delete','ImageController@delete');
        $api->post('crop/upload','ImageController@crop');

        $api->get('commit','CommitController@index');
        $api->post('commit','CommitController@store');
        $api->get('user/commit','CommitController@userCommit');


        $api->get('user/user/{id}','UserController@userInfo');

        $api->get('fav','FavController@index');
        $api->get('hasfav','FavController@hasFav');
        $api->post('fav','FavController@store');
        $api->get('user/fav','FavController@userFav');

        $api->post('fan','FanController@fan');
        $api->get('hasfan','FanController@hasFan');
        $api->get('user/fan','FanController@userFan');


        $api->get('topic','TopicController@index');
        $api->get('tag','TagController@index');
        $api->get('akira','AkiraController@index');
        $api->get('star','StarController@index');
        $api->get('director','DirectorController@index');

        $api->get('anime','AnimeController@homeIndex');
        $api->get('search','SearchController@search');
        $api->get('anime/recommend','AnimeController@homeRecommend');
        $api->post('admin/address/user','AddressController@userAddress');

        $api->resource('admin/anime','AnimeController');
        $api->resource('admin/movie','MovieController');
        $api->resource('admin/picture','PictureController');
        $api->resource('admin/tv','TvController');
        $api->resource('admin/article','ArticleController');



        $api->get('anime/hot','AnimeController@hot');
        $api->get('article/hot','ArticleController@hot');
        $api->get('tv/hot','TvController@hot');
        $api->get('picture/hot','PictureController@hot');
        $api->get('movie/hot','MovieController@hot');


        $api->group(['middleware' => 'jwt.auth'], function ($api){
            $api->get('user/me','AuthController@AuthenticatedUser');
            $api->get('user','UserController@index');
            $api->get('user/{id}','UserController@show');
        });
    });
});
