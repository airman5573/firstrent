<div class="special-sale-car-list">
  <div class="main-image"><?php 
  $desktop = get_field('speical_sale_page_image_desktop');
  $mobile = get_field('speical_sale_page_image_mobile');
  if ($desktop) { ?>
    <img class="img-desktop visible-upper-sm" src="<?php echo $desktop; ?>" alt=""> <?php
  }
  if ($mobile) { ?>
    <img class="img-mobile visible-under-sm" src="<?php echo $mobile; ?>" alt=""> <?php
  }?>
  </div>
  <?php
  $args = array(
    'numberposts'	=> -1,
    'posts_per_page' => -1,
    'post_type'		=> 'car_speical_sale'
  );
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()):
    while($the_query->have_posts()): $the_query->the_post(); 
      $pid = get_the_ID();
      $title = get_the_title();
      $sub_info = get_field('car_special_sale_info');
      $brand = get_field('car_brand');
      $price = get_field('car_rent_price'); ?>
      <div class="car-item">
        <div class="wrapper">
          <div class="left">
            <div class="title"><?php echo $title; ?></div>
            <div class="sub-info">- <?php echo $sub_info; ?></div>
            <div class="price"><?php echo $price ?></div>
            <a href="<?php echo home_url("?page_id=4423&carid={$pid}&memo={$title}({$brand}) 견적 문의합니다"); ?>">
              <img src="<?php echo firstrent_get_image_uri('price-btn.png'); ?>" alt="">
            </a>
          </div>
          <div class="right">
            <img src="<?php echo get_the_post_thumbnail_url($pid); ?>" alt="">
          </div>
        </div>
      </div>
      <?php
    endwhile;
  endif; ?>
</div>