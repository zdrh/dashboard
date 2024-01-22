<?php



echo $this->extend('layout/backend/template');

echo $this->section('content');
?>
<h1>Seznam uživatelů</h1>
<?php


$table = new \CodeIgniter\View\Table();
var_dump($users);
$table->setHeading('id', 'Uživatelské jméno', 'Email', 'Jméno', 'Přijmení', 'Registrace', 'Skupiny', "");
foreach ($users as $row) {
    $datum = date('j.n.Y h:m:s', $row[0]->created_on);
    $groups = "";
    foreach ($row as $group){
        $groups .= "<span class=\"badge bg-primary rounded-pill\">".$group->name."</span>";
    }
    $edit = anchor('admin/user/edit/'.$row[0]->user_id, $form->editButton);
    $delete =  $form->deleteButtonStart."data-bs-target=\"#modal".$row[0]->user_id.$form->deleteButtonEnd;
    $table->addRow($row[0]->user_id, $row[0]->username, $row[0]->email, $row[0]->first_name, $row[0]->last_name, $datum, $groups, $edit.$delete);
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

foreach ($users as $row) {
    ?>
<div class="modal" id="modal<?= $row[0]->user_id?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Smazat uživatele</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><b>Následující uživatel bude smazán:</b></p>
        <p><b>ID: </b><?=$row[0]->user_id ?></p>
        <p><b>Jméno: </b><?=$row[0]->first_name." ".$row[0]->last_name ?></p>
        <p><b>Email: </b><?= $row[0]->email ?></p>
        <p><b>Uživatelské jméno: </b><?= $row[0]->username ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Zrušit</button>
        <?php
        echo form_open('admin/user/remove/'.$row[0]->user_id);
        $data = array (
          '_method' => 'delete'
        );
        echo form_hidden($data);
        ?><button type="submit" class="btn btn-danger">Smazat uživatele</button></form>
      </div>
    </div>
  </div>
</div>

<?php
}

echo $this->endSection();
