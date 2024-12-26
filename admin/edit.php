<?php include('includes/header.php') ?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="pl-3 pt-3">
                        <h4 class="heading">Edit hall Details</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <?php 
                        if(isset($_GET['id']))
                        {
                            $editid = $_GET['id'];
                            $editdata_query = "SELECT * FROM rooms WHERE id='$editid'"; 
                            $editdata_run = mysqli_query($con, $editdata_query);
                            $data = mysqli_fetch_array($editdata_run);
                            if(mysqli_num_rows($editdata_run) > 0)
                            {
                        ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="room_id" value="<?= $data['id']; ?>" />

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">hall Name</label>
                                                <input type="text" class="form-control" value="<?= $data['room_name']; ?>" name="room_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Door No</label>
                                                <input type="text" class="form-control" value="<?= $data['door_no']; ?>" name="door_no">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Total Rooms</label>
                                                <input type="number" class="form-control" value="<?= $data['room_qty']; ?>" name="noofrooms">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Capacity</label><small class="help-text">Seats No.</small>
                                                <input type="number" class="form-control" value="<?= $data['capacity']; ?>" name="capacity">
                                            </div>
                                        </div>
                                            
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="summernote form-control" required name="description"><?= $data['description']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Add hall Imagealls</label>
                                                <input type="file" class="form-control" name="room_image">
                                                <input type="hidden" name="room_image_old" value="<?= $data['room_image']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label">Show/Hide</label> <br>
                                                <label class="switch">
                                                    <input type="checkbox" <?= $data['status'] == '0'? '':'checked'; ?> name="visibility">
                                                    <span class="slider round"></span>
                                                </label>
                                                <small class="help-text">Green=Shown, Red=Hidden</small>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <button type="submit" name="update_room_btn" class="btn btn-primary btn-block float-right">Update Details</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                        <?php 
                            }
                            else
                            {
                                ?>
                                    <h1>No Record Found</h1>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <h1>Error: 404 Not Found</h1>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>



<?php include('includes/footer.php') ?>
