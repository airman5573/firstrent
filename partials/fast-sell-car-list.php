<div class="fast-sell-car-list">
  <div class="main-image"><?php 
    $desktop = get_field('fast_sell_page_image_desktop');
    $mobile = get_field('fast_sell_page_image_mobile');
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
    'post_type'		=> 'car_fast_sell'
  );
  $the_query = new WP_Query($args);
  if ($the_query->have_posts()):
    while($the_query->have_posts()): $the_query->the_post(); 
      $pid = get_the_ID();
      $title = get_the_title();
      $sub_info = get_field('car_info1');
      $badges = get_field('car_badges');
      $brand = get_field('car_brand');
      $fuels = array_filter(get_field('car_fuel_type'), function($val){ return !empty($val); });
      $fuel = implode(', ', array_map(function($val){ return $val['label']; }, $fuels));
      if (!empty($fuel)) $fuel = '(' . $fuel . ')';
      $price = get_field('car_rent_price'); ?>
      <div class="car-item">
        <div class="wrapper">
          <div class="top">
            <div class="left">
              <div class="title"><?php echo $title; ?></div>
              <div class="car-badges"><?php
                foreach($badges as $badge) :
                  ['value' => $class, 'label' => $label] = $badge; ?>
                  <span class="car-badge <?php echo $class; ?>"><?php echo $label ?></span> <?php
                endforeach; ?>
              </div>
              <ul class="badges"></ul>
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
          <div class="bottom"><?php
            the_content(); ?>
          </div>
        </div>
      </div>
      <?php
    endwhile;
  endif; ?>
</div>