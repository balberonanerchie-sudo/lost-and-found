<div class="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-compass"></i>
        <span>weFind</span>
    </div>

    <div class="sidebar-menu">
        <ul>
            <li><a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a class="nav-link {{ request()->is('admin/manage-item') ? 'active' : '' }}" href="{{ route('admin.manageItem') }}"><i class="far fa-folder-open"></i><span>Manage Item</span></a></li>
            <li><a class="nav-link {{ request()->is('admin/manage-user') ? 'active' : '' }}" href="{{ route('admin.manageUser') }}"><i class="fas fa-user-alt"></i><span>Manage User</span></a></li>
            <li><a class="nav-link {{ request()->is('admin/check-appointment') ? 'active' : '' }}" href="{{ route('admin.checkAppointment') }}"><i class="far fa-calendar-check"></i><span>Appointment</span></a></li>
        </ul>
    </div>
</div>