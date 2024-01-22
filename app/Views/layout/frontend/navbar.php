<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <ul class="navbar-nav">

      <?php
      foreach ($menu as $item) {
        $props = array(
          'class' => "nav-link"
        );
        echo '<li class="nav-item">';
        echo anchor($item->link, $item->name, $props);
        echo "</li>";
      }

      ?>

    </ul>

    <ul class="d-flex navbar-nav ms-auto">
      <li class="nav-item"><?= anchor('login', 'Přihlásit', $props) ?></li>
      <li class="nav-item"><?= anchor('login2', 'Přihlásit2', $props) ?></li>
      <li class="nav-item"><?= anchor('register', 'Registrovat', $props) ?></li>
      <li class="nav-item"><?= anchor('register2', 'Registrovat2', $props) ?></li>
    </ul>
  </div>
</nav>