function changePDF(div, tab)
{
	
	var instru = $(div).children().text();
	console.log (tab);
	var tabURLPDF = tab;
	$('#pdfPartition').children().remove();

	switch(instru)
	{
		case "Piano" :  
						if(tabURLPDF['Piano']!="")
						{
								$('#pdfPartition').html("<iframe src="+tabURLPDF['Piano']+"></iframe>");
						}else{
								$('#pdfPartition').html("<div class='noPDF'><span>Aucune partition trouvée pour cet instrument</span></div>");

						}
						break;
		case "Guitare" :  
						if(tabURLPDF['Guitare']!="")
						{
								$('#pdfPartition').html("<iframe src="+tabURLPDF['Guitare']+"></iframe>");
						}else{
								$('#pdfPartition').html("<div class='noPDF'><span>Aucune partition trouvée pour cet instrument</span></div>");
						}
						break;
		case "Basse" :  
						if(tabURLPDF['Basse']!="")
						{
								$('#pdfPartition').html("<iframe src="+tabURLPDF['Basse']+"></iframe>");
						}else{
								$('#pdfPartition').html("<div class='noPDF'><span>Aucune partition trouvée pour cet instrument</span></div>");
						}
						break;
	}

	var parentDivs = $('#tabTypeScore').children();

	parentDivs.each(function(){

			$(this).css("background-color", "#03abd5");
			$(div).removeClass("pdfActif");

	});
	$(div).css("background-color", "#90BBf7");
	$(div).addClass("pdfActif");
	
}


function chargePart(tab)
{

	
	var tabURLPDF = tab;

	for(var i in tabURLPDF)
	{
		if(tabURLPDF['Piano'].length>0)
		{
			$('#Piano').click();
		}else{

			if(tabURLPDF['Guitare'].length>0)
			{
				$('#Guitare').click();

			}else if(tabURLPDF['Basse'].length>0){

				$('#Basse').click();
			}else{
				$('#pdfPartition').html("<div class='noPDF'><span>Aucune partition trouvée pour cette musique</span></div>");
						
			}
		}
	}


}


