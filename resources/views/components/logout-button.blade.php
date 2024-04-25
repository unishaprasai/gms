<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
        <span>{{ __('Log Out') }}</span>
    </x-dropdown-link>
</form>

<style>
    .dropdown-link span {
        color: #d23f1e; /* Red color */
    }
</style>
