
<!DOCTYPE html>
<html>

<head>
  <title>Tabla de Ordenes de Compra</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript"></script>

</head>

<body>
  <table>
      <tr>
        <th>OC</th>
        <th>Proveedor</th>
        <th>Producto</th>
        <th>Descripcion</th>
        <th>Cantidad</th>
        <th>Fecha de Entrega</th>
        <th>Precio</th>
      </tr>
    <!-- Aquí se muestra datos del xml-->
    <tbody id="ver_xml"></tbody>
  </table>
  <div id="seleccionar_xml"></div>
  
  <button id="ver_data">Ver</button>
  <button id="insert_data">Insertar</button>
  <button id="select_xml">Seleccionar</button>


  <script type="text/javascript">
        $ (function (){
          //ve la funcion de la BD
            $('#ver_data').click(function (){
                $('#ver_xml').load('verXml.php');
              });
              
              //funcion para insertar en la BD
              $('#insert_data').click(function (){
                $('#ver_xml').load('insertXml.php');
                alert("YA INGRESADO LOS DATOS CORRECTAENTE");
            });
            $('#select_xml').click(function (){
                $('#seleccionar_xml').load('subir.html');
                alert("YA Seleccionado LOS DATOS CORRECTAENTE");
            });
        });
    </script>
</body>

</html>