<div class="circle-bar">
    <?php $rating_settings['rating'] = get_post_meta(get_the_id(),'_post_meta_key',true) == ''?random_int(10,90):0; ?>
    <div class="first circle element-ready-circle" data-rating="<?php echo htmlspecialchars(json_encode($rating_settings), ENT_QUOTES, 'UTF-8'); ?>" >
        <strong></strong>
    </div>
</div>