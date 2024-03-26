<form method="POST" action="{{ route('logout') }}">
    @csrf
    
    <button type="submit" class="btn btn-danger">
        {{ __('Logout') }}
    </button>
</form>