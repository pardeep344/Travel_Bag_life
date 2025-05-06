@extends('admin.index')

@section('content')
<!-- Display error message for image -->
@if($errors->has('bannerimg'))
<div style="color: red;">
    <strong>{{ $errors->first('bannerimg') }}</strong>
</div>
@endif
<div class="container">
<form action="{{ isset($banner) ? route('admin.banner.update', $banner->id)  : route('banner.store') }}" method="POST" enctype="multipart/form-data" class="form">
    @csrf
    <img id="imagePreview" src="{{isset($banner) && $banner->image ? asset('storage/' .$banner->image) : '#'}}" alt="Preview" style="display: {{ isset($banner) && $banner->image ? 'block' : 'none' }};" width="150">
    <input type="file" name="bannerimg" id="bannerimg" onchange="previewImage(event)" class="input-fileds">
     
    <input type="text" name="url" placeholder="Enter URL (optional)" class="input-fileds" value="{{ isset($banner) ? $banner->url : '' }}">
    <button type="submit" class="admin-btn">Upload</button>
</form>
</div>
<hr>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>URL</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($banners as $banner)
            <tr>
                <td>{{ $banner->id }}</td>
                <td><img src="{{ asset('storage/' .$banner->image) }}" width="150"></td>
                <td><a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a></td>
                <td >
                    <div class="action-cell">
                    <a href="{{ route('admin.banner.edit', $banner->id) }}" class="edit-btn">Edit</a> 
                
                    <form action="{{ route('banner.delete', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                        @csrf
                        @method('DELETE')
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