<?php

Route::get('/admin/login', 'Panel\LoginController@Login')->name('Admin.Login');
Route::post('/admin/login', 'Panel\LoginController@Verify')->name('Admin.Login');
Route::get('/testapi', 'Panel\ImdbController@testApi')->name('Test.Api');



Route::group(['middleware' => ['admin']], function () {
    Route::get('/', 'Panel\DashboardController@Index')->name('BaseUrl');
    Route::get('/logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('Admin.Login');
    })->name('logout');
    Route::get('movie/add', 'Panel\MoviesController@Add')->name('Panel.AddMovie');
    Route::post('movie/add', 'Panel\MoviesController@Save')->name('Panel.AddMovie');
    Route::put('movie/add', 'Panel\MoviesController@EditPost')->name('Panel.AddMovie');
    Route::get('users', 'Panel\UserController@List')->name('Panel.UserList');
    Route::post('user/add', 'Panel\UserController@Add')->name('Panel.AddUser');
    Route::get('series/add', 'Panel\SeriesController@Add')->name('Panel.AddSerie');
    Route::post('series/add', 'Panel\SeriesController@Save')->name('Panel.AddSerie');


    Route::delete('user/delete', 'Panel\UserController@Delete')->name('Panel.DeleteUser');
    Route::get('movies/list', 'Panel\MoviesController@MoviesList')->name('Panel.MoviesList');
    Route::get('series/list', 'Panel\SeriesController@SeriesList')->name('Panel.SeriesList');

    Route::get('series/{serie}/season/add', 'Panel\SeriesController@AddSeason')->name('Panel.AddSeason');
    Route::post('series/{serie}/season/add', 'Panel\SeriesController@InsertSeason')->name('Panel.AddSeason');

    Route::delete('series/season/delete', 'Panel\SeriesController@DeleteSeason')->name('Panel.DeleteSeason');
    Route::get('series/season/{season}', 'Panel\SeriesController@EditSeason')->name('Panel.EditSeason');
    Route::post('series/season/{season}', 'Panel\SeriesController@SaveEditSeason')->name('Panel.EditSeason');

    Route::post('series/section/ajax/imdb', 'Panel\SeriesController@getSectionImdbData')->name('Panel.getSectionImdbData');


    Route::get('series/addsection/{season}', 'Panel\SeriesController@AddSection')->name('Panel.AddSection');
    Route::post('series/addsection/{season}', 'Panel\SeriesController@InsertSection')->name('Panel.AddSection');
    Route::delete('series/section/delete', 'Panel\SeriesController@DeleteSection')->name('Panel.DeleteSection');
    Route::get('series/section/{section}', 'Panel\SeriesController@EditSection')->name('Panel.EditSection');
    Route::post('series/section/{section}', 'Panel\SeriesController@SaveEditSection')->name('Panel.EditSection');


    Route::post('ajax/series/all', 'Panel\SeriesController@GetSeriesAjax')->name('Panel.Ajax.Series');



    Route::get('movie/{post}', 'Panel\MoviesController@Edit')->name('Panel.EditMovie');
    Route::post('movie/{post}', 'Panel\MoviesController@EditMovie')->name('Panel.EditMovie');

    Route::get('serie/{post}', 'Panel\SeriesController@Edit')->name('Panel.EditSerie');
    Route::post('serie/{post}', 'Panel\SeriesController@EditSerie')->name('Panel.EditSerie');


    Route::post('actor/insert', 'Panel\ActorsController@Insert')->name('Panel.Actor.Insert');
    Route::get('upload/video', 'Panel\MoviesController@UploadVideo')->name('Panel.UploadVideo');
    Route::post('upload/video', 'Panel\MoviesController@SaveVideo')->name('Panel.UploadVideo');
    Route::get('upload/episode', 'Panel\MoviesController@AddEpisode')->name('Panel.UploadEpisode');
    Route::post('upload/episode', 'Panel\MoviesController@SaveEpisode')->name('Panel.UploadEpisode');
    Route::delete('post/delete', 'Panel\MoviesController@DeletePost')->name('Panel.DeletePost');
    Route::delete('video/delete', 'Panel\MoviesController@DeleteVideo')->name('Panel.DeleteVideo');
    Route::get('plans/add', 'Panel\PlanController@Add')->name('Panel.AddPlan');
    Route::post('plans/add', 'Panel\PlanController@Save')->name('Panel.AddPlan');
    Route::get('plans/{id}/edit', 'Panel\PlanController@Edit')->name('Panel.EditPlan');
    Route::put('plans/{id}/edit', 'Panel\PlanController@SaveEdit')->name('Panel.EditPlan');
    Route::get('plans/list', 'Panel\PlanController@List')->name('Panel.PlanList');
    Route::delete('plans/delete', 'Panel\PlanController@Delete')->name('Panel.DeletePlan');
    Route::delete('post/image/delete', 'Panel\MoviesController@DeleteImage')->name('Panel.DeleteImage');
    Route::get('discounts', 'Panel\DiscountController@List')->name('Panel.DiscountList');
    Route::post('discount/save', 'Panel\DiscountController@Save')->name('Panel.Discount.Insert');
    Route::get('discount/{id}/edit', 'Panel\DiscountController@Edit')->name('Panel.Discount.Edit');
    Route::put('discount/{id}/edit', 'Panel\DiscountController@SaveEdit')->name('Panel.Discount.Edit');
    Route::delete('discount/delete', 'Panel\DiscountController@Delete')->name('Panel.DeleteDiscount');
    Route::get('sendmessage', 'Panel\MessageController@Add')->name('Panel.SendMessage');
    Route::post('sendmessage', 'Panel\MessageController@Send')->name('Panel.SendMessage');
    Route::get('blog/add', 'Panel\BlogController@Add')->name('Panel.AddBlog');
    Route::post('upload-image', 'Panel\BlogController@UploadImage')->name('UploadImage');
    Route::post('blog/add', 'Panel\BlogController@Save')->name('Panel.AddBlog');
    Route::get('blog/list', 'Panel\BlogController@List')->name('Panel.BlogList');
    Route::delete('blog/delete', 'Panel\BlogController@DeleteBlog')->name('Panel.DeleteBlog');
    Route::get('blog/edit/{blog}', 'Panel\BlogController@Edit')->name('Panel.EditBlog');
    Route::post('blog/edit/{blog}', 'Panel\BlogController@SaveEdit')->name('Panel.EditBlog');

    Route::get('comments/unconfirmed', 'Panel\CommentController@UnconfirmedComments')->name('Panel.UnconfirmedComments');
    Route::get('comments/confirmed', 'Panel\CommentController@ConfirmedComments')->name('Panel.ConfirmedComments');

    Route::get('setting', 'Panel\SettingController@Show')->name('Panel.Setting');
    Route::post('setting', 'Panel\SettingController@Save')->name('Panel.Setting');



    Route::post('imdb/get', 'Panel\ImdbController@Get')->name('Panel.GetImdb');
    Route::post('ajax/actor/get', 'Panel\ActorsController@GetActorAjax')->name('Panel.Ajax.GetActor');
    Route::post('ajax/director/get', 'Panel\ActorsController@GetDirectorAjax')->name('Panel.Ajax.GetDirector');
    Route::post('ajax/category', 'Panel\MoviesController@AddCatAjax')->name('Panel.AddCatAjax');

});
