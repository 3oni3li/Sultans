<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<style>
/* About Us Styling */
.about-section {
    padding: 100px 0;
    background: linear-gradient(to right, #e0f7fa, #ffffff);
    color: #333;
}
.about-section h2 {
    font-size: 3rem;
    font-weight: bold;
    text-align: center;
    color: #0056b3;
    margin-bottom: 20px;
    position: relative;
}
.about-section h2::after {
    content: '';
    position: absolute;
    width: 80px;
    height: 4px;
    background: #0056b3;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 5px;
}
.about-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 40px;
}
.about-image {
    flex: 1;
    margin-right: 20px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
}
.about-image img {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
}
.about-image img:hover {
    transform: scale(1.05);
}
.about-text {
    flex: 2;
}
.about-text h3 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 20px;
}
.about-text p {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 20px;
    color: #555;
}
.about-text .btn-primary {
    background: #0056b3;
    border: none;
    font-size: 1rem;
    padding: 10px 20px;
    border-radius: 30px;
    transition: background-color 0.3s ease;
}
.about-text .btn-primary:hover {
    background: #003f7f;
}

/* Mission Section */
.mission-section {
    padding: 80px 0;
    background: #f8f9fa;
    text-align: center;
}
.mission-section h2 {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #0056b3;
    position: relative;
}
.mission-section h2::after {
    content: '';
    position: absolute;
    width: 80px;
    height: 4px;
    background: #0056b3;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 5px;
}
.mission-content {
    max-width: 800px;
    margin: 0 auto;
    font-size: 1.2rem;
    line-height: 1.8;
    color: #555;
    margin-top: 20px;
}

/* Call-to-Action Section */
.cta-section {
    background: #0056b3;
    color: white;
    padding: 60px 0;
    text-align: center;
}
.cta-section h3 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}
.cta-section .btn-primary {
    padding: 15px 30px;
    font-size: 1.2rem;
    border-radius: 30px;
}
</style>

<section class="about-section">
    <div class="container">
        <h2>About Us</h2>
        <div class="about-content">
            <div class="about-image">
                <img src="images/about.jpg" alt="About Sultan's Spa Resort">
            </div>
            <div class="about-text">
                <h3>Welcome to Sultan's Spa Resort</h3>
                <p>At Sultan's Spa Resort, we pride ourselves on delivering a unique blend of luxury, comfort, and unforgettable experiences. Nestled in the heart of a serene landscape, our resort offers the perfect escape for relaxation and rejuvenation.</p>
                <p>Whether you're here for a romantic getaway, a family vacation, or a solo retreat, we ensure that every moment is filled with indulgence and tranquility. Our world-class amenities, exceptional hospitality, and attention to detail make us the ideal destination for your next retreat.</p>
                <a href="contact-us.php" class="btn btn-primary">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="mission-section">
    <div class="container">
        <h2>Our Mission</h2>
        <div class="mission-content">
            <p>Our mission is to create a haven where guests can escape the everyday and immerse themselves in an unparalleled atmosphere of relaxation and rejuvenation. We are committed to exceeding expectations through our dedication to exceptional service, sustainable practices, and continuous innovation.</p>
            <p>At Sultan's Spa Resort, we strive to foster connections, inspire tranquility, and deliver experiences that create lasting memories.</p>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <h3>Ready to Book Your Stay?</h3>
        <p>Experience the luxury and tranquility of Sultan's Spa Resort. Book your room today!</p>
        <!-- "Book Now" button navigates to the rooms.php page -->
        <a href="all-rooms.php" class="btn btn-primary">Book Now</a>
    </div>
</section>

<?php include('includes/footer.php'); ?>
