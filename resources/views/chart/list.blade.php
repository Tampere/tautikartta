@extends('layout')

@section('content')
    <h1 class="title is-1">Tautikartta kaavioina</h1>
    <p>Valitse haluamasi postinumeroalue</p>

    <div class="notification is-primary">
        <ul class="tauti-list">
            <li><a href="/chart/all">Kaikkien postinumeroalueiden yhteenlasketut kaaviot</a></li>
        @foreach($data as $item)
            <li><a href="/chart/{{$item->postcode}}">{{$item->postcode}}</a></li>
        @endforeach
        </ul>
    </div>
@endsection