/*
 *  Image Frame Script file
 */

jQuery(document).ready(function($){
    var meta_image_frame;
	$('#meta-image-button').click(function(e){
		 e.preventDefault();
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
 
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
 
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
 
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
 
            // Sends the attachment URL to our custom image input field.
            $('#primary-chart-image').attr('value',media_attachment.id);
			$('#meta_img').attr("src",media_attachment.url);
			$('#meta_img').attr("width","auto");
			$('#meta_img').attr("height","180");
			$('.media-modal-icon').click();
			 
        });
 
        // Opens the media library frame.
        meta_image_frame.open();
		
    }); 
	
});