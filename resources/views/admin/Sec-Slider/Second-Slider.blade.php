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
<form action="{{ isset($secSlider) ? route('admin.secSlider.update', $secSlider->id) : route('admin.secSlider.store') }}" method="post" enctype="multipart/form-data" class="form">
    @csrf
    <img id="imagePreview" src="{{ isset($secSlider) && $secSlider->image ? asset('storage/' . $secSlider->image) : '#' }}" alt="Preview" style="display: {{ isset($secSlider) && $secSlider->image ? 'block' : 'none' }};" width="150">
    <input type="file" name="image" id="image" class="input-fileds" onchange="previewImage(event)">
    <label for="title" class="label-prop">Title:</label>
    <input type="text" name="title" id="title" class="input-fileds" placeholder="Enter your Title" value="{{ isset($secSlider) ? $secSlider->title : '' }}">
    <label for="description" class="label-prop">Description:</label>
    <textarea name="description" id="description" class="input-fileds" placeholder="Enter the description">{{ isset($secSlider) ? $secSlider->description : '' }}</textarea>
    <label for="price" class="label-prop">Price:</label>
    <input type="text" name="price" id="price" class="input-fileds" placeholder="Enter price" value="{{ isset($secSlider) ? $secSlider->price : '' }}">
    <label for="rating" class="label-prop">Rating:</label>
    <input type="text" name="rating" id="rating" class="input-fileds" placeholder="Enter Rating" value="{{ isset($secSlider) ? $secSlider->rating : '' }}">
    <label for="duration" class="label-prop">Duration:</label>
    <input type="text" name="duration" id="duration" class="input-fileds" placeholder="Enter duration day" value="{{ isset($secSlider) ? $secSlider->duration : '' }}">

    <button type="submit" class="admin-btn">{{ isset($secSlider) ? 'Update' : 'Create' }} Slider</button>
</form>
</div>
<hr>

<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>title</th>
            <th>description</th>
            <th>price</th>
            <th>rating</th>
            <th>duration</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $secSliders as $secSlider)

            <tr>
            <td>{{$secSlider->id}}</td>
            <td><img src="{{ asset('storage/' . $secSlider->image) }}" width="100" alt="Slider Image"></td>
            <td>{{$secSlider->title}}</td>
            <td>{{$secSlider->description}}</td>
            <td>{{$secSlider->price}}</td>
            <td>{{$secSlider->rating}}</td>
            <td>{{$secSlider->duration}}</td>
                <td>
                    <div class="action-cell">
                    <a href="{{route('admin.secSlider.edit',$secSlider->id)}}" class="edit-btn">Edit</a>
                    <form action="{{route('admin.secSlider.delete', $secSlider->id) }}"  onclick="return confirm('Delete this banner?')">
                        <button type="submit">Delete</button>
                    </form>
                    </div>
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