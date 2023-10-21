<?php

  $options = get_design_plus_option();

  $message = $options['header_message'];
  $url = $options['header_message_url'];
  $font_color = $options['header_message_font_color'];
  $bg_color = $options['header_message_bg_color'];

?>
<div id="header_message" style="color:<?php esc_attr_e($font_color); ?>;background-color:<?php esc_attr_e($bg_color); ?>;">
  <?php if($url){ ?>
  <a href="<?php echo esc_url($url); ?>" class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
  <?php }else{ ?>
  <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
  <?php } ?>
</div>