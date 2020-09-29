<!doctype html>
<html lang="en">
  <head>
  <style>
        body {
          background-color:lightblue;
        }
        h1 {
  color: lightblue;
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 20px;
}


  </style>        
      
    <title>Productos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>
  <h1><Strong> Productos</h1> </Strong>

  <div class="container">
          
  <form class="form-group" action="" method="post">
              <div class="form-group">

                    <label for="lbl_id" ><b>ID</b></label>
                    <input type="text" name="txt_id" id="txt_id" class="form-control" value="0"  readonly> 
    
                    <label for="lbl_producto" ><b>Producto</b></label>
                    <input type="text" name="txt_producto" id="txt_producto" class="form-control"  required>
                    
                    <label for="lbl_descripcion" ><b>Descripcion</b></label>
                    <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" required>
                   
                    <label for="lbl_costo" ><b>Precio Costo</b></label>
                    <input type="number" name="txt_costo" id="txt_costo" class="form-control" required>
                   
                    <label for="lbl_venta" ><b>Precio Venta</b></label>
                    <input type="number"  name="txt_venta" id="txt_venta" class="form-control" required>
                                  
                    <label for="lbl_marca" ><b>Marca</b></label>
                    <select name="drop_marca" id="drop_marca" class="form-control">

                  <option value="0">------Seleccione------</option>
                    <?php

                        include("Conexion.php");

                        $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                        
                        $db_conexion -> real_query("select idmarca as id, marca from marcas");

                        $resultado = $db_conexion-> use_result();

                        while($fila = $resultado->fetch_assoc()){
                            echo "<option value='".$fila['id']."'>".$fila['marca']."</option>";

                        }

                        $db_conexion ->close();

                    ?>
                        
                    </select>
    
                    <label for="lbl_existencias" ><b>Existencias</b></label>
                    <input type="number"  name="txt_existencias" id="txt_existencias" class="form-control" required>
                                  
                  </div>
    
              <div class="modal-footer">               
                
                <button name="btn_agregar" id="btn_agregar"  value="agregar" class="btn btn-success">Agregar</button>

              </div>

    </form>

    <div class="container">

    <div class="row">
    
    <div class="col-1"></div>

    <div class="col-10">

    
            <!--Tabla-->
          <table class="table table-striped table-inverse table-responsive my-5 text-center" id="tbl_productos">
            <thead class="thead-inverse" id="tbl_empleados">
              <tr>
                <th>Producto</th>
                <th>Descripcion</th>
                <th>Precio Costo</th>
                <th>Precio Venta</th>
                <th>Existencias</th>
                <th>Marca</th>
                <th>Acciones</th>
             
              </tr>
              </thead>
              <tbody>
              <!--Llenar Tabla-->

              <?php 
                  include("Conexion.php");
                  $db_conexion = mysqli_connect($db_host, $db_user,$db_pass,$db_name);
                  $query = "select p.idproducto as id, p.producto, p.descripcion, p.precio_costo, p.precio_venta, p.existencia, m.marca, m.idmarca from productos as p inner join marcas as m on p.idmarca = m.idmarca";
                  $results = mysqli_query($db_conexion, $query);
                  while ($row = mysqli_fetch_array($results)) {?>

                  <tr>
                    <td> <?php echo $row['producto'] ?> </td>
                    <td> <?php echo $row['descripcion'] ?> </td>
                    <td> <?php echo $row['precio_costo'] ?> </td>
                    <td> <?php echo $row['precio_venta'] ?> </td>
                    <td> <?php echo $row['existencia'] ?> </td>
                    <td> <?php echo $row['marca'] ?> </td>
                    <td>
                    <a  class="btn btn-secondary" href="modificar_empleado.php?id=<?php echo $row['id']?>">
                     Modificar
                     </a>


                    <a class="btn btn-danger" href="EliminarProducto.php?id=<?php echo $row['id']?>">
                    Eliminar
                    </a>

                    
                    </td>
                   
                  </tr>
                   
                 

                  <?php } ?>    
                      
              </tbody>
          </table>

        
          </div>

          <div class="col-1"></div>
    
          </div>

          </div>

          </div>
<!--Insertar datos-->
<?php

if(isset($_POST["btn_agregar"])){

  include("Conexion.php");

  $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  $txt_producto = utf8_decode($_POST["txt_producto"]);
  $txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
  $txt_costo = utf8_decode($_POST["txt_costo"]);
  $txt_venta = utf8_decode($_POST["txt_venta"]);
  $drop_marca = utf8_decode($_POST["drop_marca"]);
  $txt_existencias = utf8_decode($_POST{"txt_existencias"});
  $sql = "insert into productos(producto, descripcion, precio_costo, precio_venta, idmarca, existencia) values ('".$txt_producto."', '".$txt_descripcion."', '".$txt_costo."','".$txt_venta."', ".$drop_marca.", '".$txt_existencias."')";

  if($db_conexion->query($sql)==true){
    $db_conexion->close();
    print "<script>window.setTimeout(function() { window.location = 'index.php' }, 30);</script>";

  }else{
    echo "Error: " . $sql . "<br>" . $db_conexion->close();
  }

}     

?>

  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    <script type="text/javascript">
        
        function limpiar(){
       $("#txt_id").val(0);
       $("#txt_producto").val('');
       $("#txt_descripcion").val('');
       $("#txt_costo").val('');
       $("#txt_venta").val('');
       $("#txt_existencias").val('');
       $("#drop_marca").val(1);
        }
        
        $('#tbl_productos').on('click', 'tr td', function(evt){
            var target, id, idmarca, producto, descripcion, costo, venta,existencia;
            
            target = $(event.target);
            
            id = target.parent().data("id");
            producto = target.parent("tr").find("td").eq(0).html();
            descripcion = target.parent("tr").find("td").eq(1).html();
            costo = target.parent("tr").find("td").eq(2).html();
            venta = target.parent("tr").find("td").eq(3).html();
            idmarca = target.parent().data("idmarca");
            existencia = target.parent("tr").find("td").eq(4).html();
            
            $("#txt_id").val(id);
            $("#txt_producto").val(producto);
            $("#txt_descripcion").val(descripcion);
            $("#txt_costo").val(costo);
            $("#txt_venta").val(venta);
            $("#drop_marca").val(idmarca);
            $("#txt_existencias").val(existencia);     
            
        })  
    
</script>
  
  </body>
</html>