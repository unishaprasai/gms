<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="Backend/assets/images/faces/face15.jpg" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
            <span>Gold Member</span>
          </div>
        </div>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('home') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-account"></i>
        </span>
        <span class="menu-title">Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">View Users</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Add Users</a></li>

        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic-members" aria-expanded="false"
        aria-controls="ui-basic-members" onclick="toggleMembersSubMenu()">
        <span class="menu-icon">
          <i class="mdi mdi-account-group"></i>
        </span>
        <span class="menu-title">Members</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic-members">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ url('view_members') }}">View Members</a></li>


          <!-- <li class="nav-item"> <a class="nav-link" href="{{url('add_members')}}">Add Members</a></li> -->
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic-trainers" aria-expanded="false"
        aria-controls="ui-basic-trainers" onclick="toggleTrainersSubMenu()">
        <span class="menu-icon">
          <i class="mdi mdi-account-supervisor"></i>
        </span>
        <span class="menu-title">Trainers</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic-trainers">
        <ul class="nav flex-column sub-menu">
          <!-- <li class="nav-item"> <a class="nav-link" href="{{url('view_trainer')}}">View Trainers</a></li> -->
          <!-- <li class="nav-item"> <a class="nav-link" href="{{url('add_trainer')}}">Add Trainers</a></li> -->
        </ul>
      </div>
    </li>


    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic-packages" aria-expanded="false"
        aria-controls="ui-basic-packages" onclick="togglePackagesSubMenu()">
        <span class="menu-icon">
          <i class="mdi mdi-package"></i>
        </span>
        <span class="menu-title">Packages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic-packages">
        <ul class="nav flex-column sub-menu">
          <!-- <li class="nav-item"> <a class="nav-link" href="{{url('view_package')}}">View Packages</a></li> -->
          <!-- <li class="nav-item"> <a class="nav-link" href="{{url('add_package')}}">Add Packages</a></li> -->
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic-schedule" aria-expanded="false"
        aria-controls="ui-basic-schedule" onclick="toggleScheduleSubMenu()">
        <span class="menu-icon">
          <i class="mdi mdi-calendar-clock"></i>
        </span>
        <span class="menu-title">Schedule</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic-schedule">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">View Schedule</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Add Schedule</a></li>
        </ul>
      </div>
    </li>


    <li class="nav-item menu-items">
      <a class="nav-link" href="index.html">
        <span class="menu-icon">
          <i class="mdi mdi-account-check"></i>
        </span>
        <span class="menu-title">Attendance</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="index.html">
        <span class="menu-icon">
          <i class="mdi mdi-currency-usd"></i>
        </span>
        <span class="menu-title">Payment</span>
      </a>
    </li>


  </ul>
</nav>