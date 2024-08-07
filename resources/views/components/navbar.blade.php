<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="mr-auto form-inline">
    <ul class="mr-3 navbar-nav">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
      </li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <!--
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="text-white dropdown-item-icon bg-primary">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Template update is available now!
                            <div class="time text-primary">2 Min Ago</div>
                        </div>
                    </a>
                </div>
                <div class="text-center dropdown-footer">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        -->
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="{{ 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
          class="mr-1 rounded-circle">
        <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">{{ auth()->user()->office->name }}</div>
        <a href="{{ route('app.profile.index') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profil Saya
        </a>
        <!--
                <a href="#" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="#" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="#" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                -->
        <div class="dropdown-divider"></div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <a class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); this.closest('form').submit()">
            <i class="mb-1 fas fa-sign-out-alt"></i> Logout
          </a>
        </form>
      </div>
    </li>
  </ul>
</nav>
