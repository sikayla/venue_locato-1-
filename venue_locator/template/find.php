<script?php
// Primo Venues Homepage
?>
<!DOCTYPE html>
<html>
<head>
    <title>Primo Venues</title>
      <!-- Tailwind CSS -->
      <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <style>
        #map {
            width: 100%;
            height: 100vh; /* Full screen height */
            border-radius: 8px;
        }
    </style>
</head>
< class="bg-gray-100">
    <header class="bg-gray-900 text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="https://storage.googleapis.com/a1aa/image/QOWx9_f-JLLdSC3i9qFfz_zb1MADK2Gma9cNyhemwGI.jpg" alt="Primo Venues Logo" class="mr-2" width="40" height="40" />
            <span class="text-xl font-bold">primovenues</span>
        </div>
        <nav class="flex items-center space-x-4">
                <a href="#" class="hover:underline">Submit Venue</a>
                <div class="relative group">
                    <a href="#" class="hover:underline flex items-center">Explore <i class="fas fa-chevron-down ml-1"></i></a>
                    <div class="absolute left-0 mt-2 w-48 bg-white text-black shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                    <a href="index.php" class="block px-4 py-2 hover:bg-gray-200">Home</a>
                    <a href="list_venues.php" class="block px-4 py-2 hover:bg-gray-200">List Venues</a>
                    <a  href="manage_bookings.php" class="block px-4 py-2 hover:bg-gray-200">Bookings</a>
                    <a href="find.php" class="block px-4 py-2 hover:bg-gray-200">Find Venues</a>
                    </div>
                </div>
                <a href="#" class="hover:underline">Help</a>
                <a href="signin.php" class="hover:underline">Sign In</a>
            </nav>
    </header>
    <div class="flex">
        <div class="w-1/2 p-4">
            <div class="bg-white p-4 rounded shadow">
                <div class="flex space-x-4 mb-4">
                    <input type="text" class="w-full p-2 border rounded" placeholder="Search for venues" />
                    <select class="w-full p-2 border rounded">
                        <option>All Regions</option>
                    </select>
                </div>
               
                <div class="mb-4">
    <p class="font-bold mb-2">Filter by tag:</p>
    <div class="space-y-2">
        <?php
        $tags = ["High Price", "Low Price", "6 person", "10 Person", "Covered Court"];
        foreach ($tags as $tag) {
            echo '<label class="flex items-center">';
            echo '<input type="checkbox" class="filter-checkbox mr-2" data-tag="' . $tag . '" />' . $tag;
            echo '</label>';
        }
        ?>
    </div>
</div>

