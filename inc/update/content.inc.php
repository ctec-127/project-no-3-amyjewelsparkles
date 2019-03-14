<?php // Filename: connect.inc.php

require_once __DIR__ . "/../db/mysqli_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

// http://php.net/manual/en/mysqli.real-escape-string.php

if($_SERVER['REQUEST_METHOD']=="POST"){
    // grab primary key from hidden field
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    }
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        $first = $db->real_escape_string(strip_tags($_POST['first']));
    }
    if (empty($_POST['last'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        $last = $db->real_escape_string(strip_tags($_POST['last']));
    }
    if (empty($_POST['sid'])) {
        array_push($error_bucket,"<p>A student ID is required.</p>");
    } else {
        $sid = $db->real_escape_string(strip_tags($_POST['sid']));
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }
    if (empty($_POST['phone'])) {
        array_push($error_bucket,"<p>A phone number is required.</p>");
    } else {
        $phone = $db->real_escape_string(strip_tags($_POST['phone']));
    }
    if (!isset($_POST['gpa'])) {
        array_push($error_bucket,"<p>GPA is required.</p>");
    }else {
        #$gpa = $_POST['gpa'];
        $gpa = $db->real_escape_string($_POST['gpa']);
    }
    if (empty($_POST['financial_aid'])) {
        array_push($error_bucket,"<p>Financial Aid information is required.</p>");
    }elseif($_POST['financial_aid'] == 'no'){
        $financial_aid = $db->real_escape_string('no');
    }else{
        #$financial_aid = $_POST['financial_aid'];
        $financial_aid = $db->real_escape_string($_POST['financial_aid']);
    }
    if (empty($_POST['degree_program'])) {
        array_push($error_bucket,"<p>A degree program is required.</p>");
    } else {
        #$degree_program = $_POST['degree_program'];
        $degree_program = $db->real_escape_string($_POST['degree_program']);
    }
    if(empty($_POST['grad_date'])){
        array_push($error_bucket,"<p>Gradutaion Date is required.</p>");
    } else{
        $grad_date = $db->real_escape_string($_POST['grad_date']);
    }

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        if($_POST['financial_aid'] == 'no'){
            $financial_aid = $db->real_escape_string('0');
        }
        $sql = "UPDATE $db_table SET first_name='$first', last_name='$last', student_id=$sid, email='$email', phone='$phone', gpa='$gpa', financial_aid='$financial_aid', degree_program='$degree_program', grad_date='$grad_date' WHERE id=$id";

        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            The record with Student ID: '. $sid . ' has been updated! <a href="display-records.php">Back to Record Manager</a>
          </div>';
            
        }
    } else {
        display_error_bucket($error_bucket);
    } // end of error bucket
} else {
    // check for record id (primary key)
    $id = $_GET['id'];
    // now we need to query the database and get the data for the record
    // note limit 1
    $sql = "SELECT * FROM $db_table WHERE id=$id LIMIT 1";
    // query database
    $result = $db->query($sql);
    // get the one row of data
    while($row = $result->fetch_assoc()) {
        $first = $row['first_name'];
        $last = $row['last_name'];
        $sid = $row['student_id'];
        $email = $row['email'];
        $phone = $row['phone'];
        $degree_program = $row['degree_program'];
        $grad_date = $row['grad_date'];
        $gpa = $row['gpa'];
        $financial_aid = $row['financial_aid'];
        
    }
}