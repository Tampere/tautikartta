@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading">Anna varoitusteksti</div>
                    <div class="panel-block">
                        <form action="{{url('admin')}}" method="post">
                            {{csrf_field()}}
                            <label class="label">Varoitusteksti</label>
                            <p class="control">
                                <input class="input" type="text" name="varoitus" value="{{$warning->text ?? ''}}">
                            </p>

                            <p class="control">
                                <button class="button is-primary">Tallenna</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
