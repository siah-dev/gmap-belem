var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

	//INICIALIZAR MAPA
	function initialize(json) {	
		var latlng = new google.maps.LatLng(-3.625066, -52.4812983);
						
		var options = {
						zoom: 5,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP						
		};
					
		map = new google.maps.Map(document.getElementById("mapa"), options);
		carregarPontos(json);

	}
		
	//INFOBOX
	function abrirInfoBox(id, marker) {
			if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
				infoBox[idInfoBoxAberto].close();
			}
					
			infoBox[id].open(map, marker);
			idInfoBoxAberto = id;	
	}
	
	//CARREGAR OS PONTOS NO MAPA
	function carregarPontos(response) {
				$.each(response, function(index,ponto) {
                    var str = String(ponto.cod_cidade);
                    var res = str.split("");
                    var stringRes = res[0]+''+res[1]+''+res[2]+''+res[3]+''+res[4]+''+res[5];
                    var urlCnes = "http://cnes2.datasus.gov.br/Exibe_Ficha_Estabelecimento.asp?VCo_Unidade="+stringRes+ponto.cnes+"";
                    var latlngbounds = new google.maps.LatLngBounds();
                    var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(ponto.latitude, ponto.longitude),
                                title: ponto.nome_hospital,
                                icon: '../img/marcadores/'+ponto.tipoEstabelecimento.img+''
                            });
                    var myOptions = {
                                content: '',
                                pixelOffset: new google.maps.Size(-150, 0)
                            };
					
                    infoBox[ponto.id] = new InfoBox(myOptions);
                    infoBox[ponto.id].marker = marker;
								
						/*
						infoBox[ponto.id].listener = google.maps.event.addListener(marker, 'click', function (e) {
								abrirInfoBox(ponto.id, marker);
						});
						*/
								
                    //QUANDO CLICA NO MARCADOR, ABRE UMA SOLICITACAO AJAX PARA O CONTROLLER UNIDADES ACTION LEITOS
                    google.maps.event.addListener(marker, 'click', function (e) {
                        $.ajax({
                            url: '../unidades/detalhes?id='+ponto.id+'&crs='+ponto.crs,
                            method: 'GET',
                            dataType: 'html'
                        }).done(function(response){
                        //REMOVE AS ASPAS QUE ESTÃO VINDO COMO RETURN DO PHP
                            response = response.substring(1);
                            response = response.substring(0,(response.length - 1));
                            //console.log(response);
                            $('.cnes-modal').html("<a class='btn btn-primary btn-xs' style='float:left' href="+urlCnes+" target='_blank'>CNES</a><a class='btn btn-primary btn-xs' style='float:left' href='../unidades/perfil?id="+ponto.id+"' target='_blank'>Perfil da Unidade</a><button type='button' class='btn btn-primary' data-dismiss='modal'>OK</button>");
                            $('.modalLeitosBody').html(response);
                            $('#modalLeitos').modal('show');
                        }).error(function(){
                            alert('Nenhum leito cadastrado!');
                        });

                    });
                    markers.push(marker);

                    latlngbounds.extend(marker.position);

                });

        var markerCluster = new MarkerClusterer(map, markers,{imagePath: '../img/m'});
        map.fitBounds(latlngbounds);
				
	}
function isolaUnidade(latitude,longitude){
	var foco = new google.maps.LatLng(latitude,longitude);
	map.setCenter(foco);
	map.setZoom(15);
}