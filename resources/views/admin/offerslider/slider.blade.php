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
        <form action="{{ isset($slider) ? route('admin.slider.update', $slider->id) : route('admin.slider.store') }}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            <img id="imagePreview" src="{{ isset($slider) && $slider->image ? asset('storage/' . $slider->image) : '#' }}" alt="Preview" style="display: {{ isset($slider) && $slider->image ? 'block' : 'none' }};" width="150">
            <input type="file" name="image" id="image" class="input-fileds" onchange="previewImage(event)">
            <label for="title" class="label-prop">Title:</label>
            <input type="text" name="title" id="title" class="input-fileds" placeholder="Enter your Title" value="{{ isset($slider) ? $slider->title : '' }}">
            <label for="description" class="label-prop">Description:</label>
            <textarea name="description" id="description" placeholder="Enter the description">{{ isset($slider) ? $slider->description : '' }}</textarea>
            <label for="price" class="label-prop">Price:</label>
            <input type="text" name="price" id="price" class="input-fileds" placeholder="Enter price" value="{{ isset($slider) ? $slider->price : '' }}">
            <label for="rating" class="label-prop">Rating:</label>
            <input type="text" name="rating" id="rating" class="input-fileds" placeholder="Enter Rating" value="{{ isset($slider) ? $slider->rating : '' }}">
            <label for="Duration" class="label-prop">Duration:</label>
            <input type="text" name="duration" id="duration" class="input-fileds" placeholder="Enter duration day" value="{{ isset($slider) ? $slider->duration : '' }}">

            <button type="submit" class="admin-btn">{{ isset($slider) ? 'Update' : 'Create' }}  Slider</button>
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
                @foreach ( $sliders as $slider)

                    <tr>
                    <td>{{$slider->id}}</td>
                    <td><img src="{{ asset('storage/' . $slider->image) }}" width="100" alt="Slider Image"></td>
                    <td>{{$slider->title}}</td>
                    <td>{{$slider->description}}</td>
                    <td>{{$slider->price}}</td>
                    <td>{{$slider->rating}}</td>
                    <td>{{$slider->duration}}</td>
                    <td >
                            <div class="action-cell">
                                <a href="{{route('admin.slider.edit',$slider->id)}}" class="edit-btn">Edit</a>
                            <form action="{{route('admin.slider.delete', $slider->id) }}" method="POST"  onsubmit="return confirm('Are you sure you want to delete this item?')">
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