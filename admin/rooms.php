<?php include('includes/header.php') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="pl-3 pt-3">
                    <h4 class="heading">All Rooms</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Room Name</th>
                                    <th>Door No</th>
                                    <th>Total Rooms</th>
                                    <th>Capacity</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $all_rooms = "SELECT * FROM rooms"; 
                                $all_rooms_run = mysqli_query($con, $all_rooms);

                                if(mysqli_num_rows($all_rooms_run) > 0):
                                    foreach($all_rooms_run as $row)
                                    {
                                    ?>
                                    <tr>
                                        <td> <?= $row['id']; ?> </td>
                                        <td> <?= $row['room_name']; ?> </td>
                                        <td> <?= $row['door_no']; ?> </td>
                                        <td> <?= $row['room_qty']; ?> </td>
                                        <td> <?= $row['capacity']; ?> </td>
                                        <td> 
                                            <img src="../uploads/<?= $row['room_image']; ?>" width="50px" alt="Image here">
                                        </td>
                                        <td> 
                                            <?= $row['status'] == '1'?  '<span class="text-danger fw-bold">Hidden</span> ':'<span class="text-success fw-bold">Visible</span>'; ?> 
                                        </td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <button type="submit" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm" name="delete_room">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                else :
                                ?>
                                <tr class="text-center">
                                    <td colspan="9"><h1>No records Found </h1></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<?php include('includes/footer.php') ?>
