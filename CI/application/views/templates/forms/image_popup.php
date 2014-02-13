<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ZoomMarkt</title>
<link rel="stylesheet" href="/css/foundation.css" />
<link rel="stylesheet" href="/css/style.css" />
<script src="/js/modernizr.js"></script>
<script src="/js/jquery.js"></script> 
<script src="/js/foundation.min.js"></script>
</head>
<body id="imgbody">
<style>
    .top_nav_img{height:32px;width:100%;background-color:#333;font-size: 0.8em;padding:8px 8px;}
    .top_nav_img a {;color:#fff;}
</style>
    <?php
        $attributes = array('data-abide' => '', 'novalidate' => 'novalidate', 'id' => 'imagepop');
        echo form_open(uri_string(), $attributes);
        ?>
<div class="row">
   <div class="small-6 columns"> 
           <div class="top_nav_img"><a href="javascript:void(0)" onclick="$('#imgbody').hide();window.parent.parentCloser()">[sluiten]</a></div>
       
           <img src="<?php echo base_url() . getImage($image['file_name'], $image['user_path'], 600, 640 ); ?>">
      </div>
   <div class="small-6 columns">  
           <div class="row">
                <div class="small-12 columns">
                    <label for="title">Titel <small>verplicht</small></label>
                    <input type="text" name="title" id="title" value="<?php if (isset($image['title'])) echo htmlspecialchars($image['title']); ?>" placeholder="Naam van de afbeelding" required pattern="alpha_numeric">
                    <small class="error">U moet een titel opgeven</small>
                </div>
            </div>
           <div class="row">
                <div class="small-12 columns">
                    <label for="description">Beschrijving</label>
                    <textarea style="height:74px;" name="description" placeholder="description" id="description"><?php if (isset($image['description'])) echo htmlspecialchars($image['description']); ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <label for="category">Categorie</label>
                   <select name="category_id" >
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['category_id']; ?>" <?php if (isset($image['category_id'])) if ($image['category_id'] == $category['category_id']) echo "selected" ;?>><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
                </div>
            </div>  
           <div class="row">
                <div class="small-12 columns">
                    <label for="description">Tags</label>
                    <textarea style="height:74px;" name="tags" placeholder="tags" id="tags"><?php if (isset($image['tags'])) echo htmlspecialchars($image['tags']); ?></textarea>
                </div>
            </div>  
       <div class="row">
                <div class="small-12 columns">
                    <button type="submit" id="upload-file"  class="small button  radius custom-narrow form-btn">Verstuur</button>
                </div>
            </div>   
    
   </div>
</div>   
        <?php if (isset($image['id'])) echo form_hidden('id', $image['id']); ?>
        <?php echo form_hidden($csrf); ?>
        <?php echo form_close(); ?>
<script>
$(document).foundation();
 $(document).ready(function() {
    $('#imgbody').show('fast'); 
 });
</script>
</body>
</html>
