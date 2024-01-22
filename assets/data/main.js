$(document).ready(function() {   
	 
    $('#example').DataTable({        
		
		
		info:false,
		
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
			{
				extend:    'pdfHtml5',
				text:      '<i class="bi bi-file-earmark-pdf-fill"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend: 'excelHtml5',
				text: '<i class="bi bi-file-earmark-excel-fill"></i> ', // Ícono de Excel
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'print',
				text:      '<i class="bi bi-printer-fill"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			}
			
		]	        
    });     

	$('#example2').DataTable({
	
	
		info: false,
		
		language: {
			"lengthMenu": "Mostrar _MENU_ registros",
			"zeroRecords": "No se encontraron resultados",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch": "Buscar:",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"sProcessing": "Procesando...",
		},
		//para usar los botones   
		responsive: "true",
		dom: 'Bfrtilp',
		buttons: [
			{
				extend: 'pdfHtml5',
				text: '<i class="bi bi-file-earmark-pdf-fill"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend: 'excelHtml5',
				text: '<i class="bi bi-file-earmark-excel-fill"></i> ', // Ícono de Excel
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend: 'print',
				text: '<i class="bi bi-printer-fill"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			}
			]
	});
});