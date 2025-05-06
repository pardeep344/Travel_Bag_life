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
    <div style="color: green">{{ session('success') }}</div>
@endif
<div class="container">
    <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <img id="imagePreview" src="#" alt="Preview not available" width="200" height="200" style="display: none;">
        <input type="file" name="image" id="image" placeholder="select img" class="input-fileds" onchange="previewImage(event)">
        <button type="submit" class="admin-btn">Upload</button>
    </form>
</div>  

 



<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($images as $image)

            <tr>
                <td>{{ $image->id }}</td>
                <td><img src="{{ asset('storage/' . $image->image) }}" width="100"></td>
                <td>
                    <div class="action-cell">
                    <form action="{{ route('admin.partner.destroy', $image->id) }}" method="POST" onclick="return confirm('Are you sure?')" >
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