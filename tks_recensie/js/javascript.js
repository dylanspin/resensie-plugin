
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
			document.getElementById(oud).style.color = "";
		}

		document.getElementById('recForm').style.display = "block";		
		document.getElementById('hideInput').style.display = "none";

		oud = welk.id; 
		smiley = welk.id; 

		if(welk == sm3){
			document.getElementById(smiley).style.color = "green";
		}
		if(welk == sm2){
			document.getElementById(smiley).style.color = "orange";
		}
		if(welk == sm1){
			document.getElementById(smiley).style.color = "red";
		}
		
		document.getElementById('hiddenPopup').value = smiley;//set de hidden input zo dat de php daar dan de score van pakt

	}