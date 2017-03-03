<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tautikartta</title>

        <!-- Styles -->
        <link rel="stylesheet" href="css/app.css?v=2">
    </head>
    <body>

    <div id="modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Mikä on Tampereen tautikartta?</p>
            </header>
            <section class="modal-card-body" style="max-height: 200px;">
                <p>Tampereen kaupunki kehittää konseptia, jolla tiettyjen tautiluokkien esiintyvyyttä voidaan esittää
                    internetissä kansalaisille.</p>

                <p>Tiedot saadaan Tampereen kaupungin terveyspalvelujen yhteydessä kirjatuista niistä diagnooseista, jotka
                    poimitaan vastaanottokäyntien yhteydessä kansainvälisestä ICD-10 ja kansallisesta ICPC-2
                    -koodistoista.</p>

                <div class="notification is-primary">
                    <p>Seurattavat tautiluokat ovat:</p>
                    <ul class="tauti-list">
                        <li>
                            <a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00570&p_hakusana=influenssa">Influenssa
                                ja influenssan kaltaiset taudit</a></li>
                        <li>
                            <a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00608&p_hakusana=ripulin%20hoito%20%20">Vatsataudit
                                (tai ripuli- oksennustaudit)</a></li>
                        <li><a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00550">Vesirokko</a>
                        </li>
                        <li>
                            <a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00530&p_hakusana=tulirokko">Streptokokin
                                aiheuttamat nieluinfektiot ja tulirokko</a></li>
                        <li>
                            <a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00775&p_hakusana=aikuisi%C3%A4n%20diabetes%20">Aikuistyypin
                                diabetes</a></li>
                        <li>
                            <a target="_blank" href="http://www.terveyskirjasto.fi/terveyskirjasto/tk.koti?p_artikkeli=dlk00139">Klamydia</a></li>
                    </ul>
                </div>

                <p>Haluttua postinumeroaluetta kartalta klikkaamalla saa raportin viimeaikaisista seurattavien
                    tautiluokkien esiintymismääristä. Tautiluokan nimestä klikkaamalla saa lisätietoa (Terveyskirjastosta)
                    ko. sairauksista. Tautikartan raportti jakaa esiintyvät tautiluokat kahteen ikäjakaumaan eli 0-18
                    vuotiaisiin (=lapset) ja yli 18-vuotiaisiin (=aikuiset). Tiedoista ei ole tunnistettavissa yksittäisiä
                    henkilöitä.</p>

                <p>Huom! Kaikilla vastaanottokäynneillä ei voida kirjata diagnoosia tai diagnoosi kirjataan viiveellä, kun
                    tarkemmat tutkimustulokset ovat valmistuneet. Mukana raportilla ei ole Pirkanmaan sairaanhoitopiirin
                    ensiapu-Acutan diagnooseja. Palvelua kehitetään edelleen.</p>

                <p>Mikäli haluat antaa palautetta Tautikartasta, niin se onnistuu tästä linkistä
                    <a href="http://www.tampere.fi/palaute.html.stx">http://www.tampere.fi/palaute.html.stx</a></p>
            </section>
            <footer class="modal-card-foot">
                <a id="closeBtn" class="button">Sulje</a>
            </footer>
        </div>
    </div>

    <div id="app" class="columns">
        @if(strlen($warning) > 1)
            <div id="varoitus">
                <h3>{{$warning}}</h3>
            </div>
        @endif
        <div id="map" class="column is-three-quarters"></div>

        <div id="info" class="column" style="{{strlen($warning) > 1 ? 'padding-top: 25px': ''}}">
            <p>
                <a href="http://www.tampere.fi"><img src="{{asset('images/tampere.jpg')}}" alt="Tampere"></a><br>
                <b>Tautikartta</b> (<span id="openInfo" style="cursor: pointer; border-bottom: 1px solid blue;">Tietoa tautikartasta</span>)<br>
            </p>
            <a href="http://inter16.tampere.fi/terveystutka/" target="_blank">
                <img id="terveystutkalogo" src="images/terveystutka.png" alt="Terveystutka"><br>
                Terveystutkasta voit etsiä sinua kiinnostavia terveyttä edistäviä palveluja Tampereella.
            </a><br>
            <a href="https://www.thl.fi/fi/web/infektiotaudit/ajankohtaista/infektiouutiset/">THL:n infektiouutiset</a>
            <div id="list"></div>
        </div>
    </div>

        <script src="js/polygons.js?v=3"></script>
        <script src="js/app.js?v=2"></script>
        <script src="js/map.js?v=4"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMIU-6eqyhh0yH9OO77qiWSdsokw8DGEc&callback=initMap" async defer></script>
    </body>
</html>
