<form method="POST" action="{{ route('logout') }}">
    @csrf
    
    <button type="submit">
        {{ __('Logout') }}
    </button>
</form>