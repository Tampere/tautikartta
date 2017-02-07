<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tautikartta</title>

        <!-- Styles -->
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>

    <div id="app" class="columns">
        <div id="map" class="column is-three-quarters"></div>

        <div id="info" class="column">
            <p><img src="{{asset('images/tampere.jpg')}}" alt="Tampere"><br><b>Tautikartta</b><br></p>
            <a href="http://inter16.tampere.fi/terveystutka/" target="_blank">
                <img id="terveystutkalogo" src="images/terveystutka.png" alt="Terveystutka"><br>
                Terveystutkasta voit etsiä sinua kiinnostavia terveyttä edistäviä palveluja Tampereella.
            </a>
            <div id="list"></div>
        </div>
    </div>

        <script src="js/polygons.js"></script>
        <script src="js/app.js"></script>
        <script src="js/map.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMIU-6eqyhh0yH9OO77qiWSdsokw8DGEc&callback=initMap" async defer></script>
    </body>
</html>
