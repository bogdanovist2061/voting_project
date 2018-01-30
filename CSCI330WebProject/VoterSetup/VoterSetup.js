
/*
	Beckman
	VoterSetup.js
*/

var registerBtn;
var cancelBtn;
var modalDiv;
var closeBtn;
var submitBtn;
var id;
var key;

function start(){
	registerBtn = document.getElementById("register");
	registerBtn.addEventListener("click", displayForm, false);
}

function displayForm(){
	document.getElementById("modalDiv").style.display = "block";
	cancelBtn = document.getElementById("cancel");
	cancelBtn.addEventListener("click", cancelForm, false);
	modalDiv = document.getElementById("modalDiv");
	modalDiv.addEventListener("click", divCloseForm, false);
	closeBtn = document.getElementById("close");
	closeBtn.addEventListener("click", closeForm, false);
	submitBtn = document.getElementById("submit");
	submitBtn.addEventListener("click", createID, false);
}

function cancelForm() {
	document.getElementById("modalDiv").style.display = "none";
}

function divCloseForm( e ) {
	if (e.target == modalDiv) {
		document.getElementById("modalDiv").style.display = "none";
	}
}

function closeForm( e ) {
	if (e.target = closeBtn) {
		document.getElementById("modalDiv").style.display = "none";
	}
}

function createID() {
		id = Math.floor(1 + Math.random() * 10000);
		document.getElementById("key").value = id;
}

window.addEventListener("load", start, false);