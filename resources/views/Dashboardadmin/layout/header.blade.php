  <!-- top navigation -->
  
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{Session::get('Logo')}}" alt="">{{Session::get('username')}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                 <!--    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li> -->
                    <li><a href="/Home"><i class="fa fa-sign-out pull-right"></i> تسجيل خروج</a></li>
                  </ul>
                </li>

               <!--  <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <span class="badge bg-red" id="Notify"></span>
                    <i class="fa fa-bullhorn" style="font-size: 2em; padding-top: 10px"></i>
                   
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                                  <li>
                      <a>
                      
                        <span class="message">
                          أضغط لمعرفة الاصناف التى قاربت على الانتهاء
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                        <i class="fa fa-angle-left"></i>
                          <strong><a href="/MinLimtItems">عرض كل الاصناف</a></strong>
                          
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->

                <!--  <li role="presentation" class="dropdown" id="noti_Container">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" >
                  <span class="badge bg-orange"  id="noti_Counter"></span>
                    <i class="fa fa-inbox" style="font-size: 2em; padding-top: 10px"></i>
                   
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                      <a>
                      
                          <div id="noti_Button">
               
                </div>    

                <div id="notifications" >
                  
                    <div style="height:auto;" id="pnotifications">
                   
                    </div>
                   
                </div>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                        <i class="fa fa-angle-left"></i>
                          <strong><a href="#">No Notifications Else</a></strong>
                          
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
   
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->