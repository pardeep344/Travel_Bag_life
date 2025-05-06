@extends('admin.index')

@section('content')

<h1>Navbar</h1>
{{-- Success Message --}}
@if(session('success'))
<div style="color: green;">
    {{ session('success') }}
</div>
@endif

{{-- Validation Errors --}}
@if($errors->any())
<div style="color: red;">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <form action="{{ route('navbar.logo') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        @method('POST')
    
        <div>
            <img id="imagePreview" src="{{asset('storage/' .$logo->logoimg)}}" alt="Preview" width="150">
            <input type="file" name="logo" id="logo" class="input-fileds" onchange="previewImage(event)" ><br>
        </div>
        
        <button type="submit" class="admin-btn">Update Logo</button>
    </form>
    <h1>{{ isset($menu) ? 'Edit Menu Item' : 'Add Menu Item' }}</h1>
    {{-- Add / Edit Form --}}
    <form action="{{ isset($menu) ? route('navbar.update', $menu->id) : route('navbar.create') }}" method="POST" class="form">
        @csrf
        <div>
            <label for="name" class="label-prop">Name:</label>
            <input type="text" name="name"id="name" class="input-fileds" value="{{ old('name', $menu->name ?? '') }}" required>
        </div>

        <div>
            <label for="url" class="label-prop">URL:</label><br>
            <input type="text" name="url" id="url" class="input-fileds" value="{{ old('url', $menu->url ?? '') }}" required>
        </div>

        <button type="submit" class="admin-btn">{{ isset($menu) ? 'Update' : 'Add' }}</button>

        @if(isset($menu))
            <a href="{{ route('admin.navbar') }}">Cancel Edit</a>
        @endif
        
    </form>
</div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td><a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></td>
                    <td>
                        <div class="action-cell">
                        <a href="{{ route('navbar.edit', $item->id) }}" class="edit-btn">Edit</a> 
                    
                        <form action="{{ route('navbar.destroy', $item->id) }}" method="POST"   onsubmit="return confirm('Are you sure you want to delete this item?')">
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

@endsection
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