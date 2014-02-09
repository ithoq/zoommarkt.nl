<style>
    #sortable-list		{ padding:0; }
    #sortable-list li	{ cursor:move;}
    #infotxt  { background:#666;color:#fff; padding:8px; text-align: center }
</style>
<form id="dd-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <div class="row">
        <div class="large-12 columns">
            <h3>Profielpagina <?php if (isset($user)) { ?><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?><?php } ?></h3>
            <?php if (isset($message)) { ?>
                <div id="infoMessage"><?php echo $message; ?> </div>
            <?php } ?>
        </div>       
    </div> 
    <div class="row">
        <div class="small-8 columns">
            <dl class="tabs">
                <dd><a href="/profiel" >Mijn profiel</a></dd>
                <dd><a href="/aanpassen">Aanpassen</a></dd>
                <dd class="active"><a href="/mijn-fotos/alles" >Mijn foto's</a></dd>
                <dd><a href="/foto-toevoegen" >Foto's toevoegen</a></dd>
            </dl>
        </div>
        <div class="small-4 columns">
            <dl class="sub-nav right" style="margin:35px 20px 0px 0px">
                <dt>Weergave:</dt>
                <dd id="gridbutton" class="active"><a href="javascript:void(0)" onclick="switchView('gridview','fast')">Grid</a></dd>
                <dd id="listbutton"><a href="javascript:void(0)" onclick="switchView('listview','fast')">Lijst</a></dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="small-8 columns">
            <p>Hieronder staan je foto's. 
                
                <?php 
                      if (isset($image_count['99']) ) { ?>
                   <a href="/mijn-fotos/nieuw">Je hebt nog foto's die niet vindbaar zijn.</a>  
                   Deze foto's zijn uitgegrijsd in het overzicht. Je kan ze vindbaar maken door er een titel, een categorie en tags aan toe te voegen.
                <?php } ?>   
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="small-8 columns">
        <div id="message-box"> 
            <div id="infotxt">Sorteer de foto's door ze te verslepen. Foto's bovenaan de lijst worden eerder gevonden.</div>
            <input type="submit" style="display:none;height:32px;padding-top:10px;margin:0px" id="savesort" name="do_submit" value="Sla sortering op" class="button small radius expand" />
        </div>

    </div>
    <div class="small-4 columns">
        <select name="category" onchange="document.location=this[this.selectedIndex].value" >
            <option value="/mijn-fotos"> Alle categorieen </option>
            <?php foreach ($categories as $category) { ?>
                <option value="/mijn-fotos/<?php echo $category['slug']; ?>" <?php if (isset($category_data['category_id'])) if ($category['category_id'] == $category_data['category_id']) echo "selected" ;?>><?php echo $category['name']; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="imagelist gridview"  style="display:none">
    <div class="row">

        <div class="small-12 columns">
            <ul id="sortable-list" class="small-block-grid-2  medium-block-grid-3 large-block-grid-4">
                <?php
                $order = array();
                foreach ($images as $image) {
                    $order[] = $image['image_id'];
                    ?>
                    <li title="<?php echo $image['image_id']; ?>" <?php if ($image['image_stat'] == 1) {
                        echo 'class="closed"';
                    } ?>>  
                        <div class="mythumb" onclick="editImage('<?php echo $image['image_id']; ?>')" style="background-image: url(<?php echo base_url() . getImage($image['file_name'], 300, 300); ?>);"></div>
                    </li>     
<?php } ?>
            </ul>
        </div>  
    </div>  
</div>
<div class="imagelist listview" style="display:none"> 
    <?php
    foreach ($images as $image) {
        ?>
        <div class="row<?php if ($image['image_stat'] == 1) {
            echo " closed";
        } ?>" style="padding-bottom:20px;" >
            <div class="small-1 columns">
                <div class="mythumb" onclick="editImage('<?php echo $image['image_id']; ?>')" style="width:70px;height:70px;background-image: url(<?php echo base_url() . getImage($image['file_name'], 100, 100); ?>);"></div>
            </div>
            <div class="small-3 columns">
                <p><strong><?php if (empty($image['title'])) {
                    echo "geen titel";
                } else {
                    echo $image['title'];
                }; ?></strong><br>
    <?php if (empty($image['description'])) {
        echo "geen beschrijving";
    } else {
        echo $image['description'];
    }; ?>
                </p>
            </div>
            <div class="small-2 columns">
                3 keer bekeken
            </div>
            <div class="small-2 columns">
                0 keer gekocht
            </div>
            <div class="small-2 columns">
    <?php if ($image['image_stat'] == 1) {
        echo "nog niet vindbaar";
    } else {
        echo "openbaar";
    }; ?><br>
            </div>
            <div class="small-1 columns">
                <div class="right" ><a class="small button radius alert custom-narrow" href="javascript:void(0)" onclick="deleteImage('<?php echo $image['image_id']; ?>')" >Delete</a></div>
            </div>
        </div>   
<?php } ?>

