<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

    <ul class="navbar-nav">


        <?php
        foreach ($menu as $item) {
            echo '<li class="nav-item d-none d-sm-inline-block">';
            $props = array(
                "class" => "nav-link"
            );
            echo anchor($item->link, $item->name, $props);
            echo "</li>";
        }
        ?>

    </ul>
    <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
           <?php
            $imgProps = array(
                "class" => "rounded-circle img-fluid profile",
                "alt" =>  $user->first_name . " " . $user->last_name
            );
            echo img($form->uploadPath . $user->photo, false, $imgProps)
           ?>
        </li>
        <li class="nav-item dropdown">
            <?php
            $props = array(
                "class" => "nav-link dropdown-toggle",
                "role"  => "button",
                "data-bs-toggle" => "Dropdown"

                
            );
           
            //echo anchor('#',$user->first_name . " " . $user->last_name, $props);

            ?>
            <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"><?=$user->first_name . " " . $user->last_name; ?></a>
            <ul class="dropdown-menu">
                <li>
                    <?php
                    $dropProp1 = array(
                        'class' => 'dropdown-item'
                    );
                    echo anchor('admin/profile/edit', 'Upravit profil', $dropProp1);
                    ?>
                </li>
                <li>
                    <?php

                    echo anchor('admin/logout', 'Odhlásit', $dropProp1);
                    ?>
                </li>
            </ul>


    </ul>

</nav>