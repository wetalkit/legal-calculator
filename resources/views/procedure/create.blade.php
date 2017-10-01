@extends('../layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Додади процедура</div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        {{ Form::open(array('url' => 'admin/procedure')) }}

                            @include('procedure._table')

                            {{ Form::submit('Зачувај', array('class' => 'btn btn-primary pull-right')) }}
                            <a href="{{url('admin/procedure')}}" class="btn btn-default pull-right">Откажи</a>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
