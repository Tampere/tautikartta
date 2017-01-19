let map, listDiv = document.getElementById('list'), ctx = document.getElementById("myChart");

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 61.497594, lng: 23.759121},
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
            icds.data.forEach(function(item) {
                /*icdsString += '<a href="/chart/' + that.data.postinumero + '/' + item.icd + '/20160101">'+item.icd+'</a>, ';*/
                icdsString += item.icd+', ';
            });

            response.data.forEach(function(item) {
                let genderString = (item.gender === 1) ? ' aikuisilla ' : ' lapsilla ';

                let year = item.date.substr(0, 4);
                let month = item.date.substr(4, 2);
                let day = item.date.substr(6, 2);

                let readableDate = day + '.' + month + '.' + year;

                deceaseString += '<b>' + readableDate + '</b><br> ICD10: ' + item.icd + '<br>'
                    + genderString + item.lkm + ' tapausta<br>';
            });

            let contentString = '<b>Valittuna postinumeroalue ' + that.data.postinumero + '</b><br><br>' +
                '<p>Alueella aikavälillä tautiluokkia: ['+icdsString+']</p>' +
                '<p>'+ deceaseString+'</p>';

            listDiv.innerHTML = contentString;
        })).catch(function(error) {console.log(error)});
}
