<header class="header navbar navbar-expand-sm expand-header">



<a href="javascript:void(0);" class="sidebarCollapse">

    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>

</a>

    

<!-- <div class="search-animated toggle-search">

    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>

    <form class="form-inline search-full form-inline search" role="search">

        <div class="search-bar">

            <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x search-close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

        </div>

    </form>

    <span class="badge badge-secondary">Ctrl + /</span>

</div> -->



<ul class="navbar-item flex-row ms-lg-auto ms-0">



    <!-- <li class="nav-item dropdown language-dropdown">

        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <img src="../src/assets/img/1x1/us.svg" class="flag-width" alt="flag">

        </a>

        <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">

            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/us.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;USA</span></a>

            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/tr.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Turkey</span></a>

            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/br.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Brazil</span></a>

            <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="../src/assets/img/1x1/in.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;India</span></a>

        </div>

    </li>-->



    <li class="nav-item theme-toggle-item" style="opacity:0;">

        <a href="javascript:void(0);" class="nav-link theme-toggle">

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon dark-mode"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun light-mode"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>

        </a>

    </li>


   
  



    <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">

        <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <div class="avatar-container">

                <div class="avatar avatar-sm avatar-indicators avatar-online">

                    @if(Auth::user()->image != null)

                    <img alt="avatar" src="{{asset('uploads/users/'.Auth::user()->image)}}" class="rounded-circle">

                    @else

                    <img alt="avatar" src="{{asset('src/assets/img/user.png')}}" class="rounded-circle">

                    @endif

                </div>

            </div>

        </a>



        <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">

            <div class="user-profile-section">

                <div class="media mx-auto">

                    <div class="emoji me-2">

                        &#x1F44B;

                    </div>

                    <div class="media-body">

                        <h5>{{ Auth::user()->fname .' '. Auth::user()->lname }}</h5>

                        <p>@if(Auth::user()->user_role == 1)
                            Owner
                        @elseif(Auth::user()->user_role == 2)
                            Manager
                        @else
                            Sales Agent
                        @endif</p>

                    </div>

                </div>

            </div>
            
            <div class="dropdown-item">

                <a href="{{url('/users/profile')}}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>Profile</span>

                </a>

            </div>
            @php 
            $users = Auth::user();
            @endphp 
            @if($users->user_role == 1)
            <div class="dropdown-item">

                <a href="{{ url('users/shop-setting/'.$users->shop_id) }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>Shop Setting</span>

                </a>

            </div>
            @endif
            <div class="dropdown-item">

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>

                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                    @csrf

                </form>

            </div>

        </div>

        

    </li>

</ul>

</header>