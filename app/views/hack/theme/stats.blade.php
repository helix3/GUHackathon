
<div class="contain">


<?php if (!Input::has('search') or true): ?>

  <div class="before row">


    <?php echo Form::open(array('route' => 'hack.filter', 'class' => '')) ?>

    <div class="form-group">

      <div class="col-md-2"></div>
      <div class="col-md-8">

        <div class="thumbnail" style="opacity:0.8;">
        <h5>
            Terorism acts since 1970 till now: <?= \Hack\SasList::count() ?>
        </h5>

        <h5>
            Total Data Size: 91871600 B
        </h5>

        <h5>
            Armed Assault: 8952
        </h5>

        <h5>
            Bombing/Explosion Attacks: 45558
        </h5>

        <h5>
            Assasination Attacks: 13258
        </h5>

        <h5>
            Hijacking Attacks: 7506
        </h5>

        <h5>
            Other Attacks: ...
        </h5>


      </div>
      <div class="col-md-2"> </div>

    </div>

    {{ Form::close() }}
  </div>

<?php else: ?>


<?php endif; ?>


</div>

</div>


