document.addEventListener("DOMContentLoaded", function () {
    // Initialize the map centered on Rotterdam by default
    const map = L.map('map').setView([51.9225, 4.4791], 13);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const streetInput = document.getElementById("streetName");
    let debounceTimer;
    function fetchLocation(streetName) {
        fetch(`https://nominatim.openstreetmap.org/search?street=${encodeURIComponent(streetName)}&city=Rotterdam&country=Netherlands&format=json`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);

                    map.setView([lat, lon], 15);

                    if (window.marker) {
                        map.removeLayer(window.marker);
                    }

                    window.marker = L.marker([lat, lon]).addTo(map)
                        .bindPopup(`Location: ${data[0].display_name}`)
                        .openPopup();
                } else {
                    document.getElementById("error-message").innerText = "Street not found.";
                }
            })
            .catch(error => {
                console.error("Error fetching location:", error);
                document.getElementById("error-message").innerText = "Error fetching location.";
            });
    }
    function trackUserLocation() {
        if (!navigator.geolocation) {
            alert("Geolocation not supported by this browser.");
            return;
        }

        console.log("Requesting user location...");
navigator.geolocation.getCurrentPosition(
    position => {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        console.log("User location:", lat, lon);

        map.whenReady(() => {
            map.setView([lat, lon], 15);

            if (window.userMarker) {
                map.removeLayer(window.userMarker);
            }

            window.userMarker = L.marker([lat, lon]).addTo(map)
        });
    },
    error => {
        console.warn("Could not get user location:", error.message);
        alert("Could not get your location. Showing Rotterdam instead.");
        map.setView([51.9225, 4.4791], 13);
    },
    {
        enableHighAccuracy: false, // Don’t wait for precise GPS
        timeout: 5000,             // Give up after 5 seconds
        maximumAge: 10000          // Use cached location if available
    }
);
    }

    // Start location tracking
    trackUserLocation();

    streetInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);
        const streetName = this.value;

        if (streetName.length > 2) {
            debounceTimer = setTimeout(() => {
                fetchLocation(streetName);
            }, 300);
        }
    });


    document.getElementById("complaintForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const email = document.getElementById("email-adres").value;
        const name = document.getElementById("name").value;
        const phone = document.getElementById("Telefoonnummer").value;
        const complaintType = document.getElementById("klacht").value;
        const complaintText = document.getElementById("klachtText").value;

        // Determine the location from marker or user marker
        let lat, lon;
        if (window.marker) {
            lat = window.marker.getLatLng().lat;
            lon = window.marker.getLatLng().lng;
        } else if (window.userMarker) {
            lat = window.userMarker.getLatLng().lat;
            lon = window.userMarker.getLatLng().lng;
        } else {
            alert("Please locate a street or allow location access before submitting your complaint.");
            return;
        }

        // Send the complaint to the server
        fetch("/api/send-complaint", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
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
                alert("Complaint submitted successfully!");
                document.getElementById("complaintForm").reset();
                map.setView([51.9225, 4.4791], 13);
                if (window.marker) map.removeLayer(window.marker);
            } else {
                alert("Failed to submit complaint. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error sending complaint:", error);
            alert("Error sending complaint.");
        });
    });
});
