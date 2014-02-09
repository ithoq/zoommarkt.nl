<div class="row">
    <div class="small-12 columns">
        <h3 class="subheader">Login met uw e-mailadres en uw wachtwoord</h3>
    </div>
</div>
<div class="row">
    <div class="small-12 columns">
       <div id="infoMessage"><?php echo $message; ?></div>
    </div>
</div>
<?php echo form_open("inloggen"); ?>
<div class="row">
    <div class="small-6 columns">
        <p>
            <?php echo lang('login_identity_label', 'identity'); ?>
            <?php echo form_input($identity); ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="small-6 columns">
        <p>
            <?php echo lang('login_password_label', 'password'); ?>
            <?php echo form_input($password); ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="small-6 columns">
        <p>
          <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> wachtwoord onthouden  
        </p>
    </div>
</div>
<div class="row">
    <div class="small-6 columns">
         <button type="submit" id="submitknop"  class="medium button radius">Verstuur</button>
    </div>
</div>
<div class="row">
    <div class="small-4 columns">
        <p><a href="wachtwoord-vergeten"><?php echo lang('login_forgot_password'); ?></a></p>
    </div>
</div>
<?php echo form_close(); ?>

