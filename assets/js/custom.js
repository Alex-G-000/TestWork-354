jQuery(document).ready(function($){

    $('#tw_product_type').on('change', function(){
        $('#tw_product_type_val').val( $(this).val() );
    });


    $('#submit-product').on('click', function(e){
        e.preventDefault();
        const name = $('input#tw_product_name').val();      
        const price = $('input#tw_product_price').val();      
        const date = $('input#tw_creation_date').val();      
        const prodtype = $('input#tw_product_type_val').val();      
        const image = $('input#tw_alt_image_id').val(); 
        const nonce = $('input[name="tw_create_nonce"]').val();         
        
        $('#submit-product').addClass('disabled');
        $('#submit-product').text('Creating...');
  
        jQuery.ajax({
          url: the_ajax_script.ajaxurl,
          type: 'POST',
          data: { 
              action: 'tw_creaete_product',
              name: name,           
              price: price,           
              date: date,           
              prodtype: prodtype,           
              image: image, 
              nonce: nonce
          },
          success: function( data ) {
              console.log(data);  
              if(data ==='created') {
                  $('.tw-overlay').fadeIn();                     
              }                     
            }
        });
    });


    let frame,
        pform = $('form.tw-form'),
        imgIdInput = pform.find( '#tw_alt_image_id' ),
        imgContainer = pform.find( '.tw-form__img-container'),        
        delImgLink = pform.find('.tw-image-delete');
        addImgLink = pform.find('.tw-image-input');      


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
            let attachment = frame.state().get('selection').first().toJSON();
            imgContainer.append( '<img src="'+attachment.url+'" alt="" style="max-width:100%; width:100%;"/>' );

            // Send the attachment id to hidden input
            imgIdInput.val( attachment.id );
            
            addImgLink.fadeOut();
            delImgLink.fadeIn();
        });
        
        frame.open();
    });


    delImgLink.on( 'click', function( event ){
        event.preventDefault();        
        imgContainer.html( '' );
        addImgLink.fadeIn();    
        delImgLink.fadeOut();
        imgIdInput.val( '' );
    });


    $('#tw-overlay-close').on('click', function(e){
        $('#submit-product').removeClass('disabled');
        $('#submit-product').text('Create'); 
        $("form.tw-form")[0].reset(); 
        $('.tw-overlay').fadeOut();
        imgContainer.html('');
        imgIdInput.val(''); 
    });


});