<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Правен Калкулатор</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="/css/style.css" type="text/css">
        <link rel="stylesheet" href="/css/main.css" type="text/css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Exo+2:200" rel="stylesheet">
    </head>
    <body>
    <div class="hero-container fixed-top">
        <div class="header">
            <div class="div-block-logo">
                <img src="images/logo.png" width="250" alt="praven kalkulator na troshoci" class="logopad">
            </div>
            <div class="div-block menu"></div>
        </div>
    </div>

        <div class="wrapper">
            <div class="content">
                <h1 class="heading">ПРЕСМЕТКА НА ТРОШОЦИ ЗА ПРАВНИ ПОСТАПКИ</h1>
                <h2 class="sub_title">Нотарски и адвокатски тарифи, закон за судски такси, тарифа на катастар и останати <br> тарифи кои што ви се комплексни за толкување</h2>

                <!-----------PRESMETKA----------->
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
                            <div id="additional-fields">
                                <button type="submit" class="btn btn-secondary" id="btn-show">Прикажи дополнителни ставки</button>
                            </div>
                        </div>
                        <div id="calculated" class="col-md-8 ml-md-auto mr-md-auto">

                        </div>
                    </div>
                </div>
                <!-----------END-PRESMETKA----------->

                <!-----------FOOTER----------->
                <footer>
                    <div class="line"></div>
                    <div class="section-2">
                        <div class="div-block-7">
                            <div class="text-block-2">
                                Со ❤ од WeTalkIT и Skopje Legal Hackers
                            </div></div>
                        <a href="#" class="footerbttn w-button-footer">За Нас</a>
                        <a href="#" class="footerbttn w-button-footer">Водич</a>
                        <a href="#" class="footerbttn w-button-footer">Пријави Баг</a>
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
                var procedureId = $(this).val();
                var url = "{{url('/procedures')}}/"+procedureId;
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR) {
                        $('#calculate').fadeIn(500);
                        $('#additional-fields').fadeIn(500);
                        var items = data.items;
                        var n = items.length;
                        var html = '';
                        for(var i = 0; i < n; i++) {
                            if(i == 0){
                                html += '<div class="form-group mandatory">';
                            }else{
                                html += '<div class="form-group secondary">';
                            }
                            html += '<label for="'+items[i].var+'">'+items[i].name+'</label>';
                            html += '<span class="info-icon" title="'+items[i].comment+'"></span>';
                            var value = items[i].is_mandatory == 1 ? '' : items[i].attributes.placeholder;
                            if(items[i].type == 1) {
                                var placeholder = items[i].attributes.placeholder;
                                html += '<input type="text" name="'+items[i].var+'" placeholder="'+placeholder+'" class="form-control" '+(items[i].is_mandatory == 1 ? 'required' : '')+' value="'+value+'"/>';
                            } else {
                                html += '<select name="'+items[i].var+'" class="form-control" '+(items[i].is_mandatory == 1 ? 'required' : '')+'>';
                                var options = items[i].attributes.options;
                                var optionLen = options.length;
                                for(var j = 0; j < optionLen; j++) {
                                    html += '<option value="'+j+'" '+(value == j ? 'selected' : '')+'>'+options[j]+'</option>';       
                                }
                                html += '</select>';
                            }
                            html += '</div>';
                        }
                        $('#values').html(html);
                        $('#values .form-group').hide();
                        $('.mandatory').fadeIn(500);
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
                        html += '<h3>Вкупно: '+total+'</h3>';
                        html += '</div>';
                        $('#calculated').html(html);
                    }
                });
                return false;
            });
            $('#btn-show').click(function() {
                $('#values .secondary').fadeToggle(500);

                var text = $('#btn-show').text();
                $('#btn-show').text(
                    text == "Прикажи дополнителни ставки" ? "Сокриј дополнителни ставки" : "Прикажи дополнителни ставки");

            });

        </script>
    </body>
</html>
