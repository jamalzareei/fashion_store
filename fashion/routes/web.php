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
/*
Route::get('resize', 'ResizeController@resize')->name('resize.images');

Route::get('/jamali', function () {

    $data = '[{
        "name": "Aragorn",
        "race": "Human"
    }]';

    $result = json_decode($data);
    // foreach ($result as $key => $value) {
    //     # code...
    //     return $value;
    // }
    return ($result[0]->name);
    die();

    return \App\User::all()[0];



    $login = auth()->user()->login;
    $messages = \App\Models\Message::where(function($query_1){
        $query_1->where('type_user', null)->orWhere('type_user','manufacturer');
    })
    ->where(function($query_2) use($login){
        $query_2->where('recive_login', null)->orWhere('recive_login',$login);
    })
    ->select('kimiagar_message_user.message_id','kimiagar_messages.*')
    // ->with('user')
    ->leftJoin('kimiagar_message_user','kimiagar_message_user.message_id','kimiagar_messages.id')
    ->with('sender')
    ->where('message_id', null)
    ->groupBy('kimiagar_messages.id')
    // ->toSql();
    ->get();

    return (auth()->user()->manufactory) ;

    return $messages;
    
    return auth()->user();
})->name('jamali');
*/

Route::get('/', function () {
    if(auth()->check()){
        return redirect()->route('panel');
    }else{
        return view('admin.login');
    }
})->name('home');

Auth::routes();

Route::post('login-new', 'AuthenticatinController@login')->name('login.new');

Route::get('logout', function(){
    auth()->logout();
    return view('admin.login');
} )->name('log-out');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('merchant/login', function () {
    // return auth()->user();
    if(auth()->check()){
        // return auth()->user();
        return redirect()->route('panel');
    }else{
        return view('admin.login');
    }
    
})->name('panelLogin');

//////////////////////////////////////////////////////////////////////
Route::prefix("/panel")->middleware(['auth'])->namespace('PanelUsers')->group(function(){
    

    Route::get('/edit-user/{step?}', 'UserController@editUser')->name('edit.user');
    Route::post('/edit-user-post', 'UserController@editUserPost')->name('edit.user.post');
    Route::post('/edit-user-card-number-post', 'UserController@editUserCardNumberPost')->name('edit.user.card-number.post');
    Route::post('/edit-user-spesiality-post', 'UserController@editUserSpesialityPost')->name('edit.user.spesiality.post');
    Route::post('/edit-user-password-post', 'UserController@editUserPasswordPost')->name('edit.user.password.post');
    
});
Route::post('/changeCategories', 'CategoryController@changeCategories')->name('categories.change');

Route::get('/panel-', 'AuthenticatinController@index')->name('panel')->middleware(['auth']);
Route::post('/panel-', 'AuthenticatinController@index')->name('panelp')->middleware(['auth']);

