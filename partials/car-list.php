<?php
$type = $args['type']; ?>

<div class="car-list <?php echo $args['type']; ?>">
  <div class="car-list__title">
    <h2 class="title__main">
      <div><span class="highlight--orange">전차종 정보와 렌트료를 한눈에!</span></div>
    </h2>
    <h6 class="title__sub">퍼스트렌트에서 원하시는 자동차의 정보를 안내해드립니다.</h6>
  </div>
  <div class="car-list-filter">
    <ul class="filter-madein tab-links">
      <li class="tab-link <?php echo ($type == 'all') ? 'active' : ''; ?>">
        <a href="<?php echo home_url('?page_id=4494'); ?>">모두보기</a>
      </li>
      <li class="tab-link <?php echo ($type == 'domestic') ? 'active' : ''; ?>">
        <a href="<?php echo home_url('?page_id=2751'); ?>">국산차</a>
      </li>
      <li class="tab-link <?php echo ($type == 'imported') ? 'active' : ''; ?>">
        <a href="<?php echo home_url('?page_id=4496'); ?>">수입차</a>
      </li>
    </ul> <?php
    if ($type == 'domestic'): ?>
      <div class="filter-main">
        <div class="filter-brand">
          <h3>브랜드</h3>
          <ul>
            <li data-brand="제네시스"><img src="<?php echo firstrent_get_image_uri('brand/domestic/brand-genesis.png'); ?>" alt=""></li>
            <li data-brand="현대"><img src="<?php echo firstrent_get_image_uri('brand/domestic/brand-hyundai.png'); ?>" alt=""></li>
            <li data-brand="기아"><img src="<?php echo firstrent_get_image_uri('brand/domestic/brand-kia.png'); ?>" alt=""></li>
            <li data-brand="쉐보레"><img src="<?php echo firstrent_get_image_uri('brand/domestic/brand-chevrolet.png'); ?>" alt=""></li>
            <li data-brand="르노삼성"><img src="<?php echo firstrent_get_image_uri('brand/domestic/brand-renaultsamsung.png'); ?>" alt=""></li>
            <li data-brand="쌍용"><img src="<?php echo firstrent_get_image_uri('brand/domestic/brand-ssangyong.png'); ?>" alt=""></li>
          </ul>
        </div>
        <div class="filter-price">
          <h3>가격</h3>
          <ul>
            <li data-price="0_350000"><b>35</b>만원 이하</li>
            <li data-price="350000_450000"><b>35~45</b>만원</li>
            <li data-price="450000_550000"><b>45~55</b>만원</li>
            <li data-price="550000_650000"><b>55~65</b>만원</li>
            <li data-price="650000_750000"><b>65~75</b>만원</li>
            <li data-price="750000_9990000"><b>75</b>만원 이상</li>
          </ul>
        </div>
      </div> <?php
    endif;
    if ($type == 'imported'): ?>
      <div class="filter-main">
        <div class="filter-brand">
          <h3>브랜드</h3>
          <ul>
            <li data-brand="all"><img src="<?php echo firstrent_get_image_uri('brand/imported/brand-all.png'); ?>" alt=""></li>
            <li data-brand="벤츠"><img src="<?php echo firstrent_get_image_uri('brand/imported/brand-benz.png'); ?>" alt=""></li>
            <li data-brand="BMW"><img src="<?php echo firstrent_get_image_uri('brand/imported/brand-BMW.png'); ?>" alt=""></li>
            <li data-brand="아우디"><img src="<?php echo firstrent_get_image_uri('brand/imported/brand-audi.png'); ?>" alt=""></li>
            <li data-brand="폭스바겐"><img src="<?php echo firstrent_get_image_uri('brand/imported/brand-volkswagen.png'); ?>" alt=""></li>
            <li data-brand="볼보"><img class="mxw-100" src="<?php echo firstrent_get_image_uri('brand/imported/brand-volvo.png'); ?>" alt=""></li>
            <li data-brand="재규어"><img class="mxw-100" src="<?php echo firstrent_get_image_uri('brand/imported/brand-jaguar.png'); ?>" alt=""></li>
            <li data-brand="랜드로버"><img class="mxw-100" src="<?php echo firstrent_get_image_uri('brand/imported/brand-landrover.png'); ?>" alt=""></li>
            <li data-brand="렉서스"><img class="mxw-100" src="<?php echo firstrent_get_image_uri('brand/imported/brand-lexus.png'); ?>" alt=""></li>
            <li data-brand="링컨"><img class="mxw-100" src="<?php echo firstrent_get_image_uri('brand/imported/brand-lincoln.png'); ?>" alt=""></li>
            <li data-brand="테슬라"><img class="mxw-100" src="<?php echo firstrent_get_image_uri('brand/imported/brand-tesla.png'); ?>" alt=""></li>
            <li data-brand="기타"><img src="<?php echo firstrent_get_image_uri('brand/imported/brand-etc.png'); ?>" alt=""></li>
          </ul>
        </div>
      </div> <?php
    endif; ?>
    
  </div>
  <div class="car-list__list">
    <?php $titles = array(
      'city-car'              => '경차',
      'subcompact-car'        => '소형',
      'compact-car'           => '준중형',
      'mid-size-car'          => '중형',
      'large-size-car'        => '준대형',
      'full-size-luxury-car'  => '대형',
      'suv'                   => 'SUV',
      'rv'                    => 'RV',
      'van'                   => '승합차',
      'sport-car'             => '스포츠카/고성능라인',
      'electric-car'          => '전기차',
      'lorry-car'             => '화물차'
    );
    $car_list_group = firstrent_get_car_list($type);
    foreach($car_list_group as $key => $car_list): ?>
      <div class="car-group">
        <div class="car-group__title"><?php echo $titles[$key]; ?></div>
        <ul><?php
          foreach($car_list as $car):?>
            <div class="car-list-item" data-brand="<?php echo $car['brand']; ?>" data-price="<?php echo $car['pure_rental_price']; ?>">
              <div class="inner">
                <a href="<?php echo $car['link']; ?>" class="left">
                  <div class="car-thunmbnail"><img src="<?php echo $car['thumbnail_url']; ?>" alt=""></div>
                  <div class="car-info">
                    <div class="top">
                      <div class="car-name"><?php echo $car['name']; ?></div>
                      <div class="car-brand"><?php echo $car['brand']; ?></div>
                      <div class="car-badges"><?php
                        foreach($car['badges'] as $badge) :
                          ['value' => $class, 'label' => $label] = $badge; ?>
                          <span class="car-badge <?php echo $class; ?>"><?php echo $label ?></span> <?php
                        endforeach; ?>
                      </div>
                    </div>
                    <div class="bottom">
                      <span class="car-fuel-efficiency"><?php echo $car['fuel_efficiency_type']; ?>: <?php echo $car['fuel_efficiency']; ?></span><?php
                        if ($car['fuel']) : ?>
                          <span class="car-fuel"> / 연료: <?php echo $car['fuel']; ?></span><?php
                        endif; ?>
                    </div>
                  </div>
                </a>
                <div class="right">
                  <div class="price-group">
                    <div class="highlight--orange car-rental-price"><?php 
                      echo $car['rental_price'];
                      // 상담 이라는 글자가 들어있지 않은 경우에만 /월 을 뿌려준다
                      if ((strpos($car['rental_price'], "상담") === false) && (strpos($car['rental_price'], "불가") === false)) :?>
                        <span>/월</span><?php
                      endif;?>
                    </div><?php
                    if (strlen($car['lease_price']) > 1) :?>
                      <div class="highlight--orange car-lease-price"><?php 
                        echo $car['lease_price'];
                        // 상담 이라는 글자가 들어있지 않은 경우에만 /월 을 뿌려준다
                        if ((strpos($car['lease_price'], "상담") === false) && (strpos($car['lease_price'], "불가") === false)) :?>
                          <span>/월</span><?php
                        endif;?>
                      </div><?php
                    endif;?>
                  </div>
                  <a class="btn btn-primary" href="<?php echo home_url("?page_id=4423&carid={$car['carid']}&memo={$car['name']}({$car['brand']}) 견적 문의합니다"); ?>">상담신청</a>
                </div>
              </div>
            </div><?php
          endforeach;?>
        </ul>
      </div><?php
    endforeach;?>
  </div>
</div>