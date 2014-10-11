
<div class="contain">


<?php if (!Input::has('search') or true): ?>

  <div class="before row">


    <?php echo Form::open(array('route' => 'hack.filter', 'class' => '')) ?>

    <div class="form-group">

      <div class="col-md-3"></div>
      <div class="col-md-6"><input type="text" class="form-control" id="InputSearch" name="search" placeholder="Search by country, city, group name, target, date!" value="<?= Input::get('search') ?>"></div>
      <div class="col-md-3">  {{ Form::submit('Search', ['class' => 'btn btn-white', 'style' => 'height: 35px;'] ) }}
      </div>

    </div>

    {{ Form::close() }}
  </div>

<?php else: ?>


<?php endif; ?>


</div>


  <div id="map"></div>


  <!--FANCYBOX JS -->
  <script type="text/javascript">

  $(document).ready(function() {
  	$(".various").fancybox({
  		maxWidth	: 800,
  		maxHeight	: 600,
  		fitToView	: false,
  		width		: '70%',
  		height		: '70%',
  		autoSize	: false,
  		closeClick	: false,
  		openEffect	: 'none',
  		closeEffect	: 'none'
  	});
  });
  </script>

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



                var page = 2;

                setInterval( function() {

                    $.ajax({
                        url: '/',
                        type:'GET',
                        data: "?&page="+page+"&search=<?= Input::get('search', '') ?>",
                        success: function(html) {
                                html.data.forEach(function(entry) {
                                map.addMarker({
                                    lat: entry.lat,
                                    lng: entry.long,
                                    infoWindow: {
                                        content: '<p><h4><a class="various" data-fancybox-type="iframe" href="/resource/'+entry._id+'">'+entry.attack_type+'</a></h4>  Date: '+entry.date.date+'<br> Location: '+entry.city+', '+entry.country+' </p>'
                                    }

                                });
                            });

                            page++;

                        }
                    });

                }, 1000); // 5 Second reload

        }
    );
</script>




