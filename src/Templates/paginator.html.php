<div>
    <ul class="pagination">        
        <li
        <?php
        if ($paginator->getPreviousPage() == -1)
            echo "class='disabled'"
            ?>
            > 
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
            ?>">&laquo;</a></li>




        <?php
        for ($i = 1; $i <= $paginator->getNumPages(); $i++) :
            ?>

            <li
            <?php
            if ($i == $paginator->getPage())
                echo 'class="active"'
                ?>
                ><a href="<?php
                    echo 'index.php?controller=' . $paginator->getController() .
                    '&action=' . $paginator->getAction() .
                    '&page=' . $i;
                    if ($paginator->getFilters() != null) {
                        foreach ($paginator->getFilters() as $key => $value) {
                            echo '&' . $key . '=' . $value;
                        }
                    }
                    ?>" ><?php echo $i; ?></a></li>



        <?php endfor; ?>

        <li
        <?php
        if ($paginator->getNextPage() == -1)
            echo "class='disabled'"
            ?>
            > 
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
            ?>">&raquo;</a></li>
    </ul>
</div>