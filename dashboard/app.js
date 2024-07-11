document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu li:not(.logout)'); // Exclude logout button from selection

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const page = item.getAttribute('data-page');
            loadContent(page);

            // Highlight the active menu item
            menuItems.forEach(menuItem => menuItem.classList.remove('active'));
            item.classList.add('active');
        });
    });

    function loadContent(page) {
        const content = document.getElementById('content');
    
        // Apply fade-out class immediately
        content.classList.add('fade-out');
    
        // Fetch new content
        fetch(`${page}.php`)
            .then(response => response.text())
            .then(data => {
                // Update content with new HTML
                content.innerHTML = data;
    
                // Clean up: Remove fade-out class and add fade-in class for transition
                setTimeout(() => {
                    content.classList.remove('fade-out');
                    content.classList.add('fade-in');
                }, 100); // Adjust delay as needed for optimal transition
    
            })
            .catch(error => console.error('Error loading content:', error));
    }
    
    // Load the initial page
    loadContent('dashboard');
});
