<?php 
    include('Layout/header.php');
    include('Layout/sidebar.php');

?>

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Savings Page
             
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Savings Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">Title</h3> -->

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
          Add New
          </button>

          <!-- <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div> -->
        </div>
        <div class="card-body">


        <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>
                      <button class="btn btn-primary">Edit</button>
                      <button class="btn btn-danger">Disable</button>
                     
                    </td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.0
                    </td>
                    <td>Win 95+</td>
                    <td>5</td>
                    <td>
                      <button class="btn btn-primary">Edit</button>
                      <button class="btn btn-danger">Disable</button>
                     
                    </td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.5
                    </td>
                    <td>Win 95+</td>
                    <td>5.5</td>
                    <td>
                      <button class="btn btn-primary">Edit</button>
                      <button class="btn btn-danger">Disable</button>
                     
                    </td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 6
                    </td>
                    <td>Win 98+</td>
                    <td>6</td>
                    <td>
                      <button class="btn btn-primary">Edit</button>
                      <button class="btn btn-danger">Disable</button>
                     
                    </td>
                  </tr>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Entry Date</th>
                    <th>Action</th>
                  </tr>

                  
                  </tfoot>
                </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Savings</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <form action="process.php" method="POST">
              <input type="hidden" name="entered_by" value="<?php echo $_SESSION['id'];?>">


              <?php 
                
                $sql = "SELECT id, first_name, last_name FROM customers";
                $result = $conn->query($sql);

                //second sql
                $sql2 = "SELECT MAX(id) FROM savings_account";
                $result1 = $conn->query($sql2);
                $row1 = $result1->fetch_row();
                //print_r($row1);

                if($row1[0] == '' || $row1[0] == NULL){
                  $account_no = '#0000-1';
                }
                else{
                  $account_no = '#0000-' . ($row1[0] + 1);
                }

              ?>

              <div class="form-group">
                <label>Account No</label>
                <input type="text" name="account_no" value="<?php echo $account_no;?>" class="form-control" readonly>
              </div>



              <div class="form-group">
                <label>Customer</label>
                <select name="customer_id" id="" class="form-control">
                  <option value="">Select option</option>

                  <?php 
                     while($row = $result->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $row['id'];?>"><?php echo $row['first_name'] . " " . $row['last_name'];?></option>
                  <?php }?>

                </select>
              </div>


              <div class="form-group">
                <label>Frequency</label>
                <select name="savings_frequency" id="" class="form-control">
                  <option value="">Select option</option>
                  <option value="daily">Daily</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>

                </select>
              </div>
           



            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="create_account" class="btn btn-primary">Create Account</button>
            </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
        <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php 
    include('Layout/footer.php');
    

?>





<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Savings</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <form action="process.php" method="POST">
              <input type="hidden" name="entered_by" value="<?php echo $_SESSION['id'];?>">


              <?php 
                
                $sql = "SELECT id, first_name, last_name FROM customer_name";
                $result = $conn->query($sql);

                //second sql
                $sql2 = "SELECT MAX(id) FROM savings_account";
                $result1 = $conn->query($sql2);
                $row1 = $result1->fetch_row();
                //print_r($row1);

                if($row1[0] == '' || $row1[0] == NULL){
                  $account_number = '#0000-1';
                }
                else{
                  $account_number = '#0000-' . ($row1[0] + 1);
                }

              ?>

              <div class="form-group">
                <label>Account No</label>
                <input type="text" name="account_number" value="<?php echo $account_no;?>" class="form-control" readonly>
              </div>

              <div class="form-group">
                <label>Customer</label>
                <select name="customer_id" id="" class="form-control">
                  <option value="">Select option</option>

                  <?php 
                     while($row = $result->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $row['id'];?>"><?php echo $row['first_name'] . " " . $row['last_name'];?></option>
                  <?php }?>

                </select>
              </div>


              <div class="form-group">
                <label>Frequency</label>
                <select name="savings_frequency" id="" class="form-control">
                  <option value="">Select option</option>
                  <option value="daily">Daily</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>

                </select>
              </div>
           



            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="create_account" class="btn btn-primary">Create Account</button>
            </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  