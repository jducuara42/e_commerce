$(document).ready(function() 
{
    cargarProductos();
    cargarProductosActivos();
    cargarProductosNuevos();
    cargarProductosDescontinuados();
});

function cargarProductos()
{
    $.get('/e_commerce/backend/conexion.php', { funcion : "consultarProductos2" }, function(respuesta) 
    {
        //console.log("get: " + respuesta);
        $("#divProductosTodos").html(respuesta);
    });
}

function cargarProductosActivos()
{
    $.get('/e_commerce/backend/conexion.php', { funcion : "consultarProductosActivos" }, function(respuesta) 
    {
        //console.log("get: " + respuesta);
        $("#divProductosActivos").html(respuesta);
    });
}

function cargarProductosNuevos()
{
    $.get('/e_commerce/backend/conexion.php', { funcion : "consultarProductosNuevos" }, function(respuesta) 
    {
        //console.log("--get: " + respuesta);
        $("#divProductosNuevos").html(respuesta);
    });
}

function cargarProductosDescontinuados()
{
    $.get('/e_commerce/backend/conexion.php', { funcion : "consultarProductosDescontinuados" }, function(respuesta) 
    {
        console.log("--get: " + respuesta);
        $("#divProductosDescontinuados").html(respuesta);
    });
}

function agregarProducto()
{
    var titulo = $("#inputAgregarTitulo").val();
    var descripcion = $("#inputAgregarDescripcion").val();
    var precio = $("#inputAgregarPrecio").val();
    var imagen = $("#inputGroupFile01").val();

    console.log("titulo: " + titulo);
    console.log("descripcion: " + descripcion);
    console.log("precio: " + precio);
    console.log("imagen: " + imagen);
}

function editarInfoProducto()
{
    //alert("Actualizar info...");
    var ID = $("#exampleModalLabel").text();
    var titulo = $("#inputEditarTitulo").val();
    var descripcion = $("#inputEditarDescripcion").val();
    var precio = $("#inputEditarPrecio").val();
    var imagen = $("#inputGroupFile01").val();

    console.log("ID: " + ID);
    console.log("titulo: " + titulo);
    console.log("descripcion: " + descripcion);
    console.log("precio: " + precio);
    console.log("imagen: " + imagen);

    $.get('/e_commerce/backend/conexion.php', { 
        funcion : "editarProducto", 
        IDProducto : ID,
        tituloProducto: titulo,
        descripcionProducto: descripcion,
        precioProducto: precio
    }, function(resp) 
    {
        console.log("get-D: " + resp);
        //resp = 1;
        
        if(resp)
        {
            $.confirm(
            {
                title: 'Exito  :)',
                icon: 'fa fa-thumbs-o-up',
                content: 'Se actualizo el producto ' + ID + ' de la base de datos...',
                type: 'green',
                typeAnimated: true,
                buttons: 
                {
                    close: function () {cargarProductos();}
                }
            });
        }
        else
        {

            $.confirm(
            {
                title: 'Error  :(',
                icon: 'fa fa-warning',
                content: 'No se pudo actualizar el producto ' + ID + ' de la base de datos, intente mas tarde...',
                type: 'red',
                typeAnimated: true,
                buttons: 
                {
                    close: function () {}
                }
            });
        }
        
        //$('#myModalEliminarConfirmacion').modal('show');
        cargarProductos();
    });
}

function RegistroDelete2()
{
    var ID = $("#btnEliminar").attr( "valueID" );
	console.log("ID: " + ID);
    
    $.get('http://192.168.64.3/e_commerce/backend/conexion.php', { funcion : "desactivarProducto", IDProducto : ID }, function(resp) 
    {
        //console.log("get-D: " + resp);
        //resp = 1;
        
        if(resp)
        {
            $.confirm(
            {
                title: 'Exito  :)',
                icon: 'fa fa-thumbs-o-up',
                content: 'Se desactivo la planta ' + ID + ' de la base de datos...',
                type: 'green',
                typeAnimated: true,
                buttons: 
                {
                    close: function () {}
                }
            });
        }
        else
        {

            $.confirm(
            {
                title: 'Error  :(',
                icon: 'fa fa-warning',
                content: 'No se pudo desactivar el producto ' + ID + ' de la base de datos, intente mas tarde...',
                type: 'red',
                typeAnimated: true,
                buttons: 
                {
                    close: function () {}
                }
            });
        }
        
        //$('#myModalEliminarConfirmacion').modal('show');
        refrescarDatos();
    });
    
}