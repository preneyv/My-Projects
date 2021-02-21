function verifMdpTempsReel(champ)
{
	var mdpConf = ($(champ));
	var mdp = ($($(champ).prev()).prev());
	if(mdp.val().length>0)
	{
		
		if(mdpConf.val().length>0)
		{
			if(mdpConf.val().indexOf(mdp.val())==-1 || mdp.val().indexOf(mdpConf.val())==-1)
			{
				
				$(champ).css("background-color","#FA988C");
			
			}else{

				$(champ).css("background-color","#FFF");
			}

		}else{

			$(champ).css("background-color","#FFF");
		}
		
	}
}

function saisieMdpConf(champ)
{
	var next = $($(champ).next()).next();

	if(champ.value.length>0)
	{
		next.attr('disabled', false);
	}

	if(champ.value.length==0)
	{
		next.attr('disabled', true);
		next.val("");
		next.css("background-color","#FFF");
	}
}

function verifEtSaisieMdpTempsReel(champ)
{
	var next = $($(champ).next()).next();
	saisieMdpConf(champ);
	verifMdpTempsReel(next);
}

function verifMdp(champ1, champ2)
{
	var ret =true;
	if(champ1.value.length>0 && champ2.value.length>0)
	{
		if(champ1.value.indexOf(champ2.value)==-1)
		{
			$(".erreurMdp").html("Les mot de passe ne correspondent pas<br>");
			ret=false;
		}

	}else{
			$(".erreurMdp").html("Veuillez renseigner un mot de passe<br>");
			ret=false;
	}
	return ret;
}
function verifMail(champ)
{
	var ret=true;
	
	if(champ.value.length>0)
	{
		var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
		if(!regex.test(champ.value))
		{
				$('#erreurMail').html("L'adresse mail n'est pas correcte<br>");
				ret=false;
				
		}else{

			
			$('#erreurMail').html("");
		}
	}else{

		$('#erreurMail').html("L'adresse mail n'a pas été saisie<br>");
		ret=false;
	}
	return ret;
}

function verifEntrerText(champ)
{
	var ret = true;
	if(champ.value.length<=0)
	{
		$("#erreur"+champ.id).html('Veuillez saisir un '+champ.id+'<br>');
		ret =false;
	}
	return ret;
}

function validerForm(f)
{
	
	var pseudoOK = verifEntrerText(f.Pseudo);
	var nomOK = verifEntrerText(f.Nom);
	var mdpOk=verifMdp(f.mdp, f.mdpConf);
	var prenomOK = verifEntrerText(f.Prenom);
	var mailOK = verifMail(f.email)
	
	if( pseudoOK && nomOK && prenomOK && mailOK && mdpOk)
	{
		return true;
	}else{
		return false;
	}

}


function validerFormSaisieNewMdp(form)
{
	var mdpOk=verifMdp(form.mdp, form.mdpConf); 
	if(mdpOk)
	{
		setMotDePasse(form.mdp);
		$(".saisieNewMdp .erreurMdp").text("");
		event.preventDefault();
		return true;
	}else{
		return false;
	}
}

function setMotDePasse(mdp){
	
	var formdata={
		"newMotDePasse":  mdp.value,
	};

	$.ajax({
		url:"../../Controleur/modifParam.php",
		type:"POST",
		data:formdata ,
		dataType: 'JSON',
		encode:true,
		success: function(msg)
		{
			
			$("#mdpChange").html("Le mot de passe a bien été modifié");
			
			
		},
		error: function(msg)
		{
				alert(msg);
				$("#mdpChange").html("Une erreur a eu lieu lors du changement de mot de passe");
		}
	
	});
}
