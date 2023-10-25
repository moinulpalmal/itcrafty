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

/*Route::get('/', function () {
    return view('welcome');
});*/

   /* Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);*/

Auth::routes();
    Route::get('/', function () {
        return redirect()->route('home');
    })->middleware('auth')->name('start');



    //open for all logged in user
    Route::middleware('auth')->group(function (){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/home/profile', 'ProfileController@index')->name('home.profile');
        Route::get('/home/profile/change-password', 'ProfileController@changePassword')->name('home.profile.change-password');
        Route::post('/home/profile/update-password', 'ProfileController@updatePassword')->name('home.profile.update-password');

    });
    //open for all logged in user



    //administrative module
    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','restoreuser']] , function(){
        Route::get('user/historical','UserController@historicalUser')->name('user.historical');
    });


    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','createuser']] , function(){
        Route::post('user/save','UserController@saveUser')->name('user.save');
        Route::get('user/new','UserController@newUser')->name('user.new');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','updateuser']] , function(){
        Route::post('user/update','UserController@updateUser')->name('user.update');
        Route::get('user/edit/{id}','UserController@editUser')->name('user.edit');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','resetpassword']] , function(){
        Route::post('user/password/update','UserController@updatePassword')->name('user.password.update');
        Route::get('user/password/reset/{id}','UserController@resetPassword')->name('user.password.reset');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth']] , function(){
        Route::post('fabric-get-list','FabricController@getFabricList')->name('fabric-get-list');
        Route::post('buyer-season-get-list','BuyerSeasonController@getSeasonList')->name('buyer-season-get-list');
        Route::post('style-department-get-list','StyleDepartmentController@getStyleDepartmentList')->name('style-department-get-list');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator']] , function(){
        //dashboard
        //Route::get('home','AdminController@index')->name('home');

        Route::get('user/active','UserController@index')->name('user.active');
        Route::get('user/detail/{id}','UserController@detail')->name('user.detail');

        Route::delete('user/delete','UserController@softDelete')->name('user.delete');
        Route::delete('user/restore','UserController@restore')->name('user.restore');
        Route::delete('user/remove','UserController@fullDelete')->name('user.remove');
        Route::delete('user/access/block','UserController@blockAccess')->name('user.access.block');
        Route::delete('user/access/provide','UserController@provideAccess')->name('user.access.provide');

        //Route::delete('full-delete-user','UserController@fullDelete')->name('full-delete-user');
        //Route::get('user/master/{id}','UserController@master')->name('user.master');

        Route::delete('block-approval-access','UserController@blockApprovalAccess')->name('block-approval-access');
        Route::delete('user.provide-approval-access','UserController@provideApprovalAccess')->name('provide-approval-access');

        //user role management
        Route::post('user.apply-role', 'UserController@applyRole')->name('user.apply-role');

        //Route::get('user.apply-role/{role_id}/{user_id}', 'UserController@applyRole')->name('user.apply-role');
        //Route::get('user.delete-role/{role_id}/{user_id}', 'UserController@deleteRole')->name('user.delete-role');
        //user role management

        //role group
        Route::get('user/role','RoleController@index')->name('user.role');
        Route::post('user/role/save','RoleController@saveRole')->name('user.role.save');
        Route::post('user/role/edit','RoleController@updateRole')->name('user.role.edit');
        //role group

        //role task group
        Route::get('user/task','TaskController@index')->name('user.task');
        Route::post('user/task/save','TaskController@saveTask')->name('user.task.save');
        Route::post('user/task/edit','TaskController@updateTask')->name('user.task.edit');
        //role task group

    });
    //administrative module

//settings drop down list
    Route::group(['as' => 'settings.','prefix' => 'settings','namespace' => 'Settings'] , function(){
        Route::post('factory/setup/drop-down-list', 'FactoryController@getDropDownList')->name('factory.setup.drop-down-list');
        Route::post('factory/department-setup/drop-down-list', 'DepartmentController@getDropDownList')->name('factory.department-setup.drop-down-list');
        Route::post('designation/drop-down-list', 'DesignationController@getDropDownList')->name('designation.drop-down-list');
        Route::post('product/manufacturer/drop-down-list', 'ProductManufacturerController@getDropDownList')->name('product.manufacturer.drop-down-list');
        Route::post('product/vendor/drop-down-list', 'ProductVendorController@getDropDownList')->name('product.vendor.drop-down-list');
        Route::post('product/category/drop-down-list', 'ProductCategoryController@getDropDownList')->name('product.category.drop-down-list');
        Route::post('product/sub-category/drop-down-list', 'ProductSubCategoryController@getDropDownList')->name('product.sub-category.drop-down-list');
        Route::post('product/sub-category/drop-down-list-category', 'ProductSubCategoryController@getDropDownListByProductCategory')->name('product.sub-category.drop-down-list-category');
        Route::post('product/master/drop-down-list', 'ProductMasterController@getDropDownList')->name('product.master.drop-down-list');
        Route::post('employee/drop-down-list', 'CustomerController@getDropDownList')->name('employee.drop-down-list');

        Route::post('product/detail/get-warrant-detail', 'ProductDetailController@getWarrantyDetail')->name('product.detail.get-warrant-detail');

    });
