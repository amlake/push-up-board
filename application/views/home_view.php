<h3>Welcome, <?php echo $username; ?>!</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('home/record') ?>

	<label for="number">Number of push-ups</label>
	<input type="input" name="number" /><br/>

	<input type="submit" name="submit" value="Submit" />

</form>

 <a href="home/logout">Logout</a>
