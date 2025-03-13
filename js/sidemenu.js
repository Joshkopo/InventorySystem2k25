document.addEventListener('DOMContentLoaded', function() {
    // Variables
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebarMenuItems = document.querySelectorAll('.sidebar-menu-item');
    const sidebarSubmenuItems = document.querySelectorAll('.sidebar-submenu-item');
    const pages = document.querySelectorAll('.page');
    const content = document.getElementById('content');

    // Toggle sidebar
    toggleSidebar.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    });

    // Handle sidebar menu items with submenus
    sidebarMenuItems.forEach(item => {
        const submenuId = item.getAttribute('data-submenu');
        if (submenuId) {
            const submenu = document.getElementById(submenuId + '-submenu');
            item.addEventListener('click', function() {
                // Toggle submenu visibility
                const isActive = submenu.classList.contains('active');
                // Close all submenus
                document.querySelectorAll('.sidebar-submenu').forEach(sub => {
                    sub.classList.remove('active');
                    sub.style.height = '0';
                });
                // Toggle clicked submenu
                if (!isActive) {
                    submenu.classList.add('active');
                    submenu.style.height = submenu.scrollHeight + 'px';
                }
                // Update active state for main menu item
                sidebarMenuItems.forEach(menuItem => {
                    menuItem.classList.remove('active');
                });
                item.classList.add('active');
            });

            // Check if "Borrowing Management" is active on load and expand if necessary
            if (submenuId === 'borrowing' && item.classList.contains('active')) {
                submenu.classList.add('active');
                submenu.style.height = submenu.scrollHeight + 'px';
            }
        } else {
            // Handle direct links
            const pageId = item.getAttribute('data-page');
            if (pageId) {
                item.addEventListener('click', function() {
                    // Hide all pages
                    pages.forEach(page => {
                        page.style.display = 'none';
                    });
                    // Show selected page
                    document.getElementById(pageId).style.display = 'block';
                    // Update active state
                    sidebarMenuItems.forEach(menuItem => {
                        menuItem.classList.remove('active');
                    });
                    sidebarSubmenuItems.forEach(submenuItem => {
                        submenuItem.classList.remove('active');
                    });
                    item.classList.add('active');
                    // Close sidebar on mobile
                    if (window.innerWidth <= 768) {
                        sidebar.classList.add('collapsed');
                        mainContent.classList.add('expanded');
                    }
                });
            }
        }
    });

    // Handle submenu items
    sidebarSubmenuItems.forEach(item => {
        const pageId = item.getAttribute('data-page');
        if (pageId) {
            item.addEventListener('click', function() {
                // Hide all pages
                pages.forEach(page => {
                    page.style.display = 'none';
                });
                // Show selected page
                document.getElementById(pageId).style.display = 'block';
                // Update active state for submenu item
                sidebarSubmenuItems.forEach(submenuItem => {
                    submenuItem.classList.remove('active');
                });
                item.classList.add('active');
                // Update active state for parent menu item
                const parentMenuItem = item.closest('.sidebar-menu-item');
                if (parentMenuItem) {
                    sidebarMenuItems.forEach(menuItem => {
                        menuItem.classList.remove('active');
                    });
                    parentMenuItem.classList.add('active');
                }
                // Close sidebar on mobile
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            });
        }
    });

    // Handle responsive behavior
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        }
    });

    // Initialize responsive behavior
    if (window.innerWidth <= 768) {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
    }

    // Automatically expand "Borrowing Management" submenu if it's active by default
    const borrowingSubmenu = document.getElementById('borrowing-submenu');
    const borrowingMenuItem = document.querySelector('.sidebar-menu-item[data-submenu="borrowing"]');
    if (borrowingMenuItem && borrowingMenuItem.classList.contains('active')) {
        borrowingSubmenu.classList.add('active');
        borrowingSubmenu.style.height = borrowingSubmenu.scrollHeight + 'px';
    }
});
