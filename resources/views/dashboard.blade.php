@extends('admin')



@section('content')

<div class="layout-px-spacing">



<div class="middle-content container-xxl p-0">



    <div class="row layout-top-spacing">



        @if(Auth::user()->user_role != 2)



        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-chart-one">

                <div class="widget-heading">

                    <h5 class="">Takealot Sales</h5>

                  

                </div>



                <div class="widget-content">

                    <div id="revenueMonthly"></div>

                </div>

            </div>

        </div>



        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-chart-two">

                <div class="widget-heading">

                    <h5 class="">Sales by Category</h5>

                </div>

                <div class="widget-content">

                    <div id="chart-2" class=""></div>

                </div>

            </div>

        </div>



        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">

            <div class="widget-two">

                <div class="widget-content">

                    <div class="w-numeric-value">

                        <div class="w-content">

                            <span class="w-value">Daily sales</span>

                            <span class="w-numeric-title">Go to columns for details.</span>

                        </div>

                        <div class="w-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>

                        </div>

                    </div>

                    <div class="w-chart">

                        <div id="daily-sales"></div>

                    </div>

                </div>

            </div>

        </div>



         <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">

            <div class="widget widget-three">

                <div class="widget-heading">

                    <h5 class="">Summary</h5>



                    <div class="task-action">

                        <div class="dropdown">

                            <a class="dropdown-toggle" href="#" role="button" id="summary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>

                            </a>



                            <div class="dropdown-menu left" aria-labelledby="summary" style="will-change: transform;">

                                <a class="dropdown-item" href="javascript:void(0);">View Report</a>

                                <a class="dropdown-item" href="javascript:void(0);">Edit Report</a>

                                <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>

                            </div>

                        </div>

                    </div>



                </div>

                <div class="widget-content">



                    <div class="order-summary">



                        <div class="summary-list">

                            <div class="w-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>

                            </div>

                            <div class="w-summary-details">

                                

                                <div class="w-summary-info">

                                    <h6>Income</h6>

                                    <p class="summary-count">$92,600</p>

                                </div>



                                <div class="w-summary-stats">

                                    <div class="progress">

                                        <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </div>



                            </div>



                        </div>



                        <div class="summary-list">

                            <div class="w-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>

                            </div>

                            <div class="w-summary-details">

                                

                                <div class="w-summary-info">

                                    <h6>Profit</h6>

                                    <p class="summary-count">$37,515</p>

                                </div>



                                <div class="w-summary-stats">

                                    <div class="progress">

                                        <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </div>



                            </div>



                        </div>



                        <div class="summary-list">

                            <div class="w-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>

                            </div>

                            <div class="w-summary-details">

                                

                                <div class="w-summary-info">

                                    <h6>Expenses</h6>

                                    <p class="summary-count">$55,085</p>

                                </div>



                                <div class="w-summary-stats">

                                    <div class="progress">

                                        <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </div>



                            </div>



                        </div>

                        

                    </div>

                    

                </div>

            </div>

        </div> -->



        <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

            <div class="widget-one widget">

                <div class="widget-content">

                    <div class="w-numeric-value">

                        <div class="w-icon">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>

                        </div>

                        <div class="w-content">

                          @php 

                          $total_sales_seven = 0;

                          foreach($day_wise as $dwise){

                            $total_sales_seven += $dwise['price'];

                          }

                          @endphp

                            <span class="w-value">{{number_format($total_sales_seven,1)}}</span>

                            <span class="w-numeric-title">Total Orders</span>

                        </div>

                    </div>

                    <div class="w-chart">

                        <div id="total-orders"></div>

                    </div>

                </div>

            </div>

        </div>



        <!--<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">



            <div class="widget widget-activity-four">



                <div class="widget-heading">

                    <h5 class="">Recent Activities</h5>

                </div>



                <div class="widget-content">



                    <div class="mt-container-ra mx-auto">

                        <div class="timeline-line">



                            <div class="item-timeline timeline-primary">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p><span>Updated</span> Server Logs</p>

                                    <span class="badge">Pending</span>

                                    <p class="t-time">Just Now</p>

                                </div>

                            </div>



                            <div class="item-timeline timeline-success">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Send Mail to <a href="javascript:void(0);">HR</a> and <a href="javascript:void(0);">Admin</a></p>

                                    <span class="badge">Completed</span>

                                    <p class="t-time">2 min ago</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-danger">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Backup <span>Files EOD</span></p>

                                    <span class="badge">Pending</span>

                                    <p class="t-time">14:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-dark">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Collect documents from <a href="javascript:void(0);">Sara</a></p>

                                    <span class="badge">Completed</span>

                                    <p class="t-time">16:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-warning">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Conference call with <a href="javascript:void(0);">Marketing Manager</a>.</p>

                                    <span class="badge">In progress</span>

                                    <p class="t-time">17:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-secondary">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Rebooted Server</p>

                                    <span class="badge">Completed</span>

                                    <p class="t-time">17:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-warning">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Send contract details to Freelancer</p>

                                    <span class="badge">Pending</span>

                                    <p class="t-time">18:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-dark">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Kelly want to increase the time of the project.</p>

                                    <span class="badge">In Progress</span>

                                    <p class="t-time">19:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-success">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Server down for maintanence</p>

                                    <span class="badge">Completed</span>

                                    <p class="t-time">19:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-secondary">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Malicious link detected</p>

                                    <span class="badge">Block</span>

                                    <p class="t-time">20:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-warning">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Rebooted Server</p>

                                    <span class="badge">Completed</span>

                                    <p class="t-time">23:00</p>

                                </div>

                            </div>



                            <div class="item-timeline timeline-primary">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p><span>Updated</span> Server Logs</p>

                                    <span class="badge">Pending</span>

                                    <p class="t-time">Just Now</p>

                                </div>

                            </div>



                            <div class="item-timeline timeline-success">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Send Mail to <a href="javascript:void(0);">HR</a> and <a href="javascript:void(0);">Admin</a></p>

                                    <span class="badge">Completed</span>

                                    <p class="t-time">2 min ago</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-danger">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Backup <span>Files EOD</span></p>

                                    <span class="badge">Pending</span>

                                    <p class="t-time">14:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-dark">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Collect documents from <a href="javascript:void(0);">Sara</a></p>

                                    <span class="badge">Completed</span>

                                    <p class="t-time">16:00</p>

                                </div>

                            </div>



                            <div class="item-timeline  timeline-warning">

                                <div class="t-dot" data-original-title="" title="">

                                </div>

                                <div class="t-text">

                                    <p>Conference call with <a href="javascript:void(0);">Marketing Manager</a>.</p>

                                    <span class="badge">In progress</span>

                                    <p class="t-time">17:00</p>

                                </div>

                            </div>



                        </div>

                    </div>



                    <div class="tm-action-btn">

                        <button class="btn"><span>View All</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></button>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-table-one">

                <div class="widget-heading">

                    <h5 class="">Transactions</h5>

                    <div class="task-action">

                        <div class="dropdown">

                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>

                            </a>



                            <div class="dropdown-menu left" aria-labelledby="pendingTask" style="will-change: transform;">

                                <a class="dropdown-item" href="javascript:void(0);">View Report</a>

                                <a class="dropdown-item" href="javascript:void(0);">Edit Report</a>

                                <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="widget-content">

                    <div class="transactions-list">

                        <div class="t-item">

                            <div class="t-company-name">

                                <div class="t-icon">

                                    <div class="icon">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>

                                    </div>

                                </div>

                                <div class="t-name">

                                    <h4>Electricity Bill</h4>

                                    <p class="meta-date">04 Jan 1:00PM</p>

                                </div>



                            </div>

                            <div class="t-rate rate-dec">

                                <p><span>-$16.44</span></p>

                            </div>

                        </div>

                    </div>



                    <div class="transactions-list t-info">

                        <div class="t-item">

                            <div class="t-company-name">

                                <div class="t-icon">

                                    <div class="avatar">

                                        <span class="avatar-title">SP</span>

                                    </div>

                                </div>

                                <div class="t-name">

                                    <h4>Shaun Park</h4>

                                    <p class="meta-date">10 Jan 1:00PM</p>

                                </div>

                            </div>

                            <div class="t-rate rate-inc">

                                <p><span>+$36.11</span></p>

                            </div>

                        </div>

                    </div>



                    <div class="transactions-list">

                        <div class="t-item">

                            <div class="t-company-name">

                                <div class="t-icon">

                                    <div class="avatar">

                                        <span class="avatar-title">AD</span>

                                    </div>

                                </div>

                                <div class="t-name">

                                    <h4>Amy Diaz</h4>

                                    <p class="meta-date">31 Jan 1:00PM</p>

                                </div>



                            </div>

                            <div class="t-rate rate-inc">

                                <p><span>+$66.44</span></p>

                            </div>

                        </div>

                    </div>



                    <div class="transactions-list t-secondary">

                        <div class="t-item">

                            <div class="t-company-name">

                                <div class="t-icon">

                                    <div class="icon">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>

                                    </div>

                                </div>

                                <div class="t-name">

                                    <h4>Netflix</h4>

                                    <p class="meta-date">02 Feb 1:00PM</p>

                                </div>



                            </div>

                            <div class="t-rate rate-dec">

                                <p><span>-$32.00</span></p>

                            </div>

                        </div>

                    </div>





                    <div class="transactions-list t-info">

                        <div class="t-item">

                            <div class="t-company-name">

                                <div class="t-icon">

                                    <div class="avatar">

                                        <span class="avatar-title">DA</span>

                                    </div>

                                </div>

                                <div class="t-name">

                                    <h4>Daisy Anderson</h4>

                                    <p class="meta-date">15 Feb 1:00PM</p>

                                </div>

                            </div>

                            <div class="t-rate rate-inc">

                                <p><span>+$10.08</span></p>

                            </div>

                        </div>

                    </div>



                    <div class="transactions-list">

                        <div class="t-item">

                            <div class="t-company-name">

                                <div class="t-icon">

                                    <div class="avatar">

                                        <span class="avatar-title">OG</span>

                                    </div>

                                </div>

                                <div class="t-name">

                                    <h4>Oscar Garner</h4>

                                    <p class="meta-date">20 Feb 1:00PM</p>

                                </div>



                            </div>

                            <div class="t-rate rate-dec">

                                <p><span>-$22.00</span></p>

                            </div>

                        </div>

                    </div>

                    

                    

                    

                </div>

            </div>

        </div>



        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">



            <div class="widget widget-wallet-one">



                <div class="wallet-info text-center mb-3">



                    <p class="wallet-title mb-3">Total Balance</p>

                    

                    <p class="total-amount mb-3">$ 26,177.88</p>



                    <a href="#" class="wallet-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up me-2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg> Get 6% interest</a>



                </div>





                <div class="wallet-action text-center d-flex justify-content-around">

                            

                    <button class="btn btn-danger">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>

                        <span class="btn-text-inner">Topup</span>

                    </button>

                            

                    <button class="btn btn-success">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>

                        <span class="btn-text-inner">Send</span>

                    </button>

                    

                </div>



                <hr>

                

                <ul class="list-group list-group-media">

                    <li class="list-group-item ">

                        <div class="media">

                            <div class="me-3">

                                <img alt="avatar" src="../src/assets/img/netflix.svg" class="img-fluid rounded-circle">

                            </div>

                            <div class="media-body">

                                <h6 class="tx-inverse">Netflix</h6>

                                <p class="mg-b-0">June 6, 10:34</p>

                                <p class="amount">- $18.06</p>

                            </div>

                        </div>

                    </li>

                    <li class="list-group-item">

                        <div class="media">

                            <div class="me-3">

                                <img alt="avatar" src="../src/assets/img/apple-app-store.svg" class="img-fluid rounded-circle">

                            </div>

                            <div class="media-body">

                                <h6 class="tx-inverse">App Design</h6>

                                <p class="mg-b-0">June 14, 05:21</p>

                                <p class="amount">- $90.65</p>

                            </div>

                        </div>

                    </li>

                </ul>



                <button class="btn btn-secondary w-100 mt-3">View Transaction History</button>

                

            </div>

        </div> -->



        @endif

        

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-table-two">



                <div class="widget-heading">

                    <h5 class="">Recent Orders</h5>

                </div>



                <div class="widget-content">

                    <div class="table-responsive">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th><div class="th-content">Customer</div></th>

                                    <th><div class="th-content">Product</div></th>

                                    <th><div class="th-content">TSIN</div></th>

                                    <th><div class="th-content th-heading">Price</div></th>

                                    <th><div class="th-content">Status</div></th>

                                </tr>

                            </thead>

                            <tbody>

                              

                                <tr>

                                    <td><div class="td-content customer-name"></td>

                                    <td><div class="td-content product-brand text-primary"></div></td>

                                    <td><div class="td-content product-invoice"></div></td>

                                    <td><div class="td-content pricing"><span class=""></span></div></td>

                                    <td><div class="td-content"><span class="badge badge-success"></span></div></td>

                                </tr>

                              

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-table-three">



                <div class="widget-heading">

                    <h5 class="">Top Selling Product</h5>

                </div>



                <div class="widget-content">

                    <div class="table-responsive">

                        <table class="table table-scroll">

                            <thead>

                                <tr>

                                    <th class="text-center">Product Title</th>

                                    <th class="text-center" width="200">Quantity</th>

                                    <th class="text-center" width="200">Total Revenue</th>

                                </tr>

                            </thead>

                            <tbody>

                               

                                <tr>

                                    <td></td>

                                    <td class="text-center"></td>

                                    <td class="text-center"></td>

                                </tr>

                            

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>



    </div>



