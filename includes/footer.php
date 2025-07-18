        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
// Sidebar toggle functionality
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');
const sidebarToggle = document.getElementById('sidebarToggle'); // Desktop toggle
const sidebarToggleMobile = document.getElementById('sidebarToggleMobile'); // Mobile toggle

function toggleSidebar() {
    const backdrop = document.getElementById('sidebar-backdrop');
    if (window.innerWidth <= 768) {
        // Mobile behavior: overlay
        sidebar.classList.toggle('show');
        document.body.classList.toggle('sidebar-open-mobile');

        if (!backdrop) {
            // Create backdrop if it doesn't exist
            const newBackdrop = document.createElement('div');
            newBackdrop.id = 'sidebar-backdrop';
            newBackdrop.classList.add('sidebar-backdrop');
            document.body.appendChild(newBackdrop);
            newBackdrop.addEventListener('click', toggleSidebar);
            newBackdrop.classList.add('show');
        } else {
            backdrop.classList.toggle('show');
        }
    } else {
        // Desktop behavior: collapse/expand
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('shifted');
    }
}

// Event listeners for toggle buttons
if (sidebarToggle) {
    sidebarToggle.addEventListener('click', toggleSidebar);
}
if (sidebarToggleMobile) {
    sidebarToggleMobile.addEventListener('click', toggleSidebar);
}

// Initial check and resize handling
function checkLayoutOnResize() {
    const backdrop = document.getElementById('sidebar-backdrop');
    if (window.innerWidth <= 768) {
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('shifted');
        if (sidebar.classList.contains('show')) {
            if (!backdrop) {
                const newBackdrop = document.createElement('div');
                newBackdrop.id = 'sidebar-backdrop';
                newBackdrop.classList.add('sidebar-backdrop');
                document.body.appendChild(newBackdrop);
                newBackdrop.addEventListener('click', toggleSidebar);
                newBackdrop.classList.add('show');
            } else {
                backdrop.classList.add('show');
            }
            document.body.classList.add('sidebar-open-mobile');
        } else {
            if (backdrop) {
                backdrop.classList.remove('show');
            }
            document.body.classList.remove('sidebar-open-mobile');
        }
    } else {
        sidebar.classList.remove('show');
        document.body.classList.remove('sidebar-open-mobile');
        if (backdrop) {
            backdrop.classList.remove('show');
        }
    }
}

// Run on load and resize
window.addEventListener('load', checkLayoutOnResize);
window.addEventListener('resize', checkLayoutOnResize);

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true
});
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
        </script>
        </body>

        </html>