<?php 
session_start();

    //check if submit button is clicked
    //check if all inputs are not empty
    //check if input supplied is in the database
    //add user info into session
    //redirect to dashboard

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
    else{
        //process the form
        //login query
        if(isset($_POST['submit'])){
            //pass all form inputs into variable
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            //check if form inputs is not empty
            if($email != '' && $password != ''){
                //make select statement and pass record to session
                $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    
                    $row = $result->fetch_row();//get a single row record

                    //pass info into session
                    $_SESSION['id'] = $row[0];
                    $_SESSION['email'] = $email;
                    header('location: index.php');
                }
                else{
                    //redirect basck to login page with error message
                    $_SESSION['error'] = 'Invalid Email or Password';
                    header('location: login.php');
                }
            }
            else{
                //redirect back to login page with error message
                $_SESSION['error'] = 'All Fields required!!!';
                header('location: login.php');
            }
        }
        elseif(isset($_POST['save'])){
            //add customers

            //pass all form inputs into respective variables
            $email1 = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];
            $current_date = date('Y-m-d');
            $entered_by = $_POST['id'];
            $created_at = date('Y-m-d h:i:s');

            $sql = "INSERT INTO customer_table (`first_name`, `last_name`, `phone_number`, `address`, `entry_date`, `email`, `entered_by`, `created_at`)VALUES ('$first_name', '$last_name', '$phone_number', '$address', '$current_date', '$email1', '$entered_by', '$created_at')";

            if ($conn->query($sql) === TRUE) {
                //pass success msg into session
                //redirect to customers.php
                $_SESSION['msg_save'] = 'Record Inserted Successfully!!!';

            } else {
                //pass error msg into session
                //redirect to customers.php
                $_SESSION['error_save'] = 'Record Insertion Failed!!!';
            }

            header('Location:customers.php'); 

        }
        elseif(isset($_POST['update'])){
           
            //update customers table
            //pass all form inputs into respective variables
            $email2 = $_POST['email2'];
            $first_name2 = $_POST['first_name2'];
            $last_name2 = $_POST['last_name2'];
            $phone_number2 = $_POST['phone_number2'];
            $address2 = $_POST['address2'];

            $edit_id = $_POST['edit_id'];

            //update query
            $update_query = "UPDATE customer_table SET `email` = '$email2', `first_name` = '$first_name2', `last_name` = '$last_name2', `phone_no` = '$phone_no2', `address` = '$address2' WHERE id = '$edit_id'";

            if ($conn->query($update_query) === TRUE) {
                //pass success msg into session
                //redirect to customers.php
                $_SESSION['msg_save'] = 'Record Updated Successfully!!!';

            } else {
                //pass error msg into session
                //redirect to customers.php
                $_SESSION['error_save'] = 'Record Updation Failed!!!';
            }

            header('Location:customers.php');
           
        }
        elseif(isset($_POST['disable'])){
           
            $disable_id = $_POST['disable_id'];
            $status = $_POST['status'];

            if($status == 1){
                //approve
                $message = "Record Enabled Successfully!!!";
                $error = "Enable Failed!!!";
            }
            else{
                //disable
                $message = "Record Disabled Successfully!!!";
                $error = "Disable Failed!!!";
            }
            //update query
            $disable_query = "UPDATE customer_table SET `customer_status` = '$status' WHERE id = '$disable_id'";

            if ($conn->query($disable_query) === TRUE) {
                //pass success msg into session
                //redirect to customers.php
                $_SESSION['msg_save'] = $message;

            } else {
                //pass error msg into session
                //redirect to customers.php
                $_SESSION['error_save'] = $error;
            }

            header('Location:customers.php');
        }
        elseif(isset($_POST['create_account'])){

            $customer_id = $_POST['customer_id'];
            $savings_frequency = $_POST['savings_frequency'];
            $account_number = $_POST['account_number'];
            $entered_by = $_POST['entered_by'];
           

            $sql_savings = "INSERT INTO savings_account (`customer_id`, `account_number`, `frequency`, `entry_date`, `entered_by`, `created_at`)VALUES ('$customer_id', '$account_number', '$savings_frequency', '$entry_date', '$entered_by', '$created_at')";

            if ($conn->query($sql_savings) === TRUE) {
                //pass success msg into session
                //redirect to customers.php
                $_SESSION['msg_save'] = 'Record Inserted Successfully!!!';

            } else {
                //pass error msg into session
                //redirect to customers.php
                $_SESSION['error_save'] = 'Record Insertion Failed!!!';
            }

            header('Location:savings.php'); 
           
        }
        elseif(isset($_POST['deposit'])){

            //insert into savings_transactions table
            //check if record exists in balance table, ( no record => insert a new record, if record=> update)

            $currentUser = $_POST['id'];
            $savings_id = $_POST['savings_id'];
            $deposited_amount = $_POST['deposit_amount'];
            $cust_id = $_POST['customer_id'];
            $current_balance = $_POST['current_balance'];

           // $fetch_customer_id

            if($deposited_amount < 1){
                $_SESSION['error_save'] = 'Please enter a valid amount!!!';
                header('Location:savings.php'); 
            }

            //insert into transactions table
            $sql_savings_transactions = "INSERT INTO savings_transactions (`savings_id`, `customer_id`, `amount`, `category`, `entry_date`, `entered_by`, `created_at`)VALUES ('$savings_id', '$cust_id', '$deposited_amount', 'credit', '$entry_date', '$currentUser', '$created_at')";

            $conn->query($sql_savings_transactions);

            //savings balance table
            if($current_balance == 0){
                //insert record
                $new_balance = $deposited_amount;

                $sql_savings_bal = "INSERT INTO savings_balance (`savings_id`, `customer_id`, `balance`)VALUES ('$savings_id', '$cust_id', '$new_balance')";
            }
            elseif($current_balance > 0){
                //update record
                $new_balance = $deposited_amount + $current_balance;

                $sql_savings_bal = "UPDATE savings_balance SET `balance` = '$new_balance' WHERE `savings_id` = '$savings_id'";
            }
            
            if ($conn->query($sql_savings_bal) === TRUE) {
                //pass success msg into session
                //redirect to customers.php
                $_SESSION['msg_save'] = 'Record Inserted Successfully!!!';

            } else {
                //pass error msg into session
                //redirect to customers.php
                $_SESSION['error_save'] = 'Record Insertion Failed!!!';
            }

            header('Location:savings.php'); 

           
        }



      
    }
   
    

?>