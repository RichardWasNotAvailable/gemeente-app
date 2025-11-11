document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map').setView([51.9225, 4.4791], 13); // Default to Rotterdam

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const streetInput = document.getElementById("streetName");
    let debounceTimer; // To hold the debounce timer

    // Generic geocode function. If input looks like "lat,lon" it uses it directly.
    function geocodeAndMark(query, popupText) {
        // If query is empty, do nothing
        if (!query) return;

        // If it's already lat,lon
        const coordMatch = query.trim().match(/^(-?\d+(?:\.\d+)?)[,\s]+(-?\d+(?:\.\d+)?)$/);
        if (coordMatch) {
            const lat = parseFloat(coordMatch[1]);
            const lon = parseFloat(coordMatch[2]);
            setMapMarker(lat, lon, popupText || query);
            return;
        }

        // Otherwise, use Nominatim search
        fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query + ' Rotterdam, Netherlands')}&format=json&limit=1`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const lat = data[0].lat;
                    const lon = data[0].lon;
                    const displayName = data[0].display_name;
                    setMapMarker(lat, lon, popupText || displayName);
                } else {
                    console.warn('No geocoding result for', query);
                }
            })
            .catch(err => console.error('Geocoding error:', err));
    }

    function setMapMarker(lat, lon, popupText) {
        map.setView([lat, lon], 15);

        if (window.marker) {
            map.removeLayer(window.marker);
        }

        window.marker = L.marker([lat, lon]).addTo(map)
            .bindPopup(popupText || `Location: ${lat}, ${lon}`)
            .openPopup();
    }

    // Add an event listener to the input field with debounce if present
    if (streetInput) {
        streetInput.addEventListener("input", function () {
            clearTimeout(debounceTimer); // Clear previous timer
            const streetName = this.value;

            if (streetName.length > 2) { // Only search if more than 2 characters
                debounceTimer = setTimeout(() => {
                    geocodeAndMark(streetName);
                }, 300); // 300 ms debounce delay
            }
        });
    }

    // Handle form submission to send the complaint and location (only if form exists)
    const complaintForm = document.getElementById("complaintForm");
    if (complaintForm) {
        complaintForm.addEventListener("submit", function (e) {
            e.preventDefault();

            // Ensure a marker/location exists before submitting
            if (!window.marker) {
                alert("Please locate a street before submitting your complaint.");
                return;
            }

            const lat = window.marker.getLatLng().lat;
            const lon = window.marker.getLatLng().lng;

            // Create or update hidden inputs for latitude/longitude so the existing
            // server-side controller (which expects form POST data) receives them.
            function upsertHidden(name, value) {
                let input = document.querySelector(`input[name="${name}"]`);
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    complaintForm.appendChild(input);
                }
                input.value = value;
            }

            upsertHidden('latitude', lat);
            upsertHidden('longitude', lon);

            // Submit the form to the server (will use the form action /klachten and include @csrf token)
            complaintForm.submit();
        });
    }

    // When viewing complaints on the dashboard, handle clicks on the 'view-on-map' buttons.
    document.addEventListener('click', function (e) {
        const btn = e.target.closest && e.target.closest('.view-on-map');
        if (!btn) return;

        // Prefer data-loc attribute, fall back to reading the location cell in the same row
        let locationText = btn.dataset.loc;
        if (!locationText) {
            const row = btn.closest('tr');
            if (row) {
                // try to find the cell that contains locatie text (we give it class 'klachtCell')
                const cells = Array.from(row.querySelectorAll('.klachtCell'));
                // the location is expected to be in one of the cells; attempt to find a value that is not purely numeric id
                const possible = cells.map(c => c.innerText.trim()).filter(t => t && !/^\d+$/.test(t));
                locationText = possible.length ? possible[possible.length - 1] : '';
            }
        }

        if (locationText) {
            geocodeAndMark(locationText, `Klacht locatie: ${locationText}`);
        } else {
            console.warn('No location available for this complaint.');
        }
    });
});