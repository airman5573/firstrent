<?php
get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-3"> <?php
      echo get_template_part('partials/sidebar'); ?>      
    </div>
    <div class="col-lg-9">
      <div class="content-wrapper">
        <div class="title">
          <h1 class="title__main"><span class="highlight--orange">전차종 정보를 한눈에!</span></h1>
          <h6 class="title__sub">퍼스트렌트에서 원하시는 자동차의 정보를 안내해드립니다.</h6>
        </div>
        <div class="car-content"> <?php
          if (have_posts()) :
            while(have_posts()) : the_post();
              $pid = get_the_ID();
              [
                'car_new_product_min_price' => $min,
                'car_new_product_max_price' => $max
              ] = get_field('car_new_product_price_range_group');
              $new_car_price = $min . ' ~ ' . $max . '만원';
              [
                'car_fuel_efficiency_type' => $efficiency_type,
                'car_fuel_efficiency' => $efficiency
              ] = get_field('car_fuel_efficiency');
              $fuels = get_field('car_fuel_type');
              $fuel_labels = [];
              foreach($fuels as $fuel) {
                if (array_key_exists('label', $fuel)) { array_push($fuel_labels, $fuel['label']); }
              }
              $fuel_labels = implode(", ", $fuel_labels);
              $rent_fee = get_field('car_rent_price');
              $lease_fee = get_field('car_lease_price');
              $file_url = get_field('car_price_table_file');
              $title = get_the_title();
              $brand = get_field('car_brand'); ?>
              <div class="info mt-3">
                <div class="row">
                  <div class="col-md-6"> <?php
                    the_post_thumbnail('car-detail-thumbnail'); ?>
                  </div>
                  <div class="col-md-6">
                    <div class="car-title mb-3 mt-3">
                      <?php echo $title; ?>&nbsp;&nbsp;<small><?php echo $brand; ?></small>
                    </div>
                    <ul>
                      <li>신차가격 : <?php echo $new_car_price ?></li>
                      <li><?php echo $efficiency_type['label']; ?> : <?php echo $efficiency; ?></li> <?php
                      if (!empty($fuel_labels)) : ?>
                        <li>연료 : <?php echo $fuel_labels; ?></li><?php
                      endif; ?>
                    </ul>
                    <div class="btn-list mb-4"><?php
                      if ($file_url) { ?>
                        <a href="<?php echo $file_url; ?>" class="btn btn-default" target="_blank">가격표 다운로드</a>&nbsp; <?php
                      } ?>
                      <a href="<?php echo home_url("?page_id=4423&carid={$pid}&memo={$title}({$brand}) 견적 문의합니다"); ?>" class="btn btn-primary btn-firstrent">상담 신청하기</a>
                    </div>
                    <div class="car-price">
				  <span>48개월 / 연간2만km </span>
                      <div class="price-group">
                        <h2><?php 
                          echo $rent_fee;
                          if ((strpos($rent_fee, "상담") === false) && (strpos($rent_fee, "불가") === false)) :?>
                            <span>/월</span><?php
                          endif;?>
                        </h2> <?php
                          if (strlen($lease_fee) > 1) :?>
                            <h2><?php 
                              echo $lease_fee;
                              if ((strpos($lease_fee, "상담") === false) && (strpos($lease_fee, "불가") === false)) :?>
                                <span>/월</span><?php
                              endif;?>
                            </h2><?php
                          endif; ?>
                      </div>
                    </div>
                </div>
              </div>
              <div class="car-class-with-price-options">
                <table>
                  <tr>
                    <th>등급</th>
                    <th>차량가격</th>
                    <th>상담신청</th>
                  </tr> <?php 
                  if (have_rows('car_class_with_price_options_repeater')): 
                    while(have_rows('car_class_with_price_options_repeater')): the_row();
                      $option = get_sub_field('car_class_option');
                      $price = get_sub_field('car_class_price_option'); ?>
                      <tr>
                        <td><?php echo $option; ?></td>
                        <td><?php echo $price; ?>만원</td>
                        <td>
                          <a class="d-block" href="<?php echo home_url("?page_id=4423&carid={$pid}&memo={$title}({$brand}) - {$option} 견적 문의합니다"); ?>">
                            <button class="btn btn-primary">상담신청</button>
                          </a>
                        </td>
                      </tr> <?php
                    endwhile;
                  endif;
                  ?>
                </table>
              </div>
            <?php
            endwhile;
          endif; ?>
          <div class="fs-8 mb-3"><?php
            if (have_posts()) :
              while(have_posts()) : the_post();
                $title = get_the_title();
                echo '<b>' . $title . '</b>' . '차량 장기렌트 / 리스는 퍼스트렌트!';
                break;
              endwhile;
            endif;?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <?php

get_footer();
?>