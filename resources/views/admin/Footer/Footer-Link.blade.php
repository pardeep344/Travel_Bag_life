@extends('admin.index')

@section('content')
<h1>{{ isset($footerLink) ? 'Edit' : 'Add' }} Footer Link</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
<form action="{{ isset($footerLink) ? route('admin.footerLinks.update', $footerLink->id) : route('admin.footerLinks.store') }}" method="POST" class="form">
    @csrf
    @if(isset($footerLink))
        @method('PUT')
    @endif

    <!-- Text Field -->
    <label for="Text" class="label-prop">Text:</label>
    <input type="text" name="Text" id="Text" class="input-fileds" value="{{ old('Text', $footerLink->Text ?? '') }}" required><br>

    <!-- Url Field -->
    <label for="Url" class="label-prop">Url:</label>
    <input type="text" name="Url" id="Url" class="input-fileds" value="{{ old('Url', $footerLink->Url ?? '') }}" required><br>

     
    <label for="active" class="label-prop">Status:</label>
<label for="active" class="label-prop"><input type="radio" name="Status" id="active" value="active" {{ isset($footerLink) && $footerLink->Status == 'active' ? 'checked' : '' }}> Active</label>
<label for="inactive" class="label-prop"><input type="radio" name="Status" id="inactive" value="inactive" {{ isset($footerLink) && $footerLink->Status == 'inactive' ? 'checked' : '' }}> Inactive</label>
    

    
    <button type="submit" class="admin-btn">{{ isset($footerLink) ? 'Update' : 'Create' }} Footer Link</button>
</form>
</div>
<table class="table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Url</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($Footerlinks as $Footerlink)
        <tr>
            <td>{{ $Footerlink->id }}</td>
            <td>{{ $Footerlink->Text }}</td>
            <td>{{ $Footerlink->Url }}</td>
            <td>{{ $Footerlink->Status }}</td>
            <td >
                <div class="action-cell">
                <a href="{{ route('admin.footerLinks.edit', $Footerlink->id) }}" class="edit-btn" >Edit</a>
    
                <form action="{{ route('admin.footerLinks.destroy', $Footerlink->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this footer link?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" >Delete Footer Link</button>
                </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



@endsection
