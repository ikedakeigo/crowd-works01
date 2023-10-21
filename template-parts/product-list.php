<?php

$options = get_design_plus_option();

?>
<section id="index_product_list" class="index_product_list index_section<?php if($options['product_list_type'] !== 'products') echo ' no_label'; ?>" style="background-color:<?php esc_attr_e($options['product_list_bg_color']); ?>;">
  <div class="inner">
  <?php

    $title = $options['product_list_headline'];
    $sub_title = $options['product_list_sub_headline'];
    $desc = $options['product_list_desc'];
    if($title || $sub_title){

  ?>
    <div class="common_header">
      <h2 class="heading rich_font">
        <?php if($title){ ?><span class="heading_top common_headline"><?php echo esc_html($title); ?></span><?php } ?>
        <?php if($sub_title){ ?><span class="heading_bottom"><?php echo esc_html($sub_title); ?></span><?php } ?>
      </h2>
      <?php if($desc){ ?><p class="description"><?php echo wp_kses_post(nl2br($desc)); ?></p><?php } ?>
    </div>
    <?php

    }

    if ( is_woocommerce_active() ) {

      // 商品タイプ
      $type = esc_attr($options['product_list_type']);
      $is_sale = false;
      if($type == 'sale_products') {
        $type = 'products';
        $is_sale = true;
      }

      // 表示数
      $limit = (!is_mobile()) ? $options['product_list_num'] : $options['product_list_num_sp'];
      // products 全ての商品
      // featured_products 注目商品
      // sale_products セール商品

      $order = $options['product_list_order'];
      // orderby = "menu_order" 標準
      // orderby = "date" 新着順
      // orderby = "popularity" 人気順
      // orderby = "rand" ランダム

      echo do_shortcode( '['.$type.' limit="'.$limit.'" orderby="'.$order.'" class="type_'.$type.'" on_sale="'.$is_sale.'"]' );

      if($options['product_list_button_display'] == 'display'){

    ?>
    <div class="button_wrap">
      <a class="q_custom_button q_custom_<?php echo $options['product_list_button_type']; ?>" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><?php echo esc_html($options['product_list_button_label']); ?></a>
    </div>
    <?php

      }

    }

    ?>
  </div>
</section>