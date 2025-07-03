<li class="nav-item dropdown ms-lg-2">
    <a class="nav-link p-0 dropdown-toggle position-relative" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span>
            @if(isset($admin) && $admin->profile_picture)
                <img src="{{ asset('storage/' . $admin->profile_picture) }}" width="32" height="32" alt="Admin Profile" style="border-radius: 50%; object-fit: cover;">
            @else
                <img src="{{ asset('img/avatars/avatar.jpg') }}" width="32" height="32" alt="Default Avatar" style="border-radius: 50%; object-fit: cover;">
            @endif
        </span>
        <span class="me-3 d-none d-md-inline">
            {{ isset($admin) && $admin->name ? $admin->name : 'Admin' }}
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                <i class="align-middle me-1 fas fa-fw fa-user"></i>
                Profile
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</li> 