</div>



</div>



@endsection



@push('js')

<script>

window.addEventListener("load", function(){



try {



  getcorkThemeObject = localStorage.getItem("theme");

  getParseObject = JSON.parse(getcorkThemeObject)

  ParsedObject = getParseObject;



  if (ParsedObject.settings.layout.darkMode) {

    

    var Theme = 'dark';



    Apex.tooltip = {

        theme: Theme

    }



    /**

        ==============================

        |    @Options Charts Script   |

        ==============================

    */

    

    /*

        =============================

            Daily Sales | Options

        =============================

    */

    var d_2options1 = {

      chart: {

          height: 160,

          type: 'bar',

          stacked: true,

          stackType: '100%',

          toolbar: {

              show: false,

          }

      },

      dataLabels: {

          enabled: false,

      },

      stroke: {

          show: true,

          width: [3, 4],

          curve: "smooth",

      },

      colors: ['#e2a03f', '#e0e6ed'],

      series: [{

          name: 'Sales',

          data: [

            @foreach($day_wise as $dwise)

            {!! json_encode($dwise['price']) !!},

            @endforeach

        ]

      }],

      xaxis: {

          labels: {

              show: false,

          },

          categories: [

            @foreach($day_wise as $dwise)

            {!! json_encode(\Carbon\Carbon::parse($dwise['date'])->format("l")) !!},

            @endforeach

        ],

          crosshairs: {

          show: false

          }

      },

      yaxis: {

          show: false

      },

      fill: {

          opacity: 1

      },

      plotOptions: {

          bar: {

              horizontal: false,

              columnWidth: '25%',

              borderRadius: 8,

          }

      },

      legend: {

          show: false,

      },

      grid: {

          show: false,

          xaxis: {

              lines: {

                  show: false

              }

          },

          padding: {

          top: -20,

          right: 0,

          bottom: -40,

          left: 0

          }, 

      },

      responsive: [

          {

              breakpoint: 575,

              options: {

                  plotOptions: {

                      bar: {

                          borderRadius: 5,

                          columnWidth: '35%'

                      }

                  },

              }

          },

      ],

    }

    

    /*

        =============================

            Total Orders | Options

        =============================

    */

    var d_2options2 = {

      chart: {

        id: 'sparkline1',

        group: 'sparklines',

        type: 'area',

        height: 290,

        sparkline: {

          enabled: true

        },

      },

      stroke: {

          curve: 'smooth',

          width: 2

      },

      fill: {

        type:"gradient",

        gradient: {

            type: "vertical",

            shadeIntensity: 1,

            inverseColors: !1,

            opacityFrom: .30,

            opacityTo: .05,

            stops: [100, 100]

        }

      },

      series: [{

        name: 'Sales',

        data: [

          @foreach($day_wise as $dwise)

            {!! json_encode($dwise['price']) !!},

            @endforeach

        ]

      }],

      labels: ['1', '2', '3', '4', '5', '6', '7'],

      yaxis: {

        min: 0

      },

      grid: {

        padding: {

          top: 125,

          right: 0,

          bottom: 0,

          left: 0

        }, 

      },

      tooltip: {

        x: {

          show: false,

        },

        theme: Theme

      },

      colors: ['#00ab55']

    }

    

    /*

        =================================

            Revenue Monthly | Options

        =================================

    */

    var options1 = {

      chart: {

        fontFamily: 'Nunito, sans-serif',

        height: 365,

        type: 'area',

        zoom: {

            enabled: false

        },

        dropShadow: {

          enabled: true,

          opacity: 0.2,

          blur: 10,

          left: -7,

          top: 22

        },

        toolbar: {

          show: false

        },

      },

      colors: ['#e7515a', '#2196f3'],

      dataLabels: {

          enabled: false

      },

      markers: {

        discrete: [{

        seriesIndex: 0,

        dataPointIndex: 7,

        fillColor: '#000',

        strokeColor: '#000',

        size: 5

      }, {

        seriesIndex: 2,

        dataPointIndex: 11,

        fillColor: '#000',

        strokeColor: '#000',

        size: 4

      }]

      },

      subtitle: {

        text: {!! json_encode($total_sale / 1000 .'K') !!} ,

        align: 'left',

        margin: 0,

        offsetX: 100,

        offsetY: 0,

        floating: false,

        style: {

          fontSize: '18px',

          color:  '#00ab55'

        }

      },

      title: {

        text: 'Total Sales',

        align: 'left',

        margin: 0,

        offsetX: -10,

        offsetY: 0,

        floating: false,

        style: {

          fontSize: '18px',

          color:  '#bfc9d4'

        },

      },

      stroke: {

          show: true,

          curve: 'smooth',

          width: 2,

          lineCap: 'square'

      },

      series: [ {

          name: 'Sales',

          data: [

            @foreach($total_amount as $tamount)

            {!! json_encode($tamount[0]['price']) !!},

            @endforeach

        ]

      }],

      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

      xaxis: {

        axisBorder: {

          show: false

        },

        axisTicks: {

          show: false

        },

        crosshairs: {

          show: true

        },

        labels: {

          offsetX: 0,

          offsetY: 5,

          style: {

              fontSize: '12px',

              fontFamily: 'Nunito, sans-serif',

              cssClass: 'apexcharts-xaxis-title',

          },

        }

      },

      yaxis: {

        labels: {

          formatter: function(value, index) {

            return (value / 1000) + 'K'

          },

          offsetX: -15,

          offsetY: 0,

          style: {

              fontSize: '12px',

              fontFamily: 'Nunito, sans-serif',

              cssClass: 'apexcharts-yaxis-title',

          },

        }

      },

      grid: {

        borderColor: '#191e3a',

        strokeDashArray: 5,

        xaxis: {

            lines: {

                show: true

            }

        },   

        yaxis: {

            lines: {

                show: false,

            }

        },

        padding: {

          top: -50,

          right: 0,

          bottom: 0,

          left: 5

        },

      }, 

      legend: {

        position: 'top',

        horizontalAlign: 'right',

        offsetY: -50,

        fontSize: '16px',

        fontFamily: 'Quicksand, sans-serif',

        markers: {

          width: 10,

          height: 10,

          strokeWidth: 0,

          strokeColor: '#fff',

          fillColors: undefined,

          radius: 12,

          onClick: undefined,

          offsetX: -5,

          offsetY: 0

        },    

        itemMargin: {

          horizontal: 10,

          vertical: 20

        }

        

      },

      tooltip: {

        theme: Theme,

        marker: {

          show: true,

        },

        x: {

          show: false,

        }

      },

      fill: {

          type:"gradient",

          gradient: {

              type: "vertical",

              shadeIntensity: 1,

              inverseColors: !1,

              opacityFrom: .19,

              opacityTo: .05,

              stops: [100, 100]

          }

      },

      responsive: [{

        breakpoint: 575,

        options: {

          legend: {

              offsetY: -50,

          },

        },

      }]

    }

    

    /*

        ==================================

            Sales By Category | Options

        ==================================

    */

    var options = {

        chart: {

            type: 'donut',

            width: 370,

            height: 430

        },

        colors: ['#622bd7', '#e2a03f', '#e7515a', '#e2a03f'],

        dataLabels: {

          enabled: false

        },

        legend: {

            position: 'bottom',

            horizontalAlign: 'center',

            fontSize: '14px',

            markers: {

              width: 10,

              height: 10,

              offsetX: -5,

              offsetY: 0

            },

            itemMargin: {

              horizontal: 10,

              vertical: 30

            }

        },

        plotOptions: {

          pie: {

            donut: {

              size: '75%',

              background: 'transparent',

              labels: {

                show: true,

                name: {

                  show: true,

                  fontSize: '29px',

                  fontFamily: 'Nunito, sans-serif',

                  color: undefined,

                  offsetY: -10

                },

                value: {

                  show: true,

                  fontSize: '26px',

                  fontFamily: 'Nunito, sans-serif',

                  color: '#bfc9d4',

                  offsetY: 16,

                  formatter: function (val) {

                    return val

                  }

                },

                total: {

                  show: true,

                  showAlways: true,

                  label: 'Total',

                  color: '#888ea8',

                  formatter: function (w) {

                    return w.globals.seriesTotals.reduce( function(a, b) {

                      return a + b

                    }, 0)

                  }

                }

              }

            }

          }

        },

        stroke: {

          show: true,

          width: 15,

          colors: '#0e1726'

        },

        series: [{{$tsales[0]['price'] }}, {{ $tsales_return[0]['price'] }}],

        labels: ['Sales', 'Return'],

  

        responsive: [

          { 

            breakpoint: 1440, options: {

              chart: {

                width: 325

              },

            }

          },

          { 

            breakpoint: 1199, options: {

              chart: {

                width: 380

              },

            }

          },

          { 

            breakpoint: 575, options: {

              chart: {

                width: 320

              },

            }

          },

        ],

    }



  } else {



    var Theme = 'dark';



    Apex.tooltip = {

        theme: Theme

    }



    /**

        ==============================

        |    @Options Charts Script   |

        ==============================

    */

    

    /*

        =============================

            Daily Sales | Options

        =============================

    */

    var d_2options1 = {

      chart: {

          height: 160,

          type: 'bar',

          stacked: true,

          stackType: '100%',

          toolbar: {

              show: false,

          }

      },

      dataLabels: {

          enabled: false,

      },

      stroke: {

          show: true,

          width: [3, 4],

          curve: "smooth",

      },

      colors: ['#e2a03f', '#e0e6ed'],

      series: [{

          name: 'Sales',

          data: [

            @foreach($day_wise as $dwise)

            {!! json_encode($dwise['price']) !!},

            @endforeach

          ]

      }],

      xaxis: {

          labels: {

              show: false,

          },

          categories: [

            @foreach($day_wise as $dwise)

            {!! json_encode(\Carbon\Carbon::parse($dwise['date'])->format("l"))!!},

            @endforeach

        ],

          crosshairs: {

          show: false

          }

      },

      yaxis: {

          show: false

      },

      fill: {

          opacity: 1

      },

      plotOptions: {

          bar: {

              horizontal: false,

              columnWidth: '25%',

              borderRadius: 8,

          }

      },

      legend: {

          show: false,

      },

      grid: {

          show: false,

          xaxis: {

              lines: {

                  show: false

              }

          },

          padding: {

          top: -20,

          right: 0,

          bottom: -40,

          left: 0

          }, 

      },

      responsive: [

          {

              breakpoint: 575,

              options: {

                  plotOptions: {

                      bar: {

                          borderRadius: 5,

                          columnWidth: '35%'

                      }

                  },

              }

          },

      ],

    }

    

    /*

        =============================

            Total Orders | Options

        =============================

    */

    var d_2options2 = {

      chart: {

        id: 'sparkline1',

        group: 'sparklines',

        type: 'area',

        height: 290,

        sparkline: {

          enabled: true

        },

      },

      stroke: {

          curve: 'smooth',

          width: 2

      },

      fill: {

        opacity: 1,

        // type:"gradient",

        // gradient: {

        //     type: "vertical",

        //     shadeIntensity: 1,

        //     inverseColors: !1,

        //     opacityFrom: .30,

        //     opacityTo: .05,

        //     stops: [100, 100]

        // }

      },

      series: [{

        name: 'Sales',

        data: [

            @foreach($day_wise as $dwise)

            {!! json_encode($dwise['price']) !!},

            @endforeach

        ]

      }],

      labels: ['1', '2', '3', '4', '5', '6', '7'],

      yaxis: {

        min: 0

      },

      grid: {

        padding: {

          top: 125,

          right: 0,

          bottom: 0,

          left: 0

        }, 

      },

      tooltip: {

        x: {

          show: false,

        },

        theme: Theme

      },

      colors: ['#00ab55']

    }

    

    /*

        =================================

            Revenue Monthly | Options

        =================================

    */

    var options1 = {

      chart: {

        fontFamily: 'Nunito, sans-serif',

        height: 365,

        type: 'area',

        zoom: {

            enabled: false

        },

        dropShadow: {

          enabled: true,

          opacity: 0.2,

          blur: 10,

          left: -7,

          top: 22

        },

        toolbar: {

          show: false

        },

      },

      colors: ['#1b55e2', '#e7515a'],

      dataLabels: {

          enabled: false

      },

      markers: {

        discrete: [{

        seriesIndex: 0,

        dataPointIndex: 7,

        fillColor: '#000',

        strokeColor: '#000',

        size: 5

      }, {

        seriesIndex: 2,

        dataPointIndex: 11,

        fillColor: '#000',

        strokeColor: '#000',

        size: 4

      }]

      },

      subtitle: {

        text: {!! json_encode($total_sale / 1000 .'K') !!},

        align: 'left',

        margin: 0,

        offsetX: 100,

        offsetY: 0,

        floating: false,

        style: {

          fontSize: '18px',

          color:  '#4361ee'

        }

      },

      title: {

        text: 'Total Sales',

        align: 'left',

        margin: 0,

        offsetX: -10,

        offsetY: 0,

        floating: false,

        style: {

          fontSize: '18px',

          color:  '#0e1726'

        },

      },

      stroke: {

          show: true,

          curve: 'smooth',

          width: 2,

          lineCap: 'square'

      },

      series: [{

          name: 'Sales',

          data: [ 

            @foreach($total_amount as $tamount)

            {!! json_encode($tamount[0]['price']) !!},

            @endforeach

        ]

      }],

      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

      xaxis: {

        axisBorder: {

          show: false

        },

        axisTicks: {

          show: false

        },

        crosshairs: {

          show: true

        },

        labels: {

          offsetX: 0,

          offsetY: 5,

          style: {

              fontSize: '12px',

              fontFamily: 'Nunito, sans-serif',

              cssClass: 'apexcharts-xaxis-title',

          },

        }

      },

      yaxis: {

        labels: {

          formatter: function(value, index) {

            return (value / 1000) + 'K'

          },

          offsetX: -15,

          offsetY: 0,

          style: {

              fontSize: '12px',

              fontFamily: 'Nunito, sans-serif',

              cssClass: 'apexcharts-yaxis-title',

          },

        }

      },

      grid: {

        borderColor: '#e0e6ed',

        strokeDashArray: 5,

        xaxis: {

            lines: {

                show: true

            }

        },   

        yaxis: {

            lines: {

                show: false,

            }

        },

        padding: {

          top: -50,

          right: 0,

          bottom: 0,

          left: 5

        },

      }, 

      legend: {

        position: 'top',

        horizontalAlign: 'right',

        offsetY: -50,

        fontSize: '16px',

        fontFamily: 'Quicksand, sans-serif',

        markers: {

          width: 10,

          height: 10,

          strokeWidth: 0,

          strokeColor: '#fff',

          fillColors: undefined,

          radius: 12,

          onClick: undefined,

          offsetX: -5,

          offsetY: 0

        },    

        itemMargin: {

          horizontal: 10,

          vertical: 20

        }

        

      },

      tooltip: {

        theme: Theme,

        marker: {

          show: true,

        },

        x: {

          show: false,

        }

      },

      fill: {

          type:"gradient",

          gradient: {

              type: "vertical",

              shadeIntensity: 1,

              inverseColors: !1,

              opacityFrom: .19,

              opacityTo: .05,

              stops: [100, 100]

          }

      },

      responsive: [{

        breakpoint: 575,

        options: {

          legend: {

              offsetY: -50,

          },

        },

      }]

    }

    

    /*

        ==================================

            Sales By Category | Options

        ==================================

    */

    var options = {

        chart: {

            type: 'donut',

            width: 370,

            height: 430

        },

        colors: ['#622bd7', '#e2a03f', '#e7515a', '#e2a03f'],

        dataLabels: {

          enabled: false

        },

        legend: {

            position: 'bottom',

            horizontalAlign: 'center',

            fontSize: '14px',

            markers: {

              width: 10,

              height: 10,

              offsetX: -5,

              offsetY: 0

            },

            itemMargin: {

              horizontal: 10,

              vertical: 30

            }

        },

        plotOptions: {

          pie: {

            donut: {

              size: '75%',

              background: 'transparent',

              labels: {

                show: true,

                name: {

                  show: true,

                  fontSize: '29px',

                  fontFamily: 'Nunito, sans-serif',

                  color: undefined,

                  offsetY: -10

                },

                value: {

                  show: true,

                  fontSize: '26px',

                  fontFamily: 'Nunito, sans-serif',

                  color: '#0e1726',

                  offsetY: 16,

                  formatter: function (val) {

                    return val

                  }

                },

                total: {

                  show: true,

                  showAlways: true,

                  label: 'Total',

                  color: '#888ea8',

                  formatter: function (w) {

                    return w.globals.seriesTotals.reduce( function(a, b) {

                      return a + b

                    }, 0)

                  }

                }

              }

            }

          }

        },

        stroke: {

          show: true,

          width: 15,

          colors: '#fff'

        },

        series: [{{$tsales[0]['price'] }}, {{ $tsales_return[0]['price'] }}],

        labels: ['Sales', 'Return'],

  

        responsive: [

          { 

            breakpoint: 1440, options: {

              chart: {

                width: 325

              },

            }

          },

          { 

            breakpoint: 1199, options: {

              chart: {

                width: 380

              },

            }

          },

          { 

            breakpoint: 575, options: {

              chart: {

                width: 320

              },

            }

          },

        ],

    }

  }

  



/**

    ==============================

    |    @Render Charts Script    |

    ==============================

*/





/*

    ============================

        Daily Sales | Render

    ============================

*/

var d_2C_1 = new ApexCharts(document.querySelector("#daily-sales"), d_2options1);

d_2C_1.render();



/*

    ============================

        Total Orders | Render

    ============================

*/

var d_2C_2 = new ApexCharts(document.querySelector("#total-orders"), d_2options2);

d_2C_2.render();



/*

    ================================

        Revenue Monthly | Render

    ================================

*/

var chart1 = new ApexCharts(

    document.querySelector("#revenueMonthly"),

    options1

);



chart1.render();



/*

    =================================

        Sales By Category | Render

    =================================

*/

var chart = new ApexCharts(

    document.querySelector("#chart-2"),

    options

);



chart.render();



/*

    =============================================

        Perfect Scrollbar | Recent Activities

    =============================================

*/

const ps = new PerfectScrollbar(document.querySelector('.mt-container-ra'));



// const topSellingProduct = new PerfectScrollbar('.widget-table-three .table-scroll table', {

//   wheelSpeed:.5,

//   swipeEasing:!0,

//   minScrollbarLength:40,

//   maxScrollbarLength:100,

//   suppressScrollY: true



// });











/**

   * =================================================================================================

   * |     @Re_Render | Re render all the necessary JS when clicked to switch/toggle theme           |

   * =================================================================================================

   */



document.querySelector('.theme-toggle').addEventListener('click', function() {



  // console.log(localStorage);



  getcorkThemeObject = localStorage.getItem("theme");

  getParseObject = JSON.parse(getcorkThemeObject)

  ParsedObject = getParseObject;



  if (ParsedObject.settings.layout.darkMode) {



    /*

    =================================

        Revenue Monthly | Options

    =================================

  */



    chart1.updateOptions({

      colors: ['#e7515a', '#2196f3'],

      subtitle: {

        style: {

          color:  '#00ab55'

        }

      },

      title: {

        style: {

          color:  '#bfc9d4'

        }

      },

      grid: {

        borderColor: '#191e3a',

      }

    })





    /*

    ==================================

        Sales By Category | Options

    ==================================

    */



    chart.updateOptions({

      stroke: {

        colors: '#0e1726'

      },

      plotOptions: {

        pie: {

          donut: {

            labels: {

              value: {

                color: '#bfc9d4'

              }

            }

          }

        }

      }

    })





    /*

        =============================

            Total Orders | Options

        =============================

    */



    d_2C_2.updateOptions({

      fill: {

        type:"gradient",

        gradient: {

            type: "vertical",

            shadeIntensity: 1,

            inverseColors: !1,

            opacityFrom: .30,

            opacityTo: .05,

            stops: [100, 100]

        }

      }

    })



  } else {



    /*

    =================================

        Revenue Monthly | Options

    =================================

  */



    chart1.updateOptions({

      colors: ['#1b55e2', '#e7515a'],

      subtitle: {

        style: {

          color:  '#4361ee'

        }

      },

      title: {

        style: {

          color:  '#0e1726'

        }

      },

      grid: {

        borderColor: '#e0e6ed',

      }

    })





    /*

    ==================================

        Sales By Category | Options

    ==================================

    */



    chart.updateOptions({

      stroke: {

        colors: '#fff'

      },

      plotOptions: {

        pie: {

          donut: {

            labels: {

              value: {

                color: '#0e1726'

              }

            }

          }

        }

      }

    })





    /*

        =============================

            Total Orders | Options

        =============================

    */



    d_2C_2.updateOptions({

      fill: {

        type:"gradient",

        opacity: 0.9,

        gradient: {

            type: "vertical",

            shadeIntensity: 1,

            inverseColors: !1,

            opacityFrom: .45,

            opacityTo: 0.1,

            stops: [100, 100]

        }

      }

    })

    

    

  }



})





} catch(e) {

    console.log(e);

}



})

</script>

