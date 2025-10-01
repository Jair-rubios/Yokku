async function cargarWishlist() {
  const res = await fetch("api_productos.php");
  const productos = await res.json();
  let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

  const contenedor = document.getElementById("wishlist");
  contenedor.innerHTML = "";

  productos.forEach(prod => {
    if (wishlist.includes(prod.id.toString())) {
      const card = document.createElement("div");
      card.classList.add("card");
      card.innerHTML = `
        <img src="${prod.imagen}" alt="${prod.nombre}">
        <h3>${prod.nombre}</h3>
        <p><strong>Colección:</strong> ${prod.coleccion}</p>
        <p class="precio">$${prod.precio}</p>
        <p>${prod.descripcion}</p>
        <button class="delete-btn" data-id="${prod.id}">Eliminar</button>
      `;
      contenedor.appendChild(card);
    }
  });

  // Agregar funcionalidad de eliminar
  document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      wishlist = wishlist.filter(pid => pid !== id);
      localStorage.setItem("wishlist", JSON.stringify(wishlist));
      btn.parentElement.remove(); // Elimina la card del DOM
    });
  });
}

cargarWishlist();