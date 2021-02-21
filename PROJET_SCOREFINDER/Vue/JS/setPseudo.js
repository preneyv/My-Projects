function setPseudo(pseudo){
	
	var formdata={
		"newPseudo":  pseudo.value,
	};
	
	$.ajax({
		url:"../../Controleur/modifParam.php",
		type:"POST",
		data:formdata,
		dataType:'JSON',
		encode:true,
		success: function(msg)
		{
			
			$("#pseudoUnstable").attr("id","pseudoStable");
			$("#pseudoStable").attr("onClick","changePseudo()");
			$(".valSpanPseudo").html(pseudo.value);
			
		},
		error: function(msg)
		{
				
				alert('Erreur'+msg);
				$("#pseudoUnstable").attr("id","pseudoStable");
				$("#pseudoStable").attr("onClick","changePseudo()");
				$(".valSpanPseudo").html(pseudo.value);
		}
	
});
}

function setStatutSpotify(value)
{
	
	var formdata={
		
		"onoffSpotify":  !$("#myonoffswitch2").attr("checked")	
	};
	
	$.ajax({
		type:"POST",
		url :"../../Controleur/modifParam.php",
		data:formdata,
		dataType: 'JSON',
		encode:true,
		success: function(msg)
		{
			if($("input[name="+value.name+"]").prop('checked'))
			{
				
				document.location.href = "../../Controleur/initSpotify.php";
			}
				
		},
		error: function(msg)
		{
			
			if($("input[name="+value.name+"]").prop('checked'))
			{
				
				$("input[name="+value.name+"]").prop('checked', false);
			}else{
				$("input[name="+value.name+"]").prop('checked', true);
			}
		}
	});
}

function setStatutDeezer(value)
{
	
	var formdata={
		
		"onoffDeezer" : $("#myonoffswitch").is(":checked")		
	};
	
	$.ajax({
		type:"POST",
		url :"../../Controleur/modifParam.php",
		data:formdata,
		dataType: 'JSON',
		encode:true,
		success: function(msg)
		{
			if($("input[name="+value.name+"]").prop('checked'))
			{
				
				document.location.href = "../../Controleur/loadDeezer.php";
			}			
		},
		error: function(msg)
		{
			
			if($("input[name="+value.name+"]").prop('checked'))
			{
				
				$("input[name="+value.name+"]").prop('checked', false);
			}else{
				$("input[name="+value.name+"]").prop('checked', true);
			}
		}
	});
}


function apparaitreChampsNewPw(div)
{
	var id = $(div).attr("id");
	var divCourante = $('.'+id);
	$(div).removeClass("mdpDivNonAffiche");
	$(div).addClass("mdpDivAffiche").queue(function(){
		divCourante.slideDown();
		$(this).dequeue();
	});
	

}

$(document).mouseup(function(e){

	var container = $(".saisieNewMdp");
	var container2= $(".seDeco");

    if (!container.is(e.target) && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $('.saisieNewMdp').slideUp().queue(function(){

        	var button = $('.mdpDivAffiche');
	        $(button).removeClass("mdpDivAffiche");
		    $(button).addClass("mdpDivNonAffiche");
			$('#pw').val("");
			$('#mdpconf').val("");
			$(".saisieNewMdp .erreurMdp").text("");
			$(".saisieNewMdp .mdpChange").text("");
			$(this).dequeue();
        });
        
    }

   

});


