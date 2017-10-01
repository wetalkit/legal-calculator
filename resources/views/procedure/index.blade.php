@extends('../layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Процедури</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="pull-right">
                        <a href="{{ route('procedure.create') }}" class="btn btn-primary">Додади Процедура</a>
                    </div>
                    <table class="table table-hover" data-form="procedureForm">
                        <thead>
                        <tr>
                            <th class="col-xs-10">Име</th>
                            <th class="col-xs-1"></th>
                            <th class="col-xs-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($procedures as $procedure)
                            <tr>
                                <td>{{ $procedure->name }}</td>
                                <td><a href="{{ route('procedure.edit', ['id' => $procedure->id]) }}" class="btn btn-default btn-sm">Промени</a></td>
                                <td>
                                    {{ Form::open(array('url' => 'admin/procedure/' . $procedure->id, 'class' =>'form-inline form-delete')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Избриши', array('class' => 'btn btn-danger btn-sm')) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="modal" id="confirm">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Внимание! Откако ќе се избрише процедурата не може да се врати во системот. </h4>
                                </div>
                                <div class="modal-body">
                                    <p>Дали сте сигурни дека сакате да ја избришете оваа процедура?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Откажи</button>
                                    <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Избриши</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
