<div class="row">
    <div class="small-12 columns"><h3 class="subheader">Wachtwoord vergeten?</h3>
<p>Vul je e-mailadres in zodat we je een link kunnen sturen om je wachtwoord opnieuw in te stellen</p>

<div id="infoMessage"><?php echo $message;?></div>
    </div>
</div>
<div class="row">
    <div class="small-6 columns">
<?php echo form_open("wachtwoord-vergeten");?>

      <p>
      	E-mailadres <br />
      	<?php echo form_input($email);?>
      </p>

     <p><button type="submit" id="submitknop"  class="medium button radius">Verstuur</button></p>

<?php echo form_close();?>
  </div>
</div>