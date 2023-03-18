document.addEventListener("DOMContentLoaded", e => {
	document.querySelectorAll(".dropdown-toggle.nav-link").forEach(i => {
		i.addEventListener("click", e => {
				const dmenu = e.currentTarget.parentNode.querySelector("ul.dropdown-menu");
			setTimeout(() => {
				if(dmenu.classList.contains("show")) {
					dmenu.classList.remove("show");
				}else {
					dmenu.classList.add("show");
				}
			}, 10);
		});
	})

	document.addEventListener(
		"click", 
		e => document.querySelectorAll(".dropdown-menu.show").forEach(i => i.classList.remove("show"))
	);
});