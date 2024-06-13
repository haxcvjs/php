<?php

return function ($var) {

    foreach ($var as $key => $value) {
        $$key = $value;
    }
?><?= view('Dashboard.layouts.header') ?>



<h3>Body</h3>
<ul>
    <?php foreach($users as $user): ?>
    <div>Name: <?=  $user['name']  ?></div>
    <?php endforeach ?>
</ul>


<?= view('Dashboard.layouts.footer') ?><?php
}
?>