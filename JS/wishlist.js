async function cargarWishlist() {
  const contenedor = document.getElementById("wishlist");
  contenedor.innerHTML = "<p>Cargando tu lista de deseos...</p>";

  let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

  if (wishlist.length === 0) {
    contenedor.innerHTML = "<p>Tu <b>Lista de deseos</b> está vacía</p>";
    contenedor.className = "wishlistVacia";
    return;
  }

  //APIs a consultar
  const apis = [
    { prefijo: "", url: "api_productos.php" },
    { prefijo: "M", url: "api_mujer.php" },
    { prefijo: "H", url: "api_hombres.php" },
    { prefijo: "N", url: "api_niño.php" },
    { prefijo: "NA", url: "api_niñas.php" }
  ];

  let todosLosProductos = [];

  //Cargar todas las APIs
  for (const { prefijo, url } of apis) {
    try {
      const res = await fetch(url);
      if (!res.ok) throw new Error("Error al cargar " + url);
      const productos = await res.json();
      productos.forEach(p => (p.prefijo = prefijo)); // Marca el origen
      todosLosProductos = todosLosProductos.concat(productos);
    } catch (err) {
      console.warn("No se pudo cargar:", url);
    }
  }

  contenedor.innerHTML = "";

  //Mostrar productos guardados en wishlist
  todosLosProductos.forEach(prod => {
    const prefijo = prod.prefijo || "";
    const idPrefijado = prefijo + prod.id;

    if (wishlist.includes(idPrefijado)) {
      const card = document.createElement("div");
      card.classList.add("card");
      card.innerHTML = `
        <img src="${prod.imagen}" alt="${prod.nombre}">
        <h3>${prod.nombre}</h3>
        <p><strong>Colección:</strong> ${prod.coleccion}</p>
        <p class="precio">$${prod.precio}</p>
        <p>${prod.descripcion}</p>
        <button class="delete-btn" data-id="${idPrefijado}">
          <i class="fas fa-trash-alt"></i> Eliminar
        </button>
        <button class="cart-btn" data-id="${prod.id}">
            <i class="fas fa-shopping-cart"></i>
        </button>
      `;
      contenedor.appendChild(card);
    }
  });

  //Funcionalidad para eliminar
  document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      wishlist = wishlist.filter(pid => pid !== id);
      localStorage.setItem("wishlist", JSON.stringify(wishlist));
      btn.parentElement.remove();
      cargarWishlist();
    });
  });
}

cargarWishlist();

