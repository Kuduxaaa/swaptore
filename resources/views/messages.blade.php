@if(session('error'))
    <div class="alert alert-danger mt-4">
        {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger mt-4">
        @foreach ($errors->all() as $error)
            <span>{{ $error }}</span><br>
        @endforeach
    </div>
@endif
@if(session('message'))
    <div class="alert alert-success mt-4">
        {{ session('message') }}
    </div>
@endif