<?php

$options = get_design_plus_option();
get_header();

?>
<main id="news_archive">
	<div class="l-inner inner">
<?php

get_template_part( 'template-parts/archive-header' );
if ( have_posts() ) {

?>
		<div class="post_list">
<?php
	while ( have_posts() ) :
		the_post();

		$image_size = (is_mobile()) ? 'landscape1' : 'landscape2';
		if(has_post_thumbnail()) {
			
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
		} elseif($options['news_no_image']) {
			$image = wp_get_attachment_image_src( $options['news_no_image'], $image_size );
    } elseif($options['no_image1']) {
      $image = wp_get_attachment_image_src( $options['no_image1'], $image_size );
		} else {
			$image = array();
			$image[0] = get_template_directory_uri() . "/img/common/no_image1.gif";
		}

		$desc = trim_excerpt(150);

?>
			<article class="item<?php if($options['news_archive_display_thumbnail'] == 'hide') echo ' no_thumbnail'; ?>">
				<a class="link animate_background" href="<?php the_permalink(); ?>">
					<?php if($options['news_archive_display_thumbnail'] == 'display'){ ?>
					<div class="image_wrap">
						<div class="image" style="background:url(<?php echo esc_url($image[0]); ?>) no-repeat center; background-size:cover;"></div>
					</div>
					<?php } ?>
					<div class="content_wrap">
						<p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
						<h3 class="title line1 rich_font"><span><?php the_title(); ?></span></h3>
						<?php if($desc){ ?><p class="desc line2 pc"><span><?php echo $desc; ?></span></p><?php } ?>
					</div>
					<?php if($desc){ ?><p class="desc line2 sp"><span><?php echo $desc; ?></span></p><?php } ?>
				</a>
			</article>
<?php
	endwhile;
?>
		</div>
<?php

	get_template_part( 'template-parts/pager' );

}else{

	echo '<p id="no_post">'.__('There is no registered post.', 'tcd-ankle').'</p>';

}

?>
	</div>
</main>
<?php
get_footer();