</div>

<p><?php echo $links; ?></p>
<input type="hidden" name="category_id" id="category_id" value="<?php if (isset($category_data['category_id'])) echo $category_data['category_id']; ?>" />    
<input type="hidden" name="sort_order" id="sort_order" value="<?php echo implode(',', $order); ?>" />

</form>
<div id="update_image" class="reveal-modal large" data-reveal style="width:800px">
    <a id="close_save" class="close-reveal-modal">&#215;</a>
    <iframe src="about:blank" name="ei_frame" width="90%" marginwidth="0" height="400" marginheight="0" scrolling="no" frameborder="0" id="ei_frame"></iframe>
</div>

<div id="remove_image" class="reveal-modal tiny" data-reveal>
    <div class="row">
        <div class="small-12 small-centered columns">
            <h4>Weet je zeker dat je deze foto wilt verwijderen?</h4>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
        <?php echo form_open('/afbeeldingen/delete_image'); ?>
                <input type="hidden" name="image_id" id="del_image" value="" />
                <input type="hidden" name="category_path" value="<?php if (isset($category_data['slug'])) { echo $category_data['slug']; } else { echo "alles";};?>" />
                
                <a href="#" class="small button radius" onClick="$('.close-reveal-modal').trigger('click')">Annuleer</a>
                <button type="submit" id="submitknop"  class="small button alert radius right">Verwijder</button>
               <?php echo form_hidden($csrf); ?>
               <?php echo form_close(); ?>
        </div>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>


<script>
    
    function deleteImage(id){
	// roep de delete functie aan, geef een id door aan het formulier in het modal
	$('#del_image').val(id);
	$('#remove_image').foundation('reveal', 'open');
}
  $(document).ready(function() {
      if ($.cookie("switchview")){
          switchView($.cookie("switchview"),'instant');
      } else {
           switchView('gridview');
      }
  });
    
    
    function switchView(view,speed) {
        var fader = 250;
        if (speed == 'fast') {
             fader = 0;
        }
        if (view == 'listview') {
            $('.imagelist.gridview').fadeOut(fader, function() {
                $('.imagelist.listview').fadeIn(fader);
            });
            $('#gridbutton').removeClass('active');
            $('#listbutton').addClass('active');
            $('#message-box').hide();
        }
        if (view == 'gridview') {
            $('.imagelist.listview').fadeOut(fader, function() {
                $('.imagelist.gridview').fadeIn(fader);
            });
            $('#gridbutton').addClass('active');
            $('#listbutton').removeClass('active');
            $('#message-box').show();
        }
        $.cookie("switchview",view);
    }
    function editImage(id) {
        var framesrc = '/afbeeldingen/edit_image/' + id;
        $('#ei_frame').attr("src", framesrc);
        $('#update_image').foundation('reveal', 'open');
    }

    /* when the DOM is ready */

    

</script>
