<?php
  print_r($_POST);
?>
<!doctype html>
<html>
<head>
    <title>AJAX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='jquery-ui.min.css' type='text/css' rel='stylesheet' >
    <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="jquery-ui.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(document).ready(function(){
                $(document).on('keydown', '.sector', function() {
                    var codigoAsociacion = this.id;
                    var splitid = codigoAsociacion.split('_');
                    var index = splitid[1];
                            $( '#'+codigoAsociacion ).autocomplete({
                                source: function( request, response ) {
                                    $.ajax({
                                        url: "getDetails.php",
                                        type: 'post',
                                        dataType: "json",
                                        data: {
                                            search: request.term,request:1
                                        },
                                        success: function( data ) {
                                            response( data );
                                        }
                                    });
                                },
                                select: function (event, ui) {
                                    $(this).val(ui.item.label); // display the selected text
                                    var varcodigoAsociacion = ui.item.value; // selected id to input
                                    // AJAX
                                    $.ajax({
                                        url: 'getDetails.php',
                                        type: 'post',
                                        data: {varcodigoAsociacion:varcodigoAsociacion,request:2},
                                        dataType: 'json',
                                        success:function(response){
                                            var len = response.length;
                                            if(len > 0){
                                                var codigoAsociacion = response[0]['codigoAsociacion'];
                                                var nombreProyecto = response[0]['nombreProyecto'];
                                                var codigoUnificado = response[0]['codigoUnificado'];
                                                var cadenaProductiva = response[0]['cadenaProductiva'];
                                                var sector = response[0]['sector'];
                                                document.getElementById('nombreProyecto_'+index).value = nombreProyecto;
                                                document.getElementById('codigoAsociacion_'+index).value = codigoAsociacion;
                                                document.getElementById('codigoUnificado_'+index).value = codigoUnificado;
                                                document.getElementById('cadenaProductiva_'+index).value = cadenaProductiva;
                                                document.getElementById('sector_'+index).value = sector; 
                                            }
                                        }
                                    });
                                    return false;
                                }
                            });
                });
    });
    </script>
    
</head>
<body>
    <div class="container"> 
            <form action="" method="post"  > 
                    <table border='1' style='border-collapse: collapse;'>
                        <thead>
                        <tr>
                            <th>sector</th>
                            <th>cadenaProductiva</th> 
                            <th>codigoUnificado</th> 
                            <th>nombreProyecto</th> 
                        </tr>
                        </thead>
                        <tbody>
                        <tr class='tr_input'>
                            <td>
                                <input type='text' name='sector' class='sector' id='sector_1' placeholder='Enter sector'>
                                <input type='hidden' name='codigoAsociacion' id='codigoAsociacion_1' disabled>
                            </td>
                            <td><input type='text' name='cadenaProductiva' id='cadenaProductiva_1' disabled></td> 
                            <td><input type='text' name='codigoUnificado' id='codigoUnificado_1' disabled></td>  
                            <td>
                                <input type='text' name='nombreProyecto'   id='nombreProyecto_1' disabled style="width: 900px !important;">
                                </td> 
                        </tr>
                        </tbody>
                    </table>
                    <br> 
                    <input type="submit" value="enviar">
            </form> 
    </div>
</body>
</html>

