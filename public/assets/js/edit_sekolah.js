var lat = window.editLatitude ?? -0.45;
var lng = window.editLongitude ?? 100.57;

var map = L.map('map').setView([lat, lng], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

var marker = L.marker([lat, lng], {
    draggable: true
}).addTo(map);

// Isi input jika mode edit
if (document.getElementById('latitude')) {
    document.getElementById('latitude').value = lat;
}

if (document.getElementById('longitude')) {
    document.getElementById('longitude').value = lng;
}

// Saat marker digeser
marker.on('dragend', function () {

    var pos = marker.getLatLng();

    document.getElementById('latitude').value = pos.lat;
    document.getElementById('longitude').value = pos.lng;
});

// Saat peta diklik
map.on('click', function (e) {

    document.getElementById('latitude').value = e.latlng.lat;
    document.getElementById('longitude').value = e.latlng.lng;

    marker.setLatLng(e.latlng);
});

