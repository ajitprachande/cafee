// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Check if sidebar exists
    const sidebar = document.querySelector('.sidebar');
    
    // If there's no sidebar, don't add the toggle
    if (!sidebar) return;
    
    // Create toggle button if it doesn't exist
    let toggleBtn = document.querySelector('.sidebar-toggle');
    if (!toggleBtn) {
        toggleBtn = document.createElement('button');
        toggleBtn.className = 'sidebar-toggle';
        toggleBtn.innerHTML = '<i class="fas fa-bars"></i> Menu';
        document.body.appendChild(toggleBtn);
    }
    
    // Add toggle functionality
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
    
    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && 
            event.target !== toggleBtn && 
            !toggleBtn.contains(event.target) && 
            sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });
    
    // Handle responsive tables
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        if (table.clientWidth > window.innerWidth) {
            const wrapper = document.createElement('div');
            wrapper.style.overflowX = 'auto';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }
    });
    
    // Make sure all buttons in mobile are properly sized
    if (window.innerWidth <= 576) {
        const buttons = document.querySelectorAll('.button, .btn, .btn-primary, .btn-update, .btn-delete');
        buttons.forEach(button => {
            if (button.parentElement.style.display !== 'flex') {
                button.style.width = '100%';
                button.style.marginBottom = '10px';
                button.style.textAlign = 'center';
            }
        });
    }
    
});

// Listen for window resize events to handle responsive behavior
window.addEventListener('resize', function() {
    // Refresh page if crossing major breakpoint (desktop <-> mobile)
    // Optional - can be commented out if causing issues
    /*
    const width = window.innerWidth;
    if ((width > 768 && prevWidth <= 768) || (width <= 768 && prevWidth > 768)) {
        location.reload();
    }
    prevWidth = width;
    */
}); 