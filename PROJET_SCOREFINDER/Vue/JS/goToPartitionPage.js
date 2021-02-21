function goToPartition(elt){

	
	var figure = $(elt).parent('#album_et_titre');
	
	var li = figure.find('img');
	var eCaption = figure.find('figcaption');
	

	
	
	var formData={
		'nomArtiste' : $(eCaption[2]).text(),
		'nomAlbum' : $(eCaption[1]).text(),
		'nomTrack' : $(eCaption[0]).text(),
		'urlImage' : li.attr('src')

	};

	console.log(formData);
	$.ajax({
		url:"../../Controleur/goToPartition.php",
		type:"POST",
		data:formData,
		dataType:'html',
		encode:true,
		success: function(msg)
		{
			
			document.location.href="LaPartition.php";
		},
		error: function(msg)
		{
				
				alert('Erreur'+msg);
		}
	
});
}