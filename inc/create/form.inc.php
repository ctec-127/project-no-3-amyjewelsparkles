<?php // Filename: form.inc.php ?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <label class="col-form-label" for="first">First Name </label>
    <input class="form-control" type="text" id="first" name="first" value="<?php echo (isset($first) ? $first: '');?>">
    <br>
    <label class="col-form-label" for="last">Last Name </label>
    <input class="form-control" type="text" id="last" name="last" value="<?php echo (isset($last) ? $last: '');?>">
    <br>
    <label class="col-form-label" for="id">Student ID </label>
    <input class="form-control" type="text" id="id" name="id" value="<?php echo (isset($id) ? $id: '');?>">
    <br>
    <label class="col-form-label" for="email">Email </label>
    <input class="form-control" type="text" id="email" name="email" value="<?php echo (isset($email) ? $email: '');?>">
    <br>
    <label class="col-form-label" for="phone">Phone </label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo (isset($phone) ? $phone: '');?>">
    <br>
    <label class="col-form-label" for="gpa">GPA</label>
    <input class="form-control" type="number" min="0" max="5.0" step="0.01" id="gpa" name="gpa" value="<?php echo (isset($gpa) ? $gpa: '');?>">
    <br>
    <label class="col-form-label" for="yes">Financial Aid: </label>
    
    <label class="radio-inline" for="yes"><input type="radio" name="financial_aid" id="yes" value="YES"> Yes </label>
    <label class="radio-inline" for="no"><input type="radio" name="financial_aid" id="no" value="NO" checked> No </label>
    <br>
    <div class="form-group">
        <label for="degree_program">Degree Program</label>
        <select class="form-control" id="degree_program" name="degree_program">
            <option>AAS</option>
            <option>AAT</option>
            <option>AA</option>
            <option>AST-1</option>
            <option>AST-2</option>
        </select>
    </div>
        <br>
    <br>

    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit">Save Record</button>
</form>