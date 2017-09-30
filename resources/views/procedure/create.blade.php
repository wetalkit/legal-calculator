@extends('../layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create Procedure</div>

                <div class="panel-body">
                <a href="{{ route('procedure.index') }}" class="btn btn-success">Back</a>

                <div class="col-xs-12">
                    {{ Form::open(array('url' => 'admin/procedure')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
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
                                    <th class="col-md-4">Comments</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-primary"
                               data-toggle="modal"
                               data-target="#newItemModal">Add Item</a>
                            <hr/>
                        </div>

                        {{ Form::submit('Create', array('class' => 'btn btn-success')) }}

                    {{ Form::close() }}
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
                                <textarea name="new-item-options" id="new-item-options" cols="40" rows="5"></textarea>
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
