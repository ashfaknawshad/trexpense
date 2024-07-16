document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu li');
    const content = document.getElementById('content');
    const modal = document.getElementById('myModal');

    // Function to load content
    function loadContent(page) {
        fetch(`pages/${page}.php`)
            .then(response => response.text())
            .then(data => {
                content.innerHTML = data;

                // Attach modal event listeners after content is loaded
                handleModal();
            })
            .catch(error => console.error('Error loading content:', error));
    }

    // Event listener for menu items
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            const page = this.getAttribute('data-page');
            loadContent(page);

            // Highlight the active menu item
            menuItems.forEach(menuItem => menuItem.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Load initial content
    loadContent('dashboard');

    // Handle modal functionality
    function handleModal() {
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.querySelector('.close');

        if (openModalBtn && closeModalBtn) {
            openModalBtn.addEventListener('click', function() {
                modal.style.display = 'block';
            });

            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        } else {
            console.warn('Modal elements not found.');
        }
    }

    // Attach initial modal event listeners if present in initial content
    handleModal();
});
