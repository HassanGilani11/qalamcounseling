jQuery(document).ready(function ($) {
    $(document).on("click", ".upload_gimage_button", function (e) {
        e.preventDefault();
        var $button = $(this);

        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or upload image',
            library: { // remove these to show all
                type: 'image' // specific mime
            },
            button: {
                text: 'Select'
            },
            multiple: true // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on('select', function () {
            // We set multiple to false so only get one image from the uploader
            var attachment = file_frame.state().get('selection').toJSON();
            $('.mediguss-gimage-list').empty();
            var images = [];
            $.each( attachment , function( key, value ) {
                images.push(value.id);
                var img = $('<img />', { 
                  
                    src: value.url,
                   
                  }).css({"width": "80px", "height": "80px"});
                $('.mediguss-gimage-list').append(img);
            });
            $('.ga-image-list').val(JSON.stringify( images )).trigger('change');
           

        });

        // Finally, open the modal
        file_frame.open();
    });
});