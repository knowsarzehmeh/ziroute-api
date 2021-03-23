  <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        

        <li  {{{ (Request::is('dashboard') ? 'class=active' : '') }}}  >
          <a href="{{route('user.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
<!--              <small class="label pull-right bg-green">new</small>-->
            </span>
          </a>
        </li>
      





 
   
        <li   {{{ (Request::is('adddrivers') || Request::is('managedrivers') ? 'class=active treeview' : 'class=treeview') }}}   
      >
          <a href="#">
            <i class="fa fa-list"></i> <span>Drivers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <!--  <li><a href="{{route('form.adddrivers')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
            -->

            
            <li><a href="{{route('view.managedrivers')}}"><i class="fa fa-circle-o"></i> Manage</a></li>
          
          </ul>
        </li>

        <li   {{{ (Request::is('addvehicles') || Request::is('managevehicles') ? 'class=active treeview' : 'class=treeview') }}}   
      >
          <a href="#">
            <i class="fa fa-car"></i> <span>Vehicles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <!--  <li><a href="{{route('form.addvehicles')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
           -->
            <li><a href="{{route('view.managevehicles')}}"><i class="fa fa-circle-o"></i> Manage</a></li>
          
          </ul>
        </li>
 


        <li    
      >
          <a href="#">
            <i class="fa fa-money"></i> <span>Finance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="#"><i class="fa fa-circle-o"></i> Manage</a></li>
          
          </ul>
        </li>

       <li    
      >
          <a href="#">
            <i class="fa fa-history"></i> <span>Trips History</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="#"><i class="fa fa-circle-o"></i> Manage</a></li>
          
          </ul>
        </li>

            <li    
      >
          <a href="{{route('user.logout')}}">
            <i class="fa fa-log-out"></i> <span>Log out</span>
          
          </a>
          
        </li>



   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>