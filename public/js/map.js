document.addEventListener("DOMContentLoaded", function() {
    const map = L.map('map').setView([51.9225, 4.4791], 13); // Default to Rotterdam

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const streetInput = document.getElementById("streetName");

    // Add an event listener to the input field
    streetInput.addEventListener("input", function() {
        const streetName = this.value;

        if (streetName.length > 2) { // Start searching if more than 2 characters
            // Use Nominatim API to get the coordinates
            fetch(`https://nominatim.openstreetmap.org/search?street=${encodeURIComponent(streetName)}&city=Rotterdam&format=json`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const lat = data[0].lat;
                        const lon = data[0].lon;

                        // Set map view to the new location
                        map.setView([lat, lon], 15);

                        // Clear previous markers
                        if (window.marker) {
                            map.removeLayer(window.marker);
                        }

                        // Add a marker for the new location
                        window.marker = L.marker([lat, lon]).addTo(map)
                            .bindPopup(`Location: ${data[0].display_name}`)
                            .openPopup();
                    } else {
                        alert("Location not found.");
                    }
                })
                .catch(error => {
                    console.error('Error fetching location:', error);
                    alert("Error fetching location.");
                });
        }
    });

    // Handle form submission to send the complaint and location
    document.getElementById("complaintForm").addEventListener("submit", function() {
        const email = document.getElementById("email-adres").value;
        const name = document.getElementById("name").value;
        const phone = document.getElementById("Telefoonnummer").value;
        const complaintType = document.getElementById("klacht").value;
        const complaintText = document.getElementById("klachtText").value;

        // Obtain the location from the marker
        if (window.marker) {
            const lat = window.marker.getLatLng().lat;
            const lon = window.marker.getLatLng().lng;

            // Send the complaint data to the server
            fetch('/api/send-complaint', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ensure CSRF protection
                },
                body: JSON.stringify({
                    email: email,
                    name: name,
                    phone: phone,
                    complaintType: complaintType,
                    complaintText: complaintText,
                    latitude: lat,
                    longitude: lon
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Complaint submitted successfully!');
                    // Optionally, reset the form
                    document.getElementById("complaintForm").reset();
                    map.setView([51.9225, 4.4791], 13); // Reset map view (default to Rotterdam)
                    if (window.marker) {
                        map.removeLayer(window.marker); // Remove marker after submission
                    }
                } else {
                    alert('Failed to submit complaint. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error sending complaint:', error);
                alert("Error sending complaint.");
            });
        } else {
            alert("Please locate a street before submitting your complaint.");
        }
    });
});
