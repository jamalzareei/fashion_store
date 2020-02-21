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

Auth::routes();
Route::get('admin/logout', function(){
    auth()->logout();
})->name('log-out');


Route::group(['prefix' => 'admin'], function() {
    //
    Route::get('/login', 'AuthenticatinController@index')->name('admin');

    Route::post('/login', 'AuthenticatinController@login')->name('login.admin');
    
    Route::get('/test', function(){
        if(auth()->check()){
            return 'ok';
        }else{
            return 'no';
        }
    })->name('test');
});

Route::prefix("/admin")->middleware(['admin'])->namespace('Admin')->group(function(){
    // Route::prefix("/admin")->middleware(['admin'])->namespace('Admin')->group(function(){
    //
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::get('/users', 'UsersController@users')->name('admin.users');
    Route::post('/users/update', 'UsersController@usersUpdate')->name('admin.users.update');
    Route::post('/user/update/{id}', 'UsersController@userUpdate')->name('admin.user.update');
    Route::delete('/user/delete/{id}', 'UsersController@userDelete')->name('admin.user.delete');

    Route::get('/roles', 'UsersController@roles')->name('admin.roles');
    Route::post('/role/add', 'UsersController@roleAdd')->name('admin.user.add');
    Route::delete('/role/delete/{id}', 'UsersController@roleDelete')->name('admin.role.delete');

    Route::get('/categories/{parent_id?}', 'CategoriesController@categories')->name('panel.admin.categories');//////////////////////
    Route::get('/category/edit/{id}', 'CategoriesController@categoryEdit')->name('panel.admin.category.edit');
    Route::post('/category/update/{id}', 'CategoriesController@categoryUpdate')->name('panel.admin.categories.update.id');
    Route::get('/category/add/{parentid?}', 'CategoriesController@categoryAdd')->name('panel.admin.category.add');//////////////////////
    Route::post('/category/add/{parentid?}', 'CategoriesController@categoryAddPost')->name('panel.admin.categories.add.post');
    Route::post('/categories/update', 'CategoriesController@categoriesUpdate')->name('panel.admin.categories.update');
    Route::DELETE('/categories/{id}', 'CategoriesController@categoryDelete')->name('panel.admin.categories.delete');

    Route::get('/properties/{id?}', 'CategoriesController@properties')->name('panel.admin.properties');//////////////////////
    Route::post('/properties/update', 'CategoriesController@propertiesUpdate')->name('panel.admin.properties.update');
    Route::post('/properties/add/{category_id}', 'CategoriesController@propertiesAdd')->name('panel.admin.properties.add');
    Route::DELETE('/property/{property_id}', 'CategoriesController@propertyDelete')->name('panel.admin.property.delete');

});


/*


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
*/