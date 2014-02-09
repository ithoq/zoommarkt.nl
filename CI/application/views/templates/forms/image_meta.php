<div class="row">

    <div class="large-9 medium-8 columns">

        <div id="infoMessage"><?php echo $message; ?></div>
        <?php
        $attributes = array('data-abide' => '', 'novalidate' => 'novalidate', 'id' => 'imageupload');
        echo form_open_multipart(uri_string(), $attributes);
        ?>

        <fieldset>
            <legend>Afbeelding</legend>
            <div class="row">
                <div class="small-6 columns">
                    <label for="name">Titel <small>verplicht</small></label>
                    <input type="text" name="title" id="title" value="<?php if (isset($image['name'])) echo htmlspecialchars($image['title']); ?>" placeholder="Naam van de afbeelding" required pattern="alpha">
                    <small class="error">U moet naam van de afbeelding opgeven</small> 
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <div id="queue" style="width:100%"></div>
                    <input id="userfile" name="userfile" type="file" multiple="true">
                    <button type="submit"  id="upload-file"  class="small button radius round" onClick="$('#userfile').uploadifive('upload')">Upload files</button>
                </div>
            </div>
            <div class="row"> 
                <div class="small-12 columns">
                    <label for="Achternaam">Beschrijving</label>
                    <textarea name="description" id="description" placeholder="Beschrijving"><?php if (isset($image['description'])) echo htmlspecialchars($image['description']); ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <button type="submit" id="upload-file"  class="medium button  round">Verstuur</button>
                </div>
            </div>                
        </fieldset>

        <?php if (isset($image['id'])) echo form_hidden('id', $image['id']); ?>
        <?php echo form_hidden($csrf); ?>

        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(document).ready(function() {
        var base_url = '<?php echo base_url(); ?>';
        $('#userfile').uploadifive({
            'auto': false,
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'token': '<?php echo md5('imageposting_salt' . $timestamp); ?>'
            },
            'fileObjName':'userfile',
            'queueID': 'queue',
            'uploadScript': '/profiel/do_upload',
            'onUploadComplete': function(file, data) {
                console.log(data);
            }
        });
    });
</script>

