document.addEventListener('DOMContentLoaded', function () {
    const searchBar = document.getElementById('search-bar');
    const courtContainer = document.getElementById('courtContainer');

    // Event listener for search bar input
    searchBar.addEventListener('input', function () {
        const query = searchBar.value.trim();

        if (query.length > 0) {
            // AJAX request to fetch search results
            fetch(`/search-courts?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    courtContainer.innerHTML = ''; // Clear the container
                    if (data.courts.length > 0) {
                        data.courts.forEach(court => {
                            const courtCard = document.createElement('div');
                            courtCard.classList.add('col-md-4', 'mb-4');
                            courtCard.innerHTML = `
                                <div class="card">
                                    <img src="${court.image ? court.image : '/images/default-court.jpg'}" alt="Court Image" class="card-img-top img-fluid">
                                    <div class="card-body">
                                        <h5 class="card-title">${court.court_name}</h5>
                                        <p class="card-text">
                                            <strong>Location:</strong> ${court.location}<br>
                                            <strong>Capacity:</strong> ${court.capacity} people<br>
                                            <strong>Price per Hour:</strong> $${court.price_per_hour} per hour
                                        </p>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal${court.id}">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            `;
                            courtContainer.appendChild(courtCard);
                        });
                    } else {
                        courtContainer.innerHTML = '<p class="text-center">No courts found.</p>';
                    }
                })
                .catch(error => console.error('Error fetching courts:', error));
        } else {
            courtContainer.innerHTML = '<p class="text-center">Start typing to search for courts...</p>';
        }
    });
});
