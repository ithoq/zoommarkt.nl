<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ZoomMarkt</title>
<link rel="stylesheet" href="/css/foundation.css" />
<link rel="stylesheet" href="/css/style.css" />
<script src="/js/modernizr.js"></script>
</head>
<body>
    <?php  if ($retval['status'] == 1 ){ 
        $description = trim(preg_replace('/\n+/', '<br>', $image_data['description']));
     ?>

    <h4 style="margin-left:20px;"> &laquo; De gegevens zijn opgeslagen. &laquo; &laquo; &laquo;</h4>
    <script>
        window.parent.updateRel('<?php echo $image_data['image_id'];?>','<?php echo addslashes($image_data['title']);?>', '<?php echo addslashes($description);?>' );
        setTimeout(function(){window.parent.parentCloser()},1500);
    </script>     
    <?php } else { ?>
    <?php echo $retval['txt'];?><br><br>
    <a href="#" onclick="window.parent.parentCloser()"> terug naar het overzicht</a>
    <?php } ?>
</body>
</html>