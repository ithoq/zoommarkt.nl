<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ZoomMarkt</title>
<?php 
if (isset($css_files)) {
    foreach ($css_files as $cssfile) {?>
<link rel="stylesheet" href="<?php echo $cssfile;?>" type="text/css" />
<?php 
    }
}
?><link rel="stylesheet" href="/css/foundation.css" />
<!-- link rel="stylesheet" href="/css/foundation-icons.css" -->
<link rel="stylesheet" href="/css/style.css" />
<script src="/js/modernizr.js"></script>
<script src="/js/jquery.js"></script> 
<script src="/js/foundation.min.js"></script>
<?php 
if (isset($js_files)) {
    foreach ($js_files as $jsfile) {?>
<script src="<?php echo $jsfile;?>"></script>
<?php 
    }
}
?>
</head>