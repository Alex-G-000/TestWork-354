jQuery(document).ready(function($){
    
    //get product type value from hidden field
    const prodType = $('#tw_product_type_val').val();       
    $('#tw_product_type').val( prodType );

    //update product type select
    $('#tw_product_type').on('change', function(){ 
        $('#tw_product_type_val').val( $(this).val() );           
     })


    let frame,
      metaBox = $('#tw_custom_box.postbox'), 
      imgIdInput = metaBox.find( '#tw_alt_image_id' );
      addImgLink = metaBox.find('.upload-custom-img'),
      delImgLink = metaBox.find( '.delete-custom-img'),
      imgContainer = metaBox.find( '.tw-form__img-container');


    // ADD IMAGE LINK
    addImgLink.on( 'click', function( event ){    
        event.preventDefault();   
        
        if ( frame ) {
        frame.open();
        return;
        }
        
        // Create a new media frame
        frame = wp.media({
        title: 'Select or Upload Media Of Your Chosen Persuasion',
        button: {
            text: 'Use this media'
        },
        multiple: false 
        });
        
        frame.on( 'select', function() {      
            var attachment = frame.state().get('selection').first().toJSON();
            imgContainer.append( '<img src="'+attachment.url+'" alt="" />' );

            // Send the attachment id to hidden input
            imgIdInput.val( attachment.id );
            
            addImgLink.addClass( 'hidden' );  
            delImgLink.removeClass( 'hidden' );
        });
        
        frame.open();
    });
  
  
    // DELETE IMAGE LINK
    delImgLink.on( 'click', function( event ){
        event.preventDefault();        
        imgContainer.html( '' );
        addImgLink.removeClass( 'hidden' );      
        delImgLink.addClass( 'hidden' );
        imgIdInput.val( '' );
    });

   

    // reset product ajax
    $('#tw_reset').on('click', function(){ 
        imgContainer.html( '' );
        addImgLink.removeClass( 'hidden' );      
        delImgLink.addClass( 'hidden' );
        imgIdInput.val( '' );
        $('input#tw_product_type_val').val('');
        $('input#tw_creation_date').val('');

        const postid = $('#tw_postid').val();
        const nonce = $('input[name="tw_update_nonce"]').val(); 

        jQuery.ajax({
          url: ajaxurl,
          type: 'POST',
          data: { 
              action: 'tw_reset_product_custom_meta',    
              nonce: nonce,
              postid: postid 
          },
          success: function( data ) {
              if(data === 'reseted') {
                  window.location.reload();                        
              }
            }
        });
      });

  });