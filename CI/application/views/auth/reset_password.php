<div class="row">
    <div class="small-12 columns">
        <h3 class="subheader">Wachtwoord veranderen</h3>
        <p>            
        </p>
        

<div id="infoMessage"><?php echo $message;?></div>
    </div>
</div>
<div class="row">
    <div class="small-6 columns">
<?php echo form_open('wachtwoord-reset/' . $code);?>

	<p>
		Nieuw wachtwoord (min. <?php echo $min_password_length;?> karakters) <br />
		<?php echo form_input($new_password);?>
	</p>

	<p>
		Bevestig het nieuwe wachtwoord<br />
		<?php echo form_input($new_password_confirm);?>
	</p>

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>

	<p><button type="submit" id="submitknop"  class="medium button radius">Verstuur</button></p>

<?php echo form_close();?>
  </div>
</div>