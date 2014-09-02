<div id="alert1"> </div>
<div id="alert2"> </div>

<article class="therm">
	<input id="user_count" value="<?php echo $num_pushups_user ?>" class="hidden" >
	<input id="team_count" value="<?php echo $num_pushups_team ?>" class="hidden" >
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/thermometer.js"></script>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/thermometer.css"); ?>">
</article>

<p> <a href= "<?php echo base_url();?>index.php/home"> Go home</a> </p>
<p> <a href= "<?php echo base_url();?>index.php/home/logout"> Logout</a> </p>
