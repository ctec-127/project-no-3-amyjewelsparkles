<?php // Filename: connect.inc.php

require_once __DIR__ . "/../db/mysqli_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

// http://php.net/manual/en/mysqli.real-escape-string.php

if($_SERVER['REQUEST_METHOD']=="POST"){
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        # Old way
        #$first = $_POST['first'];
        # New way
        $first = $db->real_escape_string($_POST['first']);
    }
    if (empty($_POST['last'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        #$last = $_POST['last'];
        $last = $db->real_escape_string($_POST['last']);
    }
    if (empty($_POST['sid'])) {
        array_push($error_bucket,"<p>A student ID is required.</p>");
    } else {
        #$sid = $_POST['id'];
        $sid = $db->real_escape_string($_POST['sid']);
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        #$email = $_POST['email'];
        $email = $db->real_escape_string($_POST['email']);
    }
    if (empty($_POST['phone'])) {
        array_push($error_bucket,"<p>A phone number is required.</p>");
    } else {
        #$phone = $_POST['phone'];
        $phone = $db->real_escape_string($_POST['phone']);
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
        $sql = "INSERT INTO $db_table (first_name,last_name,student_id,email,phone,gpa,financial_aid,degree_program,grad_date) ";
        $sql .= "VALUES ('$first','$last',$sid,'$email','$phone','$gpa','$financial_aid','$degree_program','$grad_date')";

        // comment in for debug of SQL
        // echo $sql;

        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            New record with Student ID:' . $sid . ' has been created!  <a href="create-record.php">Create Another Record?</a>
          </div>';

        }
    } else {
        display_error_bucket($error_bucket);
    }
}

?>
