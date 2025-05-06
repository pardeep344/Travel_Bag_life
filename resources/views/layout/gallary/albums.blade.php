
<div class="page-title"><span>Country we </span> Preferred</div>
<div class="album-container">
    
  <div class="gallery">
    @foreach ($countryGroups as $countryGroup)
      <div class="gallery-item">
        <a href="{{ $countryGroup->url }}" class="gallery-item">
          <img src="{{ asset('storage/' . $countryGroup->image) }}" alt="{{ $countryGroup->countryName }}">
          <p class="caption">{{ $countryGroup->countryName }}</p>
        </a>
      </div>
    @endforeach
  </div>
  
  
</div>