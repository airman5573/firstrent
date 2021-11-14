<?php
get_header(); ?>

<div class="container-md">
  <div class="row">
    <div class="col-lg-3"> <?php
      echo get_template_part('partials/sidebar'); ?>
    </div>
    <div class="col-lg-9">
      <div class="post-content"> <?php
        if (have_posts()) :
          while(have_posts()) : the_post();?>
            <div class="board-message">
              <h2>퍼스트렌트 고객분들의</h2>
              <h2><strong class="highlight--orange">생생한 후기를 소개합니다<em>!</em></strong></h2>
            </div> <?php
            the_content();
          endwhile;
        endif; ?>
      </div>
    </div>
  </div>
</div> <?php

get_footer(); ?>