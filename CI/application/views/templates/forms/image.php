<div class="row">

    <div class="large-9 medium-8 columns">

        <div id="infoMessage"><?php echo $message; ?></div>
        <?php
        $attributes = array('data-abide' => '', 'novalidate' => 'novalidate', 'id' => 'imageupload');
        echo form_open_multipart(uri_string(), $attributes);
        ?>

        <fieldset>
            <legend>Afbeeldingen uploaden</legend>
               <div class="row">
                <div class="small-12 columns">
                    <p>Selecteer de foto's die u wilt uploaden of sleep ze in onderstaand vak </p>
                    
                    <div id="queue"></div>
                </div>
            </div>        
             <div class="row">
                <div class="small-6 columns">
                    <input style="float:right" id="userfile" name="userfile" type="file" multiple="true">
                </div>    
          
                <div class="small-6 columns">
                     <a href="javascript:$('#userfile').uploadifive('upload')" id="upload-file"  class="small button radius round right">Upload files</a>
                </div>
            </div>                
        </fieldset>

        <?php if (isset($image['id'])) echo form_hidden('id', $image['id']); ?>
        <?php echo form_hidden($csrf); ?>

        <?php echo form_close(); ?>
       
    </div>
    
</div>
 <div class="row">
               
                <div class="small-6 columns">
                     <a href="/mijn-fotos/nieuw"  class="small button radius round">Verder</a>
                </div>
            </div>   
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(document).ready(function() {
        $('#userfile').uploadifive({
            'auto': false,
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'token': '<?php echo md5('imageposting_salt' . $timestamp); ?>'
            },
            'fileObjName':'userfile',
            'queueID': 'queue',
            'uploadScript': '/afbeeldingen/do_upload',
            'onUploadComplete': function(data) {
                console.log(data);
            }
        });
    });
</script>

