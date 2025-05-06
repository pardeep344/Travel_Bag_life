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
<form action="{{ isset($countryGroup) ? route('admin.countryshowcase.update', $countryGroup->id) : route('admin.countryshowcase.store') }}" method="post" enctype="multipart/form-data" class="form">
    @csrf
    @if(isset($countryGroup)) 
        @method('PUT')  <!-- This is crucial for updating data -->
    @endif
    <img id="imagePreview" src="{{ isset($countryGroup) && $countryGroup->image ? asset('storage/' . $countryGroup->image) : '#' }}" alt="Preview" style="display: {{ isset($countryGroup) && $countryGroup->image ? 'block' : 'none' }};" width="150">
    <input type="file" name="image" id="image" onchange="previewImage(event)" class="input-fileds">

    <label for="countryName" class="label-prop">Country Name:</label>
    <input type="text" name="countryName" id="countryName" class="input-fileds" placeholder="Enter your Title" value="{{ isset($countryGroup) ? $countryGroup->countryName : '' }}">

    <label for="url" class="label-prop">Country URL:</label>
    <input type="text" name="url" id="url" placeholder="Enter URL" class="input-fileds" value="{{ isset($countryGroup) ? $countryGroup->url : '' }}">

    <button class="admin-btn" type="submit">{{ isset($countryGroup) ? 'Update' : 'Create' }} Slider</button>
</form>
</div>
    <hr>
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>country</th>
            <th>url</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $countryGroups as $country)

            <tr>
            <td>{{$country->id}}</td>
            <td><img src="{{ asset('storage/' . $country->image) }}" width="100" alt="Image not foun"></td>
            <td>{{$country->countryName}}</td>
            <td>{{$country->url}}</td>
                <td>
                    <div class="action-cell">
                    <a href="{{route('admin.countryshowcase.edit',$country->id)}}" class="edit-btn">Edit</a>
                    <form action="{{ route('admin.countryshowcase.delete', $country->id) }}" method="POST"  onsubmit="return confirm('Are you sure you want to delete this?')">
                        @csrf
                        @method('DELETE') <!-- This will force the form to use DELETE method -->
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

 