var menuShown = false;
function toggleMenu(){
	var menu = document.getElementById("menu");
	
	if(!menuShown){
		menuShown = true;
		menu.style.right="0%";
	}
	else{
		menuShown = false;
		menu.style.right="-100%";
	}
}