<?php
$funcion = $_GET["funcion"];

if($funcion == "conexion")
{
    echo "conexion ";
    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        echo true;
    }
    else
    {
        echo false;
    }
}

if($funcion == "consultarProductos")
{
    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        echo true;
        $plantas = $objDB->consultarProductos();
        //echo "PLANTA: ".$plantas;
        
        if($plantas)
        {
            echo $plantas;
        }
        else
        {
            echo false;
        }
    }
    else
    {
        echo false;
    }
}

if($funcion == "consultarProductosDescontinuados")
{
    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        echo true;
        $plantas = $objDB->consultarProductosDescontinuados();
        //echo "PLANTA: ".$plantas;
        
        if($plantas)
        {
            echo $plantas;
        }
        else
        {
            echo false;
        }
    }
    else
    {
        echo false;
    }
}

if($funcion == "consultarProductosNuevos")
{
    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        echo true;
        $plantas = $objDB->consultarProductosNuevos();
        //echo "PLANTA: ".$plantas;
        
        if($plantas)
        {
            echo $plantas;
        }
        else
        {
            echo false;
        }
    }
    else
    {
        echo false;
    }
}

if($funcion == "consultarProductosActivos")
{
    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        echo true;
        $plantas = $objDB->consultarProductosActivos();
        //echo "PLANTA: ".$plantas;
        
        if($plantas)
        {
            echo $plantas;
        }
        else
        {
            echo false;
        }
    }
    else
    {
        echo false;
    }
}

if($funcion == "consultarProductos2")
{
    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        echo true;
        $plantas = $objDB->consultarProductos2();
        //echo "PLANTA: ".$plantas;
        
        if($plantas)
        {
            echo $plantas;
        }
        else
        {
            echo false;
        }
    }
    else
    {
        echo false;
    }
}

if($funcion == "desactivarProducto")
{
    $IDProducto = $_GET["IDProducto"];

    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        echo true;
        $plantas = $objDB->desactivarProducto($IDProducto);
        //echo "PLANTA: ".$plantas;
        
        if($plantas)
        {
            echo $plantas;
        }
        else
        {
            echo false;
        }
    }
    else
    {
        echo false;
    }
}

if($funcion == "editarProducto")
{
    $IDProducto = $_GET["IDProducto"];
    $tituloProducto = $_GET["tituloProducto"];
    $descripcionProducto = $_GET["descripcionProducto"];
    $precioProducto = $_GET["precioProducto"];
    $imagenProducto = $_GET["imagenProducto"];

    $objDB = new conexionMySQL("192.168.64.3", "db_velasVelasquez", "userVelasVelasquez", "Velas123*");
    $estado = $objDB->conectarDB();
    
    if($estado)
    {
        //echo true;
        $plantas = $objDB->editarProducto($IDProducto, $tituloProducto, $descripcionProducto, $precioProducto);
        //echo "PLANTA: ".$plantas;
        
        if($plantas)
        {
            echo $plantas;
        }
        else
        {
            echo false;
        }
    }
    else
    {
        echo false;
    }
}

class conexionMySQL
{
    var $host;
    var $DB;
    var $usuario;
    var $contrasena;
    var $estadoConexion;
    var $mysqlConexion;
    
    function __construct($host="192.168.64.3", $db="db_velasVelasquez", $usuario, $contrasena)
    {
        $this->host = $host;
        $this->DB = $db;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        
        /*
        echo $this->host;
        echo $this->DB;
        echo $this->usuario;
        echo $this->contrasena;
        */
    }
    
    function conectarDB()
    {
        /*
        echo "host: ".$this->host."<br>";
        echo "DB: ".$this->DB."<br>";
        echo "Usuario: ".$this->usuario."<br>";
        echo "Contraseña: ".$this->contrasena."<br>";
        */
        
        try 
        {
            $this->mysqlConexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->DB);
            if ($this->mysqlConexion->connect_errno) 
            {
                //echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                $this->estadoConexion = false;
            }
            else
            {
                //echo "Conexion exitosa";
                $this->estadoConexion = true;
            }
        }
        catch (mysqli_sql_exception $e) 
        {
            throw $e;
            $this->estadoConexion = false;
        }

