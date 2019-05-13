<?php 

$arguments=array(

	'applications'=>'cadWebSupport', 
	// applicationKey:secret this secret is defined on the applications table
	// this key must be unique per application.
	'middleware'=>['web','auth','applicationKey:cadWebSupport4:YXS'],
	'namespace' => 'App\Applications\cadWebSupport\Controllers',
	'prefix'=>'/dashboard/cadWebSupport'
	);


	Route::group($arguments, function() { 

		Route::get('/','cadWebSupportController@index')->name('cadWebSupport');
        Route::get('/findAccount','cadWebSupportController@findAccount')->name('findAccount');
        Route::post('/listAccount','cadWebSupportController@listAccount')->name('listAccount');
        Route::get('/deleteAccountEmail/{id}/{loginid}','cadWebSupportController@deleteAccountEmail')->name('deleteAccountEmail');
        Route::post('/deleteAccount','cadWebSupportController@deleteAccount')->name('deleteAccount');
        //
        Route::get('/findAccountRP','cadWebSupportController@findAccountRP')->name('findAccountRP');
        Route::get('/listAccountRP','cadWebSupportController@listAccountRP')->name('listAccountRP');
        Route::post('/listAccountRP','cadWebSupportController@listAccountRPPost')->name('listAccountRPPost');
        Route::get('/resetAccountEmail/{id}/{loginid}','cadWebSupportController@resetAccountEmail')->name('resetAccountEmail');
        Route::post('/resetAccount','cadWebSupportController@resetAccountPassword')->name('resetAccount');
        //
        Route::get('/templateIndex','cadWebSupportController@templateIndex')->name('templateIndex');
        Route::get('/createEmailTemplate','cadWebSupportController@createEmailTemplate')->name('createEmailTemplate');
        Route::post('/insertEmailTemplate','cadWebSupportController@insertEmailTemplate')->name('insertEmailTemplate');
        Route::get('/editEmailTemplate/{id}','cadWebSupportController@editEmailTemplate')->name('editEmailTemplate');
        Route::post('/updateEmailTemplate','cadWebSupportController@updateEmailTemplate')->name('updateEmailTemplate');
        Route::get('/selectEmailTemplate/{id}','cadWebSupportController@selectEmailTemplate')->name('selectEmailTemplate');
        //Route::post('/selectEmailTemplate','cadWebSupportController@selectEmailTemplate')->name('selectEmailTemplatePost');
        Route::post('/sendEmailTemplate','cadWebSupportController@sendEmailTemplate')->name('sendEmailTemplate');
        //
        Route::get('/cadEmailIndex','cadWebSupportController@cadEmailIndex')->name('cadEmailIndex');
        Route::get('/selectCadEmail/{id}','cadWebSupportController@selectCadEmail')->name('selectCadEmail');
        Route::post('/processCadEmailTemplate','cadWebSupportController@processCadEmailTemplate')->name('processCadEmailTemplate');
        Route::post('/processCadEmailDelete','cadWebSupportController@processCadEmailDelete')->name('processCadEmailDelete');
        Route::post('/processCadEmailRP','cadWebSupportController@processCadEmailRP')->name('processCadEmailRP');
        //
        Route::get('/docIndex','cadWebSupportController@docIndex')->name('docIndex');
        //
        Route::get('/getEmails','cadWebSupportController@getEmails')->name('getEmails');
        //




	});

