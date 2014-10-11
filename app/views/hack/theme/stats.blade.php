
<div class="contain">


<?php if (!Input::has('search') or true): ?>

  <div class="before row">


    <?php echo Form::open(array('route' => 'hack.filter', 'class' => '')) ?>

    <div class="form-group">

      <div class="col-md-2"></div>
      <div class="col-md-8">

        <div class="panel roundy">
        <h3>
            Terorism acts since 1970 till now: <?= \Hack\SasList::count() ?>
        </h3>

        <h3>
            Total Data Size: 91871600 B
        </h3>

        <h3>
            Bombing/Explosion Attacks: <?= \Hack\SasList::where('attack_type_id', '=', '0'x)->count() ?>
        </h3>

        </div>


      </div>
      <div class="col-md-2"> </div>

    </div>

    {{ Form::close() }}
  </div>

<?php else: ?>


<?php endif; ?>


</div>



