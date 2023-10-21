<?php

  $options = get_design_plus_option();

  $title = '';
  $sub_title = '';
  $desc = '';

  switch (true) {

    case is_home() :
      $title = $options['blog_archive_headline'];
      $sub_title = $options['blog_archive_sub_headline'];
      $desc = $options['blog_archive_desc'];
      break;

    case is_post_type_archive('news') :
      $title = $options['news_archive_headline'];
      $sub_title = $options['news_archive_sub_headline'];
      $desc = $options['news_archive_desc'];
      break;

    // 商品アーカイブ
    case is_woocommerce_active() && is_post_type_archive('product') && !is_search() :
      $title = $options['product_archive_headline'];
      $sub_title = $options['product_archive_sub_headline'];
      $desc = $options['product_archive_desc'];
      break;

    // 商品検索結果ページ
    case is_woocommerce_active() && is_post_type_archive('product') && is_search() :

      if ( !empty( get_search_query() ) ) {
        $title = sprintf( __( 'Product list for %s', 'tcd-ankle' ), get_search_query() );
      } else {
        $title = __( 'Search result', 'tcd-ankle' );
      }
      break;

    case  is_category() || is_tag() || is_tax() :
      $query_obj = get_queried_object();
      $term_id = $query_obj->term_id;
      $title = $query_obj->name;
      $desc = $query_obj->description;
      if( is_tax( 'product_cat' )) $sub_title = get_term_meta( $term_id, 'product_cat_sub_headline', true );
      break;

    case is_day() :
      $title = sprintf( __( 'Archive for %s', 'tcd-ankle' ), get_the_time( __( 'F jS, Y', 'tcd-ankle' ) ) );
      break;

    case is_month() :
      $title = sprintf( __( 'Archive for %s', 'tcd-ankle' ), get_the_time( __( 'F, Y', 'tcd-ankle') ) );
      break;

    case is_year() :
      $title = sprintf( __( 'Archive for %s', 'tcd-ankle' ), get_the_time( __( 'Y', 'tcd-ankle') ) );
      break;

    case is_author() :
      $title = sprintf( __( 'Archive for %s', 'tcd-ankle' ), get_the_author() );
      break;

    case is_search() :
      if ( !empty( get_search_query() ) ) {
        $title = sprintf( __( 'Search result for %s', 'tcd-ankle' ), get_search_query() );
      } else {
        $title = __( 'Search result', 'tcd-ankle' );
      }
      break;

  }


?>
<div class="common_header archive">
  <?php if($title || $sub_title){ ?>
	<h1 class="heading rich_font">
    <?php if($title){ ?><span class="heading_top common_headline"><?php echo esc_html($title); ?></span><?php } ?>
		<?php if($sub_title){ ?><span class="heading_bottom"><?php echo esc_html($sub_title); ?></span><?php } ?>
	</h1>
  <?php } if($desc){ ?>
	<p class="description"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php } ?>
</div>