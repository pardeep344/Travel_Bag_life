<?php

namespace App\Providers;

use App\Models\Aboutus;
use App\Models\Announcebar;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\country;
use App\Models\FooterEditContent;
use App\Models\FooterLink;
use App\Models\HotelBooking;
use App\Models\logoimg;
use App\Models\Navbarmenu;
use App\Models\Partner;
use App\Models\secSlider;
use App\Models\Slider;
use App\Models\SocialLink;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // Share AnnounceBar globally
    View::share('announce', Announcebar::first());

    // Share Logo globally
    View::share('logo', logoimg::first());

    // Share Navbar Menus globally
    View::share('menus', Navbarmenu::all());
    
    //Share Banner Img
    View::share('banners', Banner::all());

    // share Slider
    View::share('sliders', Slider::all());

    //countryCard
    View::share('countryGroups', country::all());

    //for blog
    View::share('blogs', Blog::all());

    //for hotel bookig
    View::share('bookingdetails', HotelBooking::all());

    //for about page
    View::share('aboutDatas', Aboutus::first());

    //for partner
    View::share('PartnerImages', Partner::all());

    //for sec-slider
    View::share('secSliders', secSlider::all());

    //for footer editable content
    View::share('footerSingleton', FooterEditContent::first());

    //for social link
    View::share('socialLinks',SocialLink::all());

        //for social link
        View::share('Footerlinks',FooterLink::all());
    }
}
