<?php

echo $this->extend('layout/frontend/template');

echo $this->section('content');

?>

<h1>Zapomenuté heslo</h1>
<p>Pokud byl zadaný email <?=$email; ?> v naší databázi, tak na něj byl odeslán odkaz pro reset hesla.</p>

<?=$this->endSection();
