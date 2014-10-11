

<?php if (!Input::has('search')): ?>
  <div class="before row">


  <?php echo Form::open(array('route' => 'hack.filter', 'class' => '')) ?>

    <div class="form-group">

      <div class="col-md-3"></div>
      <div class="col-md-6"><input type="text" class="form-control" id="InputSearch" name="search" placeholder="Search here!"></div>
      <div class="col-md-3">  {{ Form::submit('Search', ['class' => 'btn btn-white', 'style' => 'height: 35px;'] ) }}
</div>

    </div>

  {{ Form::close() }}


  </div>

<?php else: ?>

//map here

<?php endif; ?>

</div> <!--end of row -->


</div>