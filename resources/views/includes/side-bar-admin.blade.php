<!-- resources/views/includes/sidebar.blade.php -->
<aside id="sidebar" class="js-sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#">Admin Dashboard</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">Navigation Sidebar</li>
            <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}" class="sidebar-link">
                    <i class="fa-solid fa-list pe-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ url('verify_restaurant') }}" class="sidebar-link">
                    <i class="fa-solid fa-comment-dollar pe-2"></i>
                    Verify Restaurant
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ url('data_customer') }}" class="sidebar-link">
                    <i class="fa-solid fa-user pe-2"></i>
                    List of Users
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('list_food') ? 'active' : '' }}">
    <a href="{{ url('list_food') }}" class="sidebar-link">
        <i class="fa-solid fa-utensils pe-2"></i>
        List of all Food
    </a>
</li>


                                    <!-- Lien vers EvenementCollecte -->
                                    <li class="sidebar-item {{ Request::is('evenement-collecte*') ? 'active' : '' }}">
                <a href="{{ url('evenement-collecte') }}" class="sidebar-link">
                    <i class="fa-solid fa-calendar pe-2"></i>
                    Collection Event
                </a>
            </li>

            <!-- Lien vers Notification -->
            <li class="sidebar-item {{ Request::is('notification*') ? 'active' : '' }}">
                <a href="{{ url('notification') }}" class="sidebar-link">
                    <i class="fa-solid fa-bell pe-2"></i>
                    Notifications
                </a>
            </li>

<li class="sidebar-item {{ Request::is('admin/list_demandes') ? 'active' : '' }}">
    <a href="{{ url('admin/list_demandes') }}" class="sidebar-link">
        <i class="fa-solid fa-folder pe-2"></i>
        List Demands
    </a>
</li>
<li class="sidebar-item">
    <a href="{{ route('stockss.index') }}" class="sidebar-link">
        <i class="fa-solid fa-newspaper pe-2"></i>
        Stock
    </a>
</li>
<li class="sidebar-item {{ Request::is('admin/statistics') ? 'active' : '' }}">
    <a href="{{ url('admin/statistics') }}" class="sidebar-link">
        <i class="fa-solid fa-chart-line pe-2"></i>
        Partners Food Statistics
    </a>
</li>
<li class="sidebar-item">
    <a href="{{ route('categories.index') }}" class="sidebar-link">
        <i class="fa-solid fa-newspaper pe-2"></i>
        Categories
    </a>
</li>

        </ul>
    </div>
</aside>