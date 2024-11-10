document.addEventListener("DOMContentLoaded", function() {
    const itemsPerPage = 9; // Number of items per page
    const galleryItems = document.querySelectorAll('.gallery-item'); // All gallery items
    const paginationLinks = document.querySelectorAll('.page-link'); // Pagination links
    const totalPages = Math.ceil(galleryItems.length / itemsPerPage); // Total pages
    let currentPage = 1; // Current page index

    function showPage(page) {
        // Hide all gallery items
        galleryItems.forEach(item => item.style.display = 'none');

        // Calculate start and end index for items on the current page
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Display only the gallery items for the current page
        for (let i = startIndex; i < endIndex && i < galleryItems.length; i++) {
            galleryItems[i].style.display = 'block';
        }

        // Update active class for pagination
        paginationLinks.forEach(link => link.classList.remove('active'));
        paginationLinks[page].classList.add('active');
    }

    // Function to handle events for page numbers, Previous, and Next buttons
    function setPageEvents() {
        paginationLinks.forEach((link, index) => {
            if (index === 0) { // "Previous" button event
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        showPage(currentPage);
                    }
                });
            } else if (index === paginationLinks.length - 1) { // "Next" button event
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPage < totalPages) {
                        currentPage++;
                        showPage(currentPage);
                    }
                });
            } else { // Page number event
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    currentPage = index;
                    showPage(currentPage);
                });
            }
        });
    }

    // Show the first page and set up events
    showPage(currentPage);
    setPageEvents();
});
