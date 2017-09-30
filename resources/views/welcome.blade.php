<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
    <body>
        <div class="content">
           <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    {!! Form::label('procedure', 'Услуга', ['class' => 'col-sm-3']) !!}
                    <div class="col-sm-6">
                       {!! Form::select('procedure', $procedures, null, ['class' => 'form-control', 'placeholder' => 'Одберете услуга']) !!}
                    </div>
                </div>
           </div>
        </div>
        <script src="//code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script>
            $('[name="procedure"]').change(function() {
                var procedureId = $(this).val();
                var url = "{{route('get_items')}}";
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {procedureId : procedureId},
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR) {
                        console.log(data, textStatus, jqXHR);
                    }
                });
            });
        </script>
    </body>
</html>
