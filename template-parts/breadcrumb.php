<?php

  $options = get_design_plus_option();

?>
<div id="bread_crumb">
  <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
<?php

if ( is_woocommerce_active() && ( is_post_type_archive( 'product' ) || is_shop() || is_product_taxonomy() || is_product() || is_cart() || is_checkout() || is_account_page() ) ) {

?>
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
<?php

  $breadcrumb_position = 2;
  $WC_Breadcrumb = new WC_Breadcrumb();
  $breadcrumbs = $WC_Breadcrumb->generate();

  if( $breadcrumbs && (is_singular('product') || is_product()) ) {

?>
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><span itemprop="name"><?php echo esc_html($options['product_label']); ?></span></a><meta itemprop="position" content="2"></li>
<li class="category" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url($breadcrumbs[0][1]); ?>"><span itemprop="name"><?php echo esc_html($breadcrumbs[0][0]); ?></span></a><meta itemprop="position" content="3"></li>
<li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($breadcrumbs[1][0]); ?></span><meta itemprop="position" content="4"></li>
<?php

  }else{

    if ( $breadcrumbs ) {
      foreach( $breadcrumbs as $key => $breadcrumb ) :
        if ( ! empty( $breadcrumb[1] ) && count( $breadcrumbs ) !== $key + 1 ) {
?>
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
  <a itemprop="item" href="<?php echo esc_url( $breadcrumb[1] ); ?>">
    <span itemprop="name"><?php echo esc_html( $breadcrumb[0] ); ?></span>
  </a>
  <meta itemprop="position" content="<?php echo $breadcrumb_position++; ?>">
</li>
<?php
        } else {
?>
<li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
  <span itemprop="name"><?php echo esc_html($breadcrumb[0]); ?></span>
  <meta itemprop="position" content="<?php echo $breadcrumb_position; ?>">
</li>
<?php
        };
      endforeach;
      unset( $breadcrumb );
    };
    unset( $breadcrumbs );

  }

     // news single -----------------------
}elseif(is_singular('news')) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
 <?php
      // Search -----------------------
      } elseif(is_search()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e('Search result','tcd-ankle'); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // Blog page -----------------------
      } elseif(is_home()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // Category, Tag , Archive page -----------------------
      } elseif(is_category() || is_tag() || is_day() || is_month() || is_year()) {
        if (is_category()) {
          $title = single_cat_title('', false);
        } elseif( is_tag() ) {
          $title = single_tag_title('', false);
        } elseif (is_day()) {
          $title = sprintf(__('Archive for %s', 'tcd-ankle'), get_the_time(__('F jS, Y', 'tcd-ankle')) );
        } elseif (is_month()) {
          $title = sprintf(__('Archive for %s', 'tcd-ankle'), get_the_time(__('F, Y', 'tcd-ankle')) );
        } elseif (is_year()) {
          $title = sprintf(__('Archive for %s', 'tcd-ankle'), get_the_time(__('Y', 'tcd-ankle')) );
        };
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
 <?php
      //  Page -----------------------
      } elseif(is_page()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="2"></li>
 <?php
      //  Attachment page -----------------------
      } elseif(is_attachment()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // Other page -----------------------
      } else {
      $category = get_the_category();
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-ankle'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if($category) { ?>
 <li class="category" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
  <?php
       $count=1;
       foreach ($category as $cat) {
  ?>
  <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php $count++; } ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
 <?php }; ?>
 </ul>
</div>
