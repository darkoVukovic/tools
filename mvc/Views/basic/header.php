<header class="<?php echo (isset($links)) ? 'headerWlinks' : 'headerNLinks' ;?>">
    <h1><?= $title ?></h1>
    <ul>
        <?php 
        
        if(isset($links)) {
            foreach($links as $link) {
                ?>
                    <li><a href="<?= $link['href']?>"><?= $link['name'] ?></a></li>
                <?php
            }
 
        }
        ?>
    </ul>
</header>