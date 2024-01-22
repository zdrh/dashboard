<?php

echo $this->extend('layout/frontend/template');

echo $this->section('content');


?>
<div class="login-box mt-5">

    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <h4 class="text-center">Zapomenuté heslo</h4>
            <?php

            if ($message != "") {
                echo "<div class=\"alert alert-" . $type . "\">" . $message . "</div>";
            }
            ?>


        </div>
        <?php
        $attributes = array(
            'novalidate' => 'novalidate',
            'id' => 'forgottenPassword',
            'autocomplete'  => 'on'
        ); 
        echo form_open('forgotten-password-complete', $attributes); ?>
        <div class="input-group mb-3">
            <div class="form-floating">
                <input type="email" class="form-control" placeholder="" name="email" id="email" autocomplete="on">
                <label for="email">Email zadaný při registraci</label>

            </div>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary btn-block">Odeslat</button>
        </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).addClass("is-invalid").removeClass("is-valid");
                $(".error").addClass("text-danger d-block");
            },
            unhighlight: function(element) {
                $(element).addClass("is-valid").removeClass("is-invalid");
                $(".error").addClass("text-success d-block");
            }
        });

        $("#forgottenPassword").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                }

            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().parent().parent());
            },
            errorElement: "div",
        })
    });
</script>

<?php
echo form_close();

echo $this->endSection();
