<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\TemplateAuthController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\VoiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SampleController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\TemplatePasswordController;
use App\Http\Controllers\Category1Controller;
use App\Http\Controllers\Category2Controller;
use App\Http\Controllers\Category3Controller;
use App\Http\Controllers\Category4Controller;
use App\Http\Controllers\Category5Controller;
use App\Http\Controllers\Category6Controller;
use App\Http\Controllers\Category7Controller;
use App\Http\Controllers\Category8Controller;
use App\Http\Controllers\Category9Controller;
use App\Http\Controllers\Category10Controller;
use App\Http\Controllers\Category11Controller;
use App\Http\Controllers\Category12Controller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController as OfficialIndexController;
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

// オフィシャル
Route::get(config('custom.page.index.url'), [OfficialIndexController::class, 'index'])->name(config('custom.page.index.route'));
Route::get(config('custom.page.category1.url'), [Category1Controller::class, 'index'])->name(config('custom.page.category1.route'));
Route::get(config('custom.page.category2.url'), [Category2Controller::class, 'index'])->name(config('custom.page.category2.route'));
Route::get(config('custom.page.category3.url'), [Category3Controller::class, 'index'])->name(config('custom.page.category3.route'));
Route::get(config('custom.page.category3.url').'/detail/{id}', [Category3Controller::class, 'detail'])->name(config('custom.page.category3.route').'.detail')->where('id', '[0-9]+');
Route::get(config('custom.page.category4.url'), [Category4Controller::class, 'index'])->name(config('custom.page.category4.route'));
Route::get(config('custom.page.category5.url'), [Category5Controller::class, 'index'])->name(config('custom.page.category5.route'));
Route::get(config('custom.page.category6.url'), [Category6Controller::class, 'index'])->name(config('custom.page.category6.route'));
Route::get(config('custom.page.category6.url').'/detail/{id}', [Category6Controller::class, 'detail'])->name(config('custom.page.category6.route').'.detail')->where('id', '[0-9]+');
Route::get(config('custom.page.category7.url'), [Category7Controller::class, 'index'])->name(config('custom.page.category7.route'));
Route::get(config('custom.page.category8.url'), [Category8Controller::class, 'index'])->name(config('custom.page.category8.route'));
Route::get(config('custom.page.contact.url'), [ContactController::class, 'index'])->name(config('custom.page.contact.route'));
Route::post(config('custom.page.contact_confirm.url'), [ContactController::class, 'confirm'])->name(config('custom.page.contact_confirm.route'));
Route::post(config('custom.page.contact_send.url'), [ContactController::class, 'send'])->name(config('custom.page.contact_send.route'));
Route::get(config('custom.page.contact_confirm.url'), [ContactController::class, 'error']);
Route::get(config('custom.page.contact_send.url'), [ContactController::class, 'error']);
Route::get(config('custom.page.category9.url'), [Category9Controller::class, 'index'])->name(config('custom.page.category9.route'));
Route::get(config('custom.page.category10.url'), [Category10Controller::class, 'index'])->name(config('custom.page.category10.route'));
Route::get(config('custom.page.category12.url').'/{guard?}', [Category12Controller::class, 'index'])->name(config('custom.page.category12.route'));

Route::middleware(['auth.custom:templates'])->group(function () {
    Route::get(config('custom.page.category11.url').'/{guard?}', [Category11Controller::class, 'index'])->name(config('custom.page.category11.route'));
});
// 認証
Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login/{guard?}', 'Login')->where('guard', 'admin|templates');
    Route::post('/login/{guard?}', 'postLogin')->where('guard', 'admin|templates');
    Route::get('/logout/{guard?}', 'Logout')->where('guard', 'admin|templates');
});

