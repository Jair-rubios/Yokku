async function cargarProductos() {
  const contenedor = document.getElementById("productos");
  try {
    const res = await fetch('api_hombres.php');
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

    //Prefijo "H" para productos de hombres
    document.querySelectorAll(".wishlist-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = "H" + btn.dataset.id;
        let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

        if (!wishlist.includes(id)) {
          wishlist.push(id);
          localStorage.setItem("wishlist", JSON.stringify(wishlist));
          btn.classList.add("added");
        }
      });
    });

    document.querySelectorAll(".cart-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = "H" + btn.dataset.id;
      let cart = JSON.parse(localStorage.getItem("cart")) || [];

      const productoExistente = cart.find(p => p.id === id);

      if (productoExistente) {
        productoExistente.cantidad += 1;
        localStorage.setItem("cart", JSON.stringify(cart));
        btn.classList.add("added");
      } else {
        cart.push({ id: id, cantidad: 1 });
        localStorage.setItem("cart", JSON.stringify(cart));
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
