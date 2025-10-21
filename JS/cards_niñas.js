async function cargarProductos() {
  const contenedor = document.getElementById("productos");
  try {
    const res = await fetch("api_niñas.php");
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
      `;
      contenedor.appendChild(card);
    });

    // 👇 Prefijo "NA" para productos de niñas
    document.querySelectorAll(".wishlist-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = "NA" + btn.dataset.id;
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
