

$(document).ready(function(e){

	
	$('.param').click(function(e){
		
	     
	        if($('.panneauParam').hasClass('nonafficheParam'))
	        {
	        	$('.panneauParam').addClass('afficheParam');
	        	$('.panneauParam').removeClass('nonafficheParam');
	        }
	        
	        
	    });

	$('body').click(function(e){
		
		
	     
			var container = $('.panneauParam');
			var container2 = $('.param');

			if ((!container.is(e.target) && container.has(e.target).length === 0)&& (!container2.is(e.target) && container2.has(e.target).length === 0))// ... nor a descendant of the container
	    	{
				if($('.panneauParam').hasClass('afficheParam'))
	     		{
		        
		        	 $('.panneauParam').addClass('nonafficheParam');
		        	 $('.panneauParam').toggleClass('afficheParam');
		    	}
	     	}
	       
	});

	$('#btnPFavoris100a1000px').click(function(e){
		
	     
	        if($('#partieDroite_page').hasClass('nonafficheFav'))
	        {
	        	$('#partieDroite_page').addClass('afficheFav');
	        	$('#partieDroite_page').removeClass('nonafficheFav');
	        }
	        
	        
	    });

	$('body').click(function(e){
		
		
	     
			var container = $('#partieDroite_page');
			var container2 = $('#btnPFavoris100a1000px');

			if ((!container.is(e.target) && container.has(e.target).length === 0)&& (!container2.is(e.target) && container2.has(e.target).length === 0))// ... nor a descendant of the container
	    	{
				if($('#partieDroite_page').hasClass('afficheFav'))
	     		{
		        
		        	 $('#partieDroite_page').addClass('nonafficheFav');
		        	 $('#partieDroite_page').toggleClass('afficheFav');
		    	}
	     	}
	       
	});

	
});
	





			  
