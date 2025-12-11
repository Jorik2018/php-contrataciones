var urlBase = getAbsolutePath();
var obtenerRutaBase=urlBase.split("views");
var rutaBase=obtenerRutaBase[0];
var mostraMensajeBusqueda=true;

var colBusqueda = [
    { "title": 'NRO',                        "data": 'numero',          "className": "dt-center", "targets": "_all" },
        
    { "title": "PROCESO",                    "data": "deProceso",       "className": "dt-center", "targets": "_all"},
    { "title": "TIPO",                       "data": "deTipo",          "className": "dt-center", "targets": "_all"},
    { "title": "DESCRIPCION RESPUESTA",      "data": "deRespuesta",     "className": "dt-center", "targets": "_all"},
    { "title": "ARCHIVO",                    "data": "noArchivo",      "className": "dt-center", "targets": "_all"},
    
    { "title": "ID CONVOCATORIA",            "data": "idConvocatoria",  "visible": false},    
    { "title": "ID RESPUESTA",               "data": "idRespuesta",  "visible": false}
];

function loadTable(data){
    
    let table = new DataTable('#tResultRespuesta'); 

    if (table) {
	    table.destroy();
	    $('#tResultRespuesta > tbody').empty();
    }
	
    table = $('#tResultRespuesta').DataTable( {
    	scrollX: true,
        searching: false,
        iDisplayLength: 5,
        //dom: "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6 text-right'B>><'row be-datatable-body'<'col-sm-12'tr>><'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
        bLengthChange: false,        
        language: {
                    "lengthMenu": '_MENU_ items por página',
                    "search": '<i class="fa fa-search"></i>',
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Total de registros: _TOTAL_",
                    "sInfoEmpty":      "",
                    "sInfoFilteminT":   "(filtrado de un total de _MAX_ registros)",
                    "sLoadingRecords": "Cargando...",
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
        bSort: false,
        paging: true,
        data: data,
        select: true,
        columns: colBusqueda
    });
};
function limpiar(){
    $("#tipo, #proceso").val("").change();
    $("#descripcion, #archivo").val("");
    $('#formRespuesta').removeClass('was-validated');
};
function limpiarBusqueda(){
    $("#procesoBus").val("").change();
    $("#tipoBus").val("0").change();
    $("#descripcionBus").val("");
    tablaInical();
};
function cargar_proceso() {
    $.post(rutaBase+'controllers/respuestas.php?op=selectP', function (data) {        
        $("#proceso").html(data);
        $("#procesoBus").html(data);
    });
};
function tablaInical(){
    var miJson=[];
    loadTable(miJson);
};
function cargarTablaData(json){
    var miJson=[];
    $.each(json, function(key,reg) {
        miJson.push(reg);
    });
    loadTable(miJson);
};
function busquedaRespuesta(){
    
    tablaInical();
    if(mostraMensajeBusqueda){
        mostrarModalBarraCarga("modalBarraProgreso", "Se esta procesando su busqueda, por favor esperar...");
    }    

    var procesoBus = $.trim($("#procesoBus").val());
    var tipoBus = $.trim($("#tipoBus").val());
    var descripcionBus = $.trim($("#descripcionBus").val());
    
    if( procesoBus=="" && tipoBus=="" && descripcionBus=="" ){
        
        $.ajax({
            url: rutaBase+'controllers/respuestas.php?op=getRespuesta',
            type: 'GET',
            dataType: "json",
            success: function (response) {
                
                if(mostraMensajeBusqueda){
                    ocultarModalBarraCarga("modalBarraProgreso");
                }
                if(response.nrofila>0){
                    cargarTablaData(response.json);
                }else{
                    tablaInical();
                }
            },
            error: function () {
                if(mostraMensajeBusqueda){
                    ocultarModalBarraCarga("modalBarraProgreso");
                }
                mostrarModalMensaje("modalMensaje", "Error al procesar la busqueda, invocar la funcion getRespuesta", true);
            }
        });

    }else{
        
        if( procesoBus=="" ){ procesoBus="NO"; }
        if( tipoBus=="0" ){ tipoBus="NO"; }
        if( descripcionBus=="" ){ descripcionBus="NO"; } 

        $.ajax({
            url: rutaBase+'controllers/respuestas.php?op=getRespuestaData',
            type: 'GET',
            data: {
                idProceso:procesoBus,
                Tipo:tipoBus,
                deRespuesta:descripcionBus
            },
            dataType: "json",
            success: function (response) {
                
                ocultarModalBarraCarga("modalBarraProgreso");
                if(response.nrofila>0){
                    cargarTablaData(response.json);
                }else{
                    tablaInical();
                }
                
            },
            error: function () {
                ocultarModalBarraCarga("modalBarraProgreso");
                mostrarModalMensaje("modalMensaje", "Error al procesar la busqueda, invocar la funcion getRespuestaData", true);
            }
        });
    }
};

$(document).ready(function () {
    
    cargar_proceso();
    tablaInical();
	
	$("#proceso").select2();
	$("#procesoBus").select2();

    $('#btoLimpiarBus').unbind("click").click(function(){
        limpiarBusqueda();
    });

    $('#btoLimpiar').unbind("click").click(function(){
        limpiar();
    });

    $('#btoBuscar').unbind("click").click(function(){
        busquedaRespuesta();
    });

    $('#btoGrabar').unbind("click").click(function(){
        var grabacion = false;
        if( document.getElementById("formRespuesta").checkValidity() /*&& selProValue!="0" && selTipValue!="0"*/ ){  
            mostrarModalMensaje("modalMensaje", "¿Está seguro de guardar, este nuevo registro respuesta?", grabacion); 
        }else{
            $('#formRespuesta').addClass('was-validated');            
        }  
    });

    $('#btoGrabarFinal').unbind("click").click(function(){
        $("#modalCovocatoria").modal('hide');
        $("#btoGrabar").attr("disabled","disabled");
        $("#formRespuesta").submit();        
    });

    $('#formRespuesta').on('submit', function (e) {
        e.preventDefault();
        if (this.checkValidity()) {
            // Crear un objeto FormData para incluir el archivo
            let formData = new FormData(this);

            $.ajax({
                url: rutaBase+'controllers/respuestas.php?op=guardaryeditar',
                type: 'POST',
                data: formData, // Enviar el objeto FormData
                processData: false, // Evitar que jQuery procese los datos
                contentType: false, // Evitar que jQuery agregue encabezados innecesarios
                success: function (response) {
                    
                    mostraMensajeBusqueda=false;
                    limpiar();
                    limpiarBusqueda();
                    busquedaRespuesta();
                    $("#btoGrabar").removeAttr("disabled");

                    mostrarModalMensaje("modalMensaje", "Respuesta grabación exitosa.", true); 
                    mostraMensajeBusqueda=true;
                },
                error: function (response) {
                    $("#btoGrabar").removeAttr("disabled");
                    mostrarModalMensaje("modalMensaje", "Error en el proceso de guardar nueva respuesta.", true); 
                    //console.log(response);
                }
            });
        }
        $(this).addClass('was-validated');
    });
});

