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
<form action="{{ isset($social) ? route( 'admin.socialLink.update', $social->id) : route( 'admin.socialLink.store') }}" method="post" enctype="multipart/form-data" class="form">
    @csrf
    <img id="imagePreview" src="{{ isset($social) && $social->Image ? asset('storage/' . $social->Image) : '#' }}" alt="Preview" style="display: {{ isset($social) && $social->Image ? 'block' : 'none' }};" width="150">
    <input type="file" name="Image" id="Image" class="input-fileds" onchange="previewImage(event)">
    <label for="Url" class="label-prop">Title:</label>
    <input type="text" name="Url" id="Url" class="input-fileds" placeholder="Enter your Url" value="{{ isset($social) ? $social->Url : '' }}">
    <button type="submit" class="admin-btn">{{ isset($social) ? 'Update' : 'Create' }} Add</button>
</form>
</div>
<hr>

<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>Url</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $socialLinks as $socialLink)

            <tr>
            <td>{{$socialLink->id}}</td>
            <td><img src="{{ asset('storage/' . $socialLink->Image) }}" width="100" alt="Slider Image"></td>
            <td>{{$socialLink->Url}}</td>
                <td>
                    <div class="action-cell">
                    <a href="{{route('admin.socialLink.edit',$socialLink->id)}}" class="edit-btn">Edit</a>
                     
                    <form action="{{route('admin.socialLink.delete', $socialLink->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
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