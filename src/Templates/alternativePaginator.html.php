<div>
    <ul class="pager">        
        <li class="previus 
        <?php
        if ($paginator->getPreviousPage() == -1)
            echo "disabled";
        ?>
            "> 
            <a href="<?php
            if ($paginator->getPreviousPage() == -1) {
                echo '#';
            } else {
                echo 'index.php?controller=' . $paginator->getController() .
                '&action=' . $paginator->getAction() .
                '&page=' . $paginator->getPreviousPage();
                if ($paginator->getFilters() != null) {
                    foreach ($paginator->getFilters() as $key => $value) {
                        echo '&' . $key . '=' . $value;
                    }
                }
            }
            ?>">&larr;Entradas recientes</a></li>





        <li class="next 
        <?php
        if ($paginator->getNextPage() == -1)
            echo "disabled"
            ?>
            "> 
            <a href="<?php
            if ($paginator->getNextPage() == -1) {
                echo '#';
            } else {
                echo 'index.php?controller=' . $paginator->getController() .
                '&action=' . $paginator->getAction() .
                '&page=' . $paginator->getNextPage();
                if ($paginator->getFilters() != null) {
                    foreach ($paginator->getFilters() as $key => $value) {
                        echo '&' . $key . '=' . $value;
                    }
                }
            }
            ?>">Entradas anteriores&rarr;</a></li>
    </ul>
</div>