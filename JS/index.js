    document.addEventListener('DOMContentLoaded', function() {
    const priceRange = document.getElementById('price-range');
    const priceDisplay = document.getElementById('price-display');
    const applyRangeCheckbox = document.getElementById('apply-range');
    const searchButton = document.getElementById('search-button');
    const highestPriceButton = document.getElementById('highest-price-button');
    const lowestPriceButton = document.getElementById('lowest-price-button');
    const searchInput = document.getElementById('search-input');
    const categoryFilters = Array.from(document.querySelectorAll('.category-filter'));
    const audienceFilters = Array.from(document.querySelectorAll('.audience-filter'));
    const productCards = Array.from(document.querySelectorAll('.product-card'));

    function updatePriceDisplay() {
        priceDisplay.textContent = priceRange.value;
    }
    
    function filterProducts(searchTerm = '') {
        const maxPrice = parseInt(priceRange.value);
        const selectedCategories = categoryFilters.filter(cb => cb.checked).map(cb => cb.value);
        const selectedAudiences = audienceFilters.filter(cb => cb.checked).map(cb => cb.value);

        productCards.forEach(card => {
            const productPrice = parseInt(card.getAttribute('data-price'));
            const productText = card.querySelector('.product-text').textContent.toLowerCase();
            const productCategories = card.getAttribute('data-category').toLowerCase().split(', ').map(c => c.trim());
            const productAudiences = card.getAttribute('data-audience').toLowerCase().split(', ').map(a => a.trim());

            const withinPriceRange = !applyRangeCheckbox.checked || (productPrice <= maxPrice);
            const matchesSearchTerm = productText.includes(searchTerm);
            const matchesCategory = selectedCategories.length === 0 || selectedCategories.some(cat => productCategories.includes(cat));
            const matchesAudience = selectedAudiences.length === 0 || selectedAudiences.some(aud => productAudiences.includes(aud));

            if (withinPriceRange && matchesSearchTerm && matchesCategory && matchesAudience) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function resetFilter() {
        productCards.forEach(card => {
            card.style.display = 'block';
        });
    }

    function sortProducts(order) {
        const productsContainer = document.querySelector('.products');
        const sortedCards = productCards.sort((a, b) => {
            const priceA = parseInt(a.getAttribute('data-price'));
            const priceB = parseInt(b.getAttribute('data-price'));

            return order === 'asc' ? priceA - priceB : priceB - priceA;
        });

        productsContainer.innerHTML = '';

        sortedCards.forEach(card => {
            productsContainer.appendChild(card);
        });
    }

    priceRange.addEventListener('input', function() {
        updatePriceDisplay();
        filterProducts();
    });

    applyRangeCheckbox.addEventListener('change', function() {
        filterProducts();
    });

    searchButton.addEventListener('click', function() {
        const searchTerm = searchInput.value.toLowerCase();
        filterProducts(searchTerm);
    });

    searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            const searchTerm = searchInput.value.toLowerCase();
            filterProducts(searchTerm);
        }
    });

    highestPriceButton.addEventListener('click', function() {
        sortProducts('desc');
    });

    lowestPriceButton.addEventListener('click', function() {
        sortProducts('asc');
    });

    // Add event listeners for category and audience filters
    categoryFilters.forEach(cb => cb.addEventListener('change', function() {
        filterProducts(searchInput.value.toLowerCase());
    }));

    audienceFilters.forEach(cb => cb.addEventListener('change', function() {
        filterProducts(searchInput.value.toLowerCase());
    }));

    // Initialize display
    updatePriceDisplay();
    filterProducts(); // Ensure products are filtered on page load
    
});

