let map, listDiv = document.getElementById('list');

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 61.497594, lng: 23.759121}, //61.497594, 23.759121
        zoom: 13
    });

    addPolygons();
}

function showArrays(event) {

    let deceaseString = '';

    let data = axios.get('data/' + this.data.postinumero)
        .then(response => {
            window.data = response.data;
            response.data.forEach(item => {
                deceaseString += 'ICD10: ' + item.icd + ' pvm: ' + item.date + ' lkm: ' + item.lkm + ' ryhma: ' + item.gender;
            });

            let contentString = '<b>' + this.data.postinumero + '</b><br><br>' +
                '<p>Alueen taudit:</p>' +
                '<p>'+ deceaseString+'</p>';

            listDiv.innerHTML = contentString;
        })
        .catch(error => console.log(error));
}
