<?php
get_header(); ?>

<div class="container-md">
  <div class="row">
    <div class="col-lg-3">
      <div class="row"><?php
        echo get_template_part('partials/sidebar'); ?>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="row">
        <ul class="col-lg-8 visible-upper-xl"> 
          <div class="swiper main-slider">
            <div class="swiper-wrapper"> <?php
              if (have_rows('main_slider_xl_repeater', 'main_slider')) :
                while( have_rows('main_slider_xl_repeater', 'main_slider') ) : the_row(); 
                  $image_url = get_sub_field('main_slider_xl_image', 'main_slider');
                  $link = get_sub_field('main_slider_xl_link', 'main_slider'); ?>
                  <li class="slide-item swiper-slide">
                    <img src="<?php echo $image_url; ?>" alt="">
                  </li> <?php
                endwhile;
              endif; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </ul>
        <ul class="col-lg-8 visible-between-lg-xl">
          <div class="swiper main-slider">
            <div class="swiper-wrapper"> <?php
              if (have_rows('main_slider_lg_repeater', 'main_slider')) :
                while( have_rows('main_slider_lg_repeater', 'main_slider') ) : the_row(); 
                  $image_url = get_sub_field('main_slider_lg_image', 'main_slider');
                  $link = get_sub_field('main_slider_lg_link', 'main_slider'); ?>
                  <li class="slide-item swiper-slide">
                    <img src="<?php echo $image_url; ?>" alt="">
                  </li> <?php
                endwhile;
              endif; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </ul>
        <ul class="col-lg-8 visible-between-md-lg">
          <div class="swiper main-slider">
            <div class="swiper-wrapper"> <?php
              if (have_rows('main_slider_md_repeater', 'main_slider')) :
                while( have_rows('main_slider_md_repeater', 'main_slider') ) : the_row(); 
                  $image_url = get_sub_field('main_slider_md_image', 'main_slider');
                  $link = get_sub_field('main_slider_md_link', 'main_slider'); ?>
                  <li class="slide-item swiper-slide">
                    <img src="<?php echo $image_url; ?>" alt="">
                  </li> <?php
                endwhile;
              endif; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </ul>
        <ul class="col-lg-8 visible-under-md">
          <div class="swiper main-slider">
            <div class="swiper-wrapper"> <?php
              if (have_rows('main_slider_sm_repeater', 'main_slider')) :
                while( have_rows('main_slider_sm_repeater', 'main_slider') ) : the_row(); 
                  $image_url = get_sub_field('main_slider_sm_image', 'main_slider');
                  $link = get_sub_field('main_slider_sm_link', 'main_slider'); ?>
                  <li class="slide-item swiper-slide">
                    <img src="<?php echo $image_url; ?>" alt="">
                  </li> <?php
                endwhile;
              endif; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </ul>
        <div class="col-lg-4 consult-slider">
          <div class="consult-slider__title box-title">
            진행중인 상담
          </div>
          <ul class="consult-slider__list"> <?php
            $list = firstrent_get_consult_list();
            foreach($list as $item) : ?>
              <li class="list-item">
                <div class="left">
                  <img src="<?php echo $item['thumbnail_url']; ?>">
                </div>
                <div class="right">
                  <h5>상담신청</h5>
                  <div><?php echo mb_substr($item['name'], 0, 1) . '**님 ' . $item['consult_type']; ?></div>
                  <div><?php echo $item['date']; ?></div>
                </div>
              </li> <?php
            endforeach; ?>
          </ul>
        </div>
      <div class="row"> <?php
        echo get_template_part('partials/latest-review-board'); ?>
      </div>
    </div>
  </div>
</div> <?php

get_footer();