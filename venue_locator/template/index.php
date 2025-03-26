<?php
$title = "FIND SUITABLE VENUE AROUND BACOOR CAMPUS";
$places = [
    ["name" => "Muntinlupa", "image" => "/venue_locator/images/venue2.jpg"],
    ["name" => "Las Piñas City", "image" => "/venue_locator/images/venue2.jpg"],
    ["name" => "Mandaluyong", "image" => "/venue_locator/images/venue2.jpg"],
    ["name" => "San Juan", "image" => "/venue_locator/images/venue2.jpg"],
    ["name" => "Parañaque", "image" => "/venue_locator/images/venue2.jpg"]
];
$venues = [
    ["id" => 1, "name" => "Molino 3 Bacoor 3 Basketball Court", "location" => "Bacoor, Cavite", "phone" => "09171095025", "image" => "/venue_locator/images/venue1.jpg"],
    ["id" => 2, "name" => "Bacoor City Hall COVERED COURT", "location" => "Bacoor, Cavite", "phone" => "+639171081429", "image" => "/venue_locator/images/image2.jpg"],
    ["id" => 3, "name" => "San Lorenzo Ruiz Homes Covered Court", "location" => "Bacoor, Cavite", "phone" => "09175399049", "image" => "/venue_locator/images/sanlorenzo.png"],
    ["id" => 4, "name" => "Molino 1 (Progressive 18) Covered Court", "location" => "Bacoor, Cavite", "phone" => "(632) 343 - 9181, (0917) 572 - 4395", "image" => "/venue_locator/images/image4.jpg"],
    ["id" => 5, "name" => "Mary Homes Covered Basketball Court'", "location" => "Bacoor, Cavitei", "phone" => "020562616", "image" => "/venue_locator/images/image1.jpg"],
    ["id" => 6, "name" => "Garden City II Sunvar Village Basketball Court", "location" => "Bacoor, Cavite", "phone" => "+63943 320 0424", "image" => "/venue_locator/images/image5.jpg"],
    ["id" => 7, "name" => "LOWLAND COVERED COURT'", "location" => "Bacoor, Cavitei", "phone" => "020562616", "image" => "/venue_locator/images/image6.jpg"],
    ["id" => 8, "name" => "Soldiers Hills IV Phase 2 Covered Court", "location" => "Bacoor, Cavite", "phone" => "+63943 320 0424", "image" => "/venue_locator/images/image5.jpg"],
    
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventech Locator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <header class="bg-gray-900 text-white">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img src="https://storage.googleapis.com/a1aa/image/V-jfRMhl83XULC5ga6O--o_XgBeTSQ4oPEtd2hid8So.jpg" alt="Primo Venues Logo" class="h-10 w-10">
                <span class="ml-3 text-xl font-bold">ventechvenues</span>
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
        </div>
    </header>
    <main>
        <div class="relative">
            <img src="/venue_locator/images/venue2.jpg" alt="Beautiful beach resort with clear blue water and palm trees" class="w-full h-96 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Find the perfect event place</h1>
                <p class="text-lg md:text-xl mb-8">Discover hundreds of great places in the Philippines to host your special event</p>
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                    <input type="text" placeholder="Search for venues" class="px-4 py-2 rounded-md text-black">
                    <select class="px-4 py-2 rounded-md text-black">
                        <option>All Regions</option>
                    </select>
                    <select class="px-4 py-2 rounded-md text-black">
                        <option>Choose a category</option>
                    </select>
                    <button class="px-4 py-2 bg-blue-600 rounded-md hover:bg-blue-700">Search</button>
                </div>
            </div>
        </div>
    </main>
    <div class="container mx-auto py-12">
        <h1 class="text-3xl font-bold text-center mb-2"><?= $title; ?></h1>
        <p class="text-center text-gray-600 mb-8">Explore the best locations around the country from our listings.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($places as $place): ?>
                <div class="relative">
                    <img src="<?= $place['image']; ?>" alt="Event place in <?= htmlspecialchars($place['name'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
                        <span class="text-white text-xl font-semibold"><?= htmlspecialchars($place['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-2">Where do you want to host your event?</h1>
        <p class="text-center text-gray-600 mb-8">Find the right venue based on your requirements. Explore our Listings.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach ($venues as $venue) : ?>
    <a href="venue<?= $venue['id']; ?>.php"
       class="block bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
       
        <img src="<?= htmlspecialchars($venue['image']) ?>" alt="<?= htmlspecialchars($venue['name']) ?>" class="w-full h-40 object-cover">
        <div class="p-4">
            <h2 class="text-xl font-semibold"> <?= htmlspecialchars($venue['name']) ?> </h2>
            <p class="text-gray-600"> <?= htmlspecialchars($venue['location']) ?> </p>
            <p class="text-gray-600"><i class="fas fa-phone-alt"></i> <?= htmlspecialchars($venue['phone']) ?> </p>
            <div class="mt-2">
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-yellow-500"></i>
                <i class="fas fa-star text-gray-300"></i>
            </div>
        </div>
    </a>
<?php endforeach; ?>
</div>

    </div>
</body>
</html>


