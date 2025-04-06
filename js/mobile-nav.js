/**
 * Mobile Navigation Enhancement Script
 * This script improves mobile navigation behavior
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get navigation elements
    const menuBtn = document.querySelector('.menu_btn');
    const closeBtn = document.querySelector('.close_btn');
    const clickCheckbox = document.getElementById('click');
    const nav = document.querySelector('nav');
    const header = document.querySelector('header');
    const navItems = document.querySelectorAll('nav ul li a');
    
    // Fix potential z-index issues
    if (header) {
        header.style.zIndex = '100';
    }
    
    // Ensure the menu toggle works
    if (menuBtn && closeBtn && clickCheckbox) {
        // Force-fix the menu button display
        menuBtn.style.display = 'block';
        closeBtn.style.display = 'none';
        
        // Add redundant event listeners for the menu buttons
        menuBtn.addEventListener('click', function(e) {
            clickCheckbox.checked = true;
            menuBtn.style.display = 'none';
            closeBtn.style.display = 'block';
            e.stopPropagation();
        });
        
        closeBtn.addEventListener('click', function(e) {
            clickCheckbox.checked = false;
            menuBtn.style.display = 'block';
            closeBtn.style.display = 'none';
            e.stopPropagation();
        });
    }
    
    // Close menu when clicking on a navigation item
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            clickCheckbox.checked = false;
            if (menuBtn && closeBtn) {
                menuBtn.style.display = 'block';
                closeBtn.style.display = 'none';
            }
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const isInsideNav = nav && nav.contains(e.target);
        const isMenuBtn = menuBtn && menuBtn.contains(e.target);
        const isCloseBtn = closeBtn && closeBtn.contains(e.target);
        
        if (!isInsideNav && !isMenuBtn && !isCloseBtn && clickCheckbox && clickCheckbox.checked) {
            clickCheckbox.checked = false;
            if (menuBtn && closeBtn) {
                menuBtn.style.display = 'block';
                closeBtn.style.display = 'none';
            }
        }
    });
    
    // Add a specific iOS fix
    if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
        // iOS sometimes has issues with position: fixed
        if (header) {
            header.style.position = 'absolute';
        }
        
        // Add smooth scrolling fix for iOS
        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                if (this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        setTimeout(() => {
                            window.scrollTo({
                                top: targetElement.offsetTop - header.offsetHeight,
                                behavior: 'smooth'
                            });
                        }, 300);
                    }
                }
            });
        });
    }
}); 