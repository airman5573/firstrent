<?php
$default_consult_image_id = 7497;
/**
 * 함수들이 자리한 파일입니다
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package firstrent
 */

/**
 * 테마의 기본 기능들과 Wordpress가 지원하는 기능들을 설정합니다
 */
function firstrent_setup() {
  // load_theme_textdomain( 'firstrent', get_template_directory() . '/languages' );

  /**
   * 워드프레스가 알아서 Document Title을 지정합니다
   */
  add_theme_support( 'title-tag' );

  /**
   * Post/Page에 Thumbnail을 등록할 수 있습니다
   */
  add_theme_support('post-thumbnails');

  /**
   * 이미지 사이즈에 이름을 붙여서 편하게 사이즈를 지정할 수 있습니다
   */
  add_image_size('car-thumbnail', 145, 85, true );
  add_image_size('car-detail-thumbnail', 400, 1000);
  add_image_size('center-thumbnail', 203, 200, true );
  add_image_size('box-thumbnail', 121, 75, true );
  add_image_size('horizontal-thumbnail', 270, 130, true );
  add_image_size('search-thumbnail', 130, 80, true );
}
add_action( 'after_setup_theme', 'firstrent_setup');

/**
 * Image를 조금 더 쉽게 가져옵니다
 */
function firstrent_get_image_uri($path) {
  return get_template_directory_uri() . "/assets/images/{$path}";
}

/**
 * css파일을 load합니다
 */
