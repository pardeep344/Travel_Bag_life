<div class="page-title"><span>About </span> Us</div>
@if(isset($aboutDatas) && !empty($aboutDatas))
    <div class="ab-container">
        <div class="text-style">
        <p>{{ $aboutDatas->text ?? 'No text available' }}</p>
            <button class="blog-btn">Conact For More</button>
        </div>
        <div class="ab-img">
            @if($aboutDatas->image)
                <a href="#">
                    <img src="{{ asset('storage/' . $aboutDatas->image) }}" alt="not found" class="ab-left-img" loading="eager">
                </a>
            @else
                <p>No image available.</p>
            @endif
        </div>
    </div>
@else
    <p>No about content available.</p>
@endif


<div class="page-title"><span>our </span> partners</div>
<div class="sponser-tag">
    @foreach($PartnerImages as $partner)
    <div class="tag-img-div"><a href="#"><img src="{{asset('storage/' .$partner->image)}}" alt="not found" class="partner-tag"></a></div>
    @endforeach
</div>
 
<div class="page-title"><span>Spacial For</span> Couple</div>
<div class="parent-container">
    
    <div class="slider-container">
        
        <button id="prevBtn" class="slider-btn">❮</button>
        <div class="slider flex clone-enabled">
            
            @foreach ($secSliders as $secSlider)
                <div class="slide">
                    <div><a href=""><img src="{{ asset('storage/' . $secSlider->image) }}" alt="img not found" class="slide-imgs" loading="eager"></a></div>
                    <div class="card-title"><p>Name: {{ $secSlider->title }}</p></div>
                    <div class="card-description"><p>Description: {{ $secSlider->description }}</p></div>
                    <div class="card-price"><p>Price: {{ $secSlider->price }}</p></div>
                    <div class="card-duration"><p>Duration: {{ $secSlider->duration }}</p></div>
                    <div class="card-rating"><p>{{ $secSlider->rating }}</p><img src="{{asset('images/star.png')}}" alt="no img" class="rating-icon"></div>
                    <div><button class="btn btn-primary">Book Now</button></div>
                </div>
            @endforeach
        </div>
        
        <button id="nextBtn" class="slider-btn">❯</button>
    </div>
    
</div>
 
    