<?php // Filename: advanced-search.php
$pageTitle = "Advanced Search";
//getting the header content
require 'inc/layout/header.inc.php'; 
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1><i class="fas fa-search mr-2"></i>Advanced Search</h1>
			<form action="search-records.php" method="POST" class="form-inline my-2 my-lg-0">      
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
		</div>
    </div>
</div>
<!-- getting the footer file content -->
<?php require 'inc/layout/footer.inc.php'; ?>