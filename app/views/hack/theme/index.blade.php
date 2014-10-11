
<div class="contain">


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


<?php endif; ?>


</div>


  <div id="map"></div>

    <!--Google maps-->

    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="/assets/js/gmaps.js"></script>
<script type="text/javascript">
    //Initialize Clinics Map
    $(document).ready( function()
        {
            var map;

            map = new GMaps({
                el: '#map',
                lat: 51.469948,
                lng: 0.0525667,
                zoom: 4,
                zoomControl : true,
                zoomControlOpt: {
                    style : 'SMALL',
                    position: 'TOP_LEFT'
                },
                panControl : false,
                streetViewControl : false,
                mapTypeControl: false,
                overviewMapControl: false
            });
            <?php foreach ($data as $key => $value) { ?>

                <?php if($value->lat > 0.00000000): ?>
                    map.addMarker({
                        lat: <?= $value->lat ?>,
                        lng: <?= $value->long ?>,
                        infoWindow: {
                            content: '<p><h4><a href="#"><?= addslashes($value->attack_type) ?></a></h4>  Date: <?= $value->date['date'] ?><br> Location: <?= addslashes($value->city) ?>, <?= addslashes($value->country) ?> </p>'
                        }
                    });
                <?php endif ?>

            <?php } ?>


                var page = 2;

                setInterval( function() {

                    $.ajax({
                        url: '/',
                        type:'GET',
                        data: "&page=" +page,
                        success: function(html) {

                        html.data.forEach(function(entry) {
                        map.addMarker({
                            lat: entry.lat,
                            lng: entry.long,
                            infoWindow: {
                                content: '<p><h4><a href="#">'+entry.attack_type+'</a></h4>  Date: '+entry.date.date+'<br> Location: '+entry.city+', '+entry.country+' </p>'
                            }
                        });
                        console.log(entry);
                        });

                        page++;

                        }
                    });

                }, 100); // 5 Second reload

        }
    );


</script>

    <script src="/assets/js/main.js"></script>



