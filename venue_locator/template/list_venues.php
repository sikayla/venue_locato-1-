<?php 
// Database connection
$host = "localhost";
$user = "root"; // Change if needed
$pass = "";
$dbname = "venue_db"; // Change database name if needed

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unique categories, prices, and person capacities
$venueTypeQuery = "SELECT DISTINCT category FROM venues";
$venueTypeResult = $conn->query($venueTypeQuery);

$priceQuery = "SELECT DISTINCT category2 FROM venues";
$priceResult = $conn->query($priceQuery);

$personQuery = "SELECT DISTINCT category3 FROM venues";
$personResult = $conn->query($personQuery);

// Fetch all venues
$sql = "SELECT * FROM venues ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Venues</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body{
            background-color: #1a1a2e;
        }
        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-gray-900 text-white">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img src="<?= $image_url ?>" alt="Primo Venues Logo" class="h-10 w-10"/>
                <span class="ml-2 text-xl font-bold">primovenues</span>
            </div>
            <nav class="flex space-x-4">
                <a class="hover:underline" href="#">Submit Venue</a>
                <div class="relative group">
                    <a class="hover:underline" href="#">Explore <i class="fas fa-chevron-down"></i></a>
                    <div class="absolute hidden group-hover:block bg-white text-black mt-2 py-2 w-48 shadow-lg">
                        <a href="list_venues.php" class="block px-4 py-2 hover:bg-gray-200">List Venues</a>
                        <a href="manage_bookings2.php" class="block px-4 py-2 hover:bg-gray-200">Bookings</a>
                    </div>
                </div>
                <a href="#" class="hover:underline">Help</a>
                <a href="signin.php" class="hover:underline">Sign In</a>
            </nav>
        </div>
       


        
        
                    
    </header>

    <div class="row mb-3">
        
        <div class="col-md-6 text-md-end">
            <div class="d-inline-block">
                <div class="dropdown filter-dropdown d-inline">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Filters
                    </button> <br> <button class="btn btn-outline-danger ms-2" id="clearFilters" onclick="clearFilters()">Clear</button>
                    <ul class="dropdown-menu p-3" aria-labelledby="filterDropdown">
                        <li class="mb-2">
                            <label><b>Venue Type:</b></label>
                            <select class="form-select" id="venueTypeFilter" onchange="filterVenues()">
                                <option value="">All</option>
                                <?php while ($row = $venueTypeResult->fetch_assoc()) : ?>
                                    <option value="<?= strtolower($row['category']); ?>"><?= $row['category']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </li>
                        <li class="mb-2">
                            <label><b>Price:</b></label>
                            <select class="form-select" id="priceFilter" onchange="filterVenues()">
                                <option value="">All</option>
                                <?php while ($row = $priceResult->fetch_assoc()) : ?>
                                    <option value="<?= strtolower($row['category2']); ?>"><?= ucfirst($row['category2']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </li>
                        <li class="mb-2">
                            <label><b>Person Capacity:</b></label>
                            <select class="form-select" id="personFilter" onchange="filterVenues()">
                                <option value="">All</option>
                                <?php while ($row = $personResult->fetch_assoc()) : ?>
                                    <option value="<?= strtolower($row['category3']); ?>"><?= $row['category3']; ?> Persons</option>
                                <?php endwhile; ?>
                            </select>
                        </li>
                    </ul>
                </div>

                
            </div>
        </div>
    </div>

   

   
    <div class="container mt-4">
        <div class="row" id="venueList">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-md-3 mb-4 venue-card" 
                    data-category="<?= strtolower($row['category']); ?>"
                    data-price="<?= strtolower($row['category2']); ?>"
                    data-person="<?= strtolower($row['category3']); ?>">
                    <div class="card">
                        <img src="<?= $row['image']; ?>" class="card-img-top" alt="<?= $row['name']; ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-primary"><?= $row['category']; ?></span>
                            <span class="badge bg-success"><?= ucfirst($row['category2']); ?></span>
                            <span class="badge bg-info"><?= $row['category3']; ?> Persons</span>
                            <h5 class="card-title mt-2"><?= $row['name']; ?></h5>
                            <p class="card-text"><?= substr($row['description'], 0, 100); ?>...</p>
                            <h6 class="text-dark fw-bold">₱<?= number_format($row['price'], 2); ?></h6>
                            <a href="venue_details.php?id=<?php echo $venue['id']; ?>" class="view-venue-btn">View Venue</a>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script>

function clearFilters() {
    document.getElementById('searchInput').value = "";
    document.getElementById('venueTypeFilter').value = "";
    document.getElementById('priceFilter').value = "";
    document.getElementById('personFilter').value = "";
    filterVenues(); // Refresh the venue list
}

function filterVenues() {
    let searchInput = document.getElementById('searchInput').value.toLowerCase();
    let venueType = document.getElementById('venueTypeFilter').value.toLowerCase();
    let price = document.getElementById('priceFilter').value.toLowerCase();
    let person = document.getElementById('personFilter').value.toLowerCase();

    let cards = document.getElementsByClassName('venue-card');

    for (let i = 0; i < cards.length; i++) {
        let titleElement = cards[i].getElementsByClassName('card-title')[0];
        let title = titleElement ? titleElement.innerText.toLowerCase() : "";

        let cardCategory = cards[i].getAttribute('data-category');
        let cardPrice = cards[i].getAttribute('data-price');
        let cardPerson = cards[i].getAttribute('data-person');

        let matchTitle = title.includes(searchInput);
        let matchCategory = venueType === "" || cardCategory === venueType;
        let matchPrice = price === "" || cardPrice === price;
        let matchPerson = person === "" || cardPerson === person;

        if (matchTitle && matchCategory && matchPrice && matchPerson) {
            cards[i].style.display = "block";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>

