@extends('DashbordAdminPanel.layout.master')
@section('content')
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
           <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <!-- <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button> -->
                            <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div> -->
                        <!-- </div> -->
                        <h4 class="mb-0">
                        Total:  <span class="count"><a >{{$Employer}}</a></span>
                        </h4>
                        <h4 class="mb-0">
                        Total/week : <span class="count">{{$Employerweek}}</span>
                        </h4>
                        <a href="/Employeradmin">
                        <p class="text-light">No of Employer</p>
                        </a>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <!-- <div class="dropdown float-right"> -->
                            <!-- <a href="/Candidateadmin" class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown"> -->
                                <!-- <i class="fa fa-cog"></i> -->
<!-- </a> -->
                            <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> -->
                                <!-- <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                        <h4 class="mb-0">
                        total: <span class="count">{{$TotalCandidate}}</a></span>
                        </h4>
                        <h4 class="mb-0">
                        total/week:<span class="count">{{$TotalCandidateweek}}</span>
                        </h4>
                        <a href="/Candidateadmin">
                        <p class="text-light">No of Candidates</p>
                        </a>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <!-- <div class="dropdown float-right"> -->
                            <!-- <a href="/Jobadmin" class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
</a> -->
                            <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div> -->
                        <!-- </div> -->
                        <h4 class="mb-0">
                        total: <span class="count">{{$TotalJob}}</span>
                        </h4>
                        <h4 class="mb-0">
                        total/week:<span class="count">{{$TotalJobweek}}</span>
                        </h4>
                        <a href="/Jobadmin">
                        <p class="text-light">No of Post Job</p>
                        </a>
                    </div>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <!-- <div class="dropdown float-right"> -->
                            <!-- <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button> -->
                            <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div> -->
                        <!-- </div> -->
                        <h4 class="mb-0">
                        Total: <span class="count">{{$Requests}}</span>
                        </h4>
                        <h4 class="mb-0">
                        Total/week: <span class="count">{{$Requestsweek}}</span>
                        </h4>
                        <a href="/Requestsadmin">
                        <p class="text-light">No of requests</p>
                        </a>
                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <!-- <div class="col-lg-3 col-md-6"> -->
                <!-- <div class="social-box facebook"> -->
                    <!-- <i class="fa fa-facebook"></i> -->
                    <!-- <ul>
                        <li>
                            <strong><span class="count">40</span> k</strong>
                            <span>friends</span>
                        </li>
                        <li>
                            <strong><span class="count">450</span></strong>
                            <span>feeds</span>
                        </li>
                    </ul> -->
                <!-- </div> -->
                <!--/social-box-->
            <!-- </div> -->
            <!--/.col-->


            <!-- <div class="col-lg-3 col-md-6"> -->
                <!-- <div class="social-box twitter">
                    <i class="fa fa-twitter"></i>
                    <ul>
                        <li>
                            <strong><span class="count">30</span> k</strong>
                            <span>friends</span>
                        </li>
                        <li>
                            <strong><span class="count">450</span></strong>
                            <span>tweets</span>
                        </li>
                    </ul>
                </div> -->
               
            <!-- </div> -->
            <!--/.col-->


            <!-- <div class="col-lg-3 col-md-6"> -->
                <!-- <div class="social-box linkedin"> -->
                    <!-- <i class="fa fa-linkedin"></i> -->
                    <!-- <ul>
                        <li>
                            <strong><span class="count">40</span> +</strong>
                            <span>contacts</span>
                        </li>
                        <li>
                            <strong><span class="count">250</span></strong>
                            <span>feeds</span>
                        </li>
                    </ul> -->
                <!-- </div> -->
                <!--/social-box-->
            <!-- </div> -->
            <!--/.col-->


            <!-- <div class="col-lg-3 col-md-6"> -->
                <!-- <div class="social-box google-plus"> -->
                    <!-- <i class="fa fa-google-plus"></i> -->
                    <!-- <ul>
                        <li>
                            <strong><span class="count">94</span> k</strong>
                            <span>followers</span>
                        </li>
                        <li>
                            <strong><span class="count">92</span></strong>
                            <span>circles</span>
                        </li>
                    </ul> -->
                <!-- </div> -->
                <!--/social-box-->
            <!-- </div> -->
            <!--/.col-->

         
        


        </div> <!-- .content -->
    </div><!-- /#right-panel -->



@endsection