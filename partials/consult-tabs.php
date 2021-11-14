<div class="consult-tabs">
  <div class="inner">
    <ul class="tab-links">
      <li id="tab-link-rent" class="tab-link rent">렌트/리스</li>
      <li id="tab-link-electric" class="tab-link electric">전기차 문의</li>
      <li id="tab-link-tax" class="tab-link tax">세무상담</li>
    </ul>
    <div class="tab-contents">
      <div class="tab-content rent" data-link="tab-link-rent">
        <div class="title">
          <h2 class="title__main">
            <div>저희가 <span class="highlight--orange">가장 합리적인 선택</span>을</div>
            <div>도와드리겠습니다.</div>
          </h2>
          <h6 class="title__sub">디테일한 컨설팅을 통해 내게 맞는 조건을 확인하세요.</h6>
        </div>
        <form class="needs-validation" novalidate action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post"><?php
          wp_nonce_field( 'consult_rent_lease' ); ?>
          <input type="hidden" name="carid" value="<?php echo isset($_GET['carid']) ? $_GET['carid'] : ''; ?>">
          <input type="hidden" name="action" value="firstrent_process_ajax_form_consult_rent_lease" />
          <input type="hidden" name="consult_type" value="consult_rent_lease" />
          <div class="mb-3">
            <label for="consult_name" class="label-highlight">* 이름 (필수)</label>
            <input id="consult-name" type="text" class="form-control" name="consult_name" placeholder="이름을 입력해주세요" required/>
            <div class="invalid-feedback">이름을 입력해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-phone-number" class="label-highlight">* 전화번호 (필수)</label>
            <input id="consult-phone-number" type="text" class="form-control phone-number" name="consult_phone_number" placeholder="전화번호를 입력해주세요" required/>
            <div class="invalid-feedback">올바른 전화번호를 입력해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-location">지역</label>
            <select id="consult-location" class="form-select" name="consult_location">
              <option selected disabled value="">지역을 선택해주세요</option>
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
            <div class="invalid-feedback">지역을 선택해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-estimated-rental-fee">예상렌트료</label>
            <select id="consult-estimated-rental-fee" class="form-select" name="consult_estimated_rental_fee">
              <option selected disabled value="">예상렌트료를 선택해주세요</option>
              <option value="m35">35만원 미만</option>
              <option value="m45">35만원 ~ 45만원</option>
              <option value="m55">45만원 ~ 55만원</option>
              <option value="m65">55만원 ~ 65만원</option>
              <option value="m75">65만원 ~ 75만원</option>
              <option value="m999">75만원 이상</option>
            </select>
            <div class="invalid-feedback">예상렌트료를 선택해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-rental-method">대여방식</label>
            <div class="radio-buttons">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_rental_method" id="method-long" value="long">
                <label class="form-check-label" for="method-long">장기렌트</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_rental_method" id="method-lease" value="lease">
                <label class="form-check-label" for="method-lease">리스</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_rental_method" id="method-compare" value="compare">
                <label class="form-check-label" for="method-compare">렌트/리스 비교</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="consult-rental-method">대여기간</label>
            <div class="radio-buttons">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_rental_period" id="period-m36" value="m36">
                <label class="form-check-label" for="period-m36">36개월</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_rental_period" id="period-m48" value="m48">
                <label class="form-check-label" for="period-m48">48개월</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_rental_period" id="period-m60" value="m60">
                <label class="form-check-label" for="period-m60">60개월</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="consult-etc">기타</label>
            <div class="radio-buttons">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="consult_etc_yes_deposit" id="etc-yes-deposit" value="yes_deposit">
				  <label class="form-check-label" for="etc-yes-deposit">초기비용 유</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="consult_etc_no_deposit" id="etc-no-deposit" value="no_deposit">
				  <label class="form-check-label" for="etc-no-deposit">초기비용 무</label></input>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="consult_etc_include_maintenance_service" id="etc-include-maintenance-service" value="include_maintenance_service">
                <label class="form-check-label" for="etc-include-maintenance-service">정비서비스 포함(추가비용 발생)</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="consult-available-call-time">통화가능시간</label>
            <select id="consult-available-call-time" class="form-select"">
              <option selected disabled value="">통화가능한 시간을 선택해주세요</option>
              <option value="오전 10시 ~ 12시">오전 10시 ~ 12시</option>
              <option value="오후 12시 ~ 2시">오후 12시 ~ 2시</option>
              <option value="오후 2시 ~ 4시">오후 2시 ~ 4시</option>
              <option value="오후 4시 ~ 6시">오후 4시 ~ 6시</option>
              <option value="오후 6시 ~ 7시">오후 6시 ~ 7시</option>
              <option value="other">기타(입력가능)</option>
            </select>
            <div class="consult-available-call-time-etc d-none">
              <input class="form-control" type="text" name="consult_available_call_time" placeholder="통화가능한 시간을 입력해주세요">
            </div>
          </div>
          <div class="mb-3">
            <label>남기실 말씀</label>
            <textarea name="consult_message" class="form-control" rows="3"><?php echo isset($_GET['memo']) ? $_GET['memo'] : ''; ?></textarea>
          </div>
          <div class="mb-4">
            <div class="form-check privacy-policy-agreement">
              <div class="left me-2">
                <input class="form-check-input" type="checkbox" value="" id="rent-privacy-policy-agreement-check" checked required>
                <label class="form-check-label" for="rent-privacy-policy-agreement-check">개인정보 수집·이용 및 제3자 제공 동의</label>
                <div class="invalid-feedback">개인정보 수집/이용 동의가 필요합니다</div>
              </div>
              <div class="right">
                <button type="button" class="btn open-modal">내용보기</a>
              </div>
            </div>
          </div>
          <button class="btn btn-primary">지금 바로 문의하기</button>
        </form>
      </div>
      <div class="tab-content electric" data-link="tab-link-electric">
        <div class="title">
          <h2 class="title__main">
            <div><span class="highlight--orange">이제는 전기차 시대!</span></div>
            <div>대세에 맞는 트렌드리더가 되어보세요.!</div>
          </h2>
          <h6 class="title__sub">
            다양한 전기차를 전문상담을 통해,<br>합리적인 조건으로 운용하실 수 있도록 꼼꼼히 따져 드리겠습니다.
          </h6>
        </div>
        <form class="needs-validation" novalidate action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post"><?php
          wp_nonce_field( 'consult_electric' ); ?>
          <input type="hidden" name="action" value="firstrent_process_ajax_form_consult_electric" />
          <input type="hidden" name="consult_type" value="consult_electric" />
          <div class="mb-3">
            <label for="consult_name" class="label-highlight">* 이름 (필수)</label>
            <input id="consult-name" type="text" class="form-control" name="consult_name" placeholder="이름을 입력해주세요" required/>
            <div class="invalid-feedback">이름을 입력해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-phone-number" class="label-highlight">* 전화번호 (필수)</label>
            <input id="consult-phone-number" type="text" class="form-control phone-number" name="consult_phone_number" placeholder="전화번호를 입력해주세요" required/>
            <div class="invalid-feedback">올바른 전화번호를 입력해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-location">* 지역</label>
            <select id="consult-location" class="form-select" name="consult_location">
              <option selected disabled value="">지역을 선택해주세요</option>
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
            <div class="invalid-feedback">지역을 선택해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult_car_type">차종</label>
            <input id="consult-car-type" type="text" class="form-control" name="consult_car_type" placeholder="차종을 입력해주세요" />
          </div>
          <div class="mb-3">
            <label>남기실 말씀</label>
            <textarea name="consult_message" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
            <div class="form-check privacy-policy-agreement">
              <div class="left me-2">
                <input class="form-check-input" type="checkbox" value="" id="electric-privacy-policy-agreement-check" checked required>
                <label class="form-check-label" for="electric-privacy-policy-agreement-check">개인정보 수집·이용 및 제3자 제공 동의</label>
                <div class="invalid-feedback">개인정보 수집/이용 동의가 필요합니다</div>
              </div>
              <div class="right">
                <button type="button" class="btn open-modal">내용보기</a>
              </div>
            </div>
          </div>
          <button class="btn btn-primary">지금 바로 문의하기</button>
        </form>
      </div>
      <div class="tab-content tax" data-link="tab-link-tax">
        <div class="title">
          <h2 class="title__main">
            <div>장기렌트 이용 시,</div>
            <div><span class="highlight--orange">내게 유리한게 무엇일까?</span></div>
            <div><span class="highlight--orange">세제혜택이 궁금하시다구요?</span></div>
          </h2>
          <h6 class="title__sub">개인/법인 사업자 고객님들께, 1:1 맞춤 전문 세무상담 서비스를 제공합니다.</h6>
        </div>
        <form class="needs-validation" novalidate action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post"><?php
          wp_nonce_field( 'consult_tax' ); ?>
          <input type="hidden" name="action" value="firstrent_process_ajax_form_consult_tax" />
          <input type="hidden" name="consult_type" value="consult_tax" />
          <div class="mb-3">
            <label for="consult_name" class="label-highlight">* 이름 (필수)</label>
            <input id="consult-name" type="text" class="form-control" name="consult_name" placeholder="이름을 입력해주세요" required/>
            <div class="invalid-feedback">이름을 입력해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-phone-number" class="label-highlight">* 전화번호 (필수)</label>
            <input id="consult-phone-number" type="text" class="form-control phone-number" name="consult_phone_number" placeholder="전화번호를 입력해주세요" required/>
            <div class="invalid-feedback">올바른 전화번호를 입력해주세요</div>
          </div>
          <div class="mb-3">
            <label for="consult-customer-type">고객구분</label>
            <div class="radio-buttons">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_customer_type" id="customer-private" value="private">
                <label class="form-check-label" for="customer-private">개인사업자</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="consult_customer_type" id="customer-company" value="company">
                <label class="form-check-label" for="customer-company">법인사업자</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label>남기실 말씀</label>
            <textarea name="consult_message" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
            <div class="form-check privacy-policy-agreement">
              <div class="left me-2">
                <input class="form-check-input" type="checkbox" value="" id="tax-privacy-policy-agreement-check" checked required>
                <label class="form-check-label" for="tax-privacy-policy-agreement-check">개인정보 수집·이용 및 제3자 제공 동의</label>
                <div class="invalid-feedback">개인정보 수집/이용 동의가 필요합니다</div>
              </div>
              <div class="right">
                <button type="button" class="btn open-modal">내용보기</a>
              </div>
            </div>
          </div>
          <button class="btn btn-primary">지금 바로 문의하기</button>
        </form>
      </div>
    </div>
  </div>
</div>