@section('header')
   <header class="suplus-header sticky-top">
        <nav class="py-2 navbar navbar-expand-lg headerbackroud">
          <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="{{route('home')}}" style="font-weight: 700; font-size: 20px;">
              <div class="d-flex align-items-center gap-2 text-white">Suplus Food</div>
            </a>
      
            <!-- Navbar Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#customNavbar" aria-controls="customNavbar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
      
            <!-- Centered Navbar Items -->
            <div class="collapse navbar-collapse justify-content-center" id="customNavbar">
              <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('about_us')}}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">Contact us</a></li>


                @if (Auth::check())
                 <li class="nav-item"><a class="nav-link" href="{{route('post')}}">Post</a></li>

                @else
               <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Post</a></li>
                @endif
                
                  
                  
                <li class="nav-item"><a class="nav-link" href="{{ route('ngo') }}">NGO's</a></li>
              </ul>
              <div class="d-flex flex-column gap-2 mt-3 d-lg-none">
                @if (Auth::check())
                <!-- Notification Bell Icon for Mobile -->
                <div class="dropdown mb-2">
                  <button class="btn position-relative" type="button" id="notificationDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                      <path d="M8 16a2 2 0 0 0 1.985-1.75H6.015A2 2 0 0 0 8 16zm.104-14.804A1 1 0 0 0 7 2c0 .628-.134 1.197-.356 1.684C5.885 4.68 5 6.066 5 8v2.086l-.707.707A1 1 0 0 0 4 12h8a1 1 0 0 0 .707-1.707L12 10.086V8c0-1.934-.885-3.32-1.644-4.316A3.007 3.007 0 0 0 9 2a1 1 0 0 0-.896-.804zM8 1a2 2 0 0 1 2 2c0 .628.134 1.197.356 1.684C10.115 4.68 11 6.066 11 8v2.586l1 1V12H4v-.414l1-1V8c0-1.934.885-3.32 1.644-4.316A3.007 3.007 0 0 1 8 1z"/>
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationCountMobile" style="font-size: 0.7rem; display: none;">0</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notificationDropdownMobile" style="min-width: 320px; max-width: 400px; max-height: 350px; overflow-y: auto;">
                    <li class="d-flex justify-content-between align-items-center mb-2">
                      <span class="fw-bold">Notifications</span>
                      <button class="btn btn-sm btn-link text-danger p-0" id="clearNotificationsBtnMobile">Clear All</button>
                    </li>
                    <div id="notificationListMobile">
                      <li class="text-center text-muted">No notifications</li>
                    </div>
                  </ul>
                </div>
                <!-- End Notification Bell Icon for Mobile -->
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target=".needy-person-modal">
                    Add Needy Person
                  </button>
                     <div class="dropdown">
                  <button class="btn dropdown-toggle custom-dropdown d-flex align-items-center gap-2 px-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                    @php
                        $user = Auth::user();
                        $profilePic = $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('img/avatars/avatar-2.jpg');
                        $username = strstr($user->email, '@', true);
                    @endphp
                    <img src="{{ $profilePic }}" style="width: 32px; height: 32px; border-radius: 50%;">
                    <div class="me-2">
                      <p class="mb-0 profile-name1">{{ $user->first_name }} {{ $user->last_name }}</p>
                      <p class="mb-0 profile-name" style="margin-left: -8px;">{{ $username }}</p>
                    </div>
                    <img src="./img/sidebar/dd.svg" alt="Dropdown icon" style="width: 10px; height: 5px; filter: brightness(0) invert(1);">
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                    @if($user->role === 'donor')
                        <li><a class="dropdown-item" href="{{ route('my.donation.requests') }}">My Donation Posts</a></li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('received.donations') }}">Received Donations</a></li>
                        <li><a class="dropdown-item" href="{{ route('pending.donations') }}">Pending Donations</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                  </ul>
                </div>    
                @else
                   <a href="{{route('login')}}" class="btn btn-outline-secondary" >
                  Sign in
                  </a>
                   <a href="{{route('signup')}}" class="btn btn-outline-secondary" >
                    Sign up
                  </a>
                @endif
                
             
              </div>
            </div>
      
            <!-- Profile Dropdown on the Right for Larger Screens -->
            <div class="d-none d-lg-flex align-items-center gap-3">
                 @if (Auth::check())
                 <!-- Notification Bell Icon -->
                 <div class="dropdown me-2">
                   <button class="btn position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; color: white;">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                       <path d="M8 16a2 2 0 0 0 1.985-1.75H6.015A2 2 0 0 0 8 16zm.104-14.804A1 1 0 0 0 7 2c0 .628-.134 1.197-.356 1.684C5.885 4.68 5 6.066 5 8v2.086l-.707.707A1 1 0 0 0 4 12h8a1 1 0 0 0 .707-1.707L12 10.086V8c0-1.934-.885-3.32-1.644-4.316A3.007 3.007 0 0 0 9 2a1 1 0 0 0-.896-.804zM8 1a2 2 0 0 1 2 2c0 .628.134 1.197.356 1.684C10.115 4.68 11 6.066 11 8v2.586l1 1V12H4v-.414l1-1V8c0-1.934.885-3.32 1.644-4.316A3.007 3.007 0 0 1 8 1z"/>
                     </svg>
                     <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationCount" style="font-size: 0.7rem; display: none;">0</span>
                   </button>
                   <ul class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notificationDropdown" style="min-width: 320px; max-width: 400px; max-height: 350px; overflow-y: auto;">
                     <li class="d-flex justify-content-between align-items-center mb-2">
                       <span class="fw-bold">Notifications</span>
                       <button class="btn btn-sm btn-link text-danger p-0" id="clearNotificationsBtn">Clear All</button>
                     </li>
                     <div id="notificationList">
                       <li class="text-center text-muted">No notifications</li>
                     </div>
                   </ul>
                 </div>
                 <!-- End Notification Bell Icon -->
                 <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target=".needy-person-modal">
                    Add Needy Person
                  </button>
                   <div class="dropdown">
                <button class="btn dropdown-toggle custom-dropdown d-flex align-items-center gap-2 px-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                  @php
                      $user = Auth::user();
                      $profilePic = $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('img/avatars/avatar-2.jpg');
                      $username = strstr($user->email, '@', true);
                  @endphp
                  <img src="{{ $profilePic }}" style="width: 32px; height: 32px; border-radius: 50%;">
                  <div class="me-2">
                    <p class="mb-0 profile-name1">{{ $user->first_name }} {{ $user->last_name }}</p>
                    <p class="mb-0 profile-name" style="margin-left: -8px;">{{ $username }}</p>
                  </div>
                  <img src="./img/sidebar/dd.svg" alt="Dropdown icon" style="width: 10px; height: 5px; filter: brightness(0) invert(1);">
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                  @if($user->role === 'donor')
                      <li><a class="dropdown-item" href="{{ route('my.donation.requests') }}">My Donation Posts</a></li>
                  @else
                      <li><a class="dropdown-item" href="{{ route('received.donations') }}">Received Donations</a></li>
                      <li><a class="dropdown-item" href="{{ route('pending.donations') }}">Pending Donations</a></li>
                  @endif
                  <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                </ul>
              </div>
                 @else
                 <a href="{{route('login')}}" class="btn btn-outline-secondary" >
                    Sign in
                  </a>
                  <a href="{{route('signup')}}" class="btn btn-outline-secondary" >
                    Sign up
                  </a>
                 @endif  
                
              
             
            </div>
          </div>
        </nav>
      </header>
        <div class="modal fade needy-person-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <div class="modal-header">
          <h5 class="modal-title">Register Needy Person</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
  
        <div class="modal-body">
          <form id="needy-person-form" method="POST" action="{{ route('needy-person.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row ">
            <div class="col-md-6 mb-3">
              <label class="form-label">First Name</label>
              <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Last Name</label>
              <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
            </div>
        </div>
            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input type="tel" name="phone" class="form-control" placeholder="Enter phone number" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Address</label>
              <textarea name="address" class="form-control" rows="3" placeholder="Enter address" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Add CNIC front side image</label>
              <input type="file" name="cnic_front" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Add CNIC back side image</label>
                <input type="file" name="cnic_back" class="form-control" accept="image/*" required>
              </div>
            <div class="mb-3">
              <label class="form-label">Select NGO</label>
              <select name="ngo" class="form-select" required>
                <option value="">Select NGO</option>
                <option value="Helping Hands Foundation">Helping Hands Foundation</option>
                <option value="Care for All">Care for All</option>
                <option value="Hope Society">Hope Society</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary w-100">Register Person</button>
            </div>
          </form>
        </div>
  
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('Notification script loaded');
    
    // Desktop notification elements
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationList = document.getElementById('notificationList');
    const notificationCount = document.getElementById('notificationCount');
    const clearBtn = document.getElementById('clearNotificationsBtn');

    // Mobile notification elements
    const notificationDropdownMobile = document.getElementById('notificationDropdownMobile');
    const notificationListMobile = document.getElementById('notificationListMobile');
    const notificationCountMobile = document.getElementById('notificationCountMobile');
    const clearBtnMobile = document.getElementById('clearNotificationsBtnMobile');

    console.log('Desktop elements:', { notificationDropdown, notificationList, notificationCount, clearBtn });
    console.log('Mobile elements:', { notificationDropdownMobile, notificationListMobile, notificationCountMobile, clearBtnMobile });

    function fetchNotifications() {
        console.log('Fetching notifications...');
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         document.querySelector('input[name="_token"]')?.value;
        
        console.log('CSRF Token:', csrfToken);
        
        fetch('/notifications', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Notifications data:', data);
            
            const notificationHTML = data.notifications.length === 0 
                ? '<li class="text-center text-muted">No notifications</li>'
                : data.notifications.map(n => 
                    `<li class='mb-2 small border-bottom pb-2'>
                        <div>${n.data && n.data.message ? n.data.message : n.type.replace('App\\Notifications\\', '')}</div>
                        <div class='text-muted' style='font-size: 0.8em;'>${new Date(n.created_at).toLocaleString()}</div>
                    </li>`
                ).join('');

            // Update desktop
            if (notificationList) {
                notificationList.innerHTML = notificationHTML;
                console.log('Updated desktop notification list');
            }
            if (notificationCount) {
                notificationCount.textContent = data.unread_count;
                notificationCount.style.display = data.unread_count > 0 ? 'inline-block' : 'none';
                console.log('Updated desktop notification count:', data.unread_count);
            }

            // Update mobile
            if (notificationListMobile) {
                notificationListMobile.innerHTML = notificationHTML;
                console.log('Updated mobile notification list');
            }
            if (notificationCountMobile) {
                notificationCountMobile.textContent = data.unread_count;
                notificationCountMobile.style.display = data.unread_count > 0 ? 'inline-block' : 'none';
                console.log('Updated mobile notification count:', data.unread_count);
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
            const errorHTML = '<li class="text-center text-danger">Error loading notifications</li>';
            
            if (notificationList) notificationList.innerHTML = errorHTML;
            if (notificationListMobile) notificationListMobile.innerHTML = errorHTML;
        });
    }

    function clearNotifications() {
        console.log('Clearing notifications...');
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         document.querySelector('input[name="_token"]')?.value;
        
        fetch('/notifications/clear', { 
            method: 'POST', 
            headers: { 
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            } 
        })
        .then(response => response.json())
        .then(data => {
            console.log('Clear response:', data);
            if (data.success) {
                const noNotificationsHTML = '<li class="text-center text-muted">No notifications</li>';
                
                // Update desktop
                if (notificationList) {
                    notificationList.innerHTML = noNotificationsHTML;
                }
                if (notificationCount) {
                    notificationCount.style.display = 'none';
                }

                // Update mobile
                if (notificationListMobile) {
                    notificationListMobile.innerHTML = noNotificationsHTML;
                }
                if (notificationCountMobile) {
                    notificationCountMobile.style.display = 'none';
                }
            }
        })
        .catch(error => {
            console.error('Error clearing notifications:', error);
        });
    }

    // Desktop event listeners
    if (notificationDropdown) {
        console.log('Adding desktop click listener');
        notificationDropdown.addEventListener('click', function(e) {
            console.log('Desktop bell clicked');
            e.preventDefault();
            fetchNotifications();
        });
    }
    if (clearBtn) {
        console.log('Adding desktop clear listener');
        clearBtn.addEventListener('click', function(e) {
            console.log('Desktop clear clicked');
            e.preventDefault();
            clearNotifications();
        });
    }

    // Mobile event listeners
    if (notificationDropdownMobile) {
        console.log('Adding mobile click listener');
        notificationDropdownMobile.addEventListener('click', function(e) {
            console.log('Mobile bell clicked');
            e.preventDefault();
            fetchNotifications();
        });
    }
    if (clearBtnMobile) {
        console.log('Adding mobile clear listener');
        clearBtnMobile.addEventListener('click', function(e) {
            console.log('Mobile clear clicked');
            e.preventDefault();
            clearNotifications();
        });
    }
});
</script>
@endpush



