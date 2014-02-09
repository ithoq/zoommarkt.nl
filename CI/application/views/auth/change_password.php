<div class="row">
    <div class="small-12 columns">
<h3 class="subheader">Wachtwoord veranderen</h3>
<p></p>

<div id="infoMessage"><?php echo $message;?></div>
    </div>
</div>
<?php echo form_open("wachtwoord-veranderen");?>
<div class="row">
    <div class="small-6 columns">
      <p>
           Oude wachtwoord<br />
            <?php echo form_input($old_password);?>
      </p>

      <p>
             Nieuw wachtwoord (min. <?php echo $min_password_length;?> karakters) <br />
            <?php echo form_input($new_password);?>
      </p>

      <p>
           Bevestig het nieuwe wachtwoord<br />
            <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
      <p><button type="submit" id="submitknop"  class="medium button radius">Verstuur</button></p>
    </div>
</div>
<?php echo form_close();?>
