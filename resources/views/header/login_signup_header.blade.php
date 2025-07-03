@section('header_login_signup')
 <header class="headerbackroud shadow">
    <div class="d-flex container  justify-content-between align-items-center p-3  ">
        <div>
        <a href="{{route('home')}}" class="auth-logo"> 
            <!-- <img src="/logo.png" alt="Logo" class="img-fluid" style="height: 50px;">  -->
            Surplus Food </a>
        </div>
        <div>
             @if (request()->is('signup'))
                         <a href="{{route('login')}}"> <button class="btn btn-outline-secondary">login</button> </a>
             @else
         <a href="{{route('signup')}}"> <button class="btn btn-outline-secondary">signup</button> </a>

            @endif
        </div>
    </div>
    </header>    
@endsection