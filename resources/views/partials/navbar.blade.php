<header class="top-navbar">
    <div class="navbar-content">
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <div class="navbar-actions">
            <div class="user-profile" data-bs-toggle="modal" data-bs-target="#accountModal" style="cursor: pointer;">
                <div class="user-avatar">AD</div>
                <div class="user-info">
                    <h6>Admin User</h6>
                    <p>Administrator</p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Account Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-end">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountModalLabel">Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="user-profile mb-3">
                    <div class="user-avatar">AD</div>
                    <div class="user-info">
                        <h6>Admin User</h6>
                        <p>Administrator</p>
                    </div>
                </div>
                <hr>
                <p class="mb-1"><strong>Email:</strong> admin@wefind.com</p>
                <p class="mb-0"><strong>Role:</strong> Admin</p>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
