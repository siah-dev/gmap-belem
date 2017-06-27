function handleAjaxLink(e) {
    e.preventDefault();

    var
        $link = $(e.target),
        callUrl = '../site/mapa?crs='+getCRS(),
        formId = $link.data('formId'),
        onDone = $link.data('onDone'),
        onFail = $link.data('onFail'),
        onAlways = $link.data('onAlways'),
        ajaxRequest;
    ajaxRequest = $.ajax({
        type: "post",
        dataType: 'json',
        url: callUrl,
        data: (typeof formId === "string" ? $('#' + formId).serializeArray() : null)
    });
    // Assign done handler
    if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
        ajaxRequest.done(ajaxCallbacks[onDone]);
    }
    // Assign fail handler
    if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
        ajaxRequest.fail(ajaxCallbacks[onFail]);
    }
    // Assign always handler
    if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
        ajaxRequest.always(ajaxCallbacks[onAlways]);
    }

}

function handleAjaxLinkTrs(e) {
    e.preventDefault();
    var
        $link = $(e.target),
        callUrl = '../mapa/trs?crs='+getCRS(),
        formId = $link.data('formId'),
        onDone = $link.data('onDone'),
        onFail = $link.data('onFail'),
        onAlways = $link.data('onAlways'),
        ajaxRequest;
    ajaxRequest = $.ajax({
        type: "post",
        dataType: 'json',
        url: callUrl,
        data: (typeof formId === "string" ? $('#' + formId).serializeArray() : null)
    });

    console.log($('#' + formId).serializeArray());

    // Assign done handler
    if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
        ajaxRequest.done(ajaxCallbacks[onDone]);
    }
    // Assign fail handler
    if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
        ajaxRequest.fail(ajaxCallbacks[onFail]);
    }
    // Assign always handler
    if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
        ajaxRequest.always(ajaxCallbacks[onAlways]);
    }

}

var ajaxCallbacks = {
	 'simpleDone': function (response) {
					// This is called by the link attribute 'data-on-done' => 'simpleDone'
					//OBJETO RETORNADO DA ROTA SITE/MAPA
					var obj = $.parseJSON(response);
					var unidades = "";
					$.each(obj.unidades,function(index,value){
							unidades += '<h5><a href=\'#\' onclick=\'isolaUnidade('+value.latitude+','+value.longitude+')\'>'+value.nome_hospital+'</a> <small>('+value.crs0.nome+') - <a class=\'btn btn-default btn-xs\' href='+value.urlCnes+' target=\'_blank\' role=\'button\'>CNES</a></small></h5>';
						});
					$('#unidades_saudeContainer').show();
					$('.unidades_saude').html(unidades);
					//IDENTIFICAÇÃO DO LOCAL
					var txt = '<ul class=\'myLocation\'>Local: ';
					$.each(obj.regioes,function(index,value){
						txt += '<li>'+value.nome+'</li>';
					});
					txt += '</ul>';
					//console.log(txt);
					$('#ident_local').html(txt);
					//MONTA OS FILTROS POR ESTABELECIMENTO			
					var filtros = montarFiltros(obj.estabelecimentos);	
					$('.container-legend').html(filtros);
					//INICIA O MAPA
					google.maps.event.addDomListener(window, 'load', initialize(obj.unidades));
     },
    'simpleDoneTrs': function (response) {
                    // This is called by the link attribute 'data-on-done' => 'simpleDone'
                    //OBJETO RETORNADO DA ROTA SITE/MAPA
                    var obj = $.parseJSON(response);
                    console.log(obj);
                    var unidades = "";
                    $.each(obj.unidades,function(index,value){
                        unidades += '<h5><a href=\'#\' onclick=\'isolaUnidade('+value.latitude+','+value.longitude+')\'>'+value.nome_hospital+'</a> <small>('+value.crr0.regionais+') - <a class=\'btn btn-default btn-xs\' href='+value.urlCnes+' target=\'_blank\' role=\'button\'>CNES</a></small></h5>';
                    });
                    $('#unidades_saudeContainer').show();
                    $('.unidades_saude').html(unidades);
                    //IDENTIFICAÇÃO DO LOCAL
                    var txt = '<ul class=\'myLocation\'>Local: ';
                    $.each(obj.regioes,function(index,value){
                        txt += '<li>'+value.regionais+'</li>';
                    });
                    txt += '</ul>';
                    //console.log(txt);
                    $('#ident_local').html(txt);
                    //MONTA OS FILTROS POR ESTABELECIMENTO
                    var filtros = montarFiltros(obj.estabelecimentos);
                    $('.container-legend').html(filtros);
                    //INICIA O MAPA
                    google.maps.event.addDomListener(window, 'load', initialize(obj.unidades));
                    }
    }

function ajaxRequestLegendas(){
	var dados = $('#filtroLegenda:checked').serializeArray();
	//console.log(dados);
	$.ajax({
        method: "post",
        dataType: 'json',
        url: '../site/mapa?crs='+getCRS(),
        data: dados
    }).done(function(response){
		//console.log(response);
		limparMarcadores();
		var obj = $.parseJSON(response);
		google.maps.event.addDomListener(window, 'load', initialize(obj.unidades));
	});
}