// end settings drop down list

    Route::group(['as' => 'settings.','prefix' => 'settings','namespace' => 'Settings','middleware' => ['auth', 'settings']] , function(){
        Route::group(['middleware' => ['factory_department']] , function(){
            //factory setup
            Route::get('factory/setup', 'FactoryController@index')->name('factory.setup');
            Route::post('factory/setup/save', 'FactoryController@save')->name('factory.setup.save');
            Route::post('factory/setup/edit', 'FactoryController@edit')->name('factory.setup.edit');
            Route::delete('factory/setup/delete', 'FactoryController@delete')->name('factory.setup.delete');
            Route::delete('factory/setup/activate', 'FactoryController@activate')->name('factory.setup.activate');
            Route::delete('factory/setup/de-activate', 'FactoryController@deActivate')->name('factory.setup.de-activate');
            //factory setup

            //department setup
            Route::get('factory/department-setup', 'DepartmentController@index')->name('factory.department-setup');
            Route::post('factory/department-setup/save', 'DepartmentController@save')->name('factory.department-setup.save');
            Route::post('factory/department-setup/edit', 'DepartmentController@edit')->name('factory.department-setup.edit');
            Route::delete('factory/department-setup/delete', 'DepartmentController@delete')->name('factory.department-setup.delete');
            Route::delete('factory/department-setup/activate', 'DepartmentController@activate')->name('factory.department-setup.activate');
            Route::delete('factory/department-setup/de-activate', 'DepartmentController@deActivate')->name('factory.department-setup.de-activate');
            //department setup
        });

        Route::group(['middleware' => ['factory_it']] , function(){
            //factory it setup
            Route::get('factory/it-setup', 'FactoryItController@index')->name('factory.it-setup');
            Route::post('factory/it-setup/save', 'FactoryItController@save')->name('factory.it-setup.save');
            Route::post('factory/it-setup/edit', 'FactoryItController@edit')->name('factory.it-setup.edit');
            Route::delete('factory/it-setup/delete', 'FactoryItController@delete')->name('factory.it-setup.delete');
            Route::delete('factory/it-setup/activate', 'FactoryItController@activate')->name('factory.it-setup.activate');
            Route::delete('factory/it-setup/de-activate', 'FactoryItController@deActivate')->name('factory.it-setup.de-activate');
            //factory it setup
        });

        Route::group(['middleware' => ['designation']] , function(){
            //designation setup
            Route::get('designation', 'DesignationController@index')->name('designation');
            Route::post('designation/save', 'DesignationController@save')->name('designation.save');
            Route::post('designation/edit', 'DesignationController@edit')->name('designation.edit');
            Route::delete('designation/delete', 'DesignationController@delete')->name('designation.delete');
            Route::delete('designation/activate', 'DesignationController@activate')->name('designation.activate');
            Route::delete('designation/de-activate', 'DesignationController@deActivate')->name('designation.de-activate');
            //designation setup
        });

        Route::group(['middleware' => ['employee']] , function(){
            //employee setup
            Route::get('employee', 'CustomerController@index')->name('employee');
            Route::post('employee/save', 'CustomerController@save')->name('employee.save');
            Route::post('employee/edit', 'CustomerController@edit')->name('employee.edit');
            Route::post('employee/info-by-emp-id', 'CustomerController@editByEmpId')->name('employee.info-by-emp-id');
            Route::delete('employee/delete', 'CustomerController@delete')->name('employee.delete');
            Route::delete('employee/activate', 'CustomerController@activate')->name('employee.activate');
            Route::delete('employee/de-activate', 'CustomerController@deActivate')->name('employee.de-activate');
            //employee setup
        });

        Route::group(['middleware' => ['product']] , function(){

            Route::group(['middleware' => ['product_vendor']] , function(){
            //product vendor setup
                Route::get('product/vendor/setup', 'ProductVendorController@index')->name('product.vendor.setup');
                Route::post('product/vendor/setup/save', 'ProductVendorController@save')->name('product.vendor.setup.save');
                Route::post('product/vendor/setup/edit', 'ProductVendorController@edit')->name('product.vendor.setup.edit');
                Route::delete('product/vendor/setup/delete', 'ProductVendorController@delete')->name('product.vendor.setup.delete');
                Route::delete('product/vendor/setup/activate', 'ProductVendorController@activate')->name('product.vendor.setup.activate');
                Route::delete('product/vendor/setup/de-activate', 'ProductVendorController@deActivate')->name('product.vendor.setup.de-activate');
                //product vendor setup

                //product vendor person setup
                Route::get('product/vendor/person', 'ProductVendorPersonController@index')->name('product.vendor.person');
                Route::post('product/vendor/person/save', 'ProductVendorPersonController@save')->name('product.vendor.person.save');
                Route::post('product/vendor/person/edit', 'ProductVendorPersonController@edit')->name('product.vendor.person.edit');
                Route::delete('product/vendor/person/delete', 'ProductVendorPersonController@delete')->name('product.vendor.person.delete');
                Route::delete('product/vendor/person/activate', 'ProductVendorPersonController@activate')->name('product.vendor.person.activate');
                Route::delete('product/vendor/person/de-activate', 'ProductVendorPersonController@deActivate')->name('product.vendor.person.de-activate');
                //product vendor person setup

                //product manufacturer setup
                Route::get('product/manufacturer', 'ProductManufacturerController@index')->name('product.manufacturer');
                Route::post('product/manufacturer/save', 'ProductManufacturerController@save')->name('product.manufacturer.save');
                Route::post('product/manufacturer/edit', 'ProductManufacturerController@edit')->name('product.manufacturer.edit');
                Route::delete('product/manufacturer/delete', 'ProductManufacturerController@delete')->name('product.manufacturer.delete');
                Route::delete('product/manufacturer/activate', 'ProductManufacturerController@activate')->name('product.manufacturer.activate');
                Route::delete('product/manufacturer/de-activate', 'ProductManufacturerController@deActivate')->name('product.manufacturer.de-activate');
                //product manufacturer setup
            });


            Route::group(['middleware' => ['product_master']] , function(){
                //product category setup
                Route::get('product/category', 'ProductCategoryController@index')->name('product.category');
                Route::post('product/category/save', 'ProductCategoryController@save')->name('product.category.save');
                Route::post('product/category/edit', 'ProductCategoryController@edit')->name('product.category.edit');
                Route::delete('product/category/delete', 'ProductCategoryController@delete')->name('product.category.delete');
                Route::delete('product/category/activate', 'ProductCategoryController@activate')->name('product.category.activate');
                Route::delete('product/category/de-activate', 'ProductCategoryController@deActivate')->name('product.category.de-activate');
                //product category setup

                //product sub-category setup
                Route::get('product/sub-category', 'ProductSubCategoryController@index')->name('product.sub-category');
                Route::post('product/sub-category/save', 'ProductSubCategoryController@save')->name('product.sub-category.save');
                Route::post('product/sub-category/edit', 'ProductSubCategoryController@edit')->name('product.sub-category.edit');
                Route::delete('product/sub-category/delete', 'ProductSubCategoryController@delete')->name('product.sub-category.delete');
                Route::delete('product/sub-category/activate', 'ProductSubCategoryController@activate')->name('product.sub-category.activate');
                Route::delete('product/sub-category/de-activate', 'ProductSubCategoryController@deActivate')->name('product.sub-category.de-activate');
                //product sub-category setup

                //product master setup
                Route::get('product/master', 'ProductMasterController@index')->name('product.master');
                Route::post('product/master/save', 'ProductMasterController@save')->name('product.master.save');
                Route::post('product/master/edit', 'ProductMasterController@edit')->name('product.master.edit');
                Route::delete('product/master/delete', 'ProductMasterController@delete')->name('product.master.delete');
                Route::delete('product/master/activate', 'ProductMasterController@activate')->name('product.master.activate');
                Route::delete('product/master/de-activate', 'ProductMasterController@deActivate')->name('product.master.de-activate');
                //product master setup
            });
            Route::group(['middleware' => ['product_detail']] , function(){
                //product detail setup
                Route::get('product/detail', 'ProductDetailController@index')->name('product.detail');
                Route::post('product/detail/save', 'ProductDetailController@save')->name('product.detail.save');
                Route::post('product/detail/edit', 'ProductDetailController@edit')->name('product.detail.edit');
                Route::delete('product/detail/delete', 'ProductDetailController@delete')->name('product.detail.delete');
                Route::delete('product/detail/activate', 'ProductDetailController@activate')->name('product.detail.activate');
                Route::delete('product/detail/de-activate', 'ProductDetailController@deActivate')->name('product.detail.de-activate');
                //product sub-category setup
            });
        });

    });


