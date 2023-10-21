<?php

get_header();
$options = get_design_plus_option();
get_template_part('template-parts/breadcrumb');

?>
<main id="main_contents">
	<article id="main_col" class="primary">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div id="article">

			<div id="" class="article_header">
				<div class="featured_image">
					<?php echo wp_get_attachment_image($post->ID, 'full') ?>
				</div>
				<?php
					$caption = wp_get_attachment_caption($post->ID);
					if($caption){
				?>
				<ul class="meta_wrap">
          <li><?php echo esc_html($caption); ?></li>
        </ul>
				<?php } ?>
        <h1 class="title rich_font_ post"><?php the_title(); ?></h1>
      </div>
			
			<div class="post_content clearfix">
			<?php
			
				the_content();
				if ( ! post_password_required() ) custom_wp_link_pages();
				
			?>
			</div>

    </div><!-- END #article -->

<?php endwhile; endif; ?>

  </article><!-- END #main_col -->
</main><!-- END #main_contents -->
<?php get_footer(); ?>