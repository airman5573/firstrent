function validatePhoneNumber(phoneNumber) {
  var patternPhone = /01[016789]-[0-9]{4}-[0-9]{4}/;
  if (!patternPhone.test(phoneNumber)) return false;
  return true;
}

function clearForm($form) {
  $form.find('select').each(function() {
    jQuery(this).prop('selectedIndex', 0).trigger("change");
  });
  $form.find('textarea').each(function() {
    return jQuery(this).val('');
  });

  $form.find('input:not([type=hidden])').each(function() {
    switch (this.type) {
      case 'password': return jQuery(this).val('');
      case 'text': return jQuery(this).val('');
      case 'radio':
        this.checked = false;
        return;
      case 'checkbox':
        this.checked = false;
        return;
    }
  });
}

function post(path, params, method='post') {
  // The rest of this code assumes you are not using a library.
  // It can be made less verbose if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.style.display = 'none';
  form.submit();
}