Route::group(['as' => 'services.','prefix' => 'services','namespace' => 'Services','middleware' => ['auth', 'services']] , function(){

    Route::group(['middleware' => ['service_receive_desk']] , function(){
        Route::get('master/new', 'ServiceMasterController@new')->name('master.new');
        Route::post('master/save', 'ServiceMasterController@save')->name('master.save');
    });

    Route::group(['middleware' => ['service_delivery_desk']] , function(){

    });

    Route::group(['middleware' => ['service_team_leader']] , function(){
        Route::get('master/edit/{id}', 'ServiceMasterController@edit')->name('master.edit');
        Route::post('master/update', 'ServiceMasterController@update')->name('master.update');
        Route::delete('master/delete', 'ServiceMasterController@delete')->name('master.delete');
        Route::post('master/assign', 'ServiceMasterController@assign')->name('master.assign');

        Route::get('search/product', 'ServiceSearchController@searchProduct')->name('search.product');
        Route::post('search/product/result', 'ServiceSearchController@searchProductResult')->name('search.product.result');
        Route::get('search/factory', 'ServiceSearchController@searchFactory')->name('search.factory');
        Route::post('search/factory/result', 'ServiceSearchController@searchFactoryResult')->name('search.factory.result');
        Route::delete('master/proceed-without-warranty', 'ServiceMasterController@proceedWithoutWarranty')->name('master.proceed-without-warranty');
        Route::delete('master/solution/approve', 'ServiceMasterController@approveComplete')->name('master.solution.approve');

    });


    Route::group(['middleware' => ['service_person']] , function(){
        Route::get('master/detail/{id}', 'ServiceMasterController@detail')->name('master.detail');
        Route::get('master/queue', 'ServiceMasterController@queue')->name('master.queue');
        Route::get('master/assigned', 'ServiceMasterController@assigned')->name('master.assigned');
        Route::get('master/under-process', 'ServiceMasterController@underProcess')->name('master.under-process');

        Route::get('master/warranty-requested', 'ServiceMasterController@warrantyRequested')->name('master.warranty-requested');
   // Route::get('master/warranty-sent', 'ServiceMasterController@warrantyRequested')->name('master.warranty-sent');
        Route::get('master/warranty-received', 'ServiceMasterController@warrantyReceived')->name('master.warranty-received');
        Route::get('master/solved', 'ServiceMasterController@solved')->name('master.solved');
        Route::get('master/solved-approved', 'ServiceMasterController@solvedApproved')->name('master.solved-approved');
        Route::get('master/delivered', 'ServiceMasterController@delivered')->name('master.delivered');
        //warranty section
        Route::post('master/warranty/check/send', 'ServiceMasterController@sendWarrantyRequest')->name('master.warranty.check.send');
        //end warranty section
        Route::delete('master/generate-warranty-request', 'ServiceMasterController@generateWarrantyRequest')->name('master.generate-warranty-request');
       // Route::delete('master/receive-from-warranty', 'ServiceMasterController@receiveFromWarranty')->name('master.receive-from-warranty');
        Route::post('master/requisition-request/send', 'ServiceMasterController@sendRequisitionRequest')->name('master.requisition-request.send');
        Route::post('master/requisition/save', 'ServiceMasterController@addRequisitionInfo')->name('master.requisition.save');
        Route::post('master/requisition/reject-product', 'ServiceMasterController@rejectRequisitionProduct')->name('master.requisition.reject-product');
        Route::delete('master/make-under-process', 'ServiceMasterController@makeUnderProcess')->name('master.make-under-process');
        Route::delete('master/make-delivery', 'ServiceMasterController@deliveryComplete')->name('master.make-delivery');
        Route::post('master/solution/save', 'ServiceMasterController@serviceComplete')->name('master.solution.save');
        Route::post('master/solution/send', 'ServiceMasterController@serviceCompleteMail')->name('master.solution.send');
        Route::post('master/mac-binding/send', 'ServiceMasterController@macBindingMail')->name('master.mac-binding.send');

    });
});

