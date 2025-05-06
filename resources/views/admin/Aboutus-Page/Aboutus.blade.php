@extends('admin.index')
@section('content')

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ( $errors->all() as $error)
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
    <form action="{{ route('admin.aboutus.save') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        
        <img id="imagePreview"
             src="{{ isset($aboutData) && $aboutData->image ? asset('storage/' . $aboutData->image) : '#' }}"
             style="display: {{ isset($aboutData) && $aboutData->image ? 'block' : 'none' }};"
             width="150" alt="">

        
        <input type="file" name="image" id="image" onchange="previewImage(event)" class="input-fileds">

         
        <label for="text" class="label-prop">Text</label>
        <input type="text" name="text" id="text" placeholder="Enter text"
               value="{{ $aboutData->text ?? '' }}" class="input-fileds">
 
        <button type="submit" class="admin-btn">{{ isset($aboutData) ? 'Update' : 'Create' }}</button>
    </form>
</div>

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
