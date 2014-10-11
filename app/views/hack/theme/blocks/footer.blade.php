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

                    }, 10000); // 5 Second reload

            }
        );
    </script>
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


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

    </body>
    </html>