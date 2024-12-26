<?php include('includes/header.php') ?>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
        
            <input type="hidden" class="admin_id" name="admin_id">

            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" class="form-control admin_name" name="admin_name">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" class="form-control admin_email" name="admin_email">
            </div>
            <div class="mb-3">
                <label for="">Phone number</label>
                <input type="text" class="form-control admin_phone" name="admin_phone">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="update_admin_details" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModal">Add Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" class="form-control" name="admin_name">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" class="form-control" name="admin_email">
            </div>
            <div class="mb-3">
                <label for="">Phone number</label>
                <input type="text" class="form-control" name="admin_phone">
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" class="form-control" name="admin_password">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="add_admin" class="btn btn-primary">Add Admin</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="px-3 pt-3">
                    <h4 class="heading">Manage Admins
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary float-end">Add </a>
                    </h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Edit</th>
                                    <th>Status</th>
                                    <th>Ban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $all_admin = "SELECT * FROM admins"; 
                                $all_admin_run = mysqli_query($con, $all_admin);

                                if(mysqli_num_rows($all_admin_run) > 0):
                                    foreach($all_admin_run as $row)
                                    {
                                    ?>
                                    <tr>
                                        <td> <?= $row['id']; ?> </td>
                                        <td class="admin_name"><?=$row['name'];?></td>
                                        <td class="ademail"><?=$row['email'];?></td>
                                        <td class="adphone"><?=$row['phone'];?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary edit_btn" name="edit_admin" value="<?= $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                                        </td>
                                        <td> <?= $row['status'] == '0'?'<span class="bg-success badge p-2">Active</span>':'<span class="bg-danger badge p-2">Banned</span>'; ?> </td>
                                        <td> 
                                            <form action="code.php" method="POST">
                                                <?php if($row['status'] == '0') :?>                                                        
                                                    <button type="submit" value="<?=$row['id'];?>" <?= $row['super_admin'] == '1' ? 'disabled':'';?> class="btn btn-danger btn-sm" name="ban_admin">Ban</button>
                                                <?php  else: ?>
                                                    <button type="submit" value="<?=$row['id'];?>" class="btn btn-success btn-sm" name="unban_admin">Unban</button>
                                                <?php  endif; ?>
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
<script>
    $('.edit_btn').click(function (e) { 
        e.preventDefault();
        
        var id = $(this).val();
        var name = $(this).closest('tr').find('.adname').text();
        var email = $(this).closest('tr').find('.ademail').text();
        var phone = $(this).closest('tr').find('.adphone').text();

        $('.admin_id').val(id);
        $('.admin_name').val(name);
        $('.admin_email').val(email);
        $('.admin_phone').val(phone);
        $('#editmodal').modal('show');

    });

</script>