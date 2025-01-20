// $(document).ready(function() {
//     $('.table').DataTable();
// });

// Toggle sidebar visibility when clicking on the bi-list icon
document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
});

// Close sidebar when clicking on the overlay
document.getElementById('overlay').addEventListener('click', function() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('active');
});