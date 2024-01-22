<?php

echo $this->extend('layout/frontend/template');

echo $this->section('content');

$attributes = array(
    'novalidate' => 'novalidate',
    'id' => 'register',
    'autocomplete'  => 'on'
);
echo form_open('register-complete', $attributes);
?>

<div class="register-box mt-5">


    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrovat</p>


            <div class="mb-3">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="" name="username" id="username" autocomplete="on">
                        <label for="username">Uživatelské jméno</label>
                    </div>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
                <div class="form-floating">
                    <input type="text" class="form-control" placeholder="" name="name" id="name" autocomplete="on">
                    <label for="name">Jméno</label>

                </div>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
                <div class="form-floating">
                    <input type="text" class="form-control" placeholder="" name="surname" id="surname" autocomplete="on">
                    <label for="surname">Příjmení</label>

                </div>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
                <div class="form-floating">
                    <input type="email" class="form-control" placeholder="" name="email" id="email" autocomplete="on">
                    <label for="email">Email</label>
                </div>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
                <div class="form-floating">
                    <input type="password" class="form-control" placeholder="" name="password" id="password">
                    <label for="password">Heslo</label>
                </div>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            </div>

            <div class="mb-3">
            <div class="input-group">
                <div class="form-floating">
                    <input type="password" class="form-control" placeholder="" name="confirm" id="confirm">
                    <label for="confirm">Heslo</label>
                </div>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-block">Registrovat</button>
                </div>
                <!-- /.col -->
            </div>
            </form>

            <div class="col-5">
                <?php
                $props = array(
                    'class' => 'text-center'
                );

                echo anchor('login', 'Už mám účet', $props);
                ?>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
<?php
echo form_close();

?>
<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).parent().parent().addClass("is-invalid").removeClass("is-valid");
                $(".error").addClass("text-danger d-block");
            },
            unhighlight: function(element) {
                $(element).parent().parent().addClass("is-valid").removeClass("is-invalid");
                $(".error").addClass("text-success d-block");
            }
        });

        $("#register").validate({
            rules: {
                username: {
                    required: true,
                    remote: {
                        url: "register-username",
                        method: "post"
                    }

                },
                name: "required",
                surname: "required",

                password: {
                    required: true,
                    minlength: <?= $minPasswordLength; ?>
                },
                confirm: {
                    required: true,
                    minlength: <?= $minPasswordLength; ?>,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "register-email",
                        method: "post"
                    }
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
echo $this->endSection();
