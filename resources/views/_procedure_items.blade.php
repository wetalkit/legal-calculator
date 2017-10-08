@foreach($procedureItems as $item)
<div class="form-group">
   {!! Form::label($item->label, $item->name, ['class' => 'col-sm-3']) !!}
   <div class="col-sm-6">
       {!! Form::select($item->name, $item->options, null, ['class' => 'form-control']) !!}
   </div>
</div>
@endforeach