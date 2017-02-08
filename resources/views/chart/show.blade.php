@extends('layout')

@section('content')
    <h1 class="title is-1">Tautikartta kaavioina</h1>
    <p>Valittuna postinumeroalue <b>{{$postcode}}</b></p>
    <p>Tarksteltava ajanjakso: <b>1.1.2016 - 31.12.2016</b></p>
    <p><a href="/chart">Vaihda postinumeroaluetta</a></p>
    <div class="columns">
        <?php $iter = 0; ?>
        @foreach($data as $icd => $value)
            <?php $iter++; ?>
            <div class="column">
                <h4 class="title is-4">{{translateICD($icd)}}</h4>
                <canvas id="shart-{{$icd}}" width="400" height="400"></canvas>
            </div>

            <?php if($iter % 3 == 0) {
                echo '</div><div class="columns">';
                } ?>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
    <script>
        @foreach($data as $icd => $value)
        const ctx_{{$icd}} = document.getElementById("shart-{{$icd}}");
        new Chart(ctx_{{$icd}}, {
            type: 'bar',
            data: {
                labels: [
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
                ],
                datasets: [
                    {
                        label: 'Aikuisilla',
                        backgroundColor: "lightgreen",
                        borderColor: "green",
                        borderWidth: 2,
                        data: [
                            @for($i = 1; $i < 13; $i++)
                                @if(isset($value[$i]))
                                    @if(isset($value[$i][2]))
                                        {{$value[$i][2]}},
                                    @else
                                        0,
                                    @endif
                                @else
                                    0,
                                @endif
                            @endfor
                        ],
                    },
                    {
                        label: 'Lapsilla',
                        backgroundColor: "rgba(75,192,192,0.4)",
                        borderColor: "rgba(75,192,192,1)",
                        borderWidth: 2,
                        data: [
                            @for($i = 1; $i < 13; $i++)
                                @if(isset($value[$i]))
                                    @if(isset($value[$i][1]))
                                        {{$value[$i][1]}},
                                    @else
                                        0,
                                    @endif
                                @else
                                    0,
                                @endif
                            @endfor
                        ],
                    },
                ]
            },
        });
        @endforeach
    </script>
@endsection
