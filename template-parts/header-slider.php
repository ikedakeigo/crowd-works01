<?php

  $options = get_design_plus_option();

  $index_slider = apply_filters( 'ankle_header_slider_args', $slider = $options['index_slider'] );
  $index_slider_width = apply_filters( 'ankle_header_slider_width', $width = $options['index_slider_content_width'] );
  $index_slider_bg_animation = 'bg_animation_'.$options['index_slider_bg_animation'];
  $index_slider_content_animation = 'content_animation_'.$options['index_slider_content_animation'];
  $index_slider_time = $options['index_slider_time'];

?>
<div id="header_slider_wrap" class="<?php esc_attr_e($index_slider_bg_animation) ?> <?php esc_attr_e($index_slider_content_animation) ?> width_<?php esc_attr_e($index_slider_width); ?>">
  <div id="header_slider" class="swiper">
    <div class="swiper-wrapper">
      <?php

          $i = 1;
          $slider_item_total = count($index_slider);
          foreach ( $index_slider as $key => $value ) :

            $item_type = $value['slider_type'];

            // 背景
            $image = wp_get_attachment_image_src( $value['image'], 'full');
            $image_sp = wp_get_attachment_image_src( $value['image_sp'], 'full');
            $video = $value['video'];
            $youtube_url = $value['youtube'];
            $overlay_color = implode(",",hex2rgb($value['overlay_color']));
            $overlay_opacity = $value['overlay_opacity'];

            // テキスト
            $catch = $value['catch'];
            $catch_sp = $value['catch_sp'];
            $catch_color = $value['catch_font_color'];
            $desc = $value['desc'];
            $desc_sp = $value['desc_sp'];
            $desc_color = $value['desc_font_color'];

            // ボタン
            $link_type = $value['link_type'];
            $button_label = $value['button_label'];
            $button_url = $value['button_url'];

            $tag = ($link_type == 'type1' && $button_url ) ? 'a' : 'div';


      ?>
      <<?php echo $tag; ?> <?php if($link_type == 'type1') echo 'href="'.$button_url.'" '; ?>class="swiper-slide item <?php if( ($item_type == 'type2') && $video && auto_play_movie() ) { echo 'video'; } elseif( ($item_type == 'type3') && $youtube_url && auto_play_movie() ) { echo 'youtube'; } else { echo 'image_item'; }; ?> item<?php echo $i; ?> <?php if($i == 1){ echo 'first_item'; }; ?>">

        <div class="caption">

          <div class="inner">

            <?php if(!empty($catch)){ ?>
            <h2 class="animate_item catch rich_font_<?php echo esc_attr($value['catch_font_type']); ?>" style="color:<?php esc_attr_e($catch_color); ?>;">
              <?php if(!empty($catch_sp)){ ?><span class="sp"><?php echo wp_kses_post(nl2br($catch_sp)); ?></span><?php }; ?>
              <span class="pc"><?php echo wp_kses_post(nl2br($catch)); ?></span>
            </h2>
            <?php }; ?>

            <?php if(!empty($desc)){ ?>
            <div class="animate_item desc" style="color:<?php esc_attr_e($desc_color); ?>;">
              <?php if(!empty($desc_sp)){ ?><p class="sp"><?php echo wp_kses_post(nl2br($desc_sp)); ?></p><?php }; ?>
              <p class="pc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
            </div>
            <?php }; ?>

            <?php if($link_type == 'type2'){ ?>
            <div class="button_wrap animate_item">
              <a class="button" href="<?php echo esc_attr($button_url); ?>"><?php echo esc_html($button_label); ?></a>
            </div>
            <?php }; ?>

          </div>

        </div><!-- END .caption -->

        <div class="overlay" style="background-color:rgba(<?php esc_attr_e($overlay_color); ?>,<?php esc_attr_e($overlay_opacity); ?>);"></div>

        <?php if( ($item_type == 'type2') && $video && auto_play_movie() ) { ?>
        <video class="video_wrap" preload="auto" muted playsinline <?php if($slider_item_total == 1) { echo "loop"; }; ?>>
          <source src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" type="video/mp4" />
        </video>
        <?php
        
          } elseif( ($item_type == 'type3') && $youtube_url && auto_play_movie() ) {
            if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube_url, $matches)) {
        ?>
        <div class="video_wrap">
          <div class="inner">
            <div class="youtube_inner">
              <iframe id="youtube-player-<?php echo $i; ?>" class="youtube-player slide-youtube" src="https://www.youtube.com/embed/<?php echo esc_attr($matches[1]); ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&<?php if($slider_item_total > 1) { echo "loop=0"; } else { echo "playlist=" . esc_attr($matches[1]); }; ?>&playsinline=1&loop=1" frameborder="0"></iframe>
            </div>
          </div>
        </div>
        <?php
            };
          } else {
        ?>
        <?php if($image_sp) { ?><div class="bg_image sp" style="background:url(<?php echo esc_attr($image_sp[0]); ?>) no-repeat center; background-size:cover;"></div><?php }; ?>
        <?php if($image) { ?><div class="bg_image pc" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
        <?php }; ?>

      </<?php echo $tag; ?>><!-- END .item -->
    <?php
        $i++;
        endforeach;
    ?>
    </div><!-- END swiper-wrapper -->
  </div><!-- END #header_slider -->

  <?php if($slider_item_total > 1) { ?>
  <div class="swiper-pagination"></div>
  <?php } ?>

</div><!-- END #header_slider_wrap -->