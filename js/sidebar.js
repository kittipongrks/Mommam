document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.querySelector('.menu-sidebar');
    const toggleButton = document.querySelector('.toggle-btn');

    toggleButton.addEventListener('click', function () {
        if (sidebar.classList.contains('sidebar-expanded')) {
            sidebar.classList.remove('sidebar-expanded');
            sidebar.classList.add('sidebar-collapsed');
        } else {
            sidebar.classList.remove('sidebar-collapsed');
            sidebar.classList.add('sidebar-expanded');
        }
    });
});
