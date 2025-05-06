@extends('admin.index')

@section('content')


    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
<div style="color: green;">
{{ session('success') }}
</div>
@endif
<div class="container">
<form action="{{ isset($hoteldetail) ? route('admin.hotel.update', $hoteldetail->id) : route('admin.hotel.store') }}" class="form" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($hoteldetail))
    @method('PUT')
@endif
    <img id="imagePreview" src="{{ isset($hoteldetail) && $hoteldetail->image ? asset('storage/' . $hoteldetail->image) : '#' }}" alt="Preview" style="display: {{ isset($hoteldetail) && $hoteldetail->image ? 'block' : 'none' }};" width="150">
    <input type="file" name="image" id="image" class="input-fileds" onchange="previewImage(event)">
    <label for="placeName" class="label-prop">Name:</label>
    <input type="text" name="placeName" id="placeName" class="input-fileds" placeholder="Enter your Title" value="{{ isset($hoteldetail) ? $hoteldetail->placeName : '' }}">
    <label for="location" class="label-prop">Location:</label>
    <input type="text" name="location" id="location" class="input-fileds" placeholder="Enter price" value="{{ isset($hoteldetail) ? $hoteldetail->location : '' }}">
    <label for="member" class="label-prop">Member:</label>
    <input type="text" name="member" id="member" class="input-fileds" placeholder="Enter No Of Member" value="{{ isset($hoteldetail) ? $hoteldetail->member: '' }}">
    <label for="rating" class="label-prop">Rating:</label>
    <input type="text" name="rating" id="rating" class="input-fileds" placeholder="Enter rating" value="{{ isset($hoteldetail) ? $hoteldetail->rating : '' }}">
    <label for="price" class="label-prop">Price:</label>
    <input type="text" name="price" id="price" class="input-fileds" placeholder="Enter Price" value="{{ isset($hoteldetail) ? $hoteldetail->price : '' }}">
    <label for="duration" class="label-prop">Duration:</label>
    <input type="text" name="duration" id="duration" class="input-fileds" placeholder="Enter Duration" value="{{ isset($hoteldetail) ? $hoteldetail->duration : '' }}">

    <button type="submit" class="admin-btn">{{ isset($hoteldetail) ? 'Update' : 'Create' }} add hotel</button>
</form>
</div>
<hr>
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>placeName</th>
            <th>location</th>
            <th>member</th>
            <th>rating</th>
            <th>price</th>
            <th>duration</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $bookingdetails as $bookingdetail)

            <tr>
            <td>{{$bookingdetail->id}}</td>
            <td><img src="{{ asset('storage/' . $bookingdetail->image) }}" width="100" alt="Slider Image"></td>
            <td>{{$bookingdetail->placeName}}</td>
            <td>{{$bookingdetail->location}}</td>
            <td>{{$bookingdetail->member}}</td>
            <td>{{$bookingdetail->rating}}</td>
            <td>{{$bookingdetail->price}}</td>
            <td>{{$bookingdetail->duration}}</td>
             
                <td>
                    <div class="action-cell">
                    <a href="{{route('admin.hotel.edit',$bookingdetail->id)}}" class="edit-btn">Edit</a>
                    <form action="{{ route('admin.hotel.delete', $bookingdetail->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this hotel?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                 </td>
            </tr>
        @endforeach
    </tbody>
</table>
 
<script>
function previewImage(event) {
const input = event.target;
const imagePreview = document.getElementById('imagePreview');

if (input.files && input.files[0]) {
    const fileURL = URL.createObjectURL(input.files[0]);
    imagePreview.src = fileURL;
    imagePreview.style.display = 'block';
}
}
</script>

@endsection