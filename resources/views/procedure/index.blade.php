@extends('../layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Procedures</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('admin') }}" class="btn btn-success">Dashboard</a>
                    <div class="pull-right">
                        <a href="{{ route('procedure.create') }}" class="btn btn-success">Add New</a>
                    </div>
                    <table class="table table-hover" data-form="procedureForm">
                        <thead>
                        <tr>
                            <th class="col-xs-10">Name</th>
                            <th class="col-xs-1"></th>
                            <th class="col-xs-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($procedures as $procedure)
                            <tr>
                                <td>{{ $procedure->name }}</td>
                                <td><a href="{{ route('procedure.edit', ['id' => $procedure->id]) }}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    {{ Form::open(array('url' => 'procedure/' . $procedure->id, 'class' =>'form-inline form-delete')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
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
                                    <h4 class="modal-title">Delete Confirmation</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you, want to delete?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Delete</button>
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
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
