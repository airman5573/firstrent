jQuery(document).ready(function(){

// contact-bar vertical slide
(function($){
  let $newsTickers = $('.news-ticker ul');
  if ( $newsTickers.length < 1 ) return;
  let slider = ($newsTicker, itemHeight) => {
    setTimeout(() => {
      let firstChild = $($newsTicker.children[0]);
      firstChild.animate({
        marginTop: -1 * itemHeight
      }, 'slow', () => {
        firstChild.appendTo(firstChild.parent()).css({ marginTop: 0 });
        slider($newsTicker, itemHeight);
      });
    }, 3600);
  }
  let commonHeight = $newsTickers[0].children[0].clientHeight;
  if (commonHeight == 0) {
    commonHeight = $newsTickers[1].children[0].clientHeight;
  }
  slider($newsTickers[0], commonHeight);
  slider($newsTickers[1], commonHeight);
})(jQuery);

// car tab with price filter
(function($){
  let $carPriceTab = $('.car-price-tab');
  if ($carPriceTab.length < 1) return;
  let $filterItems = $('.car-price-tab .filter li');
  let $tabs = $('.car-price-tab .tab');
  if ($tabs.length < 1) return;

  var isMouseEntered = false;
  $('.car-price-tab__content').mouseenter(function () { 
    isMouseEntered = true;
  }).mouseleave(() => { isMouseEntered = false; });

  let slider = (interval) => {
    // 마우스가 먼저 올라와 있는지 체크하자
    if (isMouseEntered) {
      return setTimeout(() => { slider(interval); }, interval);
    }

    let $nextFilterItem = $('.car-price-tab .filter .on').next();
    let $nextTab = $('.car-price-tab .tabs .on').next();
    if ($nextFilterItem.length < 1 || $nextTab.length < 1) {
      $nextFilterItem = $('.car-price-tab .filter li:first');
      $nextTab = $('.car-price-tab .tabs .tab:first');
    }
    $filterItems.removeClass('on');
    $tabs.removeClass('on');
    $nextFilterItem.addClass('on');
    $nextTab.addClass('on');
    return setTimeout(() => { slider(interval); }, interval);
  };
  slider(4000);

  $filterItems.on('click', function(){
    let $li = $(this);
    $filterItems.removeClass('on');
    $('.car-price-tab .tab').removeClass('on');
    $li.addClass('on');
    let tabid = $li.data('tabid');
    $(`.car-price-tab [data-tabid="${tabid}"]`).addClass('on');
  });
})(jQuery);

// drape open / close
(function($){
  let $drapeContainer = $('.drape-container');
  if ($drapeContainer.length < 1) return;
  let $drape = $('.drape-container > .drape');
  let $btn = $('.drape-container .handle__btn');
  let close = () => {
    $drape.slideUp('slow', () => { $drapeContainer.removeClass('open'); });
  }
  let open = () => {
    $drape.slideDown('slow', () => { $drapeContainer.addClass('open'); });
  }
  $btn.on('click', () => {
    // 열려있는 상태에서 닫으려고 할때
    if (!$drapeContainer.hasClass('open')) open();
    // 닫혀있는 상태에서 열으려고 할때
    else close();
  });
})(jQuery);

// Main Slider Swiper
(function($){
  let swiper = new Swiper('.main-slider', {
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets'
    }
  });
})(jQuery);

// consult vertical slider
(function($){
  let $consultSlider = $('.consult-slider__list');
  if ( $consultSlider.length < 1 || $consultSlider[0].children.length < 6 ) return;
  let slider = ($slider, itemHeight) => {
    setTimeout(() => {
      let $firstChild = $($slider.children[0]);
      $firstChild.animate({
        marginTop: -1 * itemHeight
      }, 'slow', () => {
        $firstChild.appendTo($firstChild.parent()).css({ marginTop: 0 });
        slider($slider, itemHeight);
      });
    }, 3600);
  }
  let height = $consultSlider[0].children[0].clientHeight;
  $consultSlider.css('max-height', (height + 1) * 5); // 1px은 border 두깨
  slider($consultSlider[0], height);
})(jQuery);

// brand/price filtering
(function($){
  if ($('.car-list').length < 1) return;

  $cars = document.querySelectorAll('.car-list-item');
  let [_from, _to] = [-1, 99999999]; // 첨엔 광범위하게~
  let brand = ''; // '' = all을 의미한다

  let filter = ($cars, brand, _from, _to) => {
    for(let i = 0; i < $cars.length; i++) {
      $cars[i].style.display = 'none'; // 기본은 안보이게
      let b = $cars[i].getAttribute('data-brand');
      let p = $cars[i].getAttribute('data-price');
      let dFlex = false;
      if ( (brand == '' || brand == b) && ((_from < p) && (p <= _to)) ) {
        dFlex = true;
      }

      // 수입차의 '기타' 분류를 눌렀을때
      if (brand == '기타') {
        // 메뉴에 있는 브랜드들이 아닌 다른 브랜드인 경우에
        // 보이도록 한다.
        let importedBrands = ['벤츠', 'BMW', '아우디', '폭스바겐', '볼보', '재규어', '랜드로버', '렉서스', '링컨', '테슬라'];
        if ( !importedBrands.includes(b) ) dFlex = true;
      }
      // 수입차의 모두보기를 눌렀을때
      if (brand == 'all') dFlex = true;
      if (dFlex) $cars[i].style.display = 'block';
    }
  }

  $brandFilterItems = $('.filter-brand li');
  if ($brandFilterItems.length < 1) return; // filter가 없을 수 이음
  $brandFilterItems.on('click', function(){
    let self = $(this);
    if (self.hasClass('active')) {
      brand = '';
      self.removeClass('active');
    } else {
      $brandFilterItems.removeClass('active');
      self.addClass('active');
      brand = self.attr('data-brand'); // brand update
    }
    filter($cars, brand, _from, _to);
  });

  $priceFilterItems = $('.filter-price li');
  if ($priceFilterItems.length < 1) return;
  $priceFilterItems.on('click', function(){
    let self = $(this);
    if (self.hasClass('active')) {
      _from = 0;
      _to = 99999999;
      self.removeClass('active');
    } else {
      $priceFilterItems.removeClass('active');
      self.addClass('active');
      let price = self.attr('data-price');
      let [a, b] = price.split('_');
      // price range update
      _from = parseInt(a);
      _to = parseInt(b);
    }
    filter($cars, brand, _from, _to);
  });

})(jQuery);

// 출고후기 gallery masonry layout
(function($){
  if ($('#my-macy-container').length < 1) return;
  let macy = Macy({
    container: '#my-macy-container',
    trueOrder: true,
    waitForImages: false,
    margin: 24,
    columns: 4,
    breakAt: {
        1200: 4,
        992: 3,
        768: 3,
        576: 2
    }
  });
})(jQuery);

// 카카오톡 상담 박스 스크롤 따라 내려오도록
(function($){
  var scrollTimer;
  const $link = $('.kakao-desktop');
  const $window = $(window);
  const initialLinkTop = parseInt(($link.css('top')).replace(/\D/g, "")); 
  $window.scroll(function(){
    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(function(){
      let windowScrollTop = $window.scrollTop();
      $link.animate({
        top: (initialLinkTop + windowScrollTop) + 'px'
      }, 'slow');
    }, 100);
  });
})(jQuery);
});