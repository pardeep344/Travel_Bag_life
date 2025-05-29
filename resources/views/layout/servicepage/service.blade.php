 
<div class="page-title"><span>Family </span> Packs</div>
<div class="service-container">
  
    @foreach ( $bookingdetails as $bookingdetail)
    <div class="service-card">
        <div class="service-card-img"><a href="#"><img src="{{ asset('storage/' .$bookingdetail->image) }}" alt="not found" class="blog_img" loading="eager"></a></div>
        <div class="service-card-context">
            <div class="service-card-parha"><p>{{$bookingdetail->placeName}}</p></div>
            <div class="service-card-location"><p>Location: {{$bookingdetail->location}}</p></div>
            <div class="service-card-member"><p>Member: {{$bookingdetail->member}}</p></div>
            <div class="service-card-price"><p>Price: {{$bookingdetail->price}}</p></div>
            <div class="service-card-duration"><p>Duration: {{$bookingdetail->duration}}</p></div>
            <div class="service-card-rating card-rating"><p>Rating: {{$bookingdetail->rating}}</p>   <img src="{{asset('images/star.png')}}" alt="no img" class="rating-icon"></div>
            
            <div><input type="button" value="view" class="blog-btn"></div>
        </div>
    </div>
    
    @endforeach

     
</div>