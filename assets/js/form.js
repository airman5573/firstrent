jQuery(document).ready(function(){

let acfMap = {
  rentalMethod: {
    'long': '장기렌트',
    'lease': '리스',
    'compare': '렌트/리스 비교'
  },
  estimatedRentalFee: {
    'm35': '35만원 미만',
    'm45': '35만원 ~ 45만원 미만',
    'm55': '45만원 ~ 55만원 미만',
    'm65': '55만원 ~ 65만원 미만',
    'm75': '65만원 ~ 75만원 미만',
    'm999': '75만원 이상'
  },
  rentalPeriod: {
    'm36': '36개월',
    'm48': '48개월',
    'm60': '60개월'
  },
  deposit: {
    'yes_deposit': '보증금 유',
    'no_deposit': '보증금 무'
  },
  include_maintenance_service: '정비서비스 포함(추가비용 발생)',
  customerType: {
    'private': '개인사업자',
    'company': '법인사업자'
  }
};

// 이용약관 Modal
(function($){
  let modalBtn = $('.open-modal');
  if (modalBtn.length == 0) return;
  modalBtn.on('click', () => {
    $('#ppa-modal').modal({ fadeDuration: 100 });
  });
})(jQuery);

// 전체적으로 핸드폰 번호의 양식을 강제합니다
(function($){
  $(document).on("keyup", ".phone-number", function(){
    $(this).val($(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/,"$1-$2-$3").replace("--", "-"));
    let val = $(this).val();
    if (!validatePhoneNumber(val)) {
      this.setCustomValidity('invalid');
    } else {
      this.setCustomValidity('');
    }
  });
})(jQuery);

// form validation with bootstrap5
(function($){
  var forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false)
    });
})(jQuery);

// Ajax Simple Consult Form
(function($){
  let $form = $('.consult-simple-form');
  if ($form.length.length == 0) return;

  let $name = $('.consult-simple-form form input[name="consult_name"]');
  let $phoneNumber = $('.consult-simple-form form input[name="consult_phone_number"]');
  let $location = $('.consult-simple-form form select[name="consult_location"]');
  let $estimatedRentalFee = $('.consult-simple-form form select[name="consult_estimated_rental_fee"]');
  let $ppaCheckbox = $('.consult-simple-form form #privacy-policy-agreement-check');
  $('.consult-simple-form form').on('submit', (e) => {
    e.preventDefault();
    let action = $('.consult-simple-form form input[name="action"]').val();
    let name = $name.val();
    let phoneNumber = $phoneNumber.val();
    let location = $location.val();
    let estimatedRentalFee = $estimatedRentalFee.val();
    let nonce = $('.consult-simple-form form input[name="_wpnonce"]').val();

    if (name.length < 1) {
      alert("성함을 입력해주세요");
      $name.focus();
      return;
    }

    if (phoneNumber.length < 1) {
      alert("전화번호를 입력해주세요");
      $phoneNumber.focus();
      return;
    }

    if (!validatePhoneNumber(phoneNumber)) {
      alert("전화번호를 다시 확인해주세요");
      $phoneNumber[0].setCustomValidity('invalid');
      $phoneNumber.focus();
      return;
    }
    // simple form엔 필요하다
    if (!$ppaCheckbox.is(':checked')) { 
      alert("개인정보제공 이용약관 동의가 필요합니다");
      return;
     }

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: cpm_object.ajax_url,
      data: {
        nonce, action,
        consult_type: 'consult_simple',
        consult_name: name,
        consult_phone_number: phoneNumber,
        consult_location: location,
        consult_estimated_rental_fee: estimatedRentalFee
      },
      success: function(response) {
        $name.val('');
        $phoneNumber.val('');
        $location.prop('selectedIndex', 0);
        $estimatedRentalFee.prop('selectedIndex', 0);
        setTimeout(function() {
          // Mail & SMS보내기
          let path = '/contact-simple.php';
          post(path, {
            t1: name,
            t2: phoneNumber,
            t3: location,
            t4: estimatedRentalFee
          });
        }, 500);
      },
      error: function(response) {
        console.log("error");
        console.log(response.responseText);
      }
    });
  });
})(jQuery);

