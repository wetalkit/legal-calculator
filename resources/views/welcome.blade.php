<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Правен Калкулатор</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="/css/main.css" type="text/css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-light bg-primary fixed-top">
            <a class="navbar-brand" href="#">
                Правен Калкулатор
            </a>
        </nav>
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
           <div id="calculated" class="col-md-8 ml-md-auto mr-md-auto">
               
           </div>
        </div>
        <script src="//code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script>
            $('[name="procedure_id"]').change(function() {
                var procedureId = $(this).val();
                var url = "{{url('/procedures')}}/"+procedureId;
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR) {
                        $('#calculate').show();
                        var items = data.items;
                        var n = items.length;
                        var html = '';
                        for(var i = 0; i < n; i++) {
                            html += '<div class="form-group">';
                            html += '<label for="'+items[i].var+'">'+items[i].name+'</label>';
                            html += '<span class="info-icon" title="'+items[i].comment+'"></span>';
                            var value = items[i].is_mandatory == 1 ? '' : items[i].attributes.placeholder;
                            if(items[i].type == 1) {
                                var placeholder = items[i].attributes.placeholder;
                                html += '<input type="text" name="'+items[i].var+'" placeholder="'+placeholder+'" class="form-control" '+(items[i].is_mandatory == 1 ? 'required' : '')+'/>';
                            } else {
                                html += '<select name="'+items[i].var+'" class="form-control" '+(items[i].is_mandatory == 1 ? 'required' : '')+'>';
                                var options = items[i].attributes.options;
                                var optionLen = options.length;
                                for(var j = 0; j < optionLen; j++) {
                                    html += '<option value="'+j+'">'+options[j]+'</option>';       
                                }
                                html += '</select>';
                            }
                            html += '</div>';
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
                        var total = data.total;
                        var n = costs.length;
                        var html = '<hr>';
                        for(var i = 0; i < n; i++) {
                            html += '<div class="calculated-detailed">';
                            html += '<h3>'+data.costs[i].description+'</h3>';
                            var costDetails = data.costs[i].costs;
                            var k = costDetails.length;
                            for(var j = 0; j < k; j++) {
                                html += '<p><b>'+costDetails[j].name+': </b>'+costDetails[j].cost+'</p>';
                            }
                        }
                        html += '<h3>Вкупно: '+total+'</h3>';
                        html += '</div>';
                        $('#calculated').html(html);
                    }
                });
                return false;
            });
        </script>
    </body>
</html>
