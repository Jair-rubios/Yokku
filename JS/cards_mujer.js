async function cargarProductos() {
  const contenedor = document.getElementById("productos");
  try {
    const res = await fetch("api_mujer.php");
    if (!res.ok) throw new Error("Error al cargar API");
    const productos = await res.json();

    contenedor.innerHTML = "";

    productos.forEach(prod => {
      const card = document.createElement("div");
      card.classList.add("card");
      card.innerHTML = `
        <img src="${prod.imagen}" alt="${prod.nombre}">
        <h3>${prod.nombre}</h3>
        <p><strong>Colección:</strong> ${prod.coleccion}</p>
        <p class="precio">$${prod.precio.toFixed(2)}</p>
        <p>${prod.descripcion}</p>
        <button class="wishlist-btn" data-id="${prod.id}">
          <i class="fas fa-heart"></i>
        </button>
        <button class="cart-btn" data-id="${prod.id}">
            <i class="fas fa-shopping-cart"></i>
        </button>
      `;
      contenedor.appendChild(card);
    });

    // 🎯 Aquí agregas el prefijo "M" antes de guardar el ID en el localStorage
    document.querySelectorAll(".wishlist-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = "M" + btn.dataset.id; // 👈 prefijo "M" para productos de mujer
        let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

        if (!wishlist.includes(id)) {
          wishlist.push(id);
          localStorage.setItem("wishlist", JSON.stringify(wishlist));
          btn.classList.add("added");
        }
      });
    });

  } catch (error) {
    console.error(error);
    contenedor.innerHTML = "<p>Error al cargar los productos.</p>";
  }
}

cargarProductos();

