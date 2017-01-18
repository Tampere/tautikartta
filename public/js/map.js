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
    let that = this;
    axios.all([axios.get('data/' + this.data.postinumero + '/20160101'), axios.get('icds/' + this.data.postinumero + '/20160101')])
        .then(axios.spread(function (response, icds) {
            window.data = response.data;

            let icdsString = '';
            icds.data.forEach(item => {
                /*icdsString += '<a href="/chart/' + that.data.postinumero + '/' + item.icd + '/20160101">'+item.icd+'</a>, ';*/
                icdsString += item.icd+', ';
            });

            response.data.forEach(item => {
                let genderString = (item.gender === 1) ? ' aikuisilla ' : ' lapsilla ';
                deceaseString += '<b>' + item.date + '</b><br> ICD10: ' + item.icd + '<br>'
                    + genderString + item.lkm + ' tapausta<br>';
            });

            let contentString = '<b>Valittuna postinumeroalue ' + that.data.postinumero + '</b><br><br>' +
                '<p>Alueella aikavälillä tautiluokkia: ['+icdsString+']</p>' +
                '<p>'+ deceaseString+'</p>';

            listDiv.innerHTML = contentString;
        }));

    /*let data = axios.get('data/' + this.data.postinumero + '/20160101')
        .then(response => {
            window.data = response.data;
            response.data.forEach(item => {

                //deceaseString += 'ICD10: ' + item.icd + ' pvm: ' + item.date + ' lkm: ' + item.lkm + ' ryhma: ' + item.gender + '<br>';
                let genderString = (item.gender === 1) ? ' aikuisilla ' : ' lapsilla ';
                deceaseString += '<b>' + item.date + '</b><br> ICD10: ' + item.icd + '<br>'
                    + genderString + item.lkm + ' tapausta<br>';
            });

            let contentString = '<b>Valittuna postinumeroalue ' + this.data.postinumero + '</b><br><br>' +
                '<p>Alueen taudit:</p>' +
                '<p>'+ deceaseString+'</p>';

            /!*let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                    }]
                },
            });*!/

            listDiv.innerHTML = contentString;
        })
        .catch(error => console.log(error));*/
}
