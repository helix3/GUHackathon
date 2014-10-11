

<?php if (!Input::has('search')): ?>
  <div class="before row">


  <?php echo Form::open(array('route' => 'hack.filter', 'class' => '')) ?>

    <div class="form-group">

      <div class="col-md-3"></div>
      <div class="col-md-6"><input type="text" class="form-control" id="InputSearch" name="search" placeholder="Search here!"></div>
      <div class="col-md-3">  {{ Form::submit('Search', ['class' => 'btn btn-white', 'style' => 'height: 35px;'] ) }}
</div>

    </div>
      </div>
    </div> <!--end of row -->

  {{ Form::close() }}




<?php else: ?>
// map here!!!

<div class="before row">
<div class="col-md-2"></div>
<div class="col-md-8"> <script type="text/javascript">
                        new GMaps({
                        div: '#map',
                        lat: -12.043333,
                        lng: -77.028333
                        });
                        </script>
                      </div>
<div class="col-md-2"></div>


</div>


</div>
<?php endif; ?>


