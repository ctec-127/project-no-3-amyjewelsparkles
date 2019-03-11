<?php // Filename: display-records.php
// set page title
$pageTitle = "Record Management";
// getting header information
require_once 'inc/layout/header.inc.php'; 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
         <!-- getting display content php file -->
        <?php require_once "inc/display/content.inc.php"; ?>
        </div>
    </div> <!-- end row -->
</div> <!-- end container -->
 <!-- getting footer informaition -->
<?php require_once 'inc/layout/footer.inc.php'; ?>