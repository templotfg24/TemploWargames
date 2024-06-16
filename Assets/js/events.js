document.addEventListener('DOMContentLoaded', function() {
    const initialShow = 6;
    const container = document.getElementById('eventsContainer');
    const loadMoreButton = document.getElementById('loadMore');
    const dateFilter = document.getElementById('dateFilter');
    let filteredEvents = Array.from(container.children);

    function displayEvents(filterDate) {
        filteredEvents = Array.from(container.children).filter(event => {
            const eventDate = new Date(event.querySelector('.text-muted').textContent);
            return !filterDate || eventDate >= new Date(filterDate);
        });
        container.innerHTML = '';
        filteredEvents.forEach((event, index) => {
            event.classList.toggle('hidden', index >= initialShow);
            container.appendChild(event);
        });
        loadMoreButton.style.display = filteredEvents.length > initialShow ? 'block' : 'none';
    }

    loadMoreButton.addEventListener('click', () => {
        filteredEvents.forEach(event => event.classList.remove('hidden'));
        loadMoreButton.style.display = 'none';
    });

    dateFilter.addEventListener('change', () => {
        displayEvents(dateFilter.value);
    });

    displayEvents();
});
