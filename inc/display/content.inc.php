<?php // Filename: connect.inc.php

// getting database info and functions
require_once __DIR__ . "/../db/mysqli_connect.inc.php";

// setting variables
$orderby = 'last_name'; //default set to 'last_name'
$filter = '';

if (isset($_GET['filter'])) {
    $filter = $_GET['filter']; // setting letter filter
}

if (isset($_GET['sortby'])) {
    $orderby = $_GET['sortby']; // setting order by 
}

if (isset($_GET['clearfilter'])){ //clear filter sets $filter to ''
    $filter = '';
}

// sql query string for getting data from table using $filter, and $orderby
$sql = "SELECT * FROM $db_table WHERE last_name LIKE '$filter%' ORDER BY $orderby ASC";

//storing data base quesry results in $results
$result = $db->query($sql);

// displaying results...

if ($result->num_rows == 0) {
    echo "<h2 class=\"mt-4 alert alert-warning\">No Records for <strong>last names</strong> starting with <strong>$filter</strong></h2>";
} else {
    if(empty($filter)){
        $text = '';
    } else {
        $text = " - last names starting with $filter";
    }
    echo "<h2 class=\"mt-4 alert alert-primary\">$result->num_rows Records" . $text . '</h2>';
}

// display alphabet filters
display_letter_filters($filter);

// display message if any
display_message();

// display the data
display_record_table($result);

# close the database
$db->close();