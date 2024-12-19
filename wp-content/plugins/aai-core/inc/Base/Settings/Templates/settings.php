<div class="element-ready-admin-dashboard-container wrap">
<script type="text/javascript">

     function element_ready_typograpy_(id){
         var uniq_id = "#"+id;
       
        var store_obj = {
                        'font':jQuery(uniq_id).attr('font'),
                        'size':jQuery(uniq_id).attr('size'),
                        'selector':jQuery(uniq_id).attr('selector'),
                        'weight':jQuery(uniq_id).attr('weight')
                    };
                    
                    jQuery(uniq_id).val(JSON.stringify(store_obj));
     } 

</script>
    <div id="element-ready-adpage-tabs" class="element-ready-adpage-tabs">

        <div class="element-ready-nav-wrapper">
            <div class="element-ready-logo">
                <a href="http://quomodosoft.com/"><img src="<?php echo esc_url(ELEMENT_READY_ROOT_IMG.'main_logo.svg'); ?>" alt="<?php echo esc_attr__('logo','element-ready'); ?>"></a>
            </div>
            <ul>
                <!-- <li class="element-ready-dashboard element-ready-settings">
                    <a href="#element-ready-adpage-tabs-1">
                        <i class="dashicons dashicons-admin-home"></i>
                        <h3 class="element-ready-title"><?php // echo esc_html__('Settings','element-ready'); ?> </h3>
                        <span><?php // echo esc_html__('General settings','element-ready'); ?></span>
                    </a>
                </li> -->
                <li class="element-ready-dashboard element-ready-google-fonts">
                    <a href="#element-ready-adpage-tabs-2">
                        <i class="dashicons dashicons-admin-home"></i>
                        <h3 class="element-ready-title"><?php echo esc_html__('Fonts','element-ready'); ?> </h3>
                        <span><?php echo esc_html__('Google font load','element-ready'); ?></span>
                    </a>
                </li>
               
            </ul>
        </div>
        
        <div id="element-ready-adpage-tabs-2" class="element-ready-adpage-tab-content element-ready-dashboard dashboard">

                <form class="element-ready-components-action quomodo-component-data" action="<?php echo admin_url('admin-post.php') ?>" method="post">
                    <div class="quomodo-container-wrapper">
                        <div class="quomodo-row-wrapper">
                            <div class="element-ready-component-form-wrapper components">
                                <div class="element-ready-components-topbar">
                                    <div class="element-ready-title">
                                        <h3 class="title"><i class="dashicons dashicons-editor-alignleft"></i> <?php echo esc_html__('Google Fonts Settings','element-ready'); ?> </h3>
                                    </div>
                                    <div class="element-ready-savechanges">
                                        <button type="submit" class="element-ready-component-submit button element-ready-submit-btn"><i class="dashicons dashicons-yes"></i> <?php echo esc_html__('Save Change','element-ready'); ?></button>
                                    </div>
                                </div>
                                <div class="quomodo-row">
                                    <?php $components_settings = $this->components(); ?>
                                    <?php if( is_array( $components_settings ) ): ?>
                                    <?php foreach($components_settings as $item_key => $item): ?>
                                        <?php if($item['type'] =='switch' && !isset($item['row']) ): ?>
                                            <div class="element-ready-col <?php echo isset($item['column'])?$item['column']:'quomodo-col-xl-3 quomodo-col-lg-4 quomodo-col-md-6'; ?>">
                                                <div class="quomodo_switch_common element-ready-common <?php echo esc_attr($item['is_pro']?'element-ready-pro element-ready-dash-modal-open-btn':''); ?>">
                                            
                                                    <div class="quomodo_sm_switch">
                                                    
                                                        <strong><?php echo esc_html($item['lavel']); ?>
                                                            <?php if( $item['is_pro'] ): ?>
                                                                <span> <?php echo esc_html__( 'Pro', 'element-ready' ); ?> </span>
                                                            <?php endif; ?>    
                                                        </strong>

                                                        <input <?php echo esc_attr( $item['default']==1?'checked':'' ); ?> name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>]" class="quomodo_switch <?php echo esc_attr($item_key); ?>" id="element-ready-components-<?php echo esc_attr($item_key); ?>" type="checkbox">
                                                        <label for="element-ready-components-<?php echo esc_attr($item_key); ?>"></label>
                                                
                                                    </div>
                                                </div>
                                            </div>
                                        <?php elseif($item['type'] =='switch' && isset($item['row']) ): ?>    
                                                <div class="element-ready-col quomodo-col-md-12">
                                                    <div class="quomodo-row"> 
                                                        <div class=" <?php echo isset($item['column'])?$item['column']:'quomodo-col-xl-3 quomodo-col-lg-4 quomodo-col-md-6'; ?>">
                                                            <div class="quomodo_switch_common element-ready-common <?php echo esc_attr($item['is_pro']?'element-ready-pro element-ready-dash-modal-open-btn':''); ?>">
                                                                <div class="quomodo_sm_switch">
                                                                    <strong><?php echo esc_html($item['lavel']); ?>
                                                                        <?php if( $item['is_pro'] ): ?>
                                                                            <span> <?php echo esc_html__( 'Pro', 'element-ready' ); ?> </span>
                                                                        <?php endif; ?>    
                                                                    </strong>

                                                                    <input <?php echo esc_attr( $item['default']==1?'checked':'' ); ?> name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>]" class="quomodo_switch <?php echo esc_attr($item_key); ?>" id="element-ready-components-<?php echo esc_attr($item_key); ?>" type="checkbox">
                                                                    <label for="element-ready-components-<?php echo esc_attr($item_key); ?>"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endif; ?>
                                        
                                        <?php if($item['type'] =='select'): ?>
                                            <div class="element-ready-col quomodo-col-xl-3 quomodo-col-lg-4 quomodo-col-md-6">
                                                <div class="element-ready-data">
                                                    <strong>

                                                        <?php echo esc_html($item['lavel']); ?>
                                                          
                                                    </strong>
                                                    <?php if (isset($item['options']) && !empty($item['options'])): ?>
                                                        <div class="element-ready-custom-select" style="width:250px;">
                                                        
                                                            <select name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>]" id="element-ready-pro-select-<?php echo esc_attr($item_key); ?>">
                                                                <?php if(isset($item['options'])): ?>
                                                                    <?php foreach($item['options'] as $sel_key => $select_option): ?>
                                                                        <option <?php echo esc_attr( $item['default']==$sel_key?'selected':'' ); ?>  value="<?php echo esc_attr($sel_key); ?>"> <?php echo esc_html($select_option); ?><option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>

                                                        </div>
                                                        <label for="element-ready-components-<?php echo esc_attr($sel_key); ?>"></label>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($item['type'] =='select2'): ?>
                                            <div class="element-ready-col quomodo-col-xl-3 quomodo-col-lg-4 quomodo-col-md-6">
                                                <div class="element-ready-data ">
                                                    <strong>
                                                        <?php echo esc_html($item['lavel']); ?>
                                                        <?php $selected_value ='-1'; ?>
                                                    </strong>
                                                    <?php if (isset($item['options']) && !empty($item['options'])): ?>
                                                        <div class="element-ready-custom-select2">
                                                             <?php $select2_id = 'element-ready-pro-select2-'.$item_key; ?>
                                                                <select name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>]" id="<?php echo esc_attr($select2_id); ?>">
                                                                    <?php if(isset($item['options'])): ?>
                                                                        <?php foreach($item['options'] as $sel_key => $select_option): ?>
                                                                            <?php $selected_ = $item['default']==$sel_key?'selected':''; ?> 
                                                                            <?php $selected_value = $item['default']==$sel_key?$sel_key:'-19x63'; ?> 
                                                                            <option <?php echo esc_attr( $selected_ ); ?>  value="<?php echo esc_attr($sel_key); ?>"> <?php echo esc_html($select_option); ?><option>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                        </div>
                                                        <label for="element-ready-components-<?php echo esc_attr($sel_key); ?>">  </label>
                                                       
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                           
                                            <script type="text/javascript">

                                                jQuery(function($) {
                                                    $("#<?php echo esc_attr($select2_id); ?>").select2();
                                                    $("#<?php echo esc_attr($select2_id); ?>").val(<?php echo esc_attr($selected_value); ?>).trigger('change');
                                                });

                                            </script>
                                        <?php endif; ?>

                                        <?php if($item['type'] =='typhography'): ?>

                                            <?php $typhography2_variants_id  = 'element-ready-pro-select2-'.$item_key.'-variants'; ?>
                                            <?php $typhography2_font_size_id = 'element-ready-pro-select2-'.$item_key.'-font-size'; ?>
                                            <?php $typhography2_selector_id  = 'element-ready-pro-select2-'.$item_key.'-selector'; ?>
                                            <?php $typhography2_store_id     = 'element-ready-pro-select2-'.$item_key.'-store'; ?>
                                            <?php $typhography2_defualt_id   = str_replace('-','_','element_ready_pro_select2_'.$item_key.'_default'); ?>
                                           
                                           <div class="element-ready-col quomodo-col-xl-3 quomodo-col-lg-4 quomodo-col-md-6">
                                                <div class="element-ready-data typhography">
                                                        <strong>
                                                            <?php echo esc_html($item['lavel']); ?>
                                                        </strong>
                                                   
                                                        <div class="element-ready-custom-select2">
                                                             <?php $typhography2_id = 'element-ready-pro-select2-'.$item_key; ?>
                                                             <?php $typhography_value = $item['default']==''?'':json_decode($item['default'],true); ?>
                                                        
                                                             <?php $google_fonts = json_decode($this->get_google_fonts(),true); ?>
                                                                  
                                                                <select name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>]" id="<?php echo esc_attr($typhography2_id); ?>">
                                                                   <option value=''> <?php echo esc_html__( 'Select font family ', 'element-ready-pro' ) ?></option>
                                                                  <?php foreach($google_fonts['items'] as $_font): ?>
                                                                    <option value="<?php echo esc_html($_font['family']); ?>"> <?php echo esc_html($_font['family']); ?> </option>
                                                                  <?php endforeach; ?>
                                                                </select>
       
                                                        </div>
                                                        <input id="<?php echo esc_attr($typhography2_store_id); ?>" type="hidden" name="element-ready-pro-google-fonts-options_bk[<?php echo esc_attr($item_key); ?>]" />
                                                        <input value="<?php echo isset($typhography_value['font'])?$typhography_value['font']:''; ?>" id="<?php echo esc_attr($typhography2_store_id.'_font'); ?>" type="hidden" name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>][font]" />
                                                        <strong class="quomodo-pt-3">
                                                            <?php echo esc_html__('Weight / Varient','element-ready-pro'); ?>
                                                        </strong>
                                                        <div class="element-ready-custom-select2-font-variants">
                                                            <select name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>][weight]" id="<?php echo $typhography2_variants_id; ?>">
                                                                
                                                                <?php 

                                                                    if(isset($typhography_value['weight'])){ ?>
                                                                        <option selected value="<?php echo isset($typhography_value['weight'])?$typhography_value['weight']:''; ?>" > <?php echo esc_html($typhography_value['weight']); ?> </option>
                                                                <?php }  ?>                                                          
                                                                
                                                            </select>
                                                        </div>
                                                        <strong class="quomodo-pt-3">
                                                            <?php echo esc_html__('Font size','element-ready-pro'); ?>
                                                        </strong>
                                                        <div class="element-ready-custom-select2-font-size">
                                                            <input value="<?php echo trim(isset($typhography_value['size'])?$typhography_value['size']:'',' '); ?>" name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>][size]" id="<?php echo $typhography2_font_size_id; ?>" type="text" value="" placeholder="14px" /> 
                                                        </div>
                                                        <strong class="quomodo-pt-3">
                                                            <?php echo esc_html__('Selector','element-ready-pro'); ?>
                                                        </strong>
                                                        <div class="element-ready-custom-select2-selector">
                                                             <textarea style="width:100%" name="element-ready-pro-google-fonts-options[<?php echo esc_attr($item_key); ?>][selector]" id="<?php echo $typhography2_selector_id; ?>" type="text" placeholder="body,h1" > <?php echo trim(isset($typhography_value['selector'])?$typhography_value['selector']:'',' '); ?> </textarea>
                                                          
                                                        </div>
                                                        <label for="<?php echo esc_attr($typhography2_id); ?>">  </label>
                                                 </div>
                                            </div>

                                            <?php //print_r($typhography_value); ?>
                                          
                                            <script type="text/javascript">

                                                jQuery(function($) {
                                                    
                                                    var json_data = [];
                                                    var json_option = new Array();
                                                    $.getJSON( "<?php echo $this->file_path; ?>", function( data ) {
                                                          
                                                            $.each( data.items, function( key, val ) {
                                                                json_data.push(val);
                                                             });
                                                  
                                                    });
                                                  
                                                    $("#<?php echo esc_attr($typhography2_id); ?>").select2();
                                                    $("#<?php echo esc_attr($typhography2_id); ?>").val("<?php echo isset($typhography_value['font'])?$typhography_value['font']:''; ?>").trigger('change');
                                                    
                                                    $("#<?php echo esc_attr($typhography2_id); ?>").on('select2:select', function (e) {

                                                        $("#<?php echo $typhography2_variants_id; ?>").empty();
                                                        if(e.params.data.id){
                                                            
                                                            var _typh_value = e.params.data.id;
                                                            var family_data = _.findWhere(json_data, {family: _typh_value});
                                                           
                                                            $.each(family_data.variants, function (i, item) {
                                                                
                                                                $("#<?php echo $typhography2_variants_id; ?>").append($('<option>', { 
                                                                    value: item,
                                                                    text : item 
                                                                }));

                                                            });
                                                          
                                                        }
                                                         
                                                        $("#<?php echo $typhography2_store_id; ?>").attr('font',_typh_value);
                                                        $("#<?php echo $typhography2_store_id.'_font'; ?>").val(_typh_value);

                                                        $("#<?php echo esc_attr($typhography2_id); ?>").on("select2:clear", function (e) { 
                                                            $("#<?php echo $typhography2_store_id.'_font'; ?>").val(' ');
                                                         });
                                                         
                                                         $("#<?php echo esc_attr($typhography2_id); ?>").on("select2:clearing", function (e) { 
                                                            $("#<?php echo $typhography2_store_id.'_font'; ?>").val('');
                                                         });
                                                   
                                                        element_ready_typograpy_("<?php echo $typhography2_store_id; ?>");
                                                    });
                                                  
                                                    // font weight
                                                    $("#<?php echo $typhography2_variants_id; ?>").on('change',function(){

                                                       var font_family =  $('#<?php echo $typhography2_id; ?>').val();
                                                       $("#<?php echo $typhography2_store_id; ?>").attr('font',font_family).attr('weight',$(this).val());
                                                       element_ready_typograpy_("<?php echo $typhography2_store_id; ?>");
                                                    });

                                                    $("#<?php echo $typhography2_font_size_id; ?>").on('input',function(){
                                                        $("#<?php echo $typhography2_store_id; ?>").attr('size',$(this).val());
                                                        element_ready_typograpy_("<?php echo $typhography2_store_id; ?>");
                                                    });

                                                    $("#<?php echo $typhography2_selector_id; ?>").on('input',function(){

                                                        $("#<?php echo $typhography2_store_id; ?>").attr('selector',$(this).val());
                                                        element_ready_typograpy_("<?php echo $typhography2_store_id; ?>");
                                                    });
                            
                                                });

                                            </script>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="element_ready_pro_google_fonts_options">
                            <?php echo wp_nonce_field('element-ready-google-fonts-components', '_element_ready_google_fonts_components'); ?>
                        </div>
                    </div> <!-- container end -->
                </form>
        </div>
       
    </div>

</div>
