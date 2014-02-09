<div class="row">
    <div class="large-12 columns">
        <h3>Profielpagina <?php if (isset($user)) { ?><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?><?php } ?></h3>
        <?php if (isset($message)) { ?>
            <div id="infoMessage"><?php echo $message; ?> </div>
        <?php } ?>
    </div>       
</div> 
<div class="row">
    <div class="large-12 columns">
        <dl class="tabs">
            <dd><a href="/profiel" >Mijn profiel</a></dd>
            <dd class="active"><a href="/aanpassen">Aanpassen</a></dd>
            <dd><a href="/mijn-fotos/alles" >Mijn foto's</a></dd>
            <dd><a href="/foto-toevoegen" >Foto's toevoegen</a></dd>
        </dl>
    </div>
</div>
<?php $this->load->view('templates/forms/user');?>