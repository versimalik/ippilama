<?php //echo assets_js('../js/chosen.jquery.min.js'); ?>
<?php echo assets_js('../js/chosen.jquery.js'); ?>
<?php echo assets_js('../validate/languages/jquery.validationEngine-en.js'); ?>
<?php echo assets_js('../validate/jquery.validationEngine.js'); ?>  
<?php echo assets_js('../js/bootstrap-tag.min.js'); ?>  
<?php echo assets_js('../js/jquery.inputlimiter.1.3.1.min.js'); ?>  
<?php echo assets_js('../js/jquery-ui.min.js'); ?>  
                    
<script type="text/javascript">
	jQuery(function($) {
		
        // //filter search
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
                    _title: function(title) {
                        var $title = this.options.title || '&nbsp;'
                        if( ("title_html" in this.options) && this.options.title_html == true )
                            title.html($title);
                        else title.text($title);
                    }
                }));

        $( "#id-btn-dialog1" ).on('click', function(e) {
            e.preventDefault();
            console.log('sssssss');
            var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
                modal: true,
                title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> jQuery UI Dialog</h4></div>",
                title_html: true,
                buttons: [ 
                    {
                        text: "Cancel",
                        "class" : "btn btn-minier",
                        click: function() {
                            $( this ).dialog( "close" ); 
                        } 
                    },
                    {
                        text: "OK",
                        "class" : "btn btn-primary btn-minier",
                        click: function() {
                            // $( this ).dialog( "close" );
                            // window.location.assign("http://www.w3schools.com"); 
                            console.log($('#ws_user_name').val());
                        } 
                    }
                ]
            });
    
        });

       // binds form submission and fields to the validation engine 
       jQuery("#formID").validationEngine({
            prettySelect : true,
            promptPosition : "inline"
        });
    
		//chosen
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({
                allow_single_deselect:true,
                ext_err: ['form-field-select-4formError']
            }); 
		}

		//select/deselect all rows according to table header checkbox
        var active_class = 'activerow';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
            var th_checked = this.checked;//checkbox inside "TH" table header
            
            $(this).closest('table').find('tbody > tr.rows').each(function(){
                var row = this;
                if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });
    
        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
            var $row = $(this).closest('tr.rows');
            if(this.checked) $row.addClass(active_class);
            else $row.removeClass(active_class);
        });

        //Tags
        var tag_input = $('#form-field-tags');
        try{
            tag_input.tag(
              {
                placeholder:tag_input.attr('placeholder'),
                source: <?php echo isset($tags) ? json_encode($tags) : '[]'; ?>
              }
            )
    
            //programmatically add a new
            var $tag_obj = $('#form-field-tags').data('tag');
            // $tag_obj.add('Programmatically Added');
        }
        catch(e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            //$('#form-field-tags').autosize({append: "\n"});
        }
                

        //upload image
        var arr =[1,2,3,4];
        var whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
        var whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
        var btn_choose = "Drop images here or click to choose";
        var no_icon = "ace-icon fa fa-picture-o";
                    
        $.each(arr,function(index,obj){
            
            //image delete
            $(".butimage").click(function(){
                console.log(obj);
               $('center .imgview'+obj).hide(1000);
               
            });

            $('#id-input-image-'+this).ace_file_input({
                style:'well',
                btn_choose:'Drop images here or click to choose',
                btn_change:false,
                no_icon:'ace-icon fa fa-picture-o',
                droppable:true,
                thumbnail:'fit'
                //,icon_remove:null//set null, to hide remove/reset button
                /**,before_change:function(files, dropped) {
                    //Check an example below
                    //or examples/file-upload.html
                    return true;
                }*/
                /**,before_remove : function() {
                    return true;
                }*/
                ,
                preview_error : function(filename, error_code) {
                    //name of the file that failed
                    //error_code values
                    //1 = 'FILE_LOAD_FAILED',
                    //2 = 'IMAGE_LOAD_FAILED',
                    //3 = 'THUMBNAIL_FAILED'
                    //alert(error_code);
                },

            }).on('change', function(){
                //console.log($(this).data('ace_input_files'));
                //console.log($(this).data('ace_input_method'));
            });
                    
            var file_input = $('#id-input-image-'+this);
            file_input.ace_file_input('update_settings',
            {
                'btn_choose': btn_choose,
                'no_icon': no_icon,
                'allowExt': whitelist_ext,
                'allowMime': whitelist_mime
            })
            file_input.ace_file_input('reset_input');
            
            file_input
            .off('file.error.ace')
            .on('file.error.ace', function(e, info) {
                //console.log(info.file_count);//number of selected files
                //console.log(info.invalid_count);//number of invalid files
                //console.log(info.error_list);//a list of errors in the following format
                
                //info.error_count['ext']
                //info.error_count['mime']
                //info.error_count['size']
                
                //info.error_list['ext']  = [list of file names with invalid extension]
                //info.error_list['mime'] = [list of file names with invalid mimetype]
                //info.error_list['size'] = [list of file names with invalid size]
                
                
                /**
                if( !info.dropped ) {
                    //perhapse reset file field if files have been selected, and there are invalid files among them
                    //when files are dropped, only valid files will be added to our file array
                    e.preventDefault();//it will rest input
                }
                */
                
                
                //if files have been selected (not dropped), you can choose to reset input
                //because browser keeps all selected files anyway and this cannot be changed
                //we can only reset file field to become empty again
                //on any case you still should check files with your server side script
                //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
            });
        });
    
        //Limited
        $('input.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });

	});
</script>
