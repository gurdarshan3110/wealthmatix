@if(session()->has('flash_message'))
    <div class="alert alert-{{ session('flash_level', 'info') }}">
        {{ session('flash_message') }}
    </div>
@endif