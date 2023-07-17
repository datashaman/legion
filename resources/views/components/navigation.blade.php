<div>
    <ul class="menu menu-compact lg:menu-normal bg-base-100 w-56 p-2 rounded-box">
        @auth
        <li><x-nav-link href="{{ route('dashboard') }}" :active="true">{{ __('Dashboard') }}</x-nav-link></li>
        <li><x-nav-link href="{{ route('personas.index') }}">{{ __('Personas') }}</x-nav-link></li>
        <li><x-nav-link href="{{ route('chats.index') }}">{{ __('Chats') }}</x-nav-link></li>
        <li><x-nav-link href="{{ route('logout') }}" method="post">{{ __('Log out') }}</x-nav-link></li>
        @else
        <li><x-nav-link href="{{ route('login') }}">{{ __('Log in') }}</x-nav-link></li>
        @endauth
    </ul>
</div>
