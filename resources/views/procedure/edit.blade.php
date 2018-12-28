@extends('../layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Промени процедура: {{ $procedure->name }}</div>

                    <div class="panel-body">
                        @include('procedure._status_messages')
                        <div class="col-xs-12">
                            {{ Form::model($procedure, array('route' => array('procedure.update', $procedure->id), 'method' => 'PUT')) }}

                            @include('procedure._table')

                            {{ Form::input('hidden', 'name', $procedure->id, array('id' => 'procedure-id', 'data-url' => route('get_procedure_items'))) }}
                            
                            {{ Form::submit('Зачувај', array('class' => 'btn btn-primary pull-right', 'id' => 'submit_btn')) }}
                            <a href="{{url('admin/procedure')}}" class="btn btn-default pull-right">Откажи</a>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
