<div class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-flex">
      <i class="bi bi-compass"></i>
      <span>weFind</span>
    </div>
  </div>

  <div class="sidebar-user">
    <i class="fas fa-user-circle fa-3x"></i>
    <h3>Nerelie Balberona</h3>
    <span>balberonanere@gmail.com</span>
  </div>

  <div class="sidebar-menu">
    <ul>
      <li><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
      <li><a class="nav-link" href="{{ url('/manage-item') }}"><i class="far fa-folder-open"></i> Manage Item</a></li>
      <li><a class="nav-link" href="{{ url('/manage-user') }}"><i class="fas fa-user-alt"></i> Manage User</a></li>
      <li><a class="nav-link" href="{{ url('/check-appointment') }}"><i class="far fa-calendar-check"></i> Check Appointment</a>
      </li>
      <li><a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>
  </div>
</div>