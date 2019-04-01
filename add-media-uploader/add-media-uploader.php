<?php
// this is the only code required, yes only
// works with wordpress 5.1.1, tested on 1st April 2019
wp_enqueue_script('jquery');
wp_enqueue_media();
?>
<div>
    <label for="image_url">Image</label>
    <input type="text" name="image_url" id="image_url" class="regular-text">
    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">

</div>
<script type="text/javascript">
jQuery(document).ready(function($){
      $('#upload-btn').click(function(e) {
             e.preventDefault();
             var image = wp.media({ 
             title: 'Upload Image',
             multiple: false
      }).open()
      .on('select', function(e){
     var uploaded_image = image.state().get('selection').first();
     console.log(uploaded_image);
     var image_url = uploaded_image.toJSON().url;
     $('#image_url').val(image_url);
 });
});
});
</script>
