<?php

echo $this->extend('layout/backend/template');

echo $this->section('content');

?>
<h1>Seznam rout a skupin</h1>

<?php
$table = new \CodeIgniter\View\Table();

$table->setHeading('id', 'Routa', 'Controller/metoda',"Skupiny", "");
foreach ($routes as $row) {
    
    $groups = "";
    foreach ($row as $group){
        $groups .= "<span class=\"badge bg-primary rounded-pill\">".$group->name."</span>";
    }
    $edit = anchor('admin/route/edit/'.$row[0]->route_id2, $form->editButton);
    $delete =  $form->deleteButtonStart."data-bs-target=\"#modal".$row[0]->route_id2.$form->deleteButtonEnd;
    $table->addRow($row[0]->route_id2, $row[0]->route_id2,$row[0]->controller,"", $edit.$delete);
}

$template = array(
    'table_open' => '<table class="table table-bordered">',
    'thead_open' => '<thead>',
    'thead_close' => '</thead>',
    'heading_row_start' => '<tr>',
    'heading_row_end' => ' </tr>',
    'heading_cell_start' => '<th>',
    'heading_cell_end' => '</th>',
    'tbody_open' => '<tbody>',
    'tbody_close' => '</tbody>',
    'row_start' => '<tr>',
    'row_end'  => '</tr>',
    'cell_start' => '<td>',
    'cell_end' => '</td>',
    'row_alt_start' => '<tr>',
    'row_alt_end' => '</tr>',
    'cell_alt_start' => '<td>',
    'cell_alt_end' => '</td>',
    'table_close' => '</table>'
);

$table->setTemplate($template);

echo $table->generate();

//modaly

foreach ($routes as $row) {
    ?>
<div class="modal" id="modal<?= $row[0]->route_id2?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Smazat routu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><b>Následující routa bude smazána z databáze:</b></p>
        <p><b>ID: </b><?=$row[0]->route_id2 ?></p>
        <p><b>Routa: </b><?=$row[0]->route ?></p>
        <p><b>Controller/metoda: </b><?= $row[0]->controller ?></p>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Zrušit</button>
        <?php
        
        echo form_open('admin/route/remove/'.$row[0]->route_id2);
        $data = array (
          '_method' => 'delete'
        );
        echo form_hidden($data);
        ?><button type="submit" class="btn btn-danger">Smazat routu</button></form>
      </div>
    </div>
  </div>
</div>


<?php
}

echo $this->endSection();