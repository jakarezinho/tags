     ////// PESQUISA  CIDADES///////////////
     const locations = [{
                 name: 'Baleal',
                 lat: '39.3725',
                 lng: '-9.33705'

             }, {
                 name: 'Caldas da rainha',
                 lat: '39.4039',
                 lng: '-9.1336'
             }, {
                 name: 'Foz do arelho',
                 lat: '39.4282',
                 lng: '-9.22071'

             }, {
                 name: 'São martinho do porto',
                 lat: '39.51',
                 lng: '-9.13517'

             }, {
                 name: 'Obidos',
                 lat: '39.3607',
                 lng: '-9.15754'

             }, {
                 name: 'Nazaré',
                 lat: '39.6006',
                 lng: '-9.07166'

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
                 displayInfos(city.name, city.lat, city.lng)

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

     function displayInfos(name, lat, lng) {
         infoslocal.innerHTML = name + '<a href="#">' + name + '</a>'
         courantlocal = name
         cherche.value = courantlocal



     }

     localidadesIntro(locations)
     displayInfos('Caldas da rainha', null, null)