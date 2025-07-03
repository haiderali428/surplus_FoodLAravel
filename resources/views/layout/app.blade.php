<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/modern.css">
    <link rel="stylesheet" href="./css/sidebar.css">
        <link rel="stylesheet" href="./css/main_style.css">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="./css/modern.css">
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="stylesheet" href="{{ asset('admin/css/setting.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/contactUs.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/FSSAILicense.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/Reports.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <title>Surplus Food</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
:root {
  --light-gray: #494949;
  --accent:  #ff9900;
  --dark-bg: #0C8C85;
  --input-bg: #FFFFFF;
  --red: #DF2B20;
  --primary-text: #FFFFFF;
  --secondary-text: #9F9F9F;
  --faded-accent: rgba(238, 196, 139, 0.15);
}

*, *::before, *::after {
  font-family: "Montserrat", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

main {
  display: grid;
  place-items: center;
  width: 95% !important;
  /* min-height: 100vh; */
  /* background: #080808; */
  color: var(--primary-text);
}

#staged-form {
  background: var(--dark-bg);
  /* max-width: 530px; */
  /* width: 100%; */
  padding: 30px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  border-radius: 10px;
  border: 1px solid var(--faded-accent);
}

#staged-form h2 {
  margin: 0 0 12px 0;
}


/* ---------- STAGE PROGRESS ---------- */
#stage-progress {
  list-style: none;
  width: 80%;
}

#stage-progress li {
  float: left;
  width: 33.33%;
  position: relative;
  text-align: center;
  color: #ffffff;
  font-size: 12px;
}

#stage-progress li::before {
  display: block;
  content: "";
  height: 32px;
  width: 32px;
  border-radius: 50%;
  margin: 0 auto 5px auto;
  border: 4px solid var(--light-gray);
  background: var(--light-gray);
  transition: border 0.1s ease-in-out 0s, background 0.1s ease-in-out 0s;
}

#stage-progress li::after {
  position: absolute;
  content: "";
  width: calc(100% - 40px);
  height: 4px;
  border-radius: 5px;
  background: var(--light-gray);
  left: calc(-50% + 20px);
	top: 14px;
  background: linear-gradient(90deg, var(--accent) 50%, var(--light-gray) 50%);
  background-size: 210% 100%;
  background-position: -95% 0;
  transition: background-position 0.3s ease-in-out;
}

#stage-progress li:first-child::after {
  content: none;
}

#stage-progress li.active-stage::before {
  border-color: var(--accent);
  transition: border 0.1s ease-in-out 0.3s, background 0.1s ease-in-out 0.3s;
}

#stage-progress li.active-stage::after {
  background-position: -190% 0;
}

#stage-progress li:has(~ .active-stage)::before, #stage-progress li:has(~ .active-stage)::after {
  border-color: var(--accent);
  background: var(--accent);
  background-position: -190% 0;
}


/* ---------- FORMS ---------- */
main {
  width: 100%;
  overflow: hidden;
  margin: 24px 0;
  position: relative;
}

.registration-form {
  width: 100%;
  /* padding: 0 24px; */
  box-sizing: border-box;
  flex-shrink: 0;
}

#form-section {
  display: flex;
  transition: transform 0.3s ease-in-out;
}

main::before, main::after {
  position: absolute;
  content: "";
  height: 100%;
  width: 24px;
  top: 0;
  z-index: 1;
}


/* ---------- NAVIGATION BUTTONS ---------- */
#form-navigation button {
  font-size: 14px;
  font-weight: Bold;
  padding: 0.5em 1.5em;
  border-radius: 5px;
  cursor: pointer;
  color: var(--dark-bg);
  position: relative;
}

.primary-btn {

  background-size: 200% 200%;
  background-position: 100% 0;
  border: none;
  transition: background-position 0.3s ease-in-out;
}
.primary-btn:hover {
  background-position: 0 0;
}

.secondary-btn {
  background-size: 200% 200%;
  background-position: 100% 0;
  border: none;
  z-index: 3;
  transition: background-position 0.3s ease-in-out;
}

.secondary-btn:hover, .secondary-btn:hover::after{
  background-position: 0 0;
}

.secondary-btn::before {
  position: absolute;
  content: "";
  height: calc(100% - 4px);
  width: calc(100% - 4px);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 3px;
  background: var(--dark-bg);
  z-index: -1;
}

.secondary-btn::after {
  content: "⟵ Prev Step";
  background: #ffffff;
  background-size: 200% 200%;
  background-position: 100% 0;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: background-position 0.3s ease-in-out;
}

