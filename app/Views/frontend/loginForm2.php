<?php

echo $this->extend('layout/frontend/template');

echo $this->section('content');


?>
<div class="mx-auto">
    <div class="login-box mt-5">

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h4 class="text-center">Přihlásit se</h4>
                <?php

                if ($message != "") {
                    echo "<div class=\"alert alert-" . $type . "\">" . $message . "</div>";
                }
                ?>


            </div>
            <?= form_open('login-complete'); ?>
            <div class="input-group mb-3">
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
            <div class="input-group mb-3">
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
            <div class="input-group mb-3">
                <div class="d-flex p-3">
                    <?php
                    $props = array(
                        'class' => 'text-center'
                    );
                    echo anchor('register2', "Registrovat", $props);
                    ?>
                </div>
                <div class="d-flex ms-auto p-3">
                    <?php
                    $props = array(
                        'class' => 'text-center'
                    );
                    echo anchor('forgotten-password', "Zapomenuté heslo", $props);
                    ?>
                </div>
            </div>

            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary btn-block">Přihlásit</button>
            </div>


            </form>



            <div class="col-4">
                <p class="mb-0">

                </p>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</div>
<?php
echo form_close();

echo $this->endSection();
