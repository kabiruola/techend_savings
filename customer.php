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
            <h1>Customer Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Customer Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <?php 
          if(isset($_SESSION['msg_save'])){

          
        ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong><?php echo $_SESSION['msg_save'];?></strong>
        
        </div>
        <?php 
         unset($_SESSION['msg_save']);
          }
          elseif(isset($_SESSION['error_save'])){ 
          
        ?>

          <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong><?php echo $_SESSION['error_save'];?></strong>
        
        </div>
        <?php 
         unset($_SESSION['error_save']); 
          
          
        }
          
        ?>
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
                    <?php 
                    //pass our database credentials into variables
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "adashe_online";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection if exists
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql= "SELECT first_name, last_name, email, phone_number, entry_date FROM customer_table";
                    
                    $result = $conn->query($sql);

                    // if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                     
                     } 
                    
                  ?>
                
                <tr>
                    <td><?php echo $row['first_name'] . ' ' .$row['last_name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['phone_number'];?></td>
                    <td><?php echo $row['entry_date'];?></td>
                    <td>
                      <!-- <button class="btn btn-primary">Edit</button> -->
                      <a href="#edit-modal<?php echo $row['id']; ?>" class="btn btn-primary" data-toggle="modal">Edit</a>
                      <button class="btn btn-danger">Disable</button>

                  
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
              <h4 class="modal-title">Add Customers</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
            <form action="process.php" method="POST">
              <!-- <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>"> -->
              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name..." required>
              </div>

              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name..." required>
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="abc@gmail.com" required>
              </div>

              <div class="form-group">
                <label>Phone No</label>
                <input type="number" name="phone_number" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" cols="3"></textarea>
              </div>
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save</button> -->

              <input type="submit" name="save" class="btn btn-success" value="Submit">
            </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    