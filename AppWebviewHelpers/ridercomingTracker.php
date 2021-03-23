<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title></title>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvmnX-bdX1rJUTT0nfReXew2d96MWplnU"></script>
        
        <style>
            #mapCanvas{
    width: 100%;
    height: 400px;
}

html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}
.container, .container > div, .container > div #mapCanvas {
    height: inherit;
}
        </style>

    </head>
    
    
<body>
    <div class="container">
      <div>        
        
        <div id="mapCanvas"></div>

<script>

function initialize() {
    
    var myLatLng = new google.maps.LatLng( 7.572620, 5.405000 ),
        myOptions = {
            zoom: 16,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
            },
        map = new google.maps.Map( document.getElementById( 'mapCanvas' ), myOptions ),
        marker = new google.maps.Marker( {position: myLatLng, map: map} );
    
    marker.setMap( map );
    moveMarker( map, marker );
    
}

function moveMarker( map, marker ) {
    
    //delayed so you can see it move
    setTimeout( function(){ 
    
        marker.setPosition( new google.maps.LatLng( 7.572620,  5.405000 ) );
        map.panTo( new google.maps.LatLng( 6.493110, 3.384160 ) );
        
    }, 4000 );

};

initialize();


</script>
 


        
        </div>
        </div>
        
    </body>
</html>