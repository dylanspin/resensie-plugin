
	//hier kunnen de overgang animaties

	function closePop(){
		document.getElementById('popup').style.display = "none";
		document.getElementById('startpopup').style.display = "";
	}

	function openPop(){
		document.getElementById('popup').style.display = "block";
		document.getElementById('startpopup').style.display = "none";
	}

	var smiley;
	var oud;

	function selectScore(welk){//set de selected smiley 
		if(oud != null){
			document.getElementById(oud).style.fontSize = "30px";
		}
		oud = welk.id; 
		smiley = welk.id; 
		document.getElementById(smiley).style.fontSize = "40px";
		document.getElementById('hiddenPopup').value = smiley;
	}