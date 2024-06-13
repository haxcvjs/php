<?php return function($data) { 

            foreach ($data as $key => $value) {
                $$key = $value;
            }
            ?> 
            <?= view('Dashboard.layouts.header') ?>

fgfgfg

<h3>Body</h3>
<ul>
    <?php foreach($users as $user): ?>
    <div>Name: <?=  $user['name']  ?></div>
    <?php endforeach ?>
</ul>




<?= view('Dashboard.layouts.footer') ?>
            
             <?php } ?>
            