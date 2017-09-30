@extends('../layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="{{ route('procedure.index') }}" class="btn btn-success">Procedures</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
