function ajouterFavoris(btnClique){

	var figure = $(btnClique).parents('.titre_courant').find("#album_et_titre");
	console.log(figure);
	var li = figure.find('img');
	var eCaption = figure.find('figcaption');
	console.log(eCaption[0]);
	
		var tr = eCaption[0];
		var alb = eCaption[1];
	    var art = eCaption[2];
	    var url= li.attr('src');

	var formdata ={

		'tr' : tr.innerHTML,
		'alb' : alb.innerHTML,
	    'art' : art.innerHTML,
	    'url' : url
	}
	console.log(formdata);
	$.ajax({
		url:"../../Controleur/ajouterFavoris.php",
		type:"POST",
		data:formdata,
		dataType:'html',
		encode:true,
		success: function(msg)
		{
			
			if(msg==="ajouter")
			{	
				$('#liste_Favoris ul').load('../../Controleur/afficheTrackFav.php?cookie='+$.cookie('favoris'));
			}else{
					//alert("Track déjà présent dans les favoris");
					favExist(btnClique);
			}
			
			
		},
		error: function(msg)
		{
				
				alert('Erreur'+msg);
			
		}
	
	});
	
}


function supprimerFavoris(btnClique){

	var figure = $(btnClique).parents('.titre_courant').find("#album_et_titre");
	
	var li = figure.find('img');
	var eCaption = figure.find('figcaption');
	
	
		var tr = eCaption[0];
		var alb = eCaption[1];
	    var art = eCaption[2];
	    var url= li.attr('src');

	var formdata ={

		'tr' : tr.innerHTML,
		'alb' : alb.innerHTML,
	    'art' : art.innerHTML,
	    'url' : url
	}
	console.log(formdata);
	$.ajax({
		url:"../../Controleur/supprFavoris.php",
		type:"POST",
		data:formdata,
		dataType:'html',
		encode:true,
		success: function(msg)
		{
			
				
				$('#liste_Favoris ul').load('../../Controleur/afficheTrackFav.php?cookie='+$.cookie('favoris'));
			
			
			
		},
		error: function(msg)
		{
				
				alert('Erreur'+msg);
			
		}
	
	});
	
}

function exist(cookie, nouvelleEntrée)
{
	var res = false;
	for(var i =0; i<cookie.length; i++)
	{
		var tabTrack = JSON.parse(cookie[i]);
		if((tabTrack[1].toUpperCase() == nouvelleEntrée[1].toUpperCase()) && (tabTrack[2].toUpperCase() == nouvelleEntrée[2].toUpperCase()) && (tabTrack[3].toUpperCase() == nouvelleEntrée[3].toUpperCase()))
		{
			res = true;
		}
	}
	return res;
}

function favExist(btnClique)
{
	if($(btnClique).is('input'))
	{


		var valBtnBefChange = $(btnClique).val();
		var colorBtnBefChange = $(btnClique).css("background-color");
		
		$(btnClique).fadeTo("slow",0.1, function(){

			$(btnClique).val("Déjà ajouté aux favoris");
			$(btnClique).css("background-color", "#FF5E42");
			$(btnClique).css("border", "solid 3px #FF352F");
			
		});
		$(btnClique).fadeTo("slow",1);
		$(btnClique).delay(1000);
		$(btnClique).fadeTo("slow",0.1, function(){

			$(btnClique).val(valBtnBefChange);
			$(btnClique).css("background-color", colorBtnBefChange);
			$(btnClique).css("border", "none");
			
		});
		$(btnClique).fadeTo("slow",1);
	}
}