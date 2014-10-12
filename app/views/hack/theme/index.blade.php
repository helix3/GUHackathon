
<div class="contain">


<?php if (!Input::has('search') or true): ?>

  <div class="before row">


    <?php echo Form::open(array('route' => 'hack.filter', 'class' => '')) ?>

    <div class="form-group">

      <div class="col-md-2"></div>
      <div class="col-md-6"><input type="text" class="form-control" id="InputSearch" name="search" placeholder="Search by location, terrorist group, target, date, etc, etc..." value="<?= Input::get('search') ?>"></div>
      <div class="col-md-3">  {{ Form::submit('Search', ['class' => 'btn btn-warning', 'style' => 'height: 35px;'] ) }}
      </div>

    </div>

    {{ Form::close() }}
  </div>

<?php else: ?>


<?php endif; ?>


</div>




