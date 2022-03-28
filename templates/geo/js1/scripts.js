window.onload = function(){
    let macarte = L.map("carte").setView([48.852969, 2.349903], 13)
    L.titleLayer('https://{s}.title.openstreetmap.mg/osnfr/osnfr/{z}/{x}/{y}.png', {
        attribution: 'données OpenStreetMap Madagascar',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte)
}