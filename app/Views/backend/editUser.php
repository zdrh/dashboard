<?= $this->extend('layout/backend/template'); ?>

<?= $this->section('content'); ?>

<h1>Editovat uživatele</h1>

<?php
$attributes = array(
    'novalidate' => 'novalidate',
    'id' => 'editUser',
    'autocomplete'  => 'on'
);

echo form_open_multipart('admin/user/update/' . $userEdit->id, $attributes);

echo form_hidden('_method', 'put');

?>
<div class="register-box mt-5">


    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Editovat uživatele</p>


            <div class="mb-3">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="" name="username" id="username" autocomplete="on" value="<?= $userEdit->username ?>" disabled>
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
                        <input type="text" class="form-control" placeholder="" name="email" id="email" autocomplete="on" value="<?= $userEdit->email ?>" disabled>
                        <label for="username">Email</label>
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
                        <input type="text" class="form-control" placeholder="" name="first_name" id="first_name" autocomplete="on" value="<?= $userEdit->first_name ?>">
                        <label for="username">Jméno</label>
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
                        <input type="text" class="form-control" placeholder="" name="last_name" id="last_name" autocomplete="on" value="<?= $userEdit->last_name ?>">
                        <label for="username">Příjmení</label>
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
                        <input type="file" class="form-control" placeholder="" name="photo" id="photo" autocomplete="on">
                        <label for="username">Fotografie</label>
                    </div>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa-solid fa-image"></span>
                        </div>
                    </div>
                </div>
                <h4>Dosavadní foto</h4>
                <div>
                    <?php
                    $atributtes = array(
                        'class' => 'profile'
                    );
                    echo img($form->uploadPath . $userEdit->photo, false, $atributtes); ?>
                </div>
            </div>

            <div class="mb-3">

                <div class="form-group">
                    <label>Skupiny</label>
                    <select class="group" name='group[]' multiple="multiple" data-placeholder="Vyber skupinu" style="width: 100%;">
                        <?php
                        echo "<option value=\"\" disabled>---Vyber skupiny---</option>";
                        foreach ($groups as $option) {
                            if ($option->inGroup) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value=\"" . $option->id . "\" " . $selected . ">" . $option->name . "</option>";
                        }
                        ?>
                    </select>

                </div>
            </div>

            <div class="row">
                <!-- /.col -->
               
                    <button type="submit" class="btn btn-primary btn-block">Editovat</button>
                
                <!-- /.col -->
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.group').select2();
    });
</script>





<?= $this->endSection(); ?>