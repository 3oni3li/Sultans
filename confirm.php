<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/banner.php'); 
?>

<script
    src="https://www.paypal.com/sdk/js?client-id=AXH7IcgNKwYuxFcPjp9YeNCUg4MosJ7jGoDuw-OiszcjWAAyxUjfqSJSh2yc6yehRcMKIdcUaJcvLnHz&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo,paylater,card"
    data-sdk-integration-source="developer-studio"
    data-currency="SAR"></script>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="main-heading">Check Room Availability</h4>
                <div class="underline mb-0"></div>
                <hr class="my-0">
            </div>
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-body">

                        <?php
                        if (isset($_GET['checkin']) && isset($_GET['checkout']) && isset($_GET['roomid'])) {
                            $roomid = $_GET['roomid'];
                            $checkin = $_GET['checkin'];
                            $checkout = $_GET['checkout'];

                            // Fetch room details
                            $room_query = mysqli_prepare($con, "SELECT room_name, room_image, price, room_qty FROM rooms WHERE id=?");
                            mysqli_stmt_bind_param($room_query, "i", $roomid);
                            mysqli_stmt_execute($room_query);
                            $result = mysqli_stmt_get_result($room_query);

                            if ($room = mysqli_fetch_assoc($result)) {
                                $roomname = $room['room_name'];
                                $room_image = $room['room_image'];
                                $pricePerDay = $room['price'];
                                $room_qty = $room['room_qty'];
                            } else {
                                echo "<h5>Invalid Room Selected</h5>";
                                exit;
                            }

                            mysqli_stmt_close($room_query);

                            // Calculate total days
                            $checkins = new DateTime($checkin);
                            $checkouts = new DateTime($checkout);
                            $interval = $checkins->diff($checkouts);
                            $totalDays = $interval->days;

                            // Calculate total price
                            $totalPrice = $pricePerDay * $totalDays;

                            // Check room availability
                            $availability_query = "SELECT room_id FROM bookings WHERE room_id=? AND (
                                (checkin <= ? AND checkout >= ?) OR
                                (checkin >= ? AND checkin <= ?) OR
                                (checkin <= ? AND checkout >= ?)
                            )";
                            $availability_stmt = mysqli_prepare($con, $availability_query);
                            mysqli_stmt_bind_param($availability_stmt, "issssss", $roomid, $checkin, $checkout, $checkin, $checkout, $checkin, $checkin);
                            mysqli_stmt_execute($availability_stmt);
                            mysqli_stmt_store_result($availability_stmt);

                            if (mysqli_stmt_num_rows($availability_stmt) < $room_qty) {
                        ?>
                                <!-- Display Room Details -->
                                <div class="row">
                                    <div class="col-md-6 border-end">
                                        <img src="uploads/<?= htmlspecialchars($room_image) ?>" alt="<?= htmlspecialchars($roomname) ?> Image" class="w-100">
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="main-heading">Room is available</h2>
                                        <h6 class="form-control bg-white">Room Name: <?= htmlspecialchars($roomname) ?></h6>
                                        <h6 class="form-control bg-white">No of Days: <?= $totalDays ?></h6>
                                        <h6 class="form-control bg-white">Check In: <?= date('d-m-Y h:i A', strtotime($checkin)) ?></h6>
                                        <h6 class="form-control bg-white">Check Out: <?= date('d-m-Y h:i A', strtotime($checkout)) ?></h6>
                                        <h6 class="form-control bg-white">Price Per Day: SAR <?= number_format($pricePerDay, 2) ?></h6>
                                        <h6 class="form-control bg-white">Total Price: SAR <?= number_format($totalPrice, 2) ?></h6>

                                        <!-- Hidden Input for PayPal -->
                                        <input type="hidden" id="hidden_total_price" value="<?= htmlspecialchars($totalPrice) ?>">

                                        <div class="text-end mt-3">
                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            } else {
                                echo '<div class="row justify-content-center"><div class="col-md-6 text-center">
                                        <h2 class="heading">All rooms of this category are booked on the selected dates</h2>
                                        <a href="all-rooms.php" class="btn btn-primary px-4 mt-2">Back</a>
                                      </div></div>';
                            }

                            mysqli_stmt_close($availability_stmt);
                        } else {
                            echo "<h5>Invalid Request. Please try again.</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>

<!-- PayPal Integration -->
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        const totalPrice = document.getElementById('hidden_total_price').value || 0;

        if (totalPrice <= 0) {
            alert('Invalid total price');
            return;
        }

        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: totalPrice
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
            const roomID = <?= json_encode($roomid) ?>;
            const checkInDate = <?= json_encode($checkin) ?>;
            const checkOutDate = <?= json_encode($checkout) ?>;
            const totalPrice = document.getElementById('hidden_total_price').value;

            fetch('save_booking.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        room_id: roomID,
                        checkin: checkInDate,
                        checkout: checkOutDate,
                        total_price: totalPrice,
                        order_id: orderData.id,
                    }),
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result); // Log the full response for debugging
                    if (result.success) {
                        alert('Booking confirmed!');
                        window.location.href = 'bookings.php';
                    } else {
                        alert('Error: ' + result.message + '\n' + (result.error || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error); // Log fetch errors
                    alert('An error occurred while saving your booking.');
                });
        });
    },
}).render("#paypal-button-container");

</script>
