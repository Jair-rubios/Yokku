async function cargarCarrito() {
  const contenedor = document.getElementById("cart");
  const contenedorTotal = document.getElementById("total");
  const contenedorPagar = document.getElementById("pagar");

  contenedor.innerHTML = "<p>Cargando tu carrito...</p>";

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  if (cart.length === 0) {
    contenedor.innerHTML = "<p>Tu <b>Carrito</b> está vacío.</p>";
    contenedor.className = "carritoVacio";
    contenedorTotal.innerHTML = "";
    contenedorPagar.innerHTML = "";
    return;
  }

  const apis = [
    { prefijo: "", url: "api_productos.php" },
    { prefijo: "M", url: "api_mujer.php" },
    { prefijo: "H", url: "api_hombres.php" },
    { prefijo: "N", url: "api_niño.php" },
    { prefijo: "NA", url: "api_niñas.php" }
  ];

  let todosLosProductos = [];

  for (const { prefijo, url } of apis) {
    try {
      const res = await fetch(url);
      if (!res.ok) throw new Error("Error al cargar " + url);
      const productos = await res.json();
      productos.forEach(p => (p.prefijo = prefijo));
      todosLosProductos = todosLosProductos.concat(productos);
    } catch (err) {
      console.warn("No se pudo cargar:", url);
    }
  }

  contenedor.innerHTML = "";
  let total = 0;

  cart.forEach(item => {
    const { id, cantidad } = item;
    const producto = todosLosProductos.find(p => (p.prefijo || "") + p.id === id);

    if (producto) {
      const subtotal = producto.precio * cantidad;
      total += subtotal;

      const card = document.createElement("div");
      card.classList.add("card");
      card.innerHTML = `
        <img src="${producto.imagen}" alt="${producto.nombre}">
        <h3>${producto.nombre}</h3>
        <p><strong>Colección:</strong> ${producto.coleccion}</p>
        <p class="precio">$${producto.precio}</p>
        <label class="cantidad">Cantidad:
          <button class="btnCantidad-mas" type="button">+</button>
          <input type="number" min="1" value="${cantidad}" class="numCantidad" data-id="${id}">
          <button class="btnCantidad-menos" type="button">-</button>
        </label>
        <p class="subtotal">Subtotal: $${subtotal.toFixed(2)}</p>
        <button class="delete-btn" data-id="${id}">
          <i class="fas fa-trash-alt"></i> Eliminar
        </button>
      `;
      contenedor.appendChild(card);
    }
  });

  
  // Total general
  contenedorTotal.innerHTML = `
    <div class="total">
      <h3>Total: $${total.toFixed(2)}</h3>
    </div>
  `;

  // Eventos eliminar
  document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      cart = cart.filter(p => p.id !== id);
      localStorage.setItem("cart", JSON.stringify(cart));
      cargarCarrito(); // recarga el carrito
    });
  });

  // Eventos cambio de cantidad
  document.querySelectorAll(".cantidad").forEach(label => {
  const input = label.querySelector(".numCantidad");
  const btnMas = label.querySelector(".btnCantidad-mas");
  const btnMenos = label.querySelector(".btnCantidad-menos");

  const id = input.dataset.id;
  input.addEventListener("change", () => {
    const nuevaCantidad = parseInt(input.value);
    actualizarCantidad(id, nuevaCantidad);
  });

  btnMas.addEventListener("click", (e) => {
    e.preventDefault();
    let nuevaCantidad = parseInt(input.value) + 1;
    actualizarCantidad(id, nuevaCantidad);
  });

  btnMenos.addEventListener("click", (e) => {
    e.preventDefault();
    let nuevaCantidad = parseInt(input.value) - 1;
    actualizarCantidad(id, nuevaCantidad);
  });
});

function actualizarCantidad(id, nuevaCantidad) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const itemIndex = cart.findIndex(p => p.id === id);

  if (itemIndex !== -1) {
    if (nuevaCantidad <= 0) {
      cart.splice(itemIndex, 1);
    } else {
      cart[itemIndex].cantidad = nuevaCantidad;
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    cargarCarrito();
  }
}

contenedorPagar.innerHTML = `
    <div class="total">
      <button class="btnPagar" type="button">Pagar</button>
    </div>
  `;
}

cargarCarrito();
