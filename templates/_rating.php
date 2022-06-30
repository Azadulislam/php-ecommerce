<span class="text-warning">
    <?php
        for($i=0; $i < round($avg) ; $i++){
            echo '<i class="fas fa-star text-warning"></i>';
        }
        $emp = 5 - round($avg);
        for($i2=0; $i2 < $emp ; $i2++){
            echo '<i class="far fa-star text-warning"></i>';
        }
    ?>
</span>