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
<body><?php
        $attributes = array('data-abide' => '', 'novalidate' => 'novalidate', 'id' => 'imagepop');
        echo form_open(uri_string(), $attributes);
        ?>
<div class="row">
   <div class="small-8 columns"> 
       
<div class="off-canvas-wrap">
  <div class="inner-wrap" style="background-color:#333">
      <nav class="tab-bar">
      <section class="left-small">
        <a class="left-off-canvas-toggle menu-icon" ><span></span></a>
      </section>
      <section class="middle tab-bar-section">
        <h1 class="title">Afbeelding</h1>
      </section>
    </nav>
     <!-- Off Canvas Menu -->
    <aside class="left-off-canvas-menu">
        <!-- whatever you want goes here -->
         <ul>
            <li><label> </label></li
            <li><a href="#">Kliks: 32</a></li>
            <li><a href="#">Gestemd: 2</a></li>
            <li><a href="#">Verkocht: 1</a> </li>
            <li><a href="#">Gepubliceerd: <?php echo $image['createddate']; ?></a></li>
            <li><a href="#">Groote: <?php echo $image['file_size']; ?> kB</a></li>
            <li><a href="#">Afmetingen: <?php echo $image['image_width']; ?>x<?php echo $image['image_height']; ?></a></li>
        </ul>        
    </aside>
   <!-- main content goes here -->
    <img src="<?php echo base_url() . getImage($image['file_name'], 600, 400 ); ?>">
  <!-- close the off-canvas menu -->
  </div>
</div>
       
	
    </div>
   <div class="small-4 columns">  
           <div class="row">
                <div class="small-12 columns">
                    <label for="title">Titel</label>
                    <input type="text" name="title" id="title" value="<?php if (isset($image['title'])) echo htmlspecialchars($image['title']); ?>" placeholder="Naam van de afbeelding">
                  
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
                    <button type="submit" id="upload-file"  class="small button  radius custom-narrow">Verstuur</button>
                </div>
            </div>   
    
   </div>
</div>   
        <?php if (isset($image['id'])) echo form_hidden('id', $image['id']); ?>
        <?php echo form_hidden($csrf); ?>
        <?php echo form_close(); ?>
<script>
$(document).foundation();
</script>
</body>
</html>
