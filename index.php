<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/slider.php'); ?>

<style>
    .main-heading {
        font-size: 2.5rem;
        font-weight: bold;
        animation: fadeIn 1s ease-in-out;
    }
    .underline {
        width: 60px;
        height: 5px;
        margin: 10px auto;
        background-color: #000;
        animation: underlineGrow 1s ease-in-out;
    }
    .section {
        padding: 60px 0;
    }
    .section.bg-primary {
        background-color: #007bff;
    }
    .section.bg-light {
        background-color: #f8f9fa;
    }
    .facility-header {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
        animation: fadeIn 1s ease-in-out;
    }
    .facility-header::before, .facility-header::after {
        content: '';
        position: absolute;
        width: 50px;
        height: 2px;
        background-color: #000;
        top: 50%;
    }
    .facility-header::before {
        left: -60px;
    }
    .facility-header::after {
        right: -60px;
    }
    .facility-subheader {
        margin: 20px 0;
        font-size: 1.5rem;
        color: #666;
    }
    .facility {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin: 30px 0;
    }
    .facility .box {
        width: 30%;
        margin: 15px 0;
        text-align: center;
        animation: fadeInUp 1s ease-in-out;
    }
    .facility .box img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }
    .facility .box img:hover {
        transform: scale(1.1);
    }
    .facility .box h2 {
        margin-top: 15px;
        font-size: 1.25rem;
        font-weight: bold;
    }
    .card-box {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 1s ease-in-out;
    }
    .card-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card-box .roomimage img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }
    .card-box .roomimage img:hover {
        transform: scale(1.1);
    }
    .card-box-body {
        padding: 15px;
        text-align: left;
    }
    .card-heading {
        font-size: 1.25rem;
        font-weight: bold;
        margin: 0 0 10px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease-in-out;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes underlineGrow {
        from {
            width: 0;
        }
        to {
            width: 60px;
        }
    }
</style>

<section class="section bg-primary text-white text-center">
    <div class="container">
        <h4 class="main-heading">Sultans Spa Resort</h4>
        <div class="underline"></div>
    </div>
</section>

<section id="thirdsection" class="section">
    <div class="container text-center">
        <h1 class="facility-header">Facilities</h1>
        <div class="facility-subheader">Experience the best services at our resort</div>
        <div class="facility row">
            <?php
                $facility_query = "SELECT * FROM facilities";
                $facility_query_run = mysqli_query($con, $facility_query);

                if (mysqli_num_rows($facility_query_run) > 0) {
                    foreach ($facility_query_run as $facility) {
                        ?>
                        <div class="box col-md-4 mb-4">
                            <a href="facility.php?facility=<?= $facility['facility_name']; ?>" class="text-decoration-none">
                                <img src="images/<?= $facility['facility_image']; ?>" alt="<?= $facility['facility_name']; ?>" class="img-fluid rounded shadow">
                                <h2 class="mt-3"><?= $facility['facility_name']; ?></h2>
                                <p class="text-muted"><?= $facility['description']; ?></p>
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <h2 class="heading text-center">No facilities found</h2>
                    <?php
                }
            ?>
        </div>
    </div>
</section>

<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="main-heading">Available Rooms</h4>
                <div class="underline"></div>
            </div>
        </div>
        <div class="row mt-4">
            <?php
                $room_query = "SELECT * FROM rooms WHERE status='0'";
                $room_query_run = mysqli_query($con, $room_query);

                if (mysqli_num_rows($room_query_run) > 0) {
                    foreach ($room_query_run as $room) {
                        ?>
                        <div class="col-md-4">
                            <a href="view.php?room=<?= $room['id']; ?>" class="text-decoration-none">
                                <div class="card-box">
                                    <div class="roomimage">
                                        <img src="uploads/<?= $room['room_image']; ?>" alt="<?= $room['room_name'] ?>">
                                    </div>
                                    <div class="card-box-body">
                                        <h4 class="card-heading">
                                            <?= $room['room_name']; ?>
                                            <button class="btn btn-sm btn-primary text-white">Book Now</button>
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <h2 class="heading text-center">No rooms found</h2>
                    <?php
                }
            ?>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>

<script>
$(document).ready(function () {
    $('.testimonials').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
});
