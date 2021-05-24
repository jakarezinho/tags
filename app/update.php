<?php
require_once('../vendor/autoload.php');


use App\classes\Controller;

$test = new Controller();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $tag = $test->tag($_GET['id']);

} else {
    echo "ops";
    die();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <!-- Load Leaflet from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js" integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ==" crossorigin=""></script>

    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css" integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js" integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA==" crossorigin=""></script>
    <!--styles-->

    <style>
        :root {
            --blanc: #FFF;
            --noir: #000;
            --shadow: #2e2d2d;
            --shadow_map: text-shadow: 1px 1px 0 var(--shadow), 1px 2px 0 var(--shadow), 3px 3px 0 var(--shadow), -1px -1px 0 var(--shadow), 1px -1px 0 var(--shadow), -1px 1px 0 var(--shadow), 0 1px 0 var(--shadow);
        }

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;

        }

        #map {

            width: 100vw;
            height: 600px;
            z-index: 0;
        }

        .content {
            display: flex;
            padding-top: 20px;


        }

        .item {
            width: 600px;

            margin: 0px 15px 0px 15px;
        }

        .item input[type=text],
        input[type=number],
        textarea,
        button {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: solid 1px var(--shadow);
            outline: none;

        }

        .item button {
            background-color: var(--noir);
            color: var(--blanc);
            border: none;
            outline: none;
        }

        .item p {
            padding: 0px 0px 10px 0px;
        }

        .iconimg {

            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            list-style-type: none;

        }

        .iconimg li {
            padding: 10px;
            margin: 3px;
            text-align: center;
            background-color: #ccc;

        }
    </style>

</head>

<body>
    <h1> Update tags</h1>
    <hr>
    <div class="content">
        <div id="map"></div>
        <div class="item">
            <h2>Infos</h2>
            <?php $ic = $tag['icon'];
            $icon = '<img src="images/' . $ic . '.gif">';
            $ic ? $icon : $icon = '' ?>

            <p> <label for="tag">Tag:</label><input type="text" id="tag" placeholder="tag" value="<?= $tag['tag']; ?>" /></p>
            <p> <label for="lat">Latitude:</label> <input type="text" id="lat" placeholder="latitude" value="<?= $tag['lat']; ?>" /></p>
            <p><label for="lat">longitude:</label><input type="text" id="lng" placeholder="longitude" value="<?= $tag['lng']; ?>" /></p>
            <p> <label for="lat">Adress:</label><input type="text" id="adress" placeholder="morada" value="<?= $tag['adress']; ?>" /></p>

            <?= $icon; ?>
            <p> <label for="icon">icon:</label><input type="text" id="icon" placeholder="icon" value="<?= $tag['icon']; ?>" /></p>
            <p> <label for="color">Color:</label><input type="color" id="color" placeholder="color" value="<?= $tag['color']; ?>" /> <?= $tag['color']; ?></p>
            <label for="infos">infos:</label><textarea id="info" placeholder="info"><?= $tag['info']; ?></textarea>
            <p><label for="size">Size</label><input type="number" id="size" min="12" max="40" step="1" value="<?= $tag['size']; ?>"></p>
            <input type="hidden" id="time" placeholder="time" value="<?= $tag['time']; ?>" />
            <input type="hidden" id="id" value="<?= $_GET['id']; ?>">
            <button id="envia" class="enable "> ENVIAR</button>
            <p id="response"></p>


        </div>


    </div>

    <ul id='icongif' class="iconimg"></ul>


    <script>
        let id = document.getElementById('id')
        let tag = document.getElementById('tag')
        let lat = document.getElementById('lat')
        let lng = document.getElementById('lng')


        let adress = document.getElementById('adress')
        let icon = document.getElementById('icon')
        let color = document.getElementById('color')
        let info = document.getElementById('info')
        let latlng = [lat.value, lng.value]
        let response = document.getElementById('response')
        let icongif = document.getElementById('icongif')

        ////map
        let map = L.map('map').setView(latlng, 15);
        //// Geo code/////
        var gcs = L.esri.Geocoding.geocodeService();

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            minZoom: 11,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYXVyYmFubyIsImEiOiJja215cm8xYzIwNHp1Mnh0M2QwZ3puZmkwIn0.ig4jIr-gZzUfuIX8YZB0ug'
        }).addTo(map);

        ////add marker///
        let marker = L.marker(latlng, {
            draggable: true,
        }).addTo(map);
        //// gewt lat lang marker e adress ///
        marker.on('dragend', (e) => {

            lat.value = marker.getLatLng().lat
            lng.value = marker.getLatLng().lng
            gcs.reverse().latlng([marker.getLatLng().lat, marker.getLatLng().lng]).run((err, res) => {
                if (err) return;
                adress.value = res.address.ShortLabel
                console.log(res.address.ShortLabel)
            })
        })

        ////update click 

        envia.addEventListener('click', () => {

            updatepost(id)

        })

        ///////UPDATE Function /////

        function updatepost(id) {
            let data = new URLSearchParams();
            data.append("tag", tag.value);
            data.append("latitude", lat.value);
            data.append("longitude", lng.value);
            data.append("adress", adress.value);
            data.append("size", size.value);
            data.append("icon", icon.value);
            data.append("color", color.value);
            data.append("info", info.value);
            data.append("id", id.value);

            //  fetch
            fetch("data.php", {
                    method: 'PUT',
                    body: data
                })
                .then(function(response) {
                    return response.text();
                })
                .then(function(text) {
                    console.log(text)
                    response.innerHTML = 'tag actualizado com sucesso'

                    // location.reload()


                })
                .catch(function(error) {
                    console.log(error)
                    response.innerHTML = 'OPS'

                });

            // (C) PREVENT HTML FORM SUBMIT
            return false;
        }

        //// icons

        const icons = ['art', 'auto','bad', 'bar', 'barco', 'bof', 'bik','bomb', 'bronze', 'camion', 'chines',
            'city', 'desert', 'dino', 'eclair', 'ennui', 'fire', 'fog', 'froid', 'guerra', 'heart',
            'hipster', 'hot', 'hotp', 'like', 'love', 'mar', 'mercado', 'mild', 'mort', 'motacarro',
            'napoleon', 'nature', 'nice', 'novo', 'ok', 'onda', 'paisagem', 'pato', 'pescador', 'pff',
            'picnic', 'praia', 'religion', 'restaurante', 'sapo', 'sardines', 'star', 'super', 'superman','surfing',
            'surprise', 'sun','tourist', 'touro', 'yes', 'wind','vaga'
        ]
        const ics = [{
            art: 'art.gif',
            bad: 'bad.gif'
        }]

        ics.map((post, indice) => {
            console.log(post)
        })

        icons.forEach((items, index) => {
            let li = document.createElement('li')
            let img = document.createElement('img')
            let sp = document.createElement('p')

            sp.innerHTML = items
            img.setAttribute('src', 'images/' + items + '.gif')
            img.setAttribute('alt', items)
            li.append(sp);
            li.appendChild(img)
            icongif.appendChild(li)
            img.addEventListener('click', (e) => {
                icon.value= e.target.alt
            })

        })
    </script>
</body>

</html>