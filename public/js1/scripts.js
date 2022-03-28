window.onload = function(){
    let macarte = L.map("carte").setView([48.852969, 2.349903], 13),
    L.titleLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
    {
        attribution: 'donnée OpenstreetMap Madagascar',
        minZoom:1,
        maxZoom:20
    }).addTo(macarte)

    //
    L.Routing.control({
        geocoder: L.Control.Geocoder.nominatim(),
        lineOptions: {
            styles: [{
                color: '#d00606',
                opacity: 1,
                weight: 5
            }]
        },
        router: new L.Routing.osrmv1({
            language: 'fr',
            profile: 'car' //
        })
    }).addTo(macarte)
}