Route::group(['as' => 'issue.','prefix' => 'issue','namespace' => 'Issue','middleware' => ['auth', 'issue']] , function(){
    Route::get('old/entry', 'IssueController@oldEntry')->name('old.entry');
    Route::post('old/entry/save', 'IssueController@oldEntrySave')->name('old.entry.save');
    Route::get('old/list', 'IssueController@oldList')->name('old.list');
    Route::post('old/list/edit', 'IssueController@returnEdit')->name('old.list.edit');
});

Route::group(['as' => 'purchase.','prefix' => 'purchase','namespace' => 'Purchase','middleware' => ['auth', 'purchase']] , function(){
    Route::get('product/new', 'ProductDetailController@new')->name('product.new');
    Route::post('product/save', 'ProductDetailController@save')->name('product.save');
    Route::get('product/search', 'ProductDetailController@search')->name('product.search');
    Route::post('product/search/result', 'ProductDetailController@searchResult')->name('product.search.result');
    Route::get('product/search-sl-no', 'ProductDetailController@searchSLNo')->name('product.search-sl-no');
    Route::post('product/search-sl-no/result', 'ProductDetailController@searchSlNoResult')->name('product.search-sl-no.result');

    Route::get('product/edit/{id}', 'ProductDetailController@edit')->name('product.edit');
    Route::post('product/update', 'ProductDetailController@update')->name('product.update');

    Route::get('warranty/service-requested', 'PurchaseWarrantyController@warrantyRequestedFromService')->name('warranty.service-requested');
    Route::delete('warranty/service-requested/generate', 'PurchaseWarrantyController@generateWarrantyRequest')->name('warranty.service-requested.generate');
    Route::delete('warranty/service-requested/reject-no-warranty', 'PurchaseWarrantyController@rejectNoWarranty')->name('warranty.service-requested.reject-no-warranty');
    Route::delete('warranty/service-requested/invalid-product', 'PurchaseWarrantyController@invalidProduct')->name('warranty.service-requested.invalid-product');
    Route::delete('warranty/service-requested/warranty-void', 'PurchaseWarrantyController@warrantyVoid')->name('warranty.service-requested.warranty-void');

    Route::get('requisition/service-requested', 'PurchaseRequisitionController@warrantyRequestedFromService')->name('requisition.service-requested');
    Route::delete('requisition/service-requested/receive-product', 'PurchaseRequisitionController@receiveProduct')->name('requisition.service-requested.receive-product');
    Route::delete('requisition/service-requested/cancel', 'PurchaseRequisitionController@cancelRequisition')->name('requisition.service-requested.cancel');



    Route::get('warranty/requested', 'PurchaseWarrantyController@warrantyRequested')->name('warranty.requested');
    Route::get('warranty/mail-sent', 'PurchaseWarrantyController@warrantySentMail')->name('warranty.mail-sent');
    Route::get('warranty/product-sent', 'PurchaseWarrantyController@productSent')->name('warranty.product-sent');
    Route::get('warranty/product-received', 'PurchaseWarrantyController@receivedFromVendor')->name('warranty.product-received');
    Route::get('warranty/product-sent-service', 'PurchaseWarrantyController@sentToService')->name('warranty.product-sent-service');
    Route::get('warranty/canceled', 'PurchaseWarrantyController@canceled')->name('warranty.canceled');
    //Route::get('warranty/receive-vendor', 'PurchaseWarrantyController@warrantySentMail')->name('warranty.sent-vendor');
    Route::get('warranty/detail/{id}', 'PurchaseWarrantyController@detail')->name('warranty.detail');

    Route::post('warranty/detail/assign-vendor', 'PurchaseWarrantyController@assignVendor')->name('warranty.detail.assign-vendor');
    Route::post('warranty/detail/send-warranty-mail', 'PurchaseWarrantyController@sendWarrantyRequest')->name('warranty.detail.send-warranty-mail');
    Route::delete('warranty/detail/send-product-vendor', 'PurchaseWarrantyController@sendProductForWarranty')->name('warranty.detail.send-product-vendor');
    Route::delete('warranty/detail/receive-product-vendor', 'PurchaseWarrantyController@receiveProductFromWarranty')->name('warranty.detail.receive-product-vendor');
    Route::delete('warranty/detail/send-product-service', 'PurchaseWarrantyController@sendProductToService')->name('warranty.detail.send-product-service');
    Route::delete('warranty/detail/cancel-request', 'PurchaseWarrantyController@cancelWarrantyRequest')->name('warranty.detail.cancel-request');
});



/*Route::get('/home', 'HomeController@index')->name('home');
    Auth::routes();
    Route::get('/', function () {
        return view('home');
    })-*/