        //echo $mysqli->host_info . "\n";
        return $this->estadoConexion;
    }
   
    function editarProducto($ID, $titulo, $descripcion, $precio)
    {
        $sql = "UPDATE `tb_producto` SET `titulo_producto` = '".$titulo."', `descripcion_producto` = '".$descripcion."', `precio_producto` = '".$precio."' WHERE `tb_producto`.`id_producto` = ".$ID.";";
        //echo "SQL: ".$sql;
        $result = $this->mysqlConexion->query($sql);
        //echo "<br><br>".$result;
        return $result;
    }

    function desactivarProducto($ID)
    {
        $sql = "UPDATE `tb_producto` SET `estado_producto` = '0' WHERE `tb_producto`.`id_producto` = ".$ID.";";
        //echo "SQL: ".$sql;
        $result = $this->mysqlConexion->query($sql);
        //echo "<br><br>".$result;
        return $result;
    }
    
    function consultarProductos2()
    {
        $sql = "select *, TIMESTAMPDIFF(DAY, fecha_creacion, now()) AS dias_transcurridos from tb_producto 
        inner join tb_existencias on tb_producto.id_producto = tb_existencias.id_producto_existencias
        order by dias_transcurridos, estado_producto DESC;";
        
        $result = $this->mysqlConexion->query($sql);
        $divHTML = "<div class='row'>";

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $diasTranscurridos = $row["dias_transcurridos"];
                $estado = $row["estado_producto"];
                $titulo = "";
                $label = "";
                //echo "FECHA diasTranscurridos: ".$diasTranscurridos."<br>";

                if($diasTranscurridos < 30)
                {
                    $titulo = "Nuevo";
                    $label = "new-label";
                }
                else
                {
                    if($estado == 1)
                    {
                        $titulo = "Activo";
                        $label = "active-label";
                    }
                    else
                    {
                        $titulo = "Inactivo";
                        $label = "sale-label";
                    }
                }

                $divHTML = $divHTML."<div class='col-xl-3 col-lg-4 col-md-6'>
                <div class='single-product'>
                    <div class='product-img'>
                        <span class='pro-label ".$label."'>".$titulo."</span>
                        <span class='pro-price-2'>$ ".$row["precio_producto"]."</span>
                        <a  data-bs-toggle='modal'  data-bs-target='#productModal' href='#productModal'><br><br><img src='".$row["imagen"]."' alt='' /></a>
                    </div>
                    <div class='product-info clearfix text-center'>
                        <div class='fix'>
                            <h4 class='post-title'><a href='#'>".$row["titulo_producto"]." ".$row["id_producto"]."</a></h4>
                        </div>
                        <div class='fix'>
                            <span class='pro-rating'>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                            </span>
                        </div>
                        
                        <div class='product-action clearfix'>
                            <button id='btnEditarProducto".$row["id_producto"]."' type='button' class='btn btn-primary' btnProductoIDEditar='".$row["id_producto"]."' btnProductoTituloEditar='".$row["titulo_producto"]."' btnProductoDescripcionEditar='".$row["descripcion_producto"]."' btnProductoPrecio='".$row["precio_producto"]."' btnProductoImagen='".$row["imagen"]."'>
                                <ion-icon name='build' onclick='mostrarModalModificar(".$row["id_producto"].")'></ion-icon>
                            </button>
                            <button id='btnEliminarProducto".$row["id_producto"]."' type='button' class='btn btn-danger' btnProductoID='".$row["id_producto"]."' btnProductoTitulo='".$row["titulo_producto"]."' btnProductoDescripcion='".$row["descripcion_producto"]."'>
                                <ion-icon name='trash' onclick='mostrarModalEliminar(".$row["id_producto"].")'></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>";
            }
            
            $divHTML = $divHTML."</div>";
            
            //echo $tablaHTML;
            //return $tablaHTML;
        }
        else
        {
            //echo "0 results";
            $divHTML = false;
        }
        
        return $divHTML;
    }




    function consultarProductosActivos()
    {
        $sql = "select *, TIMESTAMPDIFF(DAY, fecha_creacion, now()) AS dias_transcurridos from tb_producto 
        inner join tb_existencias on tb_producto.id_producto = tb_existencias.id_producto_existencias
        where estado_producto = 1
        order by dias_transcurridos, estado_producto DESC;";
        
        $result = $this->mysqlConexion->query($sql);
        $divHTML = "<div class='row'>";

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $diasTranscurridos = $row["dias_transcurridos"];
                $estado = $row["estado_producto"];
                $titulo = "";
                $label = "";
                //echo "FECHA diasTranscurridos: ".$diasTranscurridos."<br>";

                if($diasTranscurridos < 30)
                {
                    $titulo = "Nuevo";
                    $label = "new-label";
                }
                else
                {
                    if($estado == 1)
                    {
                        $titulo = "Activo";
                        $label = "active-label";
                    }
                    else
                    {
                        $titulo = "Inactivo";
                        $label = "sale-label";
                    }
                }

                $titulo = "Activo";
                $label = "active-label";

                $divHTML = $divHTML."<div class='col-xl-3 col-lg-4 col-md-6'>
                <div class='single-product'>
                    <div class='product-img'>
                        <span class='pro-label ".$label."'>".$titulo."</span>
                        <span class='pro-price-2'>$ ".$row["precio_producto"]."</span>
                        <a  data-bs-toggle='modal'  data-bs-target='#productModal' href='#productModal'><br><br><img src='".$row["imagen"]."' alt='' /></a>
                    </div>
                    <div class='product-info clearfix text-center'>
                        <div class='fix'>
                            <h4 class='post-title'><a href='#'>".$row["titulo_producto"]." ".$row["id_producto"]."</a></h4>
                        </div>
                        <div class='fix'>
                            <span class='pro-rating'>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                            </span>
                        </div>
                        
                        <div class='product-action clearfix'>
                            <button id='btnEditarProducto".$row["id_producto"]."' type='button' class='btn btn-primary' btnProductoIDEditar='".$row["id_producto"]."' btnProductoTituloEditar='".$row["titulo_producto"]."' btnProductoDescripcionEditar='".$row["descripcion_producto"]."' btnProductoPrecio='".$row["precio_producto"]."' btnProductoImagen='".$row["imagen"]."'>
                                <ion-icon name='build' onclick='mostrarModalModificar(".$row["id_producto"].")'></ion-icon>
                            </button>
                            <button id='btnEliminarProducto".$row["id_producto"]."' type='button' class='btn btn-danger' btnProductoID='".$row["id_producto"]."' btnProductoTitulo='".$row["titulo_producto"]."' btnProductoDescripcion='".$row["descripcion_producto"]."'>
                                <ion-icon name='trash' onclick='mostrarModalEliminar(".$row["id_producto"].")'></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>";
            }
            
            $divHTML = $divHTML."</div>";
            
            //echo $tablaHTML;
            //return $tablaHTML;
        }
        else
        {
            //echo "0 results";
            $divHTML = false;
        }
        
        return $divHTML;
    }





    function consultarProductosNuevos()
    {
        $sql = "select *, TIMESTAMPDIFF(DAY, fecha_creacion, now()) AS dias_transcurridos from tb_producto 
        inner join tb_existencias on tb_producto.id_producto = tb_existencias.id_producto_existencias
        where estado_producto = 1
        having dias_transcurridos < 30
        order by dias_transcurridos, estado_producto DESC;";
        
        $result = $this->mysqlConexion->query($sql);
        $divHTML = "<div class='row'>";

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $diasTranscurridos = $row["dias_transcurridos"];
                $estado = $row["estado_producto"];
                $titulo = "";
                $label = "";
                //echo "FECHA diasTranscurridos: ".$diasTranscurridos."<br>";

                if($diasTranscurridos < 30)
                {
                    $titulo = "Nuevo";
                    $label = "new-label";
                }
                else
                {
                    if($estado == 1)
                    {
                        $titulo = "Activo";
                        $label = "active-label";
                    }
                    else
                    {
                        $titulo = "Inactivo";
                        $label = "sale-label";
                    }
                }

                $titulo = "Nuevo";
                $label = "new-label";

                $divHTML = $divHTML."<div class='col-xl-3 col-lg-4 col-md-6'>
                <div class='single-product'>
                    <div class='product-img'>
                        <span class='pro-label ".$label."'>".$titulo."</span>
                        <span class='pro-price-2'>$ ".$row["precio_producto"]."</span>
                        <a  data-bs-toggle='modal'  data-bs-target='#productModal' href='#productModal'><br><br><img src='".$row["imagen"]."' alt='' /></a>
                    </div>
                    <div class='product-info clearfix text-center'>
                        <div class='fix'>
                            <h4 class='post-title'><a href='#'>".$row["titulo_producto"]." ".$row["id_producto"]."</a></h4>
                        </div>
                        <div class='fix'>
                            <span class='pro-rating'>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                            </span>
                        </div>
                        
                        <div class='product-action clearfix'>
                            <button id='btnEditarProducto".$row["id_producto"]."' type='button' class='btn btn-primary' btnProductoIDEditar='".$row["id_producto"]."' btnProductoTituloEditar='".$row["titulo_producto"]."' btnProductoDescripcionEditar='".$row["descripcion_producto"]."' btnProductoPrecio='".$row["precio_producto"]."' btnProductoImagen='".$row["imagen"]."'>
                                <ion-icon name='build' onclick='mostrarModalModificar(".$row["id_producto"].")'></ion-icon>
                            </button>
                            <button id='btnEliminarProducto".$row["id_producto"]."' type='button' class='btn btn-danger' btnProductoID='".$row["id_producto"]."' btnProductoTitulo='".$row["titulo_producto"]."' btnProductoDescripcion='".$row["descripcion_producto"]."'>
                                <ion-icon name='trash' onclick='mostrarModalEliminar(".$row["id_producto"].")'></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>";
            }
            
            $divHTML = $divHTML."</div>";
            
            //echo $tablaHTML;
            //return $tablaHTML;
        }
        else
        {
            //echo "0 results";
            $divHTML = false;
        }
        
        return $divHTML;
    }


    function consultarProductosDescontinuados()
    {
        $sql = "select *, TIMESTAMPDIFF(DAY, fecha_creacion, now()) AS dias_transcurridos from tb_producto 
        inner join tb_existencias on tb_producto.id_producto = tb_existencias.id_producto_existencias
        where estado_producto = 0
        order by dias_transcurridos, estado_producto DESC;";
        
        $result = $this->mysqlConexion->query($sql);
        $divHTML = "<div class='row'>";

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                $diasTranscurridos = $row["dias_transcurridos"];
                $estado = $row["estado_producto"];
                $titulo = "";
                $label = "";
                //echo "FECHA diasTranscurridos: ".$diasTranscurridos."<br>";

                if($diasTranscurridos < 30)
                {
                    $titulo = "Nuevo";
                    $label = "new-label";
                }
                else
                {
                    if($estado == 1)
                    {
                        $titulo = "Activo";
                        $label = "active-label";
                    }
                    else
                    {
                        $titulo = "Inactivo";
                        $label = "sale-label";
                    }
                }

                $titulo = "Inactivo";
                $label = "sale-label";

                $divHTML = $divHTML."<div class='col-xl-3 col-lg-4 col-md-6'>
                <div class='single-product'>
                    <div class='product-img'>
                        <span class='pro-label ".$label."'>".$titulo."</span>
                        <span class='pro-price-2'>$ ".$row["precio_producto"]."</span>
                        <a  data-bs-toggle='modal'  data-bs-target='#productModal' href='#productModal'><br><br><img src='".$row["imagen"]."' alt='' /></a>
                    </div>
                    <div class='product-info clearfix text-center'>
                        <div class='fix'>
                            <h4 class='post-title'><a href='#'>".$row["titulo_producto"]." ".$row["id_producto"]."</a></h4>
                        </div>
                        <div class='fix'>
                            <span class='pro-rating'>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                                <a href='#'><i class='zmdi zmdi-star-half'></i></a>
                            </span>
                        </div>
                        
                        <div class='product-action clearfix'>
                            <button id='btnEditarProducto".$row["id_producto"]."' type='button' class='btn btn-primary' btnProductoIDEditar='".$row["id_producto"]."' btnProductoTituloEditar='".$row["titulo_producto"]."' btnProductoDescripcionEditar='".$row["descripcion_producto"]."' btnProductoPrecio='".$row["precio_producto"]."' btnProductoImagen='".$row["imagen"]."'>
                                <ion-icon name='build' onclick='mostrarModalModificar(".$row["id_producto"].")'></ion-icon>
                            </button>
                            <button id='btnEliminarProducto".$row["id_producto"]."' type='button' class='btn btn-danger' btnProductoID='".$row["id_producto"]."' btnProductoTitulo='".$row["titulo_producto"]."' btnProductoDescripcion='".$row["descripcion_producto"]."'>
                                <ion-icon name='trash' onclick='mostrarModalEliminar(".$row["id_producto"].")'></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>";
            }
            
            $divHTML = $divHTML."</div>";
            
            //echo $tablaHTML;
            //return $tablaHTML;
        }
        else
        {
            //echo "0 results";
            $divHTML = false;
        }
        
        return $divHTML;
    }



    function consultarProductos()
    {
        $sql = "select * from tb_producto inner join tb_existencias on tb_producto.id_producto = tb_existencias.id_producto_existencias";
        
        $result = $this->mysqlConexion->query($sql);
        $tablaHTML = "<table id='example' class='table table-striped table-bordered' style='width:100%'>
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Existencias</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>";

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                //$tablaHTML = $tablaHTML + "id: " . $row["codigo"]. " - Name: " . $row["identificacionAgricultor"]. " " . $row["fechaSiembra"]. "<br>";
                
                $tablaHTML = $tablaHTML."<tr>
                                <td>".$row["id_producto"]."</td>
                                <td>".$row["titulo_producto"]."</td>
                                <td>".$row["descripcion_producto"]."</td>
                                <td>".$row["precio_producto"]."</td>
                                <td>".$row["estado_producto"]."</td>
                                <td>".$row["cantidad_existencias"]."</td>
                                <td>
                                    <button onclick='mostrarModalEditar(".$row["id_producto"].", \"".$row["precio_producto"]."\", \"".$row["estado_producto"]."\")' type='button' class='btn btn-warning'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-pen' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
</svg></button>
                                    <button onclick='mostrarModalEliminar(".$row["id_producto"].", \"".$row['titulo_producto']." ".$row['descripcion_producto']."\")' type='button' class='btn btn-danger'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z'/>
</svg></button>
                                </td>
                            </tr>";
            }
            
            $tablaHTML = $tablaHTML."</tbody>
                        <tfoot>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Existencias</th>
                            </tr>
                        </tfoot>
                    </table>";
            
            //echo $tablaHTML;
            //return $tablaHTML;
        }
        else
        {
            //echo "0 results";
            $tablaHTML = false;
        }
        
        return $tablaHTML;
    }
    
    function desconectarDB()
    {
        
    }
}
?>
