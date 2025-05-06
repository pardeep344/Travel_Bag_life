<?php

use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AdminHeaderController;
use App\Http\Controllers\AnnouncebarController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FooterEditableController;
use App\Http\Controllers\FooterLinkController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\NavbarController;

use App\Http\Controllers\PartnerController;
use App\Http\Controllers\SecSliderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SocialLinkController;
use App\Models\Partner;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('welcome');
});

// for admin routes
Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('admin/banner',[BannerController::class,'index'])->name('admin.banner');

// for announbar
Route::get('/admin/announcebar', [AnnouncebarController::class, 'edit'])->name('admin.announcebar');
Route::post('/admin/announcebar', [AnnouncebarController::class, 'update'])->name('admin.announcebar.update');

//for navbar
Route::get('/admin/navbar',[NavbarController::class,'index'])->name('admin.navbar');
Route::post('/navbar/logo',[NavbarController::class,'updatelogo'])->name('navbar.logo');
Route::post('/navbar/menu', [NavbarController::class, 'store'])->name('navbar.create');
Route::post('/navbar/menu/{id}',[NavbarController::class,'update'])->name('navbar.update');
Route::get('/navbar/edit/{id}',[NavbarController::class,'edit'])->name('navbar.edit');
Route::delete('/navbar/destroy/{id}',[NavbarController::class,'destroy'])->name('navbar.destroy');

// for banner routes
Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin.banner');
Route::post('/admin/banner', [BannerController::class, 'store'])->name('banner.store');
Route::delete('/admin/banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');
Route::get('/admin/banner/edit/{id}', [BannerController::class, 'edit'])->name('admin.banner.edit');
Route::post('/admin/banner/update/{id}', [BannerController::class, 'update'])->name('admin.banner.update');

// slider route
Route::get('/admin/slider',[SliderController::class,'index'])->name('admin.slider.index');
Route::post('/admin/slider',[SliderController::class,'store'])->name('admin.slider.store');
Route::post('/admin/slider/update{id}',[SliderController::class,'update'])->name('admin.slider.update');
Route::get('/admin/slider/edit{id}',[SliderController::class,'edit'])->name('admin.slider.edit');
Route::delete('/admin/slider/delete{id}',[SliderController::class,'destroy'])->name('admin.slider.delete');

//country cards
Route::get('/admin/countryshowcase',[CountryController::class,'index'])->name('admin.countryshowcase');
Route::post('/admin/countryshowcase',[CountryController::class,'store'])->name('admin.countryshowcase.store');
Route::put('/admin/countryshowcase{id}',[CountryController::class,'update'])->name('admin.countryshowcase.update');
Route::get('/admin/countryshowcase{id}',[CountryController::class,'edit'])->name('admin.countryshowcase.edit');
Route::delete('/admin/countryshowcase{id}',[CountryController::class,'delete'])->name('admin.countryshowcase.delete');

//route for blog
Route::get('/admin/blog',[BlogController::class,'index'])->name('admin.blog');
Route::post('/admin/blog',[BlogController::class,'store'])->name('admin.blog.store');
Route::put('/admin/blog/{id}',[BlogController::class,'update'])->name('admin.blog.update');
Route::get('/admin/blog/{id}/edit',[BlogController::class,'edit'])->name('admin.blog.edit');
Route::delete('/admin/blog/{id}',[BlogController::class,'delete'])->name('admin.blog.delete');

//route for hotel booking
Route::get('/admin/hotel',[HotelBookingController::class,'index'])->name('admin.hotel');
Route::post('/admin/hotel/store',[HotelBookingController::class,'store'])->name('admin.hotel.store');
Route::put('/admin/hotel/{id}/update',[HotelBookingController::class,'update'])->name('admin.hotel.update');
Route::get('/admin/hotel/{id}/edit',[HotelBookingController::class,'edit'])->name('admin.hotel.edit');
Route::delete('/admin/hotel/{id}/delete',[HotelBookingController::class,'delete'])->name('admin.hotel.delete');

//route for about page
Route::get('/admin/about', [AboutusController::class, 'index'])->name('admin.aboutus');
Route::post('/admin/about', [AboutusController::class, 'storeOrUpdate'])->name('admin.aboutus.save');

//for partner page
Route::get('admin/partner', [PartnerController::class, 'index'])->name('admin.partner.index');
Route::post('admin/partner', [PartnerController::class, 'store'])->name(name: 'admin.partner.store');
Route::delete('admin/partner/{id}', [PartnerController::class, 'destroy'])->name('admin.partner.destroy');

//for sec-slider
Route::get('/admin/secSlider',[SecSliderController::class,'index'])->name('admin.secSlider.index');
Route::post('/admin/secSlider',[SecSliderController::class,'store'])->name('admin.secSlider.store');
Route::post('/admin/secSlider/update{id}',[SecSliderController::class,'update'])->name('admin.secSlider.update');
Route::get('/admin/secSlider/edit{id}',[SecSliderController::class,'edit'])->name('admin.secSlider.edit');
Route::get('/admin/secSlider/delete{id}',[SecSliderController::class,'delete'])->name('admin.secSlider.delete');

//for footer eaditable content
Route::get('/admin/Editable',[FooterEditableController::class,'index'])->name('admin.footerEditable.index');
Route::post('/admin/Editable/StoreUpdate',[FooterEditableController::class,'StoreUpdate'])->name('admin.footerEditable.StoreUpdate');

//for social link
Route::get('/admin/socialLink/index/',[SocialLinkController::class,'index'])->name('admin.socialLink.index');
Route::post('/admin/socialLink/store/',[SocialLinkController::class,'store'])->name(name: 'admin.socialLink.store');
Route::post('/admin/socialLink/update{id}/',[SocialLinkController::class,'update'])->name(name: 'admin.socialLink.update');
Route::get('/admin/socialLink/edit{id}/',[SocialLinkController::class,'edit'])->name('admin.socialLink.edit');
Route::delete('/admin/socialLink/delete{id}/',[SocialLinkController::class,'delete'])->name(name: 'admin.socialLink.delete');

//for footer link 
  Route::get('footerLinks/index/', [FooterLinkController::class, 'index'])->name('admin.footerLinks.index');
  Route::post('footerLinks/store/', [FooterLinkController::class, 'store'])->name('admin.footerLinks.store');
  Route::get('footerLinks/{id}/edit/', [FooterLinkController::class, 'edit'])->name('admin.footerLinks.edit');
  Route::put('footerLinks/{id}/', [FooterLinkController::class, 'update'])->name('admin.footerLinks.update');
  Route::delete('footerLinks/{id}/', [FooterLinkController::class, 'destroy'])->name('admin.footerLinks.destroy');


