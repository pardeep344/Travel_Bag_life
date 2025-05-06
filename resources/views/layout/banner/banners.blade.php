
<div class="banner-container">
    <button id="bannerPrevBtn" class="banner-btn">❮</button>
    @isset($banners)
    @foreach ($banners as $banner )

    <div class="banner-div">
        <a href="{{$banner->url}}"><img src="{{'storage/' .$banner->image}}" alt="image not found"></a>
    </div>
    
    @endforeach
        
    @endisset
    <button id="bannerNextBtn" class="banner-btn">❯</button>
  </div>