Route::prefix("/panel-merchant")->middleware(['merchant'])->namespace('PanelMerchant')->group(function(){

    Route::get('/', 'DashboardController@index')->name('panel.merhcant')->middleware(['auth']);
    // Route::post('/changeCategories', 'ProductController@changeCategories')->name('categories.change');

    Route::get('/dashboard', 'DashboardController@index')->name('panelDashboard');

    Route::get('/bio', 'MerchantsController@index')->name('bio.merchant');

    Route::get('/edit-merchant/{merchant_id?}', 'MerchantsController@editMerchant')->name('edit.merchant');
    Route::post('/edit-merchant-post', 'MerchantsController@editMerchantPost')->name('edit.merchant.post');

    Route::get('/add-merchant/plan1/{type?}', 'MerchantsController@addMerchantType')->name('add.merchant.type.plan.1');
    Route::post('/add-merchant-post-type', 'MerchantsController@addMerchantPostType')->name('add.merchant.post.type');
    
    Route::get('/connect-suppliers', 'MerchantsController@connectSuppliers')->name('connect.suppliers');
    Route::post('/connect-suppliers-post', 'MerchantsController@connectSuppliersPost')->name('connect.suppliers.post');

    // Route::get('/list-products/{product?}', 'ProductController@index')->name('list.product.merchant');
    


    // Route::get('/list-price/{slugProduct?}', 'ProductController@listPrice')->name('list.price.merchant');
    // Route::post('/add-price/{slugProduct?}', 'ProductController@addPrice')->name('add.price.merchant');

    
    // Route::get('/add-product', 'ProductController@addProduct')->name('add.product.merchant');
    // Route::post('/add-product', 'ProductController@addProductPost')->name('add.product.merchant.post');
    // // Route::get('/list-products', 'ProductController@listProduct')->name('list.product.merchant');
    // Route::get('/edit-product/{slug}', 'ProductController@editProduct')->name('edit.product.merchant');
    
    // Route::post('/edit-product-step-1', 'ProductController@editProductStep1')->name('edit.product.step.1.merchant.post');
    // Route::post('/edit-product-step-2', 'ProductController@editProductStep2')->name('edit.product.step.2.merchant.post');
    // Route::DELETE('/edit-product-step-2-delete/{id}', 'ProductController@editProductStep2Delete')->name('edit.product.step.2.merchant.delete.post');
    // Route::post('/edit-product-step-3', 'ProductController@editProductStep3')->name('edit.product.step.3.merchant.post');
    // Route::post('/edit-product-step-4', 'ProductController@editProductStep4')->name('edit.product.step.4.merchant.post');
    

    Route::middleware(['noghrei'])->group(function(){
        Route::get('/add-merchant/{type?}', 'MerchantsController@addMerchantType')->name('add.merchant.type');
        Route::get('/list-merchant/{type}', 'MerchantsController@listMerchantType')->name('list.merchant.type');
    });
    Route::middleware(['talai'])->group(function(){
    });
});


Route::prefix("/panel-manufactorer")->middleware(['manufactorer'])->namespace('PanelSuppliers')->group(function(){
    Route::get('/', 'DashboardController@index')->name('panel.suppliers');

    Route::get('/manufactorer/edit', 'ManufactorerController@edit')->name('panel.suppliers.edit');
    Route::post('/manufactorer/edit', 'ManufactorerController@editPost')->name('panel.suppliers.edit.post');

    
    Route::get('/manufactorer/edit/{step}', 'ManufactorerController@editSteps')->name('panel.suppliers.sale.edit');
    Route::post('/manufactorer/edit/{step}', 'ManufactorerController@editStepsPost')->name('panel.suppliers.edit.steps.post');
    
    Route::get('/manufactorer/gallery', 'ManufactorerController@editGallery')->name('panel.suppliers.gallery');
    Route::post('/manufactorer/gallery', 'ManufactorerController@editGalleryPost')->name('panel.suppliers.gallery.post');
    Route::DELETE('/manufactorer-gallery-delete/{id}', 'ManufactorerController@editGalleryPostDelete')->name('manufactorer.gallery.delete.post');

        
    




    Route::middleware(['noghrei'])->group(function(){
        Route::get('/list-products/{product?}', 'ProductController@index')->name('list.product.supplier');

        Route::get('/list-price/{slugProduct?}', 'ProductController@listPrice')->name('list.price.supplier');
        Route::post('/add-price/{slugProduct?}', 'ProductController@addPrice')->name('add.price.supplier');

        Route::get('/add-product', 'ProductController@addProduct')->name('add.product.supplier');
        Route::post('/add-product', 'ProductController@addProductPost')->name('add.product.supplier.post');
        Route::get('/edit-product/{slug}', 'ProductController@editProduct')->name('edit.product.supplier');
        
        Route::DELETE('/delete-product/{id}', 'ProductController@deleteProductPost')->name('delete.product.supplier.post');
        
        Route::post('/edit-product-step-1', 'ProductController@editProductStep1')->name('edit.product.step.1.supplier.post');
        Route::post('/edit-product-step-2', 'ProductController@editProductStep2')->name('edit.product.step.2.supplier.post');
        Route::DELETE('/edit-product-step-2-delete/{id}', 'ProductController@editProductStep2Delete')->name('edit.product.step.2.supplier.delete.post');
        Route::post('/edit-product-step-3', 'ProductController@editProductStep3')->name('edit.product.step.3.supplier.post');
        Route::post('/edit-product-step-4', 'ProductController@editProductStep4')->name('edit.product.step.4.supplier.post');

        Route::get('/report-sale/{type}', 'ReportSupplierController@index')->name('suppliers.reports.sales');

            
        Route::get('/list-decors', 'DecorController@index')->name('list.decor.supplier');
        Route::get('/add-decor', 'DecorController@addDecor')->name('add.decor.supplier');
        Route::post('/add-decor', 'DecorController@addDecorPost')->name('add.decor.supplier.post');
        Route::DELETE('/delete-decor/{id}', 'DecorController@deleteDecorPost')->name('delete.decor.supplier.post');
        Route::get('/edit-decor/{slug}', 'DecorController@editDecor')->name('edit.decor.supplier');
        Route::post('/edit-decor/{slug?}', 'DecorController@editDecorPost')->name('edit.decor.supplier.post');
        Route::post('/add-decor-image', 'DecorController@addDecorImagesPost')->name('add.decor.image.supplier.post');
        Route::DELETE('/delect-decor-image/{id}', 'DecorController@delectDecorImagesPost')->name('delect.decor.image.supplier.post');

        Route::get('/add-merchant/{type?}', 'MerchantsController@addMerchantType')->name('add.merchant.type.suppliers');
        Route::post('/add-merchant-post-type', 'MerchantsController@addMerchantPostType')->name('add.merchant.post.type.suppliers');
        Route::get('/list-merchant/{type}', 'MerchantsController@listMerchantType')->name('list.merchant.type.suppliers');
        
        Route::get('/edit-merchant/{merchant_id?}', 'MerchantsController@editMerchant')->name('edit.merchant.suppliers');
        Route::post('/edit-merchant-post', 'MerchantsController@editMerchantPost')->name('edit.merchant.post.suppliers');
    });

    Route::middleware(['talai'])->group(function(){
        
    
        Route::get('/tickets', 'MessageController@index')->name('suppliers.tickes');
        Route::get('/ticket/{id}', 'MessageController@show')->name('suppliers.ticke.show');

        
        Route::get('/update-price-avail-poducts', 'ProductsGroupController@listProduct')->name('update.price.avail.poducts');
        Route::post('/update-price-avail-poducts', 'ProductsGroupController@updatePost')->name('update.price.avail.poducts.post');



    });
});