// consult tabs
(function($){
  let $consultTabs = $('.consult-tabs');
  if ($consultTabs.length < 1) return;
  $tabLinks = $('.consult-tabs .tab-links li');
  $tabContents = $('.consult-tabs .tab-content');
  $tabLinks.on('click', function(){
    let $li = $(this);
    $tabLinks.removeClass('active');
    $tabContents.removeClass('active');
    $li.addClass('active');
    let link = $li.attr('id');
    $(`.consult-tabs [data-link="${link}"]`).addClass('active');
  });

  // 링크로 넘어왔을때 active시켜줌
  let tabLink = window.location.hash;
  if (tabLink.length < 3) {
    tabLink = '#tab-link-rent'; // default
  }
  $('.consult-tabs .tab-links ' + tabLink).click();

  // 통화가능 시간에서 '기타'를 선택하면, 직접 입력하는 Field가 나온다
  $('.tab-content.rent form #consult-available-call-time').change(function() {
    let self = $(this);
    let val = self.val();
    let input = $('.tab-content.rent form input[name="consult_available_call_time"]');
    if (val != 'other') input.val(val);
    else {
      input.val('');
      $('.tab-content.rent form .consult-available-call-time-etc').removeClass('d-none');
      self.addClass('d-none');
    }
  });

  // Processing form data - rent
  $rentForm = $('.tab-content.rent form');
  $rentForm.on('submit', function(e) {
    e.preventDefault();
    if (!this.checkValidity()) {
      e.stopPropagation();
      return;
    }
    var result = {
      nonce: $('.tab-content.rent form #_wpnonce').val(),
      action: $('.tab-content.rent form input[name="action"]').val(),
      carid: $('.tab-content.rent form input[name="carid"]').val(),
      consult_type: $('.tab-content.rent form input[name="consult_type"]').val(),
      name: $('.tab-content.rent form input[name="consult_name"]').val(),
      phone_number: $('.tab-content.rent form input[name="consult_phone_number"]').val(),
      location: $('.tab-content.rent form select[name="consult_location"]').val(),
      estimated_rental_fee: $('.tab-content.rent form select[name="consult_estimated_rental_fee"]').val(),
      rental_method: $('.tab-content.rent form input[name="consult_rental_method"]:checked').val(),
      rental_period: $('.tab-content.rent form input[name="consult_rental_period"]:checked').val(),
      yes_deposit: $('.tab-content.rent form input[name="consult_etc_yes_deposit"]:checked').val(),
      no_deposit: $('.tab-content.rent form input[name="consult_etc_no_deposit"]:checked').val(),
      include_maintenance_service: $('.tab-content.rent form input[name="consult_etc_include_maintenance_service"]:checked').val(),
      available_call_time: $('.tab-content.rent form input[name="consult_available_call_time"]').val(),
      message: $('.tab-content.rent form textarea[name="consult_message"]').val()
    };

    let estimatedRentalFee = acfMap.estimatedRentalFee[result.estimated_rental_fee];

    let rentalMethod = '';
    if (result.rental_method) rentalMethod = acfMap.rentalMethod[result.rental_method];

    let rentalPeriod = '';
    if (result.rental_period) rentalPeriod = acfMap.rentalPeriod[result.rental_period];
    console.log("result", result);

    let deposit = '';
    if (result.yes_deposit == 'yes_deposit') deposit = '보증금 유';
    else if (result.no_deposit == 'no_deposit') deposit = '보즘금 무';

    let include_maintenance_service = '';
    if (result.include_maintenance_service == 'include_maintenance_service') {
      include_maintenance_service = '정비서비스 포함';
    }

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: cpm_object.ajax_url,
      data: result,
      success: function(response) {
        console.log("success");
        clearForm($rentForm);
        $rentForm.removeClass('was-validated');
        let path = '/contact-rent.php';
        post(path, {
          c1: result.name,
          c2: result.phone_number,
          c4: result.location,
          c5: estimatedRentalFee,
          c13: rentalMethod,
          c6: rentalPeriod,
          c7: deposit,
          c8: include_maintenance_service,
          c9: result.available_call_time,
          c10: result.message
        });
      },
      error: function(response) {
        console.log("error");
        console.log(response.responseText);
      }
    });
  });

  // Processing form data - electric
  $electricForm = $('.tab-content.electric form');
  $electricForm.on('submit', function(e) {
    e.preventDefault();
    if (!this.checkValidity()) {
      e.stopPropagation();
      return;
    }
    var result = {
      nonce: $('.tab-content.electric form #_wpnonce').val(),
      action: $('.tab-content.electric form input[name="action"]').val(),
      consult_type: $('.tab-content.electric form input[name="consult_type"]').val(),
      name: $('.tab-content.electric form input[name="consult_name"]').val(),
      phone_number: $('.tab-content.electric form input[name="consult_phone_number"]').val(),
      location: $('.tab-content.electric form select[name="consult_location"]').val(),
      car_type: $('.tab-content.electric form input[name="consult_car_type"]').val(),
      message: $('.tab-content.electric form textarea[name="consult_message"]').val()
    };

    if (!validatePhoneNumber(result.phone_number)) {
      $phoneNumber = $('.tab-content.electric form input[name="consult_phone_number"]');
      $phoneNumber[0].setCustomValidity('invalid');
      $phoneNumber.focus();
      return;
    }

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: cpm_object.ajax_url,
      data: result,
      success: function(response) {
        console.log("success");
        clearForm($electricForm);
        $electricForm.removeClass('was-validated');
        let path = '/contact-electric.php';
        post(path, {
          b1: result.name,
          b2: result.phone_number,
          b4: result.location,
          b5: result.car_type,
          b10: result.message
        });
      },
      error: function(response) {
        console.log("error");
        console.log(response.responseText);
      }
    });
  });

  // Processing form data - tax
  $taxForm = $('.tab-content.tax form');
  $taxForm.on('submit', function(e) {
    e.preventDefault();
    if (!this.checkValidity()) {
      e.stopPropagation();
      return;
    }
    var result = {
      nonce: $('.tab-content.tax form #_wpnonce').val(),
      action: $('.tab-content.tax form input[name="action"]').val(),
      consult_type: $('.tab-content.tax form input[name="consult_type"]').val(),
      name: $('.tab-content.tax form input[name="consult_name"]').val(),
      phone_number: $('.tab-content.tax form input[name="consult_phone_number"]').val(),
      customer_type: $('.tab-content.tax form input[name="consult_customer_type"]:checked').val(),
      message: $('.tab-content.tax form textarea[name="consult_message"]').val()
    };

    let customerType = '';
    if (result.customer_type) customerType = acfMap[result.customer_type];

    if (!validatePhoneNumber(result.phone_number)) {
      $phoneNumber = $('.tab-content.tax form input[name="consult_phone_number"]');
      $phoneNumber[0].setCustomValidity('invalid');
      $phoneNumber.focus();
      return;
    }

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: cpm_object.ajax_url,
      data: result,
      success: function(response) {
        console.log("success");
        clearForm($taxForm);
        $taxForm.removeClass('was-validated');
        let path = '/contact-tax.php';
        post(path, {
          a1: result.name,
          a2: result.phone_number,
          a4: customerType,
          a5: result.message
        });
      },
      error: function(response) {
        console.log("error");
        console.log(response.responseText);
      }
    });
  });

  
})(jQuery);

});