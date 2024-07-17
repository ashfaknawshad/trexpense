document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu li');
    const content = document.getElementById('content');
    const addModal = document.getElementById('myModal');
    const deleteModal = document.getElementById('deleteModal');

    // Function to load content
    function loadContent(page) {
        fetch(`pages/${page}.php`)
            .then(response => response.text())
            .then(data => {
                content.innerHTML = data;

                // Attach modal event listeners after content is loaded
                handleModals();
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
    function handleModals() {
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = addModal.querySelector('.close');
        const deleteBtns = document.querySelectorAll('.deleteBtn');
        const cancelDeleteBtn = deleteModal.querySelector('#cancelDelete');
        const deleteIdInput = document.getElementById('delete_id');

        if (openModalBtn && closeModalBtn) {
            openModalBtn.addEventListener('click', function() {
                addModal.style.display = 'block';
            });

            closeModalBtn.addEventListener('click', function() {
                addModal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === addModal) {
                    addModal.style.display = 'none';
                }
            });
        } else {
            console.warn('Add Modal elements not found.');
        }

        // Handle delete button clicks
        deleteBtns.forEach(deleteBtn => {
            deleteBtn.addEventListener('click', function() {
                const transactionId = this.getAttribute('data-id');
                deleteIdInput.value = transactionId;
                deleteModal.style.display = 'block';
            });
        });

        // Handle close and cancel buttons for delete modal
        const closeDeleteBtn = deleteModal.querySelector('.close');

        closeDeleteBtn.onclick = function() {
            deleteModal.style.display = 'none';
        };

        cancelDeleteBtn.onclick = function() {
            deleteModal.style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        };
    }

    // Attach initial modal event listeners if present in initial content
    handleModals();
});


