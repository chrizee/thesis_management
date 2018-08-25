@if($errors->any() > 0)
    @foreach($errors->all() as $error)
        <p class="text text-center text-danger">{{ $error }}</p>
    @endforeach
@endif

@if(session('success'))
    <p class="text text-center text-success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="text text-center text-danger">{{ session('error') }}</p>
@endif