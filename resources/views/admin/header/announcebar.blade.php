@extends('admin.index')

@section('content')
<div class="container">
    <h1>Update Announce Bar</h1>

    @if(session('success'))
        <div style="color: green; font-size: 2rem;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.announcebar.update') }}" method="POST" class="form">
        @csrf

        <div>
            <label for="phoneno" class="label-prop">Phone Number:</label><br>
            <input type="text" name="phoneno" id="phoneno" class="input-fileds" value="{{ old('phoneno', $announce->phoneno ?? '') }}">
        </div>

        <div>
            <label for="text" class="label-prop">Text:</label><br>
            <input type="text" name="text" id="text" class="input-fileds" value="{{ old('text', $announce->text ?? '') }}">
        </div>

        <div>
            <label for="address" class="label-prop">Address:</label><br>
            <input type="text" name="address" id="address" class="input-fileds" value="{{ old('address', $announce->address ?? '') }}">
        </div>

        <button type="submit" class="admin-btn">Update</button>
    </form>
</div>
@endsection
