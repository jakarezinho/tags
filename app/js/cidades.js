     ////// PESQUISA  CIDADES///////////////
     const locations = [{
                 name: 'Baleal',
                 lat: '39.37328872711334',
                 lng: '-9.338089240589285',
                 hab: '27.753',

             }, {
                 name: 'Caldas da rainha',
                 lat: '39.40383605302325',
                 lng: '-9.133737087249758',
                 hab: '51.729'
             }, {
                 name: 'Foz do arelho',
                 lat: '39.43243509336661',
                 lng: '-9.227501741383778',
                 hab: '1.339'

             }, {
                 name: 'São martinho do porto',
                 lat: '39.50956201385417',
                 lng: '-9.134005308151247',
                 hab: '2.868',

             }, {
                 name: 'Obidos',
                 lat: '39.36073092757501',
                 lng: '-9.157614081770232',
                 hab: '11.772',

             }, {
                 name: 'Nazaré',
                 lat: '39.60093504721288',
                 lng: '-9.070909023284914',
                 hab: '14.173'

             },
             {
                 name: 'Peniche',
                 lat: '39.356043983908506',
                 lng: '-9.380811452865602',
                 hab: '14.173'

             },

         ]
         ///// VARS 
     let zoom = 16
     let cherche = document.getElementById('cherche')
     let r = document.getElementById('r')
     let listIntro = document.getElementById('listintro')
     infoslocal = document.getElementById('infoslocal')
     typeof zoomDevice !== 'undefined' ? zoom = zoomDevice : zoom
     let courantlocal
     const liItem = r.getElementsByTagName("li");


     //// CHERCHE VILE 
     cherche.addEventListener('focus', (e) => {
         localidades(locations)
         cherche.value = ''


     })

     cherche.addEventListener("keyup", (e) => {
         processResults(r)
     });

     cherche.addEventListener('focusout', (e) => {
         if (!cherche.contains(e.relatedTarget))
             setTimeout(function() {
                 r.innerHTML = ''
                 r.style.display = 'none'
             }, 500);


     });

     ///// display viles

     function localidades(locations) {

         locations.map((city, index) => {
             r.style.display = 'block'
             let li = document.createElement('li')
             let a = document.createElement('a')
             a.setAttribute('href', '#')
             a.innerHTML = city.name
             li.append(a)
             if (a.innerHTML == courantlocal) {
                 li.style.display = 'none'

             }
             r.appendChild(li)


             li.addEventListener('click', (e) => {
                 li.dataset.lat
                 cherche.value = city.name
                 r.innerHTML = ''
                 r.style.display = 'none'
                 map.setView([city.lat, city.lng], zoom);
                 displayInfos(city.name, city.hab, city.lat, city.lng)

             })


         })




     }
     ///// filtre resultats
     function processResults(r) {
         Array.from(liItem).forEach(element => {
             links = element.getElementsByTagName("a")[0];
             filterSearch = cherche.value.toUpperCase();

             if (links.innerHTML.toUpperCase().indexOf(filterSearch) > -1) {
                 element.style.display = "";
             } else {
                 element.style.display = "none";
             }
         })
     }

     //////  mini lista de viles intro
     function localidadesIntro(locations) {
         locations.map((city, index) => {
             if (listIntro) {
                 let li = document.createElement('li')
                 li.append(city.name)
                 listIntro.appendChild(li)

             }

         })

     }



     ////display infods 


     function displayInfos(name, hab, lat, lng) {
         if (infoslocal) {
             const airbnb = `<a target="_new" href="https://www.airbnb.com/s/homes?ne_lat=${lat}&ne_lng=${lng}&sw_lat=${lat-0.0002}&sw_lng=${lng-0.0002}&zoom=12&search_by_map=true&search_type=unknown&screen_size=large&map_toggle=true" class="airbnb-link"><img src="https://logo.clearbit.com/airbnb.com" width="30" height="30"></a>`
             infoslocal.innerHTML = airbnb
             courantlocal = name
             cherche.value = courantlocal
         }



     }

     localidadesIntro(locations)
     displayInfos('Caldas da rainha', '14000', '39.4039', '-9.1336')