#prev, #save {
  display: none;
}
#staged-form{
    max-width: 600px !important;
    margin-left: 2%;
}
@media(max-width: 600px){
    #staged-form{
        max-width: 530px !important;
        margin-left: 2%;
    }
    .registration-form {
    width: 90% !important;
    /* padding: 0 24px; */
    box-sizing: border-box;
    flex-shrink: 0;
}
}
@media(max-width: 550px){
    #staged-form{
        max-width: 500px !important;
        margin-left: 2%;
    }
    .registration-form {
    width: 83% !important;
    /* padding: 0 24px; */
    box-sizing: border-box;
    flex-shrink: 0;
}
}
@media(max-width: 500px){
    #staged-form{
        max-width: 450px !important;
        margin-left: 2%;
    }
    .registration-form {
    width: 76% !important;
    /* padding: 0 24px; */
    box-sizing: border-box;
    flex-shrink: 0;
}
}
@media(max-width: 450px){
    #staged-form{
        max-width: 400px !important;
        margin-left: 2%;
    }
    .registration-form {
    width: 67% !important;
    /* padding: 0 24px; */
    box-sizing: border-box;
    flex-shrink: 0;
}
}
@media(max-width: 400px){
    #staged-form{
        max-width: 350px !important;
        margin-left: 2%;
    }
    .registration-form {
    width: 59% !important;
    /* padding: 0 24px; */
    box-sizing: border-box;
    flex-shrink: 0;
}
}
@media(max-width: 350px){
    #staged-form{
        max-width: 300px !important;
        margin-left: 2%;
    }
    .registration-form {
    width: 55% !important;
    /* padding: 0 24px; */
    box-sizing: border-box;
    flex-shrink: 0;
}
}

    /* Profile page specific styles */
    .setting-nav {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .setting-navtab {
        color: #ffffff;
        border: none;
        background: rgba(255, 255, 255, 0.1);
        padding: 12px 18px;
        border-radius: 10px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .setting-navtab:hover,
    .setting-navtab.active {
        background: linear-gradient(45deg, #ff6b35, #f7931e);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
    }

    .verification-heading {
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: bold;
        margin-bottom: 25px;
        font-size: 1.5rem;
    }

    .form-input {
        background: #ffffff;
        border: 2px solid #e1e8ed;
        border-radius: 10px;
        padding: 12px 18px;
        width: 100%;
        color: #333;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .form-input:hover {
        border-color: #667eea;
        transform: translateY(-1px);
    }

    .food-profile-submit {
        background: linear-gradient(45deg, #ff6b35, #f7931e);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .food-profile-submit:hover {
        background: linear-gradient(45deg, #f7931e, #ff6b35);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    }

    .food-username p {
        color: #2c3e50;
        font-weight: bold;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .food-username span {
        color: #7f8c8d;
        font-size: 14px;
    }

    .dashboard-heading-2 {
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 30px;
        font-size: 2rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .lable-text {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Fix main content layout */
    main.content {
        display: block !important;
        width: 100% !important;
        color: #333 !important;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 30px 0;
    }

    .main {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    /* Profile image styles */
    .position-relative {
        position: relative;
    }

    .position-absolute {
        position: absolute;
    }

    /* Form validation styles */
    .is-invalid {
        border-color: #e74c3c !important;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1) !important;
    }

    .invalid-feedback {
        display: block;
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        font-weight: 500;
    }

    /* Role badge styles */
    .badge {
        font-weight: 600;
        padding: 6px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    /* Container styling */
    .container-fluid {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Tab content styling */
    .tab-content {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    /* Select dropdown styling */
    select.form-input {
        background-image: linear-gradient(45deg, transparent 50%, #667eea 50%), linear-gradient(135deg, #667eea 50%, transparent 50%);
        background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px);
        background-size: 5px 5px, 5px 5px;
        background-repeat: no-repeat;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    /* Icon styling */
    .fas {
        color: #667eea;
    }

    .setting-navtab .fas {
        color: inherit;
    }

    /* Animation for form elements */
    .form-input, .setting-navtab, .food-profile-submit {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
}
}
    </style>
</head>
<body>
    @include('sweetalert::alert')
        @yield(section: 'header')
        @yield('header_login_signup')
      @yield('content')

    @php
        $hideFooter = (
            request()->is('admin*') ||
            request()->routeIs('admin.*') ||
            request()->routeIs('login') ||
            request()->routeIs('signup') ||
            request()->routeIs('forget') ||
            request()->routeIs('user.signup') ||
            request()->routeIs('profile')
        );
    @endphp
    @unless($hideFooter)
    @include('footer.footer')
    @endunless

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if(session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '{{ session('info') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
    @stack('scripts')
</body>
</html>