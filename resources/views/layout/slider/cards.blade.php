<div class="page-title"><span>Summer</span>Offers</div>
<div class="parent-container">
    
    <div class="slider-container">
       
        <button id="prevBtn" class="slider-btn">❮</button>
        <div class="slider flex clone-enabled"> <!-- this one will be cloned -->
            @foreach ($sliders as $slider)
                <div class="slide">
                    <div><a href=""><img src="{{ asset('storage/' . $slider->image) }}" alt="img not found" class="slide-imgs"></a></div>
                    <div class="card-title"><p>{{ $slider->title }}</p></div>
                    <div class="card-description"><p>{{ $slider->description }}</p></div>
                    <div class="card-price"><p>Price: {{ $slider->price }}</p></div>
                    <div class="card-duration"><p>Duration: {{ $slider->duration }} Days</p></div>
                    <div class="card-rating"><p>{{ $slider->rating }}</p><img src="{{asset('images/star.png')}}" alt="no img" class="rating-icon"></div>
                    <div><button class="btn btn-primary">Book Now</button></div>
                </div>
            @endforeach
        </div>
        
        <button id="nextBtn" class="slider-btn">❯</button>
    </div>
    
</div>

 
