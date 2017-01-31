let mappi, listDiv = document.getElementById('list'), ctx = document.getElementById("myChart");

const ICDCODES = [
    '',
    'Influenssa ja influenssan kaltaiset taudit',
    'Vatsataudit (tai ripuli- oksennustaudit)',
    'Vesirokko',
    'Streptokokin aiheuttamat nieluinfektiot ja tulirokko'
];

function initMap() {
    mappi = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 61.497594, lng: 23.759121},
        zoom: 13
    });

    addPolygons();
}

function translateICD(icd) {
    return ICDCODES[icd];
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
                icdsString += '<li>' + translateICD(item.icd) + '</li>';
            });

            response.data.forEach(function(item) {
                let genderString = (item.gender === 1) ? ' aikuisilla ' : ' lapsilla ';

                let year = item.date.substr(0, 4);
                let month = item.date.substr(4, 2);
                let day = item.date.substr(6, 2);

                let readableDate = day + '.' + month + '.' + year;

                deceaseString += '<h6 class="title is-6">' + readableDate + '</h6><div class="notification" style="padding-left: 20px">' + translateICD(item.icd) + '<br>'
                    + genderString + item.lkm + ' tapausta</div>';
            });

            listDiv.innerHTML = '<h4 class="title is-4">Valittuna postinumeroalue ' + that.data.postinumero + '</h4>' +
                '<div class="notification is-primary">Alueella aikavälillä tautiluokkia:<br><ul class="tauti-list"> ' + icdsString + '</ul></div>' +
                '<p>' + deceaseString + '</p>';
        })).catch(function(error) {console.log(error)});
}
