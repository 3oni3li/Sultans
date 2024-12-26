<?php include('includes/header.php') ?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="pl-3 pt-3">
                        <h4 class="heading">Add New Room</h4>
                        <hr>
                    </div>
                    
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">hall Name</label>
                                        <input type="text" required class="form-control" name="room_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Door No</label>
                                        <input type="text" required class="form-control" name="door_no">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Total Rooms</label>
                                        <input type="number" required class="form-control" name="noofrooms">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Capacity</label><small class="help-text">Seats No</small>
                                        <input type="number" required class="form-control" name="capacity">
                                    </div>
                                </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="summernote form-control" required name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Add hall Imagealls</label>
                                        <input type="file" required class="form-control" name="room_image">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Show/Hide</label> <br>
                                        <label class="switch">
                                            <input type="checkbox" name="visibility">
                                            <span class="slider round"></span>
                                        </label>
                                        <small class="help-text">Green=Shown, Red=Hidden</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" name="add_room_btn" class="btn btn-primary btn-block float-right">Add Room</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>



<?php include('includes/footer.php') ?>
