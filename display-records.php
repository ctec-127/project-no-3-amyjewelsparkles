<?php // Filename: display-records.php
// set page title
$pageTitle = "Record Management";
// getting header information
require 'inc/layout/header.inc.php'; 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
         <!-- getting display content php file -->
        <?php require "inc/display/content.inc.php"; ?>
        </div>
    </div> <!-- end row -->
</div> <!-- end container -->
 <!-- getting footer informaition -->
<?php require 'inc/layout/footer.inc.php'; ?>