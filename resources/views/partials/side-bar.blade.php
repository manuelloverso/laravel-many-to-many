<aside>
    <nav>
        <h2 class="mb-3">My Portfolio</h2>
        <ul class="d-flex flex-column list-unstyled">
            <li>
                <a href="{{ url('admin') }}">{{ __('Dashboard') }}</a>
            </li>
            <li>
                <a href="{{ route('admin.projects.index') }}">{{ __('Projects') }}</a>
            </li>
            <li>
                <a href="{{ route('admin.technologies.index') }}">{{ __('Technologies') }}</a>
            </li>
            <li>
                <a href="{{ route('admin.types.index') }}">{{ __('Types') }}</a>
            </li>

            <li>
                <a href="{{ url('profile') }}">{{ __('Profile') }}</a>
            </li>

            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

    </nav>
</aside>
