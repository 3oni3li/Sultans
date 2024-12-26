<?php
include('includes/header.php');
include('includes/navbar.php');

// Get facility from query
$facility = isset($_GET['facility']) ? $_GET['facility'] : 'Unknown Facility';

// Define the image path dynamically based on the facility name
$imagePath = "images/" . str_replace(' ', '-', $facility) . ".jpg";

// Check if the image exists; if not, use a default image
if (!file_exists($imagePath)) {
    $imagePath = "images/default.jpg"; // Default fallback image
}
?>

<div class="container py-5">
    <h1 class="text-center"><?= htmlspecialchars($facility); ?></h1>
    <p class="text-center">Explore all about our <?= htmlspecialchars($facility); ?> and what makes it special.</p>

    <!-- Display Facility Information -->
    <div class="row">
        <div class="col-md-6">
            <!-- Display the image -->
            <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($facility); ?>" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <p>Here at Sultan's Spa Resort, our <?= htmlspecialchars($facility); ?> offers unmatched services and amenities...</p>
            <ul>
                <li>State-of-the-art features</li>
                <li>Luxurious experience</li>
                <li>Open 24/7</li>
            </ul>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
