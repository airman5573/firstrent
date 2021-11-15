<?php
/**
 * 헤더파일
 *
 * <head> section과 <body>안에 header section을 보여주는 template입니다
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package firstrent
 */
$my_theme = wp_get_theme( 'firstrent' );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M695GTC');</script>
<!-- End Google Tag Manager -->	
  <meta charset="<?php bloginfo('charset' ); ?>">

  <!-- For IE -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Theme Version -->
  <meta name="firstrent-version" content="<?php echo esc_attr($my_theme->Version) ?>">

  <!-- For Responsive Device -->
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

  <!-- 사이트를 소개하는 meta tag -->
  <meta property="og:url" content="http://firstrent.kr/">
  <meta property="og:title" content="퍼스트렌트">
  <meta property="og:description" content="믿음과 신뢰를 드리는 전문업체 입니다. 14개 렌터사 가격비교, 상시특가, 친절상담">
  <meta name="description" content="믿음과 신뢰를 드리는 전문업체 입니다. 14개 렌터사 가격비교, 상시특가,친절상담">
  <meta name="keywords" content="믿음과 신뢰를 드리는 전문업체 입니다. 14개 렌터사 가격비교, 상시특가,친절상담">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M695GTC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->		
  <div class="wrapper">
    <div id="masthead" class="menu navbar">
      <div class="nav-container">
        <nav class="main-nav">
          <div class="logo mobile-logo visible-under-md">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <img src="<?php echo firstrent_get_image_uri('logo/logo.png'); ?>" alt="">
            </a>
          </div>
          <ul class="menu">
            <li class="menu__item visible-upper-md">
              <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <img src="<?php echo firstrent_get_image_uri('logo/logo.png'); ?>" alt="">
                </a>
              </div>
            </li>
            <li class="menu__item">
              <a href="http://firstrent.co.kr/">안내 / 소개</a>  
            </li>
            <li class="menu__item">
              <a href="<?php echo esc_url( home_url( '/?page_id=2751' ) ); ?>">가격정보</a>
            </li>
            <li class="menu__item">
              <a
                class="link-sale visible-under-md"
                href="<?php echo esc_url( home_url( '/?page_id=2752' ) ); ?>"><i class="fas fa-check"></i> Speical Sale
              </a>
              <a
                class="link-sale visible-between-md-lg"
                href="<?php echo esc_url( home_url( '/?page_id=2752' ) ); ?>"
                style="background-image: url('<?php echo firstrent_get_image_uri( 'menu/price-sm.png' ); ?>')"><i class="fas fa-check"></i> Speical Sale
              </a>
              <a 
                class="link-sale visible-between-lg-xl"
                href="<?php echo esc_url( home_url( '/?page_id=2752' ) ); ?>"
                style="background-image: url('<?php echo firstrent_get_image_uri( 'menu/price-md.png' ); ?>')"><i class="fas fa-check"></i> Speical Sale
              </a>
              <a 
                class="link-sale visible-upper-xl"
                href="<?php echo esc_url( home_url( '/?page_id=2752' ) ); ?>"
                style="background-image: url('<?php echo firstrent_get_image_uri( 'menu/price-lg.png' ); ?>')"> <i class="fas fa-check"></i> Speical Sale
              </a>
            </li>
            <li class="menu__item">
              <a class="link-quick-release" href="<?php echo esc_url( home_url( '/?page_id=2753' ) ); ?>">
                <img src="<?php echo firstrent_get_image_uri( 'menu/realtime.png' ); ?>" alt=""> 빠른출고
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="consult-bar-container"> <?php
        $is_consult_bar_enabled = get_field('consult_enabled', 'consult_bar');
        if ( $is_consult_bar_enabled ) : ?>
          <div class="consult-bar">
            <div class="left">
              <div class="news-ticker">
                <div class="news-ticker__icon-container">
                  <i class="fas fa-bullhorn"></i>
                </div>
                <ul class="visible-upper-md"> <?php
                  if ( have_rows('news_ticker_text_repeater', 'consult_bar') ) :
                    while( have_rows('news_ticker_text_repeater', 'consult_bar') ) : the_row();
                      $message = get_sub_field('news_ticker_text');
                      echo '<li>' . $message . '</li>';
                    endwhile;
                  endif;?>
                </ul>
                <ul class="visible-under-md"> <?php
                  if ( have_rows('news_ticker_text_repeater_mobile', 'consult_bar') ) :
                    while( have_rows('news_ticker_text_repeater_mobile', 'consult_bar') ) : the_row();
                      $message = get_sub_field('news_ticker_text');
                      echo '<li>' . $message . '</li>';
                    endwhile;
                  endif;?>
                </ul>
              </div>
            </div>
            <div class="right">
              <img src="<?php echo firstrent_get_image_uri('contact-bar/contact_bar_bg.png'); ?>" alt="">
            </div>
          </div><?php
        endif;?>
      </div>
    </div>
    <div id="content" role="main">
      <div class="wrapper">
        <div class="kakao-desktop">
          <a href="http://pf.kakao.com/_fgxgUs/chat" target="_blank">
            <img src="http://firstrent.kr/wp-content/uploads/2021/11/kakao-consult.png" alt="">
          </a>
        </div>
        <?php
        // drape
        echo get_template_part('partials/drape');