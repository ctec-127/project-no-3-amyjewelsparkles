<?php // Filename: create-record.php
$pageTitle = "Create Record";
//getting the header content
require_once 'inc/layout/header.inc.php'; 
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1><i class="fas fa-edit mr-2"></i>Create a New Record</h1>
			<!-- getting create content and form files-->
			<?php require_once __DIR__ .'/inc/create/content.inc.php'; ?>
			<?php require_once __DIR__ .'/inc/shared/form.inc.php' ?>
		</div>
    </div>
</div>
<!-- getting the footer file content -->
<?php require_once 'inc/layout/footer.inc.php'; ?>