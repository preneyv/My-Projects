  if(window.location.hash) {
	  
      var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
	  hash = hash.split("|")[1]; 
	  var accessToken = hash.split("&")[0]; 
	  atValue = accessToken.split("=")[1];
	  
	  var expires = hash.split("&")[1]; 
	  eValue = expires.split("=")[1];
      
	  window.location.href = ("http://localhost/scorefinder/Controleur/loadDeezer.php?accessToken="+atValue+"&expires="+eValue);

	  
  } 