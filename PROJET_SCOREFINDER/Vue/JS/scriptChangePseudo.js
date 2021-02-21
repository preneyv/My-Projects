
function changePseudo(){
	var parent = document.getElementById("pseudoStable");

	var span = document.getElementsByClassName('valSpanPseudo')[0];
	var valSpan = span.innerHTML;
	span.innerHTML = "<input onBlur='setPseudo(this)' type='text' style='color :grey; font-size:15px;vertical-align : middle;height:30px;border:none;border-radius:5px' value='"+valSpan+"' name='newPseudo' id='newPseudo' >";
	parent.id="pseudoUnstable";
	
	$("#pseudoUnstable").attr("onclick","");

}