<button id="update-btn" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <p>136 Results Found (Showing 1-12)</p>
                <div class="flex items-center space-x-2">
                    <a href="#" class="text-blue-600">Reset</a>
                    <i class="fas fa-rss text-orange-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="grid grid-cols-2 gap-4">
                    <?php 
                    $venues = [
                        [
                            "name" => "Oval court Soldiers Hills 4",
                            "location" => "Bacoor, Cavite",
                            "phone" => "(632) 897 - 2031 loc. 137 or 290",
                            "image" => "/venue_locator/images/image1.jpg",
                            "logo" => "/venue_locator/images/venue.png"
                        ],
                        [
                            "name" => "Console Village 9",
                            "location" => "Laguna",
                            "phone" => "09175389849",
                            "image" => "/venue_locator/images/courrtt.jpg",
                            "logo" => "/venue_locator/images/venue.png"
                        ]
                    ];
                    
                    foreach ($venues as $venue) {
                        echo '<div class="bg-white p-4 rounded shadow">';
                        echo '<img src="' . $venue["image"] . '" alt="' . $venue["name"] . '" class="w-full h-40 object-cover rounded mb-2" />';
                        if (!empty($venue["logo"])) {
                            echo '<div class="flex justify-between items-center mb-2">';
                            echo '<span class="bg-blue-600 text-white px-2 py-1 rounded">FEATURED</span>';
                            echo '<img src="' . $venue["logo"] . '" alt="' . $venue["name"] . ' Logo" class="w-10 h-10" />';
                            echo '</div>';
                        }
                        echo '<h3 class="text-lg font-bold">' . $venue["name"] . '</h3>';
                        echo '<p class="text-gray-600">' . $venue["location"] . '</p>';
                        echo '<p class="text-gray-600"><i class="fas fa-phone-alt"></i> ' . $venue["phone"] . '</p>';
                        echo '<div class="flex space-x-1 mt-2">';
                        for ($i = 0; $i < 5; $i++) {
                            echo '<i class="fas fa-star text-yellow-500"></i>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
         <!-- Map Section -->
         <div class="w-1/2">
            <div id="map"></div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map').setView([14.3914, 120.982], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
    }).addTo(map);

    var locations = [
        { id: 1, name: "Molino 3 Bacoor Basketball Court", lat: 14.3914, lng: 120.982, price: 500, capacity: 10, tags: ["High Price", "10 Person", "Covered Court"], image: "/venue_locator/images/image1.jpg"},
        { id: 2, name: "Bacoor City Hall", lat: 14.3895, lng: 120.984, price: 400, capacity: 8, tags: ["Low Price", "8 Person", "Covered Court"], image: "/venue_locator/images/image2.jpg"},
        { id: 3, name: "San Lorenzo Ruiz Homes Covered Court", lat: 14.3800, lng: 120.972, price: 450, capacity: 12, tags: ["High Price", "12 Person", "Covered Court"], image: "/venue_locator/images/image4.jpg"},
        { id: 4, name: "Molino 1 (Progressive 18) Covered Court", lat: 14.3925, lng: 120.975, price: 350, capacity: 6, tags: ["Low Price", "6 Person", "Covered Court"], image: "/venue_locator/images/image5.jpg"},
        { id: 5, name: "Mary Homes Covered Basketball Court", lat: 14.3928, lng: 120.977, price: 500, capacity: 10, tags: ["High Price", "10 Person", "Covered Court"], image: "/venue_locator/images/image6.jpg" },
        { id: 6, name: "Garden City II Sunvar Village Basketball Court", lat: 14.3999, lng: 120.989, price: 300, capacity: 6, tags: ["Low Price", "6 Person", "Covered Court"], image: "/venue_locator/images/image5.jpg" },
        { id: 7, name: "LOWLAND COVERED COURT", lat: 14.4013, lng: 120.995, price: 350, capacity: 5, tags: ["Low Price", "5 Person", "Covered Court"], image: "/venue_locator/images/venue2.jpg"},
        { id: 8, name: "Console Village 9", lat: 14.4156, lng: 120.977, price: 400, capacity: 7, tags: ["Low Price", "7 Person", "Covered Court"], image: "/venue_locator/images/venue1.jpg" },
        { id: 9, name: "Ivey's Court", lat: 14.4202, lng: 120.963, price: 300, capacity: 6, tags: ["Low Price", "6 Person", "Covered Court"], image: "/venue_locator/images/image1.jpg"},
        { id: 10, name: "Oval court Soldiers Hills 4", lat: 14.4121, lng: 120.980, price: 350, capacity: 6, tags: ["Low Price", "6 Person", "Covered Court"], image: "/venue_locator/images/court3.jpg" }
    ];

    var allMarkers = [];

    function addMarkers(venues) {
        // Remove existing markers
        allMarkers.forEach(marker => marker.remove());
        allMarkers = [];

        venues.forEach(venue => {
            let marker = L.marker([venue.lat, venue.lng]).addTo(map)
                .bindPopup(`
                    <b>${venue.name}</b><br>
                    <img src="${venue.image}" alt="Venue Image" style="width:100px;height:auto;"><br>
                    ₱${venue.price}.00 - ${venue.capacity} Persons<br>
                    <a href="venue_details.php?id=${venue.id}" class="view-venue-btn">
                        View Venue
                    </a>
                `);

            marker.tags = venue.tags; // Store venue tags for filtering
            allMarkers.push(marker);
        });
    }
    
    addMarkers(locations);

    function filterMarkers() {
        let selectedFilters = [...document.querySelectorAll(".filter-checkbox:checked")]
            .map(cb => cb.getAttribute("data-tag"));

        allMarkers.forEach(marker => {
            let matches = selectedFilters.length === 0 || selectedFilters.some(filter => marker.tags.includes(filter));
            
            if (matches) {
                marker.addTo(map);
            } else {
                map.removeLayer(marker);
            }
        });
    }

    document.getElementById("update-btn").addEventListener("click", function () {
        filterMarkers();
    });

    // Fix event listener for view venue button
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("view-venue-btn")) {
            // No need to manually set the href, just let the link work
            return;
        }
    });
});
</script>


</body>
</html>
