var menuShown = false;
function toggleMenu(){
	var menu = document.getElementById("menu");
	var menuBackground = document.getElementById("menu_background");
	var globalContainer = document.getElementById("global_container");
	
	if(!menuShown){
		menuShown = true;
		menuBackground.style.visibility = "visible" ;
		menu.style.right="0%";
		menu.style.overflowY="auto";
		globalContainer.style.position="fixed";
		
	}
	else{
		menuShown = false;
		menuBackground.style.visibility = "hidden" ;
		menu.style.right="-100%";
		menu.style.overflowY="hidden";
		globalContainer.style.position="static";
	}
}