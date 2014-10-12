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



                    var page = 1;

                    setInterval( function() {

                        //if (page < 300) {
                            $.ajax({
                                url: '/?search=<?= Input::get('search', 'a') ?>?&page='+page,
                                type:'GET',
                                success: function(html) {

                                console.log(html);

                                        html.forEach(function(entry) {


                                        entry = entry._source;
                                        console.log(entry);

                                        var color = '';
                                        switch(entry.attack_type_id) {
                                            case '1':
                                                color = 'ff0000';
                                                break;
                                            case '2':
                                                color = '83b81a';
                                                break;
                                            case '3':
                                                color = 'ea4c89';
                                                break;
                                            case '4':
                                                color = 'a58559';
                                                break;
                                            case '5':
                                                color = 'eeeeee';
                                                break;
                                            case '6':
                                                color = '15495d';
                                                break;
                                            case '7':
                                                color = '00ee88';
                                                break;
                                            case '8':
                                                color = 'f57d00';
                                                break;
                                            case '9':
                                                color = 'b6bf00';
                                                break;
                                            case '10':
                                                color = '007bc1';
                                                break;
                                            default:
                                                color = '81017e';
                                        }

                                            var d = new Date(entry.date.date);
                                            var curr_date = d.getDate();
                                            var curr_month = d.getMonth() + 1; //Months are zero based
                                            var curr_year = d.getFullYear();

                                        map.addMarker({
                                            lat: entry.lat,
                                            lng: entry.long,
                                            icon: 'http://www.googlemapsmarkers.com/v1/'+color,
                                            animation: google.maps.Animation.DROP,
                                            infoWindow: {
                                                content: '<p><h4><a  href="/resource/'+entry._id+'">'+entry.attack_type+'</a></h4>  Date: '+curr_date + "-" + curr_month + "-" + curr_year+'<br> Location: '+entry.city+', '+entry.country+' </p>'
                                            }

                                        });
                                    });

                                    page++;

                                }
                            });
                        //}

                    }, 1000); // 5 Second reload

            }
        );
    </script>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

    </body>
    </html>