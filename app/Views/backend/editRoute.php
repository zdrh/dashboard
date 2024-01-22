<?= $this->extend('layout/backend/template'); ?>

<?= $this->section('content'); ?>

<h1>Editovat routu</h1>

<?php
$attributes = array(
    'novalidate' => 'novalidate',
    'id' => 'editRoute',
    'autocomplete'  => 'on'
);

echo form_open('admin/route/update/' . $routeEdit->route_id2, $attributes);

echo form_hidden('_method', 'put');

?>
<div class="register-box mt-5">


    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Editovat routu</p>


            <div class="mb-3">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="" name="route" id="route" autocomplete="on" value="<?= $routeEdit->route ?>" disabled>
                        <label for="username">Routa</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="" name="controller" id="controller" autocomplete="on" value="<?= $routeEdit->controller ?>" disabled>
                        <label for="username">Controller/metoda</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="" name="description" id="description" autocomplete="on" value="<?= $routeEdit->description ?>">
                        <label for="username">Popis</label>
                    </div>
                   
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