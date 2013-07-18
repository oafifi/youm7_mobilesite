var menuShown = false;
function toggleMenu(){
	var menu = document.getElementById("menu");
	var globalContainer = document.getElementById("global_container");
	
	if(!menuShown){
		menuShown = true;
		menu.style.visibility="visible";
		globalContainer.style.display="none";
		menu.style.position="fixed";
		menu.style.right="0%";
		globalContainer.style.left="-100%";
		globalContainer.style.position="fixed";
		
	}
	else{
		menuShown = false;
		menu.style.right="-100%";
		globalContainer.style.left="0%";
		globalContainer.style.display="block";
		globalContainer.style.position="absolute";

	}
}