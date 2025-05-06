<form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <p>edit Current Image:</p>
    <img id="imagePreview" src="{{ asset($banner->image) }}" width="150"><br><br>

    <input type="file" name="bannerimg" id="bannerimg" onchange="previewImage(event)">
    <br><br>
    <br><br>

    <label for="url">URL:</label>
    <input type="url" name="url" value="{{ old('url', $banner->url) }}">
    <br><br>

    <button type="submit">Update</button>
</form>
<script>
function previewImage(event) {
    const input = event.target;
    const imagePreview = document.getElementById('imagePreview');

    // Check if the input contains files
    if (input.files && input.files[0]) {
        const fileURL = URL.createObjectURL(input.files[0]);

        // Update the img tag to show the selected image
        imagePreview.src = fileURL;
    }
}
</script>
