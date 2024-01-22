<?php

echo $this->extend('layout/frontend/template');

echo $this->section('content');

$attributes = array(
    'novalidate' => 'novalidate',
    'id' => 'register'
);
echo form_open('register-complete', $attributes);
?>

<div class="register-box mt-5 offset">


    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrovat</p>


            <div class="form-wrapper mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Uživatelské jméno" name="username" id="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-wrapper mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Jméno" name="name" id="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-wrapper mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Příjmení" name="surname" id="surname">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-wrapper mb-3">
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-wrapper mb-3">
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="Heslo" name="password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-wrapper mb-3">
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="Heslo podruhé" name="confirm" id="confirm">
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
                $(element).addClass("is-invalid").removeClass("is-valid");
                $(".error").addClass("text-danger");
            },
            unhighlight: function(element) {
                $(element).addClass("is-valid").removeClass("is-invalid");
                $(".error").addClass("text-success");
            }
        });

        $("#register").validate({
            rules: {
                username: {
                    required: true,
                    remote:  {
                        url: "register-validate",
                        method:"post"
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
           /* messages: {
                name: "Please enter your firstname",
                surname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    remote: "Username must be unique"

                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least <?= $minPasswordLength; ?> characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least <?= $minPasswordLength; ?> characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",

            },*/
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().parent());
            },
            errorElement: "div",
        })
    });
</script>

<?php
echo $this->endSection();
