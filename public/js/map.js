let map, listDiv = document.getElementById('list'), ctx = document.getElementById("myChart");

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
                console.log(item);
                //deceaseString += 'ICD10: ' + item.icd + ' pvm: ' + item.date + ' lkm: ' + item.lkm + ' ryhma: ' + item.gender + '<br>';
                let genderString = (item.gender === 1) ? ' aikuisilla ' : ' lapsilla ';
                deceaseString += '<b>' + item.date + '</b><br> ICD10: ' + item.icd + '<br>'
                    + genderString + item.lkm + ' tapausta<br>';
            });

            let contentString = '<b>Valittuna postinumeroalue ' + this.data.postinumero + '</b><br><br>' +
                '<p>Alueen taudit:</p>' +
                '<p>'+ deceaseString+'</p>';

            /*let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                    }]
                },
            });*/

            listDiv.innerHTML = contentString;
        })
        .catch(error => console.log(error));
}
