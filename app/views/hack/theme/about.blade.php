<div class="contain">


<?php if (!Input::has('search') or true): ?>




    <?php echo Form::open(array('route' => 'hack.filter', 'class' => '')) ?>



<?php else: ?>


<?php endif; ?>


</div>

</div>