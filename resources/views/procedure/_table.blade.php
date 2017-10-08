<div class="form-group">
    {{ Form::label('name', 'Назив на процедура') }}
    {{ Form::text('name', null, array('class' => 'form-control', 'required' => true)) }}
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<hr/>
<div class="form-group">
    {{ Form::label('items', 'Параметри') }}
    <table class="table table-hover items-table">
        <thead>
        <tr>
            <th class="col-md-2">Параметар</th>
            <th class="col-md-2">Назив</th>
            <th class="col-md-1">Тип на поле</th>
            <th class="col-md-2">Зададена вредност</th>
            <th class="col-md-2">Понудени опции</th>
            <th class="col-md-2">Објаснување</th>
            <th class="col-md-1">Задолжително поле?</th>
            <th class="col-md-1"></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <a href="#" id="add-item" class="btn btn-default">Додади параметар</a>
    @if ($errors->has('items'))
        <span class="help-block">
            <strong>{{ $errors->first('items') }}</strong>
        </span>
    @endif
    <hr/>
</div>

{{ Form::label('formulas', 'Пресметковни процедури') }}
<div class="form-group row">
    <div class="col-md-6">
        {!! Form::select('formula-category', $formulas, null, ['class' => 'form-control']) !!}
    </div> 
    <div class="col-md-2">
        <button id="add_formula" class="btn btn-default btn-sm btn-add">+</button>
    </div>
</div>
<div class="formulas"></div>
@if ($errors->has('formulas'))
    <span class="help-block">
        <strong>{{ $errors->first('formulas') }}</strong>
    </span>
@endif
