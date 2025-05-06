@extends('admin.index')

@section('content')
<div style="color: green">
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
</div>
<div class="container">
<form action="{{ route('admin.footerEditable.StoreUpdate') }}" method="post" enctype="multipart/form-data" class="form">
    @csrf

    <label for="Image" class="label-prop">Select Image</label><br>

    <img id="image-preview" 
        src="{{ isset($footer) && $footer->Image ? asset('storage/' . $footer->Image) : '' }}" 
        alt="Current Image" 
        style="max-height: 100px; display: {{ isset($footer) && $footer->Image ? 'block' : 'none' }};">

    <input type="file" name="Image" id="Image" class="input-fileds">

    <label for="Text" class="label-prop">Add Text</label>
    <input type="text" name="Text" id="Text" placeholder="Enter Text Here"
           value="{{ old('Text', $footer->Text ?? '') }}" class="input-fileds">

    <label for="TelPhone" class="label-prop">Add Tel Phone No</label>
    <input type="text" name="TelPhone" id="TelPhone" placeholder="Enter TelPhone Here"
           value="{{ old('TelPhone', $footer->TelPhone ?? '') }}" class="input-fileds">

    <label for="Phone" class="label-prop">Add Phone No</label>
    <input type="text" name="Phone" id="Phone" placeholder="Enter Phone Here"
           value="{{ old('Phone', $footer->Phone ?? '') }}" class="input-fileds">

    <label for="Email" class="label-prop">Add Email</label>
    <input type="text" name="Email" id="Email" placeholder="Enter Email Here"
           value="{{ old('Email', $footer->Email ?? '') }}" class="input-fileds">

    <label for="Copyright" class="label-prop">Add Copyright</label>
    <input type="text" name="Copyright" id="Copyright" placeholder="Enter Copyright Here"
           value="{{ old('Copyright', $footer->Copyright ?? '') }}" class="input-fileds">

    <button type="submit" class="admin-btn">
        {{ isset($footer) ? 'Update' : 'Create' }}
    </button>
</form>
</div>
<script>
    document.getElementById('Image').addEventListener('change', function(event){
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the preview
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
