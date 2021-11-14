<?php 
$url = home_url() . '/?page_id=4411';
?>
<div class="review-board">
  <div class="review-board__title box-title">
    출고 후기
    <a class="more" href="<?php echo $url; ?>">
      <i class="fa fa-plus"></i>
    </a>
  </div>
  <div class="review-board__content"><?php
    echo do_shortcode("[kboard_latest id='1' url='{$url}' rpp='12']"); ?>
  </div>
</div>