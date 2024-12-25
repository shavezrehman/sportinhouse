document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const courtContainer = document.getElementById('courtContainer');
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        filterCourts();
    });

    // Category filter functionality
    categoryFilter.addEventListener('change', function() {
        filterCourts();
    });

    function filterCourts() {
        const query = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;
        
        const courtCards = courtContainer.querySelectorAll('.recipe-card');
        
        courtCards.forEach(card => {
            const courtName = card.getAttribute('data-court-name');
            const courtCategory = card.getAttribute('data-category');
            
            // Check if court name matches the query and if category matches the selected filter
            const matchesSearch = courtName.includes(query);
            const matchesCategory = selectedCategory === 'all' || selectedCategory === courtCategory;
            
            // Show or hide cards based on the search and filter conditions
            if (matchesSearch && matchesCategory) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
});
