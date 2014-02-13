<style>
    .top_nav_img{width:100%;background-color:#333; opacity: 0.8;font-size: 0.8em;padding:3px 5px;}
    .top_nav_img a {;color:#fff;}
    .visible-img{ margin-top:20px;}
    .visible-img img{ margin-bottom:40px;}
    .clearing-assembled.clearing-blackout,
    .clearing-assembled .clearing-container .carousel, 
    .clearing-assembled .clearing-container .visible-img{ 
        background:#000 
    }
    .clearing-assembled .clearing-container .carousel {height:20px; }
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
            <dl class="sub-nav right" style="margin:0px 20px 0px 0px">
                <dt>Weergave:</dt>
                <dd id="gridbutton" class="active"><a href="javascript:void(0)" onclick="switchView('gridview', 'fast')">Grid</a></dd>
                <dd id="listbutton"><a href="javascript:void(0)" onclick="switchView('listview', 'fast')">Lijst</a></dd>
            </dl>
            <dl class="sub-nav right" style="margin:0px 20px 0px 0px">
                <dt>Aantal:</dt>
                <dd id="gridbutton" class="active"><a href="javascript:void(0)" onclick="switchList('12')">12</a></dd>
                <dd id="listbutton"><a href="javascript:void(0)" onclick="switchList('24')">24</a></dd>
                <dd id="listbutton"><a href="javascript:void(0)" onclick="switchList('36')">36</a></dd>
                <dd id="listbutton"><a href="javascript:void(0)" onclick="switchList('48')">48</a></dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="small-8 columns">
            <p>Hieronder staan je foto's.
                <?php if (isset($image_count['99'])) { ?>
                    <a href="/mijn-fotos/nieuw">Je hebt nog foto's die niet vindbaar zijn.</a>
                    Deze foto's zijn uitgegrijsd in het overzicht. Je kan ze vindbaar maken door er een titel, een categorie en tags aan toe te voegen.
                <?php } ?>
            </p>
        </div>
    </div>
    <div class="row collapse" style="overflow:hidden;min-height:640px;">
        <div class="form-btn" style="display:none"></div>
        <div class="small-12 columns">
            <nav class="pushy pushy-left" style="padding-top:50px;">
                <iframe src="about:blank" name="ei_frame" width="100%" marginwidth="0" height="620" marginheight="0" scrolling="no" frameborder="0" id="ei_frame"></iframe>
            </nav>
            <div id="container">

                <div class="row">
                    <div class="small-8 columns">
                        <div id="message-box" class="">
                            <div id="infotxt">Sorteer de foto's door ze te verslepen. Foto's bovenaan de lijst worden eerder gevonden.</div>
                            <input type="submit" style="display:none;height:32px;padding-top:10px;margin:0px" id="savesort" name="do_submit" value="Sla sortering op" class="button small radius expand" />
                        </div>
                    </div>
                    <div class="small-4 columns">
                        <select name="category" onchange="document.location = this[this.selectedIndex].value" style="width:294px">
                            <option value="/mijn-fotos/alles"> Alle categorieen </option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="/mijn-fotos/<?php echo $category['slug']; ?>" <?php if (isset($category_data['category_id'])) if ($category['category_id'] == $category_data['category_id']) echo "selected";  ?>><?php echo $category['name']; ?></option>
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
                                    <li title="<?php echo $image['image_id']; ?>" <?php
                                   if ($image['category_id'] == 99) {
                                        echo 'class="closed"';
                                    }
                                    ?>  rel="imgid_<?php echo $image['image_id']; ?>">
                                        <div class="mythumb" style="background-image: url(<?php echo base_url() . getImage($image['file_name'], $image['user_path'], 300, 300); ?>);">
                                            <div class="top_nav_img">
                                                <a href="javascript:void(0)" onclick="editImage('<?php echo $image['image_id']; ?>')" class="edit-btn">[edit]</a>
                                                <div style="float:right"><a href="javascript:void(0)" onclick="$('#zm-<?php echo $image['image_id'] ;?>').trigger('click') ">[zoom]</a></div>
                                              </div>
                                        </div>
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
                        <div class="list-row row<?php
                        if ($image['category_id'] == 99) {
                            echo " closed";
                        }
                        ?>" style="padding:10px 0px " rel="imgid_<?php echo $image['image_id']; ?>">
                            <div class="small-2 columns">
                                <div style="width:8em;height:6em;overflow:hidden;" class="edit-btn" onclick="editImage('<?php echo $image['image_id']; ?>')">
                                    <img src="<?php echo base_url() . getImage($image['file_name'], $image['user_path'], 300, 300); ?>">
                                  </div>
                            </div>
                            <div class="small-4 columns">
                                   <div rel="imgtitle_<?php echo $image['image_id']; ?>" style="font-weight:bold">
                                    <?php
                                        if (empty($image['title'])) {
                                            echo "geen titel";
                                        } else {
                                            echo $image['title'];
                                        };
                                        ?></div>
                                        <div rel="imgdesc_<?php echo $image['image_id']; ?>">
                                    <?php
                                    if (empty($image['description'])) {
                                        echo "geen beschrijving";
                                    } else {
                                        echo $image['description'];
                                    };
                                    ?></div>
                               
                            </div>
                             <div class="small-2 columns">
                                3 keer bekeken<br>
                                0 keer gekocht
                            </div>
                            <div class="small-2 columns" rel="imgsearch_<?php echo $image['image_id']; ?>">
                                <?php
                                if ($image['image_stat'] == 1) {
                                    echo "nog niet vindbaar";
                                } else {
                                    echo "openbaar";
                                };
                                ?><br>
                            </div>
                            <div class="small-1 columns">
                                <div class="right" ><a class="small button radius alert custom-narrow" href="javascript:void(0)" onclick="deleteImage('<?php echo $image['image_id']; ?>')" >Delete</a></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
<ul class="clearing-thumbs" data-clearing style="display:none">
    <?php foreach ($images as $image) { ?>
     <li><a  style="display:none"  id="zm-<?php echo $image['image_id'] ;?>" href="<?php echo base_url() . getImage($image['file_name'], $image['user_path'], 1280, 900); ?>">
             <img data-caption="<?php echo htmlentities($image['title'],ENT_QUOTES) ;?>" src="<?php echo base_url() . getImage($image['file_name'], $image['user_path'], 300, 300); ?>"/>
         </a></li>
    <?php } ?>
</ul>
    
    <p><?php echo $links; ?></p>
    <input type="hidden" name="category_id" id="category_id" value="<?php if (isset($category_data['category_id'])) echo $category_data['category_id']; ?>" />
    <input type="hidden" name="sort_order" id="sort_order" value="<?php echo implode(',', $order); ?>" />


</form>
<div id="update_image" class="reveal-modal large" data-reveal style="width:800px">
    <a id="close_save" class="close-reveal-modal">&#215;</a>
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
            <input type="hidden" name="category_path" value="<?php
            if (isset($category_data['slug'])) {
                echo $category_data['slug'];
            } else {
                echo "alles";
            };
            ?>" />
            <a href="#" class="small button radius" onClick="$('.close-reveal-modal').trigger('click')">Annuleer</a>
            <button type="submit" id="submitknop"  class="small button alert radius right">Verwijder</button>
            <?php echo form_hidden($csrf); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>


<script>
    $(document).ready(function() {
        if ($.cookie("switchview")) {
            switchView($.cookie("switchview"), 'instant');
        } else {
            switchView('gridview');
        }
    });
     $(document).ready(function() {
        if ($.cookie("switchlist")) {
           // switchList($.cookie("switchlist"));
        } else {
            //switchList('12');
        }
    });
function updateRel(id,title,desc){
    $("div[rel=imgtitle_"+id+"]").text(title);
    $("div[rel=imgdesc_"+id+"]").html(desc);
    $("div[rel=imgsearch_"+id+"]").text('openbaar');
    $("div[rel=imgid_"+id+"]").removeClass('closed');
    $("li[rel=imgid_"+id+"]").removeClass('closed');
 }

</script>
<script src="/js/pushy.js"></script>