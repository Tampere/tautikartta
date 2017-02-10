let mappi, listDiv = document.getElementById('list');

const ICDCODES = [
    '',
    '<a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00570&p_hakusana=influenssa">Influenssa ja influenssan kaltaiset taudit</a>',
    '<a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00608&p_hakusana=ripulin%20hoito%20%20">Vatsataudit (tai ripuli- oksennustaudit)</a>',
    '<a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00550">Vesirokko</a>',
    '<a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00530&p_hakusana=tulirokko">Streptokokin aiheuttamat nieluinfektiot ja tulirokko</a>',
    '<a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00775&p_hakusana=aikuisi%C3%A4n%20diabetes%20">Aikuistyypin diabetes</a>'
];

const MONTHNAMES = [
    '',
    'Tammikuu',
    'Helmikuu',
    'Maaliskuu',
    'Huhtikuu',
    'Toukokuu',
    'Kesäkuu',
    'Heinäkuu',
    'Elokuu',
    'Syyskuu',
    'Lokakuu',
    'Marraskuu',
    'Joulukuu'
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

function translateMonth(month) {
    return MONTHNAMES[month];
}

function lcfirst (str) {
    str += '';
    let f = str.charAt(0).toLowerCase();
    return f + str.substr(1);
}

function showArrays() {
    let deceaseString = '';
    let that = this;
    axios.all(
        [
            axios.get('data/' + this.data.postinumero),
            axios.get('icds/' + this.data.postinumero),
            axios.get('aggregates/' + this.data.postinumero)
        ])
        .then(axios.spread(function (response, icds, aggregates) {
            window.data = response.data;

            let icdsString = '';
            icds.data.forEach(function(item) {
                icdsString += '<li>' + translateICD(item.icd) + '</li>';
            });

            let aggregatesString = '', prevYear = 0, prevMonth = 0;
            aggregates.data.forEach(function(item) {
                let genderString = (item.agegroup === 2) ? 'Aikuisilla ' : 'Lapsilla ';

                if(item.year != prevYear) {
                    aggregatesString += '<b>' + item.year + '</b><br>';
                    prevYear = item.year;
                }

                if(item.month != prevMonth) {
                    aggregatesString += '<b style="padding-left: 10px;">' + translateMonth(item.month) + '</b><br>';
                    prevMonth = item.month;
                }

                aggregatesString += '<div style="padding-left: 20px;">'
                    + genderString
                    + lcfirst(translateICD(item.icd))
                    + ': ' + item.incidences
                    + ' käyntiä</div>';
            });

            let oldDate = '';
            response.data.forEach(function(item) {
                let genderString = (item.agegroup === 2) ? 'Aikuisilla ' : 'Lapsilla ';

                let year = item.date.substr(0, 4);
                let month = item.date.substr(5, 2);
                let day = item.date.substr(8, 2);

                let readableDate = day + '.' + month + '.' + year;

                if(readableDate !== oldDate) {
                    deceaseString += '<h6 class="title is-6">' + readableDate + '</h6>';
                    oldDate = readableDate;
                }

                deceaseString += '<div class="notification" style="padding-left: 20px">' + translateICD(item.icd) + ':<br>'
                    + genderString + item.lkm + ' käyntiä</div>';
            });

            listDiv.innerHTML = '<h4 class="title is-4">Valittuna postinumeroalue <a target="_blank" href="/chart/' + that.data.postinumero + '">' + that.data.postinumero + '</a></h4>' +
                '<div class="notification is-primary">Alueella tautiluokkia:<br><ul class="tauti-list"> '
                + icdsString +
                '</ul></div>' +
                '<div class="notification">' + aggregatesString + '</div>' +
                '<p><b>Kaikki tapaukset:</b><br>' + deceaseString + '</p>';
        })).catch(function(error) {console.log(error)});
}
