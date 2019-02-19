<?php // Filename: create-record.php
$pageTitle = "Create Record";
//getting the header content
require 'inc/layout/header.inc.php'; 
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1>Create a New Record</h1>
			<!-- getting create content and form files-->
			<?php require __DIR__ .'/inc/create/content.inc.php'; ?>
			<?php require __DIR__ .'/inc/create/form.inc.php' ?>
		</div>
    </div>
</div>
<!-- getting the footer file content -->
<?php require 'inc/layout/footer.inc.php'; ?>