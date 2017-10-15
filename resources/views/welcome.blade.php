@extends('layouts.main')

@section('content')
<h1 class="heading">ПРЕСМЕТКА НА ТРОШОЦИ ЗА ПРАВНИ ПОСТАПКИ</h1>
<h2 class="sub_title">Нотарски и адвокатски тарифи, закон за судски такси, тарифа на катастар и останати тарифи кои што ви се комплексни за толкување</h2>

<div class="presmetka">
    <div class="content">
        <div class="col-md-8 ml-md-auto mr-md-auto">
            {{Form::open(['id' => 'procedure_form'])}}
            <div class="form-group">
                {!! Form::label('procedure_id', 'Услуга') !!}
                {!! Form::select('procedure_id', $procedures, null, ['class' => 'form-control', 'placeholder' => 'Одберете услуга']) !!}
            </div>
            <div id="values"></div>
            <div id="calculate">
                <button type="submit" class="btn btn-primary" id="btn-calculate">Пресметај</button>
            </div>

            {{Form::close()}}
        </div>
        <div id="calculated" class="col-md-8 ml-md-auto mr-md-auto" style="display: none;">

        </div>
    </div>
</div>


<script src="//code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script>
    $('[name="procedure_id"]').change(function() {
        $('#calculated').show();
        var procedureId = $(this).val();
        var url = "{{url('/procedures')}}/"+procedureId;
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(data, textStatus, jqXHR) {
                $('#calculate').fadeIn(300);
                var items = data.items;
                var n = items.length;
                var html = '';
                var advanced_shown = false;
                for(var i = 0; i < n; i++) {
                    if(items[i].is_mandatory == 0 && !advanced_shown) {
                        html += '<a id="advanced-filter">Прикажи дополнителни ставки</a><div class="secondary-items">';
                        advanced_shown = true;
                    }
                    if(i == 0){
                        html += '<div class="form-group mandatory">';
                    } else{
                        html += '<div class="form-group secondary">';
                    }
                    html += '<label for="'+items[i].var+'">'+items[i].name;
                    html += '<span class="info-icon" data-tooltip="'+items[i].comment+'"></span></label>';
                    var value = items[i].is_mandatory == 1 ? '' : items[i].attributes.placeholder;
                    if(items[i].type == 1) {
                        html += '<input type="text" name="'+items[i].var+'" class="form-control" required value="'+value+'"/>';
                    } else {
                        html += '<select name="'+items[i].var+'" class="form-control" required>';
                        var options = items[i].attributes.options;
                        var keys = Object.keys(options);
                        keys.forEach(function(element) {
                            html += '<option value="'+element+'" '+(value == element ? 'selected' : '')+'>'+options[element]+'</option>';    
                        });
                        html += '</select>';
                    }
                    html += '</div>';
                    if(i == n-1) {
                        html += '</div>';
                    }
                }
                $('#values').html(html);
            }
        });
    });
    $('#procedure_form').submit(function() {
        $.ajax({
            type: 'POST',
            url: '{{url("/calculate")}}',
            data: $('#procedure_form').serialize(),
            dataType: 'json',
            success: function(data, textStatus, jqXHR) {
                var costs = data.costs;
                var total = data.total_formatted;
                var n = costs.length;
                var html = '<hr>';
                for(var i = 0; i < n; i++) {
                    html += '<div class="calculated-detailed">';
                    html += '<h3>'+data.costs[i].description+'</h3>';
                    var costDetails = data.costs[i].costs;
                    var k = costDetails.length;
                    for(var j = 0; j < k; j++) {
                        html += '<p><b>'+costDetails[j].name+': </b>'+costDetails[j].cost_formatted+'</p>';
                    }
                }
                html += '<h3 class="total">Вкупно: '+total+'</h3>';
                html += '</div>';
                html += '<p class="disclaimer">Презентираните информации претставуваат приближен износ на трошоците.</p><p class="disclaimer">Поради постоење на голем број на варијабли, калкулаторот не пресметува со 100% точност.</p><p class="disclaimer">За да ја подобриме прецизноста или имате некои сугестии контактирајте нe на <a href="mailto:skopjelh@gmail.com?subject=Правен Калкулатор: Сугестии">skopjelh@gmail.com</a>.</p>'
                $('#calculated').html(html);
            }
        });
        return false;
    });
    $('.presmetka').on('click', '#advanced-filter', function() {
        $('.secondary-items').fadeToggle(300);

        if($('#advanced-filter').hasClass('expanded')) {
            $('#advanced-filter').removeClass('expanded');
            $('#advanced-filter').text("Прикажи дополнителни ставки");
        } else {
            $('#advanced-filter').addClass('expanded');
            $('#advanced-filter').text("Сокриј дополнителни ставки");
        }

    });

</script>
@endsection
