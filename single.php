<?php
get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-3"> <?php
      echo get_template_part('partials/sidebar'); ?>      
    </div>
    <div class="col-lg-9">
      <div class="post-content"> <?php
        if (have_posts()) :
          while(have_posts()) : the_post();
            the_content();
          endwhile;
        endif; ?>
      </div>
    </div>
  </div>
</div> <?php

get_footer();
?>