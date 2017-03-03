@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Anna varoitusteksti</div>
                    <div class="panel-body">
                        <form action="{{url('admin')}}" method="post">
                            {{csrf_field()}}
                            
                            <div class="form-group {{ $errors->has('varoitus') ? 'has-error' : '' }}">
                                <label class="control-label" for="varoitus">Varoitusteksti:</label>
                                <input class="form-control" type="text" name="varoitus" id="varoitus" value="{{$warning->text ?? ''}}">
                                {!!$errors->first('varoitus', '<p class="help-block">:message</p>')!!}
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Tallenna varoitusteksti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
