<nav id="sidebar">
    <div class="navbar-nav theme-brand flex-row  text-center">
        <div class="nav-logo">
            <div class="nav-item theme-logo">
                <a href="{{url('/dashboard')}}">
                    <img src="{{asset('src/assets/img/logo.svg')}}" class="navbar-logo1" alt="logo">
                </a>
            </div>
            <div class="nav-item theme-text">
                <a href="{{url('/dashboard')}}" class="nav-link"> Sync </a>
            </div>
        </div>
        <div class="nav-item sidebar-toggle">
            <div class="btn-toggle sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevrons-left">
                    <polyline points="11 17 6 12 11 7"></polyline>
                    <polyline points="18 17 13 12 18 7"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <div class="shadow-bottom"></div>
    <ul class="list-unstyled menu-categories" id="accordionExample">
        @php
        $user_role = Auth::user()->user_role;
        @endphp
        <li class="menu active">
            <a href="{{url('/dashboard')}}" aria-expanded="true" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Dashboard</span>
                </div>
            </a>
        </li>
        <li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-minus">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg><span>Main Menu</span></div>
        </li>
        <li class="menu">
            <a href="{{url('mypos/product')}}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-shopping-cart">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>My Pos</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="#product" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>  <span>Product</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="product" data-bs-parent="#accordionExample">
                <li>
                    <a href="{{url('product')}}">Product List</a>
                </li>
                <li>
                    <a href="{{url('product/create')}}">Add Product</a>
                </li>
                <li>
                <a href="{{url('category')}}">Category</a>
                </li>
                <li>
                    <a href="{{url('brand')}}">Brand</a>
                </li>
                <!-- <li>
                    <a href="{{url('unit')}}">Unit</a>
                </li> -->
                <li>
                    <a href="{{url('variant')}}">Variant</a>
                </li>
                <li>
                    <a href="{{url('price/group')}}">Price Group</a>
                </li>
            </ul>

        </li>
        <li class="menu">
            <a href="#purchases " data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                    <span>Purchases </span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="purchases" data-bs-parent="#accordionExample">
                <li>
                <a href="{{url('purchase')}}">Purchase</a>
                </li>
                @if($user_role != 3)
                <li>
                <a href="{{url('purchase/create')}}">Add Purchase</a>
                </li>
                @endif
            </ul>
        </li>
        <li class="menu">
            <a href="#sale " data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                    <span>Sales </span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="sale" data-bs-parent="#accordionExample">
                <li>

                <a href="{{url('sale')}}">Invoice</a>

                </li>

            @if($user_role != 3)
                <li>
                <a href="{{url('sale/create')}}">Add Sale</a>
                </li>
            @endif
            </ul>
        </li>
        <li class="menu">
            <a href="#customer" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                    <span>Customer</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="customer" data-bs-parent="#accordionExample">
                <li>
                <a href="{{url('customers')}}">Customer List</a>
                </li>
                <li>
                    <a href="{{url('customer/create')}}">Add Customer</a>
                </li>
            </ul>
        </li>
        <li class="menu">
            <a href="#supplier" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck">
                    <rect x="1" y="3" width="15" height="13"></rect>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
                    <span>Supplier</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="supplier" data-bs-parent="#accordionExample">
                <li>
                <a href="{{url('suppliers')}}">Supplier List</a>
                </li>
                <li>
                    <a href="{{url('suppliers/create')}}">Add Supplier</a>
                </li>
            </ul>
        </li>
        <li class="menu">
            <a href="#account " data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                <span>Accounts </span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="account" data-bs-parent="#accordionExample">
                <li>

                <a href="{{url('chart_of_account')}}">Chart of Account</a>

                </li>

                <li>

                <a href="{{url('expense')}}">Expense</a>

                </li>

                <li>

                <a href="{{url('income')}}">Income</a>

                </li>
            </ul>
        </li>
        <li class="menu">
            <a href="#report " data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>
                <span>Report </span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="report" data-bs-parent="#accordionExample">
                <li>

                <a href="{{url('/report/top/purchase')}}">Top Purchase</a>

                </li>
                <li>

                <a href="{{url('/report/top/sale')}}">Top Salet</a>

                </li>

            </ul>
        </li>
       

        

        @if($user_role == 1 || $user_role == 3)
        <li class="menu">
            <a href="#users" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Users</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="users" data-bs-parent="#accordionExample">
                <li>
                    <a href="{{route('users.create')}}"> Add User </a>
                </li>
                <li>
                    <a href="{{route('users.index')}}"> User List </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</nav>