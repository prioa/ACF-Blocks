<?php
/*
Template Name: Linklist
*/

function load_linklist_styles() {
    wp_enqueue_style( 'linklist_styles', get_template_directory_uri() . '/assets/css/linklist.css' ); 
}
add_action( 'wp_enqueue_scripts', 'load_linklist_styles' );

wp_head(); 
?>

<div class="container ll-container">
    <header class="ll-header">
        <?php
          if( have_rows('llHead') ):
            while( have_rows('llHead') ): the_row();
                $logo = get_sub_field('llLogo'); ?>
                <img src="<?php echo esc_url($logo[url]); ?>" alt="<?php echo esc_attr($logo[title]); ?>">
                <div class="hh-hl">
                    <?php echo the_sub_field('llTxt');?>
                </div>
    		<?php endwhile; ?>
		<?php endif; ?>
    </header>
    <ul class="ll-post-container" id="ll-list">
        <?php
        if( have_rows('llPosts') ):
            while( have_rows('llPosts') ) : the_row();
                $img = get_sub_field('llPostImg');
                $url = get_sub_field('llPostUrl');?>
                    <li class="ll-li-post">
                        <a href="<?php echo esc_url($url[url]); ?>" target="<?php echo esc_attr($img[target]); ?>" class="ll-post">
                            <img src="<?php echo esc_url($img[url]); ?>" alt="<?php echo esc_attr($img[title]); ?>">
                        </a>
                    </li>
                <?php
            endwhile;
        endif;
        ?>
    </ul>
    <div class="ll-footer">
        <button id="ll-load" class="cta_btn blue llBtn">show more</button>
    </div>
</div>


<script>
jQuery(document).ready(function ($) {
    size_li = $("#ll-list li").size();
    x=9;
    $('#ll-list li:lt('+x+')').show();
    $('#ll-load').click(function () {
        x= (x+9 <= size_li) ? x+9 : size_li;
        $('#ll-list li:lt('+x+')').show();
        if(x == size_li){
            $('#ll-load').hide();
        }
    });
});
</script>



<?php get_footer(); ?>