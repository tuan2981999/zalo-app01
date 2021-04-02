<?php

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

Route::get('/','Admin@dashboard');
Route::get('/dashboard','Admin@dashboard');


//login zalo
Route::get('/login-zalo','Admin@login_zalo');
Route::post('/login-to-admin','Admin@login_to_admin');
 

//product
// Route::get('/add-product','Admin@add_product');
// Route::get('/all-product','Admin@all_product');
// Route::get('/edit-product/{product_id}','Admin@edit_product');
// Route::post('/save-product','Admin@save_product');
// Route::post('/update-product','Admin@update_product');
// Route::get('/copy-product/{product_id}','Admin@copy_product');

//category product
// Route::get('/all-category','Admin@all_category');
// Route::get('/edit-category/{category_id}/{name}/{desc}/{photo_link}/{status}/{photo}','Admin@edit_category');
// Route::get('/add-category','Admin@add_category');
// Route::post('/save-category','Admin@save_category');
// Route::post('/update-category','Admin@update_category');

//order
// Route::get('/product-order','Admin@product_order');
// Route::get('/order-detail/{order_id}','Admin@order_detail');
// Route::get('/edit-order/{order_id}','Admin@edit_order');
// Route::post('/update-order','Admin@update_order');

//custumers
// Route::get('/all-customers','Admin@all_customers');

//followers
Route::get('/all-followers','Admin@all_followers');

//article
Route::get('/all-article','Admin@all_article');
Route::get('/add-article','Admin@add_article');
Route::get('/detail-article/{article_id}','Admin@detail_article');
Route::post('/save-article','Admin@save_article');
Route::get('/delete-article/{article_id}','Admin@delete_article');
Route::get('/edit-article/{article_id}','Admin@edit_article');
Route::post('/update-article','Admin@update_article');

//messenger
Route::get('/messenger','Admin@messenger'); 
Route::get('/messenger-detail/{messenger_id}','Admin@messenger_detail');
Route::post('/sent-messenger','Admin@sent_messenger'); 

//token
Route::get('/list-token','Admin@list_token');
Route::post('/save-token','Admin@save_token'); 

//broadcast
Route::get('/sent-broadcast','Admin@sent_broadcast');
Route::get('/detail-broadcast/{article_id}','Admin@detail_broadcast');
Route::post('/sent-to-broadcast/{article_id}','Admin@sent_to_broadcast');

//product synchronization
Route::get('/product-sync','Synchronization@product_sync');
Route::get('/link-sync','Synchronization@link_sync');
Route::get('/file-sync','Synchronization@file_sync');
Route::post('/save-link','Synchronization@save_link');
Route::post('/save-file','Synchronization@save_file');
Route::post('/save-sync','Synchronization@save_sync');
Route::post('/save-link-product/{category_id}','Synchronization@save_link_product');
Route::post('/save-file-product/{category_id}','Synchronization@save_file_product');

//Chatbot-Config
Route::get('/config-chatbot-script','Chatbot@config_chatbot');
Route::get('/config-chatbot-more','Chatbot@config_chatbot_more');
Route::get('/config-chatbot-time','Chatbot@config_chatbot_time');
Route::post('/save-chatbot','Chatbot@save_chatbot');
Route::post('/save-chatbot-more','Chatbot@save_chatbot_more');
Route::post('/save-chatbot-time','Chatbot@save_chatbot_time');
Route::get('/delete-chatbot/{script_id}','Chatbot@delete_chatbot');
Route::get('/delete-chatbot-more/{script_id}','Chatbot@delete_chatbot_more');
Route::get('/update-chatbot', 'Chatbot@update_chatbot'); 
Route::get('/update-chatbot-more', 'Chatbot@update_chatbot_more'); 

//user-home
Route::get('/user-social', 'Home@user_social'); 
Route::get('/login-zalo-2','Home@login_zalo');
Route::get('/logout-zalo','Home@logout_zalo');
Route::get('/login-home','Home@login_home');
Route::get('/list-status', 'Home@list_status'); 
Route::get('/list-friend', 'Home@list_friend'); 
Route::get('/account-detail', 'Home@account_detail'); 




            