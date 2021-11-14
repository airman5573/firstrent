<div class="drape-container <?php echo ((is_home() && is_front_page()) ? 'open' : 'hide'); ?>">
  <div class="drape">
    <div class="wrapper">
      <div class="left">
        <div class="car-price-tab">
          <h3 class="car-price-tab__title">
            나의 <strong>예산에 맞는 차량</strong>을 찾아보세요!
          </h3>
          <div class="car-price-tab__content">
            <ul class="filter">
              <li data-tabid="tab1"><b>35</b><small>만원 이하</small></li>
              <li data-tabid="tab2"><b>35~45</b><small>만원</small></li>
              <li data-tabid="tab3"><b>45~55</b><small>만원</small></li>
              <li data-tabid="tab4"><b>55~65</b><small>만원</small></li>
              <li data-tabid="tab5"><b>65~75</b><small>만원</small></li>
              <li data-tabid="tab6"><b>75</b><small>만원 이상</small></li>
            </ul>
            <div class="tabs"> 
              <div class="left"> <?php
                $datasets = firstrent_get_active_cars();
                $tabid = 0;
                foreach($datasets as $dataset) : $tabid += 1; ?>
                  <div class="tab" data-tabid="tab<?php echo $tabid; ?>"> <?php
                    foreach($dataset as $data) :?>
                      <div class="tab__item">
                        <a href="<?php echo $data['link']; ?>">
                          <div class="top">
                            <div class="tab__image"><?php
                              echo $data['imageTag']; ?>
                            </div>
                          </div>
                          <div class="bottom">
                            <div class="tab__car-title"><?php echo $data['title']; ?></div>
                            <div class="tab__car-price"><b><?php echo $data['price']; ?></b><small>만원</small></div>
                          </div>
                        </a>
                      </div><?php
                    endforeach; ?>
                  </div> <?php
                endforeach;?>
              </div>
              <div class="right">
                <a href="<?php echo home_url('?page_id=4494'); ?>" class="more d-flex">
                  <img src="<?php echo firstrent_get_image_uri('more.png'); ?>" alt="">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="right"><?php
        get_template_part('partials/consult-simple-form');?>
      </div>
    </div>
  </div>
  <div class="handle">
    <div class="handle__btn">
      <i class="fas fa-angle-down"></i>
      <i class="fas fa-angle-up"></i>
    </div>
  </div>
</div>