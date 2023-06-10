let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");


// Comprobar si el menú estaba abierto antes de volver a cargar la página
if (localStorage.getItem("sidebarOpen") === "true") {
  sidebar.classList.add("open");
  menuBtnChange();
}

closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  menuBtnChange();
  // Guardar el estado del menú en el almacenamiento local
  localStorage.setItem("sidebarOpen", sidebar.classList.contains("open"));
});

// Cambiar el botón del menú
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  }
}

