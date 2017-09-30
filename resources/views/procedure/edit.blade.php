@extends('../layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit procedure: {{ $procedure->name }}</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{ route('procedure.index') }}" class="btn btn-success">Back</a>
                        <div class="col-xs-12">
                            {{ Form::model($procedure, array('route' => array('procedure.update', $procedure->id), 'method' => 'PUT')) }}

                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', null, array('class' => 'form-control')) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <hr/>
                            <div class="form-group">
                                {{ Form::label('items', 'Items') }}
                                <table class="table table-hover items-table">
                                    <thead>
                                    <tr>
                                        <th class="col-md-2">Label</th>
                                        <th class="col-md-2">Name</th>
                                        <th class="col-md-2">Type</th>
                                        <th class="col-md-2">Options</th>
                                        <th class="col-md-2">Comments</th>
                                        <th class="col-md-2"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($procedure->items as $item)
                                        <tr>
                                            <td>
                                                <input name='new-item-label[]' value="{{ $item->label }}" />
                                            </td>
                                            <td>
                                                <input name='new-item-name[]' value="{{ $item->name }}" />
                                            </td>
                                            <td>
                                                <select class="form-control" id="new-item-type">
                                                    <option value="0" {{ ($item->type == 0) ? "selected" : "" }}>Text</option>
                                                    <option value="1" {{ ($item->type == 1) ? "selected" : "" }}>Dropdown</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name='new-item-options[]' value="{{ $item->options }}" />
                                            </td>
                                            <td>
                                                <input name='new-item-comments[]' value="{{ $item->comments }}" />
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger delete-item">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <a href="#" class="btn btn-primary"
                                   data-toggle="modal"
                                   data-target="#newItemModal">Add Item</a>
                                <hr/>
                            </div>
                            {{ Form::submit('Update', array('class' => 'btn btn-success')) }}

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="newItemModal"
             tabindex="-1" role="dialog"
             aria-labelledby="newItemModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="newItemModalLabel">New Item</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-2">Label</th>
                                <th class="col-md-2">Name</th>
                                <th class="col-md-2">Type</th>
                                <th class="col-md-2">Options</th>
                                <th class="col-md-4">Comments</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" id="new-item-label" placeholder="Вредност на имот">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="new-item-name" placeholder="vrednost_imot">
                                </td>
                                <td>
                                    <select class="form-control" id="new-item-type">
                                        <option value="0">Text</option>
                                        <option value="1">Dropdown</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="new-item-options" placeholder="30,000">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="new-item-comments" placeholder="...">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">Close</button>
                        <span class="pull-right">
                        <button type="button" class="btn btn-primary add-item"
                                data-dismiss="modal">
                            Add Item
                        </button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
