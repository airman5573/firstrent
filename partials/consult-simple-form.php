<div class="consult-simple-form">
  <div class="consult-simple-form__title">
    빠른 상담신청
    <span><i class="fas fa-circle"></i> 실시간 상담가능</span>
  </div>
  <div class="consult-simple-form__content">
    <form class="needs-validation" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" novalidate><?php
      wp_nonce_field( 'consult_simple' ); ?>
      <input type="hidden" name="action" value="firstrent_process_ajax_form_consult_simple" />
      <input type="hidden" name="consult_type" value="consult_simple" />
      <div>
        <input type="text" class="form-control" name="consult_name" placeholder="이름을 입력하세요" required/>
      </div>
      <div>
        <input type="tel" class="form-control phone-number" name="consult_phone_number" placeholder="전화번호를 입력하세요" required/>
      </div>
      <div>
        <select class="form-select" name="consult_location">
          <option>지역 선택하세요</option>
          <option value="서울">서울</option>
          <option value="경기">경기</option>
          <option value="인천">인천</option>
          <option value="강원">강원</option>
          <option value="충북">충북</option>
          <option value="충남">충남</option>
          <option value="대전">대전</option>
          <option value="경북">경북</option>
          <option value="경남">경남</option>
          <option value="대구">대구</option>
          <option value="전북">전북</option>
          <option value="전남">전남</option>
          <option value="광주">광주</option>
          <option value="울산">울산</option>
          <option value="부산">부산</option>
          <option value="제주">제주</option>
        </select>
      </div>
      <div>
        <select class="form-select" name="consult_estimated_rental_fee">
          <option>예상렌트료 선택하세요</option>
          <option value="m35">35만원 미만</option>
          <option value="m45">35만원 ~ 45만원</option>
          <option value="m55">45만원 ~ 55만원</option>
          <option value="m65">55만원 ~ 65만원</option>
          <option value="m75">65만원 ~ 75만원</option>
          <option value="m999">75만원 이상</option>
        </select>
      </div>
      <div>
        <div class="form-check privacy-policy-agreement">
          <div class="left">
            <input class="form-check-input" type="checkbox" value="" id="privacy-policy-agreement-check" checked required>
            <label class="form-check-label" for="privacy-policy-agreement-check">개인정보 수집/이용 동의</label>
          </div>
          <div class="right">
            <button type="button" class="btn open-modal">내용보기</a>
          </div>
        </div>
      </div>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">상담신청</button>
      </div>
    </form>
  </div>
</div>