function firstrent_enqueue_styles() {
  wp_enqueue_style('bootstrap-utilities', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap-utilities.css', array(), '0.0.1');
  wp_enqueue_style('firstrent-style', get_template_directory_uri() . '/style.css', array(), '0.0.1');
  wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/vendors/swiper/swiper-bundle-min.css', array(), '0.0.1');
  wp_enqueue_style('jq-modal', get_template_directory_uri() . '/assets/vendors/modal/modal.min.css', array(), '0.0.1');
}
add_action('wp_enqueue_scripts', 'firstrent_enqueue_styles');

/**
 * js파일을 load합니다
 */
function firstrent_enqueue_scripts() {
  wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/vendors/swiper/swiper-bundle-min.js', array(), '0.0.1', true);
  wp_enqueue_script('jq-modal', get_template_directory_uri() . '/assets/vendors/modal/modal.min.js', array('jquery'), '0.0.1', true);
  wp_enqueue_script('firstrent-utils', get_template_directory_uri() . '/assets/js/utils.js', array('jquery'), '0.0.1', true);
  wp_enqueue_script('firstrent-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'swiper', 'firstrent-utils'), '0.0.1', true);
  wp_enqueue_script('firstrent-form', get_template_directory_uri() . '/assets/js/form.js', array('jquery', 'jq-modal', 'firstrent-utils'), '0.0.1', true);
  wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/968af2aacb.js', array(), '0.0.1', false);
  wp_enqueue_script('macy', get_template_directory_uri() . '/assets/vendors/macy/macy.js', array(), '0.0.1', true);
}
add_action('wp_enqueue_scripts', 'firstrent_enqueue_scripts');

/**
 * header부분에 있는 new stiker 설정페이지입니다(Advanced custom field필요)
 */
function firstrent_add_option_page() {
  if( function_exists('acf_add_options_page') ) {
    // 알림바
    acf_add_options_page(array(
      'page_title'    => '실시간 상담 알림바',
      'menu_title'    => '알림바 설정',
      'menu_slug'     => 'consult-news-ticker',
      'capibility'    => 'edit_posts',
      'redirect'      => false,
      'post_id'       => 'consult_bar',
      'position'      => '8.2',
      'icon_url'      => 'dashicons-minus'
    ));

    // 메인페이지 슬라이드
    acf_add_options_page(array(
      'page_title'    => '메인 슬라이더',
      'menu_title'    => '슬라이더 설정',
      'menu_slug'     => 'main-slider',
      'capibility'    => 'edit_posts',
      'redirect'      => false,
      'post_id'       => 'main_slider',
      'position'      => '9.2',
      'icon_url'      => 'dashicons-screenoptions'
    ));
  }
}
firstrent_add_option_page();

function firstrent_get_active_cars() {
  $post_ids = get_posts(array(
    'numberposts'   => -1,
    'meta_query'    => array(
      'relation'    => 'AND',
      array(
        'key'       => 'car_active',
        'value'     => 'O',
        'compare'   => '='
      )
    ),
    'fields'    => 'ids',
    'post_type' => 'car'
  ));
  $dataset = array(
    35 => array(),
    45 => array(),
    55 => array(),
    65 => array(),
    75 => array(),
    999 => array(),
  );

  for ($i = 0; $i <= count($post_ids); $i++) {
    $pid = $post_ids[$i];
    $rent_price = get_field('car_rent_price', $pid);
    $rent_price = intval(preg_replace("/[^0-9]/", "",$rent_price));
    if (strlen($rent_price) < 2) continue;
    $imageTag = get_the_post_thumbnail($pid, 'car-thumbnail');
    $rent_price = floor($rent_price/10000);
    $data = array(
      'title'   => get_the_title($pid),
      'price'   => $rent_price,
      'imageTag'   => $imageTag,
      'link'    => get_permalink($pid),
      'order'   => intval(get_field('order', $pid)),
    );
    if ($rent_price <= 35) { array_push($dataset[35], $data); }
    else if ($rent_price <= 45) { array_push($dataset[45], $data); }
    else if ($rent_price <= 55) { array_push($dataset[55], $data); }
    else if ($rent_price <= 65) { array_push($dataset[65], $data); }
    else if ($rent_price <= 75) { array_push($dataset[75], $data); }
    else { array_push($dataset[999], $data); }
  }

  // sort by order
  foreach($dataset as $key => $value) {
    usort($dataset[$key], function($a, $b) { return $b['order'] - $a['order']; });
    if (count($dataset[$key]) > 4) {
      $dataset[$key] = array_slice($dataset[$key], 0, 4);
    }
  }

  return $dataset;
}

function firstrent_get_consult_list() {
  $post_ids = get_posts(array(
    'numberposts'   => -1,
    'fields'    => 'ids',
    'post_type' => 'consult'
  ));
  $dataset = array();
  foreach($post_ids as $pid) {
    $data = array(
      'thumbnail_url'     => get_the_post_thumbnail_url($pid, 'box-thumbnail'),
      'name'              => get_field('consult_name', $pid),
      'consult_type'      => (get_field('consult_type', $pid))['label'],
      'date'              => get_the_time('Y-m-d', $pid),
    );
    array_push($dataset, $data);
  }
  return $dataset;
}

/**
 * 상담 tab생성하는 Shortcode입니다
 */
function firstrent_consult_tabs_shortcode() {
  return get_template_part('partials/consult-tabs');
}
add_shortcode('consult_tabs', 'firstrent_consult_tabs_shortcode');

/**
 * 상담문의 Ajax Form 처리입니다.
 */
function firstrent_ajax_form_scripts() {
	$translation_array = array(
    'ajax_url' => admin_url( 'admin-ajax.php' )
  );
  wp_localize_script( 'firstrent-form', 'cpm_object', $translation_array );
}
add_action( 'wp_enqueue_scripts', 'firstrent_ajax_form_scripts' );

/**
 * 간편문의 Form 처리내용입니다
 */
function firstrent_process_ajax_form_consult_simple() {
  global $default_consult_image_id;
  if (!array_key_exists('consult_type', $_POST) || $_POST['consult_type'] !== 'consult_simple') return;
  if (!array_key_exists('nonce', $_POST)) die( 'Security check' );
  if (!wp_verify_nonce($_POST['nonce'], 'consult_simple')) die( 'Security check' );
  
  $name = $_POST['consult_name'];
  $phone_number = $_POST['consult_phone_number'];
  $location = $_POST['consult_location'];
  $estimated_rental_fee = $_POST['consult_estimated_rental_fee'];
  $new_post = array(
    'post_title'      => '간편문의 - ' . $name,
    'post_status'     => 'publish',
    'post_type'       => 'consult'
  );
  $pid = wp_insert_post($new_post);

  // DB에 저장하기
  update_field('consult_name', $name, $pid);
  update_field('consult_phone_number', $phone_number, $pid);
  update_field('consult_type', 'consult_simple', $pid);
  update_field('consult_result', 'registered', $pid);
  update_field('consult_simple_group', array(
    'consult_location'              => $location,
    'consult_estimated_rental_fee'  => $estimated_rental_fee
  ), $pid);
  set_post_thumbnail($pid, $default_consult_image_id); // placeholder image id

  $response = array('status' => 200, 'message' => '문의신청이 완료되었습니다', 'new_post_ID' => $pid);
  header( 'Content-Type: application/json; charset=utf-8' );
  echo json_encode( $response );
  exit; // important
}
add_action( 'wp_ajax_firstrent_process_ajax_form_consult_simple', 'firstrent_process_ajax_form_consult_simple' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_firstrent_process_ajax_form_consult_simple', 'firstrent_process_ajax_form_consult_simple'); //execute when logged out


/**
 * 렌트/리스상담 form 처리 내용입니다
 */
function firstrent_process_ajax_form_consult_rent_lease() {
  global $default_consult_image_id;
  if (!array_key_exists('consult_type', $_POST) || $_POST['consult_type'] !== 'consult_rent_lease') return;
  if (!array_key_exists('nonce', $_POST)) die( 'Security check' );
  if (!wp_verify_nonce($_POST['nonce'], 'consult_rent_lease')) die( 'Security check' );
  
  [
    'carid' => $carid, 'name' => $name, 'phone_number' => $phone_number, 'location' => $location,
    'estimated_rental_fee' => $estimated_rental_fee, 'rental_method' => $rental_method,
    'rental_period' => $rental_period, 'yes_deposit' => $yes_deposit, 'no_deposit' => $no_deposit,
    'include_maintenance_service' => $include_maintenance_service,
    'available_call_time' => $available_call_time, 'message' => $message
  ] = $_POST;

  if (empty($name) || empty($phone_number) || empty($location) || empty($estimated_rental_fee)) {
    $response = array('status' => 201, 'message' => '필수정보가 누락되었습니다', 'new_post_ID' => $pid);
  }

  $new_post = array(
    'post_title'      => '렌탈/리스문의 - ' . $name,
    'post_status'     => 'publish',
    'post_type'       => 'consult'
  );
  $pid = wp_insert_post($new_post);
  update_field('consult_name', $name, $pid);
  update_field('consult_phone_number', $phone_number, $pid);
  update_field('consult_type', 'consult_rent_lease', $pid);
  update_field('consult_result', 'registered', $pid);
  update_field('consult_rent_lease_group', array(
    'consult_location'              => $location,
    'consult_estimated_rental_fee'  => $estimated_rental_fee,
    'consult_rental_method'         => $rental_method,
    'consult_rental_period'         => $rental_period,
    'consult_etc'                   => array($yes_deposit, $no_deposit, $include_maintenance_service),
    'consult_available_call_time'   => $available_call_time,
    'consult_message'               => $message
  ), $pid);

  if (empty($carid)) {
    set_post_thumbnail($pid, $default_consult_image_id); // 4396 => placeholder image id
  } else {
    $tid = get_post_thumbnail_id($carid);
    set_post_thumbnail($pid, $tid);
  }
  
  $response = array('status' => 200, 'result' => 'success', 'message' => '문의신청이 완료되었습니다', 'new_post_ID' => $pid);
  header( 'Content-Type: application/json; charset=utf-8' );
  echo json_encode( $response );
  exit; // important
}
add_action( 'wp_ajax_firstrent_process_ajax_form_consult_rent_lease', 'firstrent_process_ajax_form_consult_rent_lease' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_firstrent_process_ajax_form_consult_rent_lease', 'firstrent_process_ajax_form_consult_rent_lease'); //execute when logged out


/**
 * 전기차상담 form 처리 내용입니다
 */
function firstrent_process_ajax_form_consult_electric() {
  global $default_consult_image_id;
  if (!array_key_exists('consult_type', $_POST) || $_POST['consult_type'] !== 'consult_electric') return;
  if (!array_key_exists('nonce', $_POST)) die( 'Security check' );
  if (!wp_verify_nonce($_POST['nonce'], 'consult_electric')) die( 'Security check' );
  
  [
    'name' => $name, 'phone_number' => $phone_number, 'location' => $location,
    'car_type' => $car_type, 'message' => $message
  ] = $_POST;

  if (empty($name) || empty($phone_number) || empty($location)) {
    $response = array('status' => 201, 'message' => '필수정보가 누락되었습니다', 'new_post_ID' => $pid);
  }

  $new_post = array(
    'post_title'      => '전기차 문의 - ' . $name,
    'post_status'     => 'publish',
    'post_type'       => 'consult'
  );
  $pid = wp_insert_post($new_post);
  update_field('consult_name', $name, $pid);
  update_field('consult_phone_number', $phone_number, $pid);
  update_field('consult_type', 'consult_electric', $pid);
  update_field('consult_result', 'registered', $pid);
  update_field('consult_electric_group', array(
    'consult_location'              => $location,
    'consult_car_type'              => $car_type,
    'consult_message'               => $message
  ), $pid);
  set_post_thumbnail($pid, $default_consult_image_id); // 4396 => placeholder image id
  
  $response = array('status' => 200, 'message' => '문의신청이 완료되었습니다', 'new_post_ID' => $pid);
  header( 'Content-Type: application/json; charset=utf-8' );
  echo json_encode( $response );
  exit; // important
}
add_action( 'wp_ajax_firstrent_process_ajax_form_consult_electric', 'firstrent_process_ajax_form_consult_electric' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_firstrent_process_ajax_form_consult_electric', 'firstrent_process_ajax_form_consult_electric'); //execute when logged out


/**
 * 세무상담 form 처리 내용입니다
 */
function firstrent_process_ajax_form_consult_tax() {
  global $default_consult_image_id;
  if (!array_key_exists('consult_type', $_POST) || $_POST['consult_type'] !== 'consult_tax') return;
  if (!array_key_exists('nonce', $_POST)) die( 'Security check' );
  if (!wp_verify_nonce($_POST['nonce'], 'consult_tax')) die( 'Security check' );
  
  [
    'name' => $name, 'phone_number' => $phone_number,
    'customer_type' => $customer_type, 'message' => $message
  ] = $_POST;

  if (empty($name) || empty($phone_number)) {
    $response = array('status' => 201, 'message' => '필수정보가 누락되었습니다', 'new_post_ID' => $pid);
  }

  $new_post = array(
    'post_title'      => '세무상담 문의 - ' . $name,
    'post_status'     => 'publish',
    'post_type'       => 'consult'
  );
  $pid = wp_insert_post($new_post);
  update_field('consult_name', $name, $pid);
  update_field('consult_phone_number', $phone_number, $pid);
  update_field('consult_type', 'consult_tax', $pid);
  update_field('consult_result', 'registered', $pid);
  update_field('consult_tax_group', array(n,
    'consult_customer_type'         => $customer_type,
    'consult_message'               => $message
  ), $pid);
  set_post_thumbnail($pid, $default_consult_image_id); // 4396 => placeholder image id
  
  $response = array('status' => 200, 'message' => '문의신청이 완료되었습니다', 'new_post_ID' => $pid);
  header( 'Content-Type: application/json; charset=utf-8' );
  echo json_encode( $response );
  exit; // important
}
add_action( 'wp_ajax_firstrent_process_ajax_form_consult_tax', 'firstrent_process_ajax_form_consult_tax' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_firstrent_process_ajax_form_consult_tax', 'firstrent_process_ajax_form_consult_tax'); //execute when logged out


function firstrent_get_car_list($madeIn = 'domestic') {
  $car_list = array(
    'city-car' => array(),
    'subcompact-car' => array(),
    'compact-car' => array(),
    'mid-size-car' => array(),
    'large-size-car' => array(),
    'full-size-luxury-car' => array(),
    'suv' => array(),
    'rv' => array(),
    'van' => array(),
    'sport-car' => array(),
    'electric-car' => array(),
    'lorry-car' => array(),
  );
  $args = array(
    'numberposts'	=> -1,
    'posts_per_page' => -1,
    'post_type'		=> 'car'
  );
  $meta_query = array(
    'relation'    => 'AND',
    array(
      'key'       => 'car_active',
      'value'     => 'O',
      'compare'   => '='
    ),
  );
  if ($madeIn == 'domestic') {
    array_push($meta_query, array(
      'key'       => 'car_made_in',
      'value'     => 'domestic',
      'compare'   => '='
    ));
  }
  else if ($madeIn == 'imported') {
    array_push($meta_query, array(
      'key'       => 'car_made_in',
      'value'     => 'imported',
      'compare'   => '='
    ));
  } elseif ($madeIn == 'all') {
    // active기만 하면 된다.
  }
  $args['meta_query'] = $meta_query;
  $the_query = new WP_Query($args);

  if ( $the_query->have_posts() ):
    while( $the_query->have_posts() ): $the_query->the_post();
      $rental_price = get_field('car_rent_price');
      $lease_price = get_field('car_lease_price');
      // if (!firstrent_is_valid_price($price)) continue;
      $pure_rental_price = intval(preg_replace("/[^0-9]/", "", $rental_price)); // filtering 해야하니까 필요하다
      $id = get_the_ID();
      $title = get_the_title();
      $thumbnail_url = get_the_post_thumbnail_url($id, 'car-thumbnail');

      $brand = get_field('car_brand');
      [
        'car_fuel_efficiency_type' => [
          'label' => $fuel_efficiency_type
        ],
        'car_fuel_efficiency'      => $fuel_efficiency
      ] = get_field('car_fuel_efficiency');
      $fuels = array_filter(get_field('car_fuel_type'), function($val){ return !empty($val); });
      $fuel = implode(', ', array_map(function($val){ return $val['label']; }, $fuels));
      $badges = array_filter(get_field('car_badge'), function($val){ return !empty($val); });
      [
        'value' => $car_type,
      ] = get_field('car_type_by_size');
      
      if (!array_key_exists($car_type, $car_list)) {
        continue;
      }
      array_push($car_list[$car_type], array(
        'carid'                 => $id,
        'thumbnail_url'         => $thumbnail_url,
        'name'                  => $title,
        'brand'                 => $brand,
        'badges'                => $badges,
        'fuel_efficiency_type'  => $fuel_efficiency_type,
        'fuel_efficiency'       => $fuel_efficiency,
        'fuel'                  => $fuel,
        'rental_price'          => $rental_price,
        'lease_price'           => $lease_price,
        'pure_rental_price'     => $pure_rental_price,
        'link'                  => get_post_permalink()
      ));
    endwhile;
  endif;
  wp_reset_postdata();
  return $car_list;
}

function firstrent_is_valid_price($val) {
  $price = intval(preg_replace("/[^0-9]/", "",$val));
  if (strlen($price) < 2) return false;
  return true;
}

/**
 * 모든 차를 필터링과 함께 보여주는 shortcode입니다.
 */
function firstrent_car_list_shortcode($atts) {
  $atts = shortcode_atts(
    array(
        'type' => 'domestic',
    ), $atts, 'type');
  return get_template_part('partials/car-list', null, array('type' => $atts['type']));
}
add_shortcode('car_list', 'firstrent_car_list_shortcode');

/**
 * 특별세일하는 차량만 보여주는 shortcode입니다.
 */
function firstrent_special_sale_car_list_shortcode() {
  return get_template_part('partials/special-sale-car-list');
}
add_shortcode('special_sale_car_list', 'firstrent_special_sale_car_list_shortcode');


/**
 * 빠른출고가 가능한 차량만 보여주는 shortcode입니다.
 */
function firstrent_fast_sell_car_list_shortcode() {
  return get_template_part('partials/fast-sell-car-list');
}
add_shortcode('fast_sell_car_list', 'firstrent_fast_sell_car_list_shortcode');