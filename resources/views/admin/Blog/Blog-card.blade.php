@extends('admin.index')

@section('content')

 
  @if ($errors->any())
    <div style="color: red">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div> 
  @endif
  <div class="container">
  <form action="{{ isset($blog) ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}" class="form" method="post" enctype="multipart/form-data">
    @csrf
    @method(isset($blog) ? 'PUT' : 'POST') <!-- Use PUT for editing, POST for new entries -->

    <!-- Image Preview for New and Edit -->
    <div>
      <label for="image" class="label-prop">Select Image:</label><br>
      @if(isset($blog) && $blog->image)
        <!-- If blog image exists, display it for editing -->
        <img id="imagePreview" src="{{ asset('storage/' . $blog->image) }}" alt="Preview" width="150" height="100px" style="display: block; margin-bottom: 10px;">
      @else
        <!-- If no image exists (during creation), hide the preview initially -->
        <img id="imagePreview" src="#" alt="No image" style="display: none; margin-bottom: 10px;" width="100px" height="100px">
      @endif
      
      <!-- Image Input -->
      <input type="file" name="image" id="image" onchange="previewImage(event)" class="input-fileds"><br>
    </div>

    <!-- Description -->
    <div>
      <label for="description" class="label-prop">Add Description:</label><br>
      <input type="text" name="description" id="description" class="input-fileds" value="{{ old('description', $blog->description ?? '') }}" placeholder="Enter description">
    </div>

    <!-- Publish Date -->
    <div>
      <label for="publishDate" class="label-prop">Pick Date:</label><br>
      <input type="date" name="publishDate" id="publishDate" class="input-fileds" value="{{ old('publishDate', $blog->publishDate ?? '') }}">
    </div>

    <button type="submit" class="admin-btn">{{ isset($blog) ? 'Update' : 'Add' }} Card</button>
  </form>
  </div>
  

  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Description</th>
        <th>Publish Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($blogs as $blog)
      <tr>
        <td>{{ $blog->id }}</td>
        <td><img src="{{ asset('storage/' . $blog->image) }}" alt="Image not found" width="100px" height="100px"></td>
        <td>{{ $blog->description }}</td>
        <td>{{ $blog->publishDate }}</td>
        <td>
          <div class="action-cell">
          <a href="{{ route('admin.blog.edit', $blog->id) }}" class="edit-btn">Edit</a>
          <form action="{{ route('admin.blog.delete', $blog->id) }}" method="post">
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
  // Image preview function
  function previewImage(event) {
    const input = event.target;
    const imagePreview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
      const fileURL = URL.createObjectURL(input.files[0]);
      imagePreview.src = fileURL;
      imagePreview.style.display = 'block'; // Show the preview image
    }
  }
</script>

@endsection
