@if(isset($announce) && !empty($announce))
 
<div class="annoucebar-container">
    <div class="annouce-child-div">
        <img src="{{ asset('images/smartphone.png') }}" alt="img not found" width="20px" height="20px">
        <p>{{ $announce->phoneno ?? 'No phone number' }}</p>
    </div>
    <div class="annouce-child-div">
        <p>{{ $announce->text ?? 'No text available' }}</p>
    </div>
    <div class="annouce-child-div">
        <img src="{{ asset('images/location-pin.png') }}" alt="img not found" width="20px" height="20px">
        <p>{{ $announce->address ?? 'No address' }}</p>
    </div>
</div>
@else
    <p>No announcements available.</p>
@endif