// Route::get('/template_login', [TemplateAuthController::class, 'login'])->name('template_login');
// Route::post('/template_login', [TemplateAuthController::class, 'postLogin']);
// Route::get('/template_logout', [TemplateAuthController::class, 'logout'])->name('template_logout');
// // // 認証
// Route::get('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/login', [AuthController::class, 'postLogin']);
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// 管理画面
Route::name('wb-admin.')->prefix('wb-admin')->middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('dashboard');
    // 運営部からのお知らせ
    Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
    // 投稿機能
    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::post('/post', [PostController::class, 'postIndex']);
    Route::get('/post/add', [PostController::class, 'add'])->name('post.add');
    Route::post('/post/add', [PostController::class, 'postAdd']);
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/edit/{id}', [PostController::class, 'postEdit']);
    Route::get('/post/display/{id}', [PostController::class, 'display'])->name('post.display');
    // お知らせ機能
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/news', [NewsController::class, 'postIndex']);
    Route::get('/news/add', [NewsController::class, 'add'])->name('news.add');
    Route::post('/news/add', [NewsController::class, 'postAdd']);
    Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('/news/edit/{id}', [NewsController::class, 'postEdit']);
    Route::get('/news/display/{id}', [NewsController::class, 'display'])->name('news.display');
    // 基本情報設定
    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/company/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/company/edit', [CompanyController::class, 'postEdit']);
    // ページ情報設定
    Route::get('/page', [PageController::class, 'index'])->name('page.index');
    Route::post('/page/edits', [PageController::class, 'postIndex'])->name('page.postIndex');
    Route::get('/page/edit/{id?}', [PageController::class, 'edit'])->name('page.edit');
    Route::post('/page/edit/{id?}', [PageController::class, 'postEdit'])->name('page.postEdit');
    Route::get('/page/edits', [PageController::class, 'error']);

    // 投稿機能
    Route::get('/production', [ProductionController::class, 'index'])->name('production.index');
    Route::post('/production', [ProductionController::class, 'postIndex']);
    Route::get('/production/add', [ProductionController::class, 'add'])->name('production.add');
    Route::post('/production/add', [ProductionController::class, 'postAdd']);
    Route::get('/production/edit/{id}', [ProductionController::class, 'edit'])->name('production.edit');
    Route::post('/production/edit/{id}', [ProductionController::class, 'postEdit']);
    Route::get('/production/display/{id}', [ProductionController::class, 'display'])->name('production.display');
    // 投稿機能
    Route::get('/voice', [VoiceController::class, 'index'])->name('voice.index');
    Route::post('/voice', [VoiceController::class, 'postIndex']);
    Route::get('/voice/add', [VoiceController::class, 'add'])->name('voice.add');
    Route::post('/voice/add', [VoiceController::class, 'postAdd']);
    Route::get('/voice/edit/{id}', [VoiceController::class, 'edit'])->name('voice.edit');
    Route::post('/voice/edit/{id}', [VoiceController::class, 'postEdit']);
    Route::get('/voice/display/{id}', [VoiceController::class, 'display'])->name('voice.display');

    // 商品カテゴリー機能
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'postIndex']);
    Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('/category/add', [CategoryController::class, 'postAdd']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/edit/{id}', [CategoryController::class, 'postEdit']);
    Route::get('/category/display/{id}', [CategoryController::class, 'display'])->name('category.display');
    Route::get('/category/sort', [CategoryController::class, 'sort'])->name('category.sort');
    Route::post('/category/sort', [CategoryController::class, 'postSort']);
    // 投稿機能
    Route::get('/sample', [SampleController::class, 'index'])->name('sample.index');
    Route::post('/sample', [SampleController::class, 'postIndex']);
    Route::get('/sample/add', [SampleController::class, 'add'])->name('sample.add');
    Route::post('/sample/add', [SampleController::class, 'postAdd']);
    Route::get('/sample/edit/{id}', [SampleController::class, 'edit'])->name('sample.edit');
    Route::post('/sample/edit/{id}', [SampleController::class, 'postEdit']);
    Route::get('/sample/display/{id}', [SampleController::class, 'display'])->name('sample.display');
    Route::get('/sample/sort/{category_id?}', [SampleController::class, 'sort'])->name('sample.sort');
    Route::post('/sample/sort', [SampleController::class, 'postSort']);

    // 投稿機能
    Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
    Route::post('/template', [TemplateController::class, 'postIndex']);
    Route::get('/template/add', [TemplateController::class, 'add'])->name('template.add');
    Route::post('/template/add', [TemplateController::class, 'postAdd']);
    Route::get('/template/edit/{id}', [TemplateController::class, 'edit'])->name('template.edit');
    Route::post('/template/edit/{id}', [TemplateController::class, 'postEdit']);
    Route::get('/template/display/{id}', [TemplateController::class, 'display'])->name('template.display');
    Route::get('/template/sort/{category_id?}', [TemplateController::class, 'sort'])->name('template.sort');
    Route::post('/template/sort', [TemplateController::class, 'postSort']);

    // 基本情報設定
    Route::get('/template_password', [TemplatePasswordController::class, 'index'])->name('template_password.index');
    Route::post('/template_password', [TemplatePasswordController::class, 'postIndex']);

    // お問合せログ
    Route::get('/log', [LogController::class, 'index'])->name('log.index');
});

// ファイルマネージャー
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
