$(document).ready(function(e) {
    $('#initMapa').on('click',function(){		
		//MOSTRAR LEGENDA 
			$('.container-legend').fadeIn('slow');
			//LIMPAR MARCADORES NO MAPA
			limparMarcadores();
		});
		$('a.leitosViewQtip').qtip({
			content:{
				text: 'Carregando...',
				ajax: {
						url: $('.leitosViewQtip').attr('href'),
						type: 'GET',
						dataType: 'html',
						success: function(data,status){
							var content = data;
							this.set('content.text',content);	
						}		
					}	
			},
			position:{
				my: 'center right',
				at: 'center left'	
			}	
		});
});

//FUNCTIONS
function getCRS(){
	var crs = [];
	$('#crs:checked').each(function(index, element) {
    	crs[index] = $(this).val();    
    });
	//console.log(crs);
	return crs;
}

function limparMarcadores(){
	//LIMPAR MARCADORES NO MAPA
		if (markers) {
			for (i in markers) {
				markers[i].setMap(null);
			}
		}
		markers.length = 0;	
}

function montarFiltros(x){
	var a = '';
	$.each(x,function(i,v){
		a += '<div class=\'legend\'><label><input type=\'checkbox\' name=\'tipo_estabelecimento[]\' id=\'filtroLegenda\' value="'+v.tipoEstabelecimento.id+'" onclick=\'ajaxRequestLegendas()\' ><img src=\"../img/marcadores/'+v.tipoEstabelecimento.img+'" alt="'+v.tipoEstabelecimento.tipo+'" />'+v.tipoEstabelecimento.tipo+'</label></div>';	
	});
	return a;
}

function marcardesmarcar(){
  $('input[type=checkbox][id=crs]').each(
         function(){
           if ($(this).prop("checked")){ 
           $(this).prop("checked", false);
		   $('label.marcar').each(function(){
				$(this).removeClass('active');   
			});
		   }
           else{
		   $(this).prop("checked", true);
		   $('label.marcar').each(function(){
				$(this).addClass('active');   
			});
		   }
         }
    );
}