Route::prefix("/panel-admin")->namespace('PanelAdmin')->group(function(){
    Route::get('/', 'DashboardController@index')->name('panel.adminer');
    Route::post('/change-login-factory', 'DashboardController@loginFactory')->name('panel.adminer.login.factory');
    Route::get('/change-login-factory', 'DashboardController@loginFactory')->name('panel.adminer.login.factory');

    
    Route::get('/file-manager', 'FilesController@list')->name('panel.adminer.filemanager');//////////////////////
    Route::post('/file-manager', 'FilesController@upload')->name('panel.adminer.filemanager.post');//////////////////////
    Route::get('/file-manager/delete', 'FilesController@delete')->name('panel.adminer.filemanager.delete');//////////////////////

    
    Route::middleware(['admin-a'])->group(function() {
        //
        Route::get('/users/roles', 'UsersController@roles')->name('panel.adminer.users.roles');//////////////////////
        Route::post('/users/role/add', 'UsersController@addRole')->name('panel.adminer.users.role.add');
        Route::DELETE('/users/role/{key}', 'UsersController@roleDelete')->name('panel.adminer.users.role.delete');

        Route::get('/users/{login?}', 'UsersController@users')->name('panel.adminer.users');//////////////////////
        Route::post('/users/update', 'UsersController@usersUpdate')->name('panel.adminer.users.update');
        Route::DELETE('/users/{login}', 'UsersController@userDelete')->name('panel.adminer.users.delete');

        Route::get('/discounts/{coupon?}', 'DiscountController@discounts')->name('panel.adminer.discounts');//////////////////////
        Route::post('/discounts/add', 'DiscountController@discountAdd')->name('panel.adminer.discounts.add');
        Route::post('/discounts/update', 'DiscountController@discountsUpdate')->name('panel.adminer.discounts.update');
        Route::DELETE('/discount/{coupon}', 'DiscountController@discountDelete')->name('panel.adminer.discount.delete');

    });

    
    Route::middleware(['admin-b'])->group(function() {
        //
        Route::get('/properties/{categoryid?}', 'CategoriesController@properties')->name('panel.adminer.properties');//////////////////////
        Route::post('/properties/update', 'CategoriesController@propertiesUpdate')->name('panel.adminer.properties.update');
        Route::post('/properties/add/{categoryid}', 'CategoriesController@propertiesAdd')->name('panel.adminer.properties.add');
        Route::DELETE('/property/{propertyid}', 'CategoriesController@propertyDelete')->name('panel.adminer.property.delete');

        
        Route::get('/reviews/{type?}', 'ReviewsController@reviews')->name('panel.adminer.reviews');//////////////////////
        Route::post('/review/replye/{type}/{id}/{coloumn}', 'ReviewsController@reviewUpdate')->name('panel.adminer.review.update');
        Route::DELETE('/reviews/{type}/{id}', 'ReviewsController@reviewDelete')->name('panel.adminer.review.delete');
    });

    
    Route::middleware(['admin-c'])->group(function() {
        //
        Route::get('/pages/{page?}', 'PagesController@pages')->name('panel.adminer.pages');//////////////////////
        Route::get('/page/add', 'PagesController@pageAdd')->name('panel.adminer.page.add');//////////////////////
        Route::post('/page/add', 'PagesController@pageAddPost')->name('panel.adminer.page.add.post');
        Route::get('/page/edit/{pageid}', 'PagesController@pageEdit')->name('panel.adminer.page.edit');
        Route::post('/page/update/{pageid}', 'PagesController@pageUpdate')->name('panel.adminer.page.update.pageid');
        Route::post('/pages/update', 'PagesController@pagesUpdate')->name('panel.adminer.pages.update');
        Route::DELETE('/page/{pageid}', 'PagesController@pageDelete')->name('panel.adminer.page.delete');

        Route::get('/suppliers', 'SuppliersController@suppliers')->name('panel.adminer.suppliers');//////////////////////
        Route::get('/manufactor/updateOrInsert/{manufacturerid?}', 'SuppliersController@manufactorUpdateOrInsert')->name('panel.adminer.manufactor.updateOrInsert');//////////////////////
        Route::post('/manufactor/updateOrInsert/{manufacturerid?}', 'SuppliersController@manufactorUpdateOrInsertPost')->name('panel.adminer.manufactor.updateOrInsert.post');
    });

    
    Route::middleware(['admin-d'])->group(function() {
        //
        Route::get('/orders-e-g', 'OrdersController@ordersEG')->name('panel.adminer.orders.e.g');//////////////////////
        Route::get('/orders-e-g/edit/{orderid}', 'OrdersController@orderEGEdit')->name('panel.adminer.order.e.g.edit');
        Route::post('/orders-e-g/update/{orderid}', 'OrdersController@orderEGUpdate')->name('panel.adminer.order.e.g.update');
        Route::DELETE('/orders/delete/{orderid}', 'OrdersController@orderDelete')->name('panel.adminer.order.delete');
    
        Route::get('/orders/{status?}', 'OrdersController@orders')->name('panel.adminer.orders');//////////////////////
        Route::get('/orders/edit/{orderid}', 'OrdersController@orderEdit')->name('panel.adminer.order.edit');
        Route::post('/orders/update/{orderid}', 'OrdersController@orderUpdate')->name('panel.adminer.order.update');
    });
    

    Route::middleware(['admin-bc'])->group(function() {
        //
        Route::get('/categories/{parent?}', 'CategoriesController@categories')->name('panel.adminer.categories');//////////////////////
        Route::get('/category/edit/{categoryid}', 'CategoriesController@categoryEdit')->name('panel.adminer.category.edit');
        Route::post('/category/update/{categoryid}', 'CategoriesController@categoryUpdate')->name('panel.adminer.categories.update.categoryid');
        Route::get('/category/add/{parentid?}', 'CategoriesController@categoryAdd')->name('panel.adminer.category.add');//////////////////////
        Route::post('/category/add/{parentid?}', 'CategoriesController@categoryAddPost')->name('panel.adminer.categories.add.post');
        Route::post('/categories/update', 'CategoriesController@categoriesUpdate')->name('panel.adminer.categories.update');
        Route::DELETE('/categories/{categoryid}', 'CategoriesController@categoryDelete')->name('panel.adminer.categories.delete');
    });

});