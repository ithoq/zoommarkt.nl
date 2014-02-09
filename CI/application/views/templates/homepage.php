<div class="row">
    <div class="large-12 columns">
<?php if (isset($user)){ ?>
        <h3 class="subheader">Welkom <?php echo $user['first_name'];?> <?php echo $user['last_name'];?></h3>
 <?php }?>
<?php if (isset($message)){ ?>
      <div id="infoMessage"><?php echo $message;?> </div>
<?php }?>
</div>       
</div>
