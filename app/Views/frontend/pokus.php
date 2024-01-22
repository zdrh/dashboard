<?php

echo $this->extend('layout/frontend/template');

echo $this->section('content');

$data = array(
    'class' => 'row g-3 form',
    'novalidate' => 'novalidate'
);
echo form_open('pokus-complete', $data);
?>

  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
    <div class="valid-feedback">
      Looks good!
    </div>

    <div class="invalid-feedback">
      Špatné údaje
    </div>
    <div class="invalid-feedback">
      Špatné údaje2
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Last name</label>
    <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationCustom03" class="form-label">City</label>
    <input type="text" class="form-control" id="validationCustom03" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom04" class="form-label">State</label>
    <select class="form-select" id="validationCustom04" required>
      <option selected disabled value="">Choose...</option>
      <option>...</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid state.
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom05" class="form-label">Zip</label>
    <input type="text" class="form-control" id="validationCustom05" required>
    <div class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>

<script type="text/javascript">
  var form = document.querySelector('[form]');
  var v = new vanillaValidation(form, {
    customRules: {
      valueIs: function (inputValue, ruleValue) {
        return inputValue === ruleValue;
      },
    },
    rules: {
      firstfield: {
        minlength: 2,
        required: true
      },
      cpf: {
        cpf: true,
        required: true
      },
      test: {
        valueIs: 'customRuleTest'
      }
    },
    messages: {
      firstfield: {
        minlength: 'This input should have at least 2 characters.',
        required: 'Input value required!'
      },
      test: {
        valueIs: 'The field value must be "customRuleTest".'
      }
    }
  });

</script>

<?php
echo form_close();

echo $this->endSection();
