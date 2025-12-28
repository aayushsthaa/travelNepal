<?php
// Admin Navigation Sidebar Component
// Maintains consistent navigation across all admin pages

$current_page = $_SERVER['REQUEST_URI'] ?? '';
$is_dashboard = str_contains($current_page, '/admin/dashboard');
$is_post_create = str_contains($current_page, '/admin/post/create');
$is_post_edit = str_contains($current_page, '/admin/post/edit');
$is_change_password = str_contains($current_page, '/admin/change-password');
?>

<!-- Admin Sidebar -->
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl border-r border-mountain-200 transform transition-transform duration-300 ease-in-out" id="admin-sidebar">
    <div class="flex flex-col h-full">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-nepal-500 to-nepal-600">
            <div class="flex items-center">
                <img src="<?php echo SITE_URL; ?>/assets/images/logo.svg" alt="logo" class="w-20 h-20 bg-white rounded-full">
                <div>
                    <h2 class="text-white font-display font-bold text-lg">Admin Panel</h2>
                </div>
            </div>
            <button onclick="toggleSidebar()" class="lg:hidden text-white hover:text-nepal-200 transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <!-- Dashboard -->
            <a href="<?php echo siteUrl('admin/dashboard'); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $is_dashboard ? 'bg-nepal-50 text-nepal-700 border-l-4 border-nepal-500' : 'text-mountain-700 hover:bg-mountain-50 hover:text-nepal-600'; ?>">
                <i class="fas fa-tachometer-alt mr-3 w-5"></i>
                Dashboard
            </a>

            <!-- Blog Posts Section -->
            <div class="pt-4">
                <h3 class="px-4 text-xs font-semibold text-mountain-500 uppercase tracking-wider mb-2">Blog Management</h3>
                
                <!-- Create New Post -->
                <a href="<?php echo siteUrl('admin/post/create'); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $is_post_create ? 'bg-nepal-50 text-nepal-700 border-l-4 border-nepal-500' : 'text-mountain-700 hover:bg-mountain-50 hover:text-nepal-600'; ?>">
                    <i class="fas fa-plus mr-3 w-5"></i>
                    New Post
                </a>

                <!-- Manage Posts -->
                <a href="<?php echo siteUrl('admin/dashboard'); ?>#posts" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo ($is_dashboard || $is_post_edit) ? 'bg-mountain-50 text-nepal-600' : 'text-mountain-700 hover:bg-mountain-50 hover:text-nepal-600'; ?>">
                    <i class="fas fa-file-alt mr-3 w-5"></i>
                    Manage Posts
                </a>

                <!-- Categories -->
                <a href="<?php echo siteUrl('admin/dashboard'); ?>#categories" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors text-mountain-700 hover:bg-mountain-50 hover:text-nepal-600">
                    <i class="fas fa-tags mr-3 w-5"></i>
                    Categories
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="pt-4">
                <h3 class="px-4 text-xs font-semibold text-mountain-500 uppercase tracking-wider mb-2">Quick Actions</h3>
                
                <!-- View Site -->
                <a href="<?php echo siteUrl(); ?>" target="_blank" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors text-mountain-700 hover:bg-mountain-50 hover:text-nepal-600">
                    <i class="fas fa-external-link-alt mr-3 w-5"></i>
                    View Site
                </a>

                <!-- Blog Posts -->
                <a href="<?php echo siteUrl('blog'); ?>" target="_blank" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors text-mountain-700 hover:bg-mountain-50 hover:text-nepal-600">
                    <i class="fas fa-blog mr-3 w-5"></i>
                    View Blog
                </a>
            </div>
        </nav>

        <!-- User Section -->
        <div class="border-t border-mountain-200 p-4">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-gradient-to-br from-nepal-500 to-nepal-600 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-mountain-900">Admin User</p>
                    <p class="text-xs text-mountain-500">travelNepal Admin</p>
                </div>
            </div>
            
            <!-- Change Password -->
            <a href="<?php echo siteUrl('admin/change-password'); ?>" class="flex items-center w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors mb-2 <?php echo $is_change_password ? 'bg-nepal-50 text-nepal-700 border-l-4 border-nepal-500' : 'text-mountain-700 hover:bg-mountain-50 hover:text-nepal-600'; ?>">
                <i class="fas fa-key mr-3 w-5"></i>
                Change Password
            </a>
            
            <!-- Logout -->
            <a href="<?php echo siteUrl('admin/logout'); ?>" class="flex items-center w-full px-4 py-3 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                <i class="fas fa-sign-out-alt mr-3 w-5"></i>
                Logout
            </a>
        </div>
    </div>
</div>

<!-- Mobile Sidebar Overlay -->
<div class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden" id="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Mobile Sidebar Toggle Button -->
<button onclick="toggleSidebar()" class="fixed top-4 left-4 z-60 lg:hidden bg-nepal-600 text-white p-3 rounded-lg shadow-lg hover:bg-nepal-700 transition-colors">
    <i class="fas fa-bars text-lg"></i>
</button>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    
    if (window.innerWidth >= 1024) {
        // Toggle sidebar on desktop
        sidebar.classList.toggle('-translate-x-full');
    } else {
        // Toggle sidebar on mobile (with overlay)
        const isHidden = sidebar.classList.contains('-translate-x-full');
        
        if (isHidden) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }
    }
}

// Close sidebar on mobile after navigation
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('#admin-sidebar a[href]');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 1024) {
                toggleSidebar();
            }
        });
    });
    
    // Initialize sidebar hidden on mobile
    if (window.innerWidth < 1024) {
        document.getElementById('admin-sidebar').classList.add('-translate-x-full');
    }
});

window.addEventListener('resize', function() {
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    
    if (window.innerWidth >= 1024) {
        // Desktop: ensure sidebar visible and overlay hidden
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
    } else {
        // Mobile: ensure sidebar hidden
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
    }
});
</script>