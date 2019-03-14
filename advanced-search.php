<?php // Filename: advanced-search.php
$pageTitle = "Advanced Search";
//getting the header content
require_once 'inc/layout/header.inc.php';
require_once 'inc/db/mysqli_connect.inc.php';
require_once 'inc/app/config.inc.php';
?>
<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1><i class="fas fa-search mr-2"></i>Advanced Search</h1>
			<form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="my-3"> 
                <?php 
                //checking for selected radio button in financial_aid
                if(isset($_POST['financial_aid'])){
                    $check = $_POST['financial_aid'];
                }else{
                    $check = '';
                }
                //setting default degree_program
                if(isset($_POST['degree_program'])){
                    $degree = $_POST['degree_program'];
                }else{
                    $degree = 'default';
                }
                ?>
                <!--form starts -->
                <div class="form-row my-2">
                    <div class="col-4">
                        <label class="row-auto-form-label" for="id">Student ID </label>
                        <input class="form-control" type="text" id="sid" name="sid" value="<?php echo (isset($_POST['sid']) ? $_POST['sid']: '');?>">
                    </div>
                    <div class="col-4">
                        <label class="row-auto-form-label" for="first">First Name </label>
                        <input class="form-control" type="text" id="first" name="first" value="<?php echo (isset($_POST['first']) ? $_POST['first']: '');?>">
                    </div>
                    <div class="col-sm-4">
                        <label class="row-auto-form-label" for="last">Last Name </label>
                        <input class="form-control" type="text" id="last" name="last" value="<?php echo (isset($_POST['last']) ? $_POST['last']: '');?>">
                    </div>
                </div>

                <div class="form-row my-2">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="row-auto-form-label" for="degree_program">Degree Program</label>
                            <select class="form-control" id="degree_program" name="degree_program">
                                <option value="default" <?php if($degree == "default") echo 'selected="selected"'?> >--select--</option>
                                <option value="AAS" <?php if($degree == "AAS") echo 'selected="selected"'?> >AAS</option>
                                <option value="AAT" <?php if($degree == "AAT") echo 'selected="selected"'?> >AAT</option>
                                <option value="AA" <?php if($degree == "AA") echo 'selected="selected"'?> >AA</option>
                                <option value="AST-1" <?php if($degree == "AST-1") echo 'selected="selected"'?> >AST-1</option>
                                <option value="AST-2" <?php if($degree == "AST-2") echo 'selected="selected"'?> >AST-2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="row-auto-form-label" for="grad_date">Graduation Date </label>
                        <input class="form-control" type="date" id="grad_date" name="grad_date" value="<?php echo (isset($_POST['grad_date']) ? $_POST['grad_date']: '');?>">
                    </div>
                    <div class="col-4">
                        <label class="row-auto-form-label" for="gpa">GPA</label>
                        <input class="form-control" type="number" min="0" max="5.0" step="0.01" id="gpa" name="gpa" value="<?php echo (isset($_POST['gpa']) ? $_POST['gpa']: '');?>">
                    </div>
                </div>
                <div class="form-row my-2">
                    <div class="col-4">
                        <label class="row-auto-form-label" for="email">Email </label>
                        <input class="form-control" type="text" id="email" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email']: '');?>">
                    </div>
                    <div class="col-4">
                        <label class="col-auto-form-label" for="phone">Phone </label>
                        <input class="form-control" type="text" id="phone" name="phone" value="<?php echo (isset($_POST['phone']) ? $_POST['phone']: '');?>">
                    </div>
                    <div class="col-4">
                        <label class="row-auto-form-label" for="yes">Financial Aid </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="financial_aid" id="yes" value="1" <?php if($check=='1') echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="financial_aid" id="no" value="0" <?php if($check=='0') echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-row my-2">
                    <div class="col-4">
                        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    </div>

                </div>
            </form>
		</div>
    </div>
</div>

<h2 class="alert alert-primary text-center">Search Results</h2>
<!-- Build search query -->
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $var=0;
    if (!empty($_POST['last'])) {
        $lastSQL = 'last_name LIKE "%'. $_POST['last'] . '%"';
        $var++;
    } else {
        $lastSQL = 'last_name Like "%"'; 
    }
    
    if (!empty($_POST["first"])) {
        $firstSQL = 'AND first_name LIKE "%'. $_POST["first"] . '%"';
        $var++;
    } else {
        $firstSQL = '';
    }
    
    if (!empty($_POST['sid'])) {
        $sidSQL = 'AND student_id LIKE "%'. $_POST['sid'] . '%"';
        $var++;
    } else {
        $sidSQL = '';
    }
    if (!empty($_POST['phone'])) {
        $phoneSQL = 'AND phone LIKE "%'. $_POST['phone'] . '%"';
        $var++;
    } else {
        $phoneSQL = '';
    }
    if (!empty($_POST['email'])) {
        $emailSQL = 'AND email LIKE "%'. $_POST['email'] . '%"';
        $var++;
    } else {
        $emailSQL = '';
    }
    if ($_POST['degree_program']=="default") {
        $degreeSQL = '';
    } else {
        $degreeSQL = 'AND degree_program="'. $_POST['degree_program'] .'"';
        $var++;
        
    }
    if (!empty($_POST['grad_date'])) {
        $gradSQL = 'AND grad_date LIKE "%'. $_POST['grad_date'] . '%"';
        $var++;
    } else {
        $gradSQL = '';
    }
    if (!empty($_POST['gpa'])) {
        $gpaSQL = 'AND gpa LIKE "%'. $_POST['gpa'] . '%"';
        $var++;
    } else {
        $gpaSQL = '';
    }
    if (isset($_POST['financial_aid'])) {
        $financial_aidSQL = 'AND financial_aid="'. $_POST['financial_aid'] . '"';
        $var++;
    } else {
        $financial_aidSQL = '';
    }
    
    // <!--display search results-->

    if ($var > 0){
        $sql = "SELECT * FROM $db_table WHERE ". $lastSQL . $firstSQL . $sidSQL . $emailSQL . $phoneSQL . $degreeSQL . $gradSQL . $gpaSQL . $financial_aidSQL . "ORDER BY last_name ASC";
        //displaying search query being sent 
        $search = $sql;
        //storing data base query results in $results;
        $result = $db->query($sql);
        //printing results
        if ($result->num_rows == 0) {
            echo "<p class=\"display-4 mt-4 text-center\"><i class=\"fas fa-user-times mr-4\"></i>No results found.</p>";
            $var=0;
        } else {
            echo "<h2 class=\"alert alert-success mt-3 text-center\"><i class=\"fas fa-user-check mr-4\"></i>$result->num_rows Record(s) found.</h2>";
            display_record_table($result);
        }
    }else{
        echo "<p class=\"display-4 mt-4 text-center\">Please enter a search criteria and press Search.</p>";
    }
}else {
    echo "<p class=\"display-4 mt-4 text-center\">Please enter a search criteria and press Search.</p>";
}
?>
<!-- getting the footer file content -->
<?php require_once 'inc/layout/footer.inc.php'; ?>