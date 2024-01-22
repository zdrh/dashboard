<?php

echo $this->extend('layout/frontend/template');

echo $this->section('content');

echo form_open('login-complete');
?>
<div class="login-box mt-5">

    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Přihlásit se</p>
            <?php
            if (isset($error)) {
                $attributes = array(
                    'type' => 'danger',
                    'message' => $error,
                    'id' => 'login'
                );
                echo view_cell('AlertCell', $attributes);
            }
            ?>

            <?= form_open('login-complete'); ?>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Uživatelské jméno" name="username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Heslo" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Přihlásit</button>
                </div>
                <!-- /.col -->
            </div>
            </form>



            <div class="col-4">
                <p class="mb-0">
                    <?php
                    $props = array(
                        'class' => 'text-center'
                    );
                    echo anchor('register', "Registrovat", $props);
                    ?>
                </p>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<?php
echo form_close();

echo $this->endSection();
