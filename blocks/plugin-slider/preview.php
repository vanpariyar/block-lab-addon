<h1><?php block_field('title');?></h1>

<div 
    class="owl-carousel owl-theme"
    data-params=<?php echo Block_lab_addon_init::the_slider_config();?>
    >
    <?php if(block_value('image-1')): ?>
        <div class="item">
            <a href="<?php block_field('image-1') ?>" data-fancybox >
                <img src="<?php block_field('image-1') ?>" />
            </a>
        </div>
    <?php endif;?>
    <?php if(block_value('image-2')): ?>
        <div class="item">
            <a href="<?php block_field('image-2') ?>" data-fancybox >
                <img src="<?php block_field('image-2') ?>" />
            </a>
        </div>
    <?php endif;?>
    <?php if(block_value('image-3')): ?>
        <div class="item">
            <a href="<?php block_field('image-3') ?>" data-fancybox >
                <img src="<?php block_field('image-3') ?>" />
            </a>
        </div>
    <?php endif;?>
    <?php if(block_value('image-4')): ?>
        <div class="item">
            <a href="<?php block_field('image-4') ?>" data-fancybox >
                <img src="<?php block_field('image-4') ?>" />
            </a>
        </div>
    <?php endif;?>
    <?php if(block_value('image-5')): ?>
        <div class="item">
            <a href="<?php block_field('image-5') ?>" data-fancybox >
                <img src="<?php block_field('image-5') ?>" />
            </a>
        </div>
    <?php endif;?>
</div>