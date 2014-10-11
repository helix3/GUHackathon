    <!DOCTYPE html>
       <html lang="en">
         <head>
           <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1">

           <!-- Add jQuery library -->
           <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

           <!-- Add mousewheel plugin (this is optional) -->
           <script type="text/javascript" src="/assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

           <!-- Add fancyBox -->
           <link rel="stylesheet" href="/assets/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
           <script type="text/javascript" src="/assets/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

           <!-- Optionally add helpers - button, thumbnail and/or media -->
           <link rel="stylesheet" href="/assets/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
           <script type="text/javascript" src="/assets/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
           <script type="text/javascript" src="/assets/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

           <link rel="stylesheet" href="/assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
           <script type="text/javascript" src="/assets/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

           <title>World Terrorism Database</title>

           <!-- Bootstrap core CSS -->
           <link href="/assets/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">

           <!-- Custom styles for this template -->
           <link href="/assets/css/justified-nav.css" rel="stylesheet">

           <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
           <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
             <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
           <![endif]-->

            <link rel="stylesheet" href="/assets/flexslider/flexslider.css" type="text/css" media="screen" />
         </head>

         <body>

                 <div class="row">

                       <div class="col-md-10">



                                 <div class=" contain" style="margin: 0 auto;
                                                                      display: block;
                                                                      position: relative;
                                                                      ">
                                                                      <div class="thumbnail">
                                 <table class="table table-hover">
                                          <thead>
                                            <tr>
                                               <th>Date</th>
                                               <th>Location</th>
                                               <th>Attack type</th>
                                               <th>Target</th>
                                               <th>Terrorist organization</th>
                                               <th>Motive</th>
                                               <th>Weapon</th>
                                               <th>Property damage</th>
                                               <th>Notes</th>

                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                        <td><?= $data->date['date'] ?></td>
                                                        <td><?= $data->city.', '.$data->country ?></td>
                                                        <td><?= $data->attack_type ?></td>
                                                        <td><?= $data->target_type ?></td>
                                                        <td><?= $data->group ?></td>
                                                        <td><?= $data->motive ?></td>
                                                        <td><?= $data->weapons ?></td>
                                                        <td><?= $data->cost ? $data->cost : 'Unknown' ?></td>
                                                        <td><?= $data->notes ?></td>


                                                     </tr>


                                          </tbody>


                                          </table>


                                          <div class="flexslider">
                                            <ul class="slides">
                                              <li>
                                                <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                              </li>
                                              <li>
                                                <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                              </li>
                                              <li>
                                                <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg"/>
                                              </li>
                                              <li>
                                                <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                              </li>

                                              <li>
                                                    <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                                  </li>
                                                  <li>
                                                    <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                                  </li>
                                                  <li>
                                                    <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg"/>
                                                  </li>
                                                  <li>
                                                    <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                                  </li>

                                                  <li>
                                                        <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                                      </li>
                                                      <li>
                                                        <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                                      </li>
                                                      <li>
                                                        <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg"/>
                                                      </li>
                                                      <li>
                                                        <img src="/assets/flexslider/demo/images/kitchen_adventurer_caramel.jpg" />
                                                      </li>


                                            </ul>
                                          </div>


                            <form method="get" action="http://www.google.com/search">
                            <div style="border:1px solid black;padding:4px;width:20em;">
                             <table border="0" cellpadding="0"> <tr><td>
                              <input type="text" name="q" size="25" maxlength="255" value="" />
                              <input type="submit" value="Google Search" /></td></tr>
                              </table> </div> </form>



                                 </div>

                             </div>






                    </div>




                    <a href="/" class="btn btn-lg btn-primary text-center contain" style="bottom: 0; position: absolute; left: 18%"> Home</a>

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
                        lat: <?= $data->lat ?>,
                        lng: <?= $data->long ?>,
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

                    map.addMarker({
                        lat: <?= $data->lat ?>,
                        lng: <?= $data->long ?>,
                        infoWindow: {
                            content: '<p><h4><a  href="/resource/'+entry._id+'">'+entry.attack_type+'</a></h4>  Date: '+entry.date.date+'<br> Location: '+entry.city+', '+entry.country+' </p>'
                        }
                    });

                }
            );
        </script>




<!-- FlexSlider -->
  <script defer src="/assets/flexslider/jquery.flexslider.js"></script>

<script type="text/javascript">
$(function(){
SyntaxHighlighter.all();
});
$(window).load(function(){
$('.flexslider').flexslider({


animation: "slide",
animationLoop: true,
itemWidth: 150,
itemMargin: 20,
pausePlay: false,
controlNav: false,
start: function(slider){
$('body').removeClass('loading');
}
});
});
</script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>

    </body>
    </html>