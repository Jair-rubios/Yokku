async function cargarCarrito() {
  const contenedor = document.getElementById("cart");
  const contenedorTotal = document.getElementById("total");
  const contenedorPagar = document.getElementById("pagar");
  const contenedorMsg = document.getElementById("msg-container");

  contenedor.innerHTML = "<p>Cargando tu carrito...</p>";

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  if (cart.length === 0) {
    contenedor.innerHTML = "<p>Tu <b>Carrito</b> está vacío.</p>";
    contenedor.className = "carritoVacio";
    contenedorTotal.innerHTML = "";
    contenedorPagar.innerHTML = "";
    contenedorMsg.innerHTML = "";
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
      <button class="btnPagar" id="btnPagar" type="button">Pagar</button>
    </div>
  `;
}

//Activar el fondo oscuro
const overlay = document.getElementById("overlay");
const tarjeta = document.getElementById("tarjeta");

document.addEventListener("click", (e) => {
  if (e.target && e.target.id === "btnPagar") {
    overlay.classList.add("activo");
  }
});

overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.remove('activo');//Desactiva el fondo oscuro cuando se hace clic directo en el fondo (es decir, fuera del formulario)
    tarjeta.classList.remove('activo');
  });

//Activar formulario de tarjeta
document.addEventListener("click", (e) => {
  if (e.target && e.target.id === "btnPagar") {
    tarjeta.classList.add("activo");
  }
});

//Validar formulario
const campos = [
  { input: document.getElementById("numTarjeta"), min: 16, tipo: "numero"},
  { input: document.getElementById("nombreTarjeta"), min: 1, tipo: "letras"},
  { input: document.getElementById("mesVenci"), min: 1, tipo: "numero"},
  { input: document.getElementById("anoVenci"), min: 4, tipo: "numero"},
  { input: document.getElementById("CVVTarjeta"), min: 3, tipo: "numero"},
];
let verificarLabel = document.getElementById("verificarLabel");
let hayError = false;

document.addEventListener("click", (e) => {
  if (e.target && e.target.id === "btn-procederPago") {

    campos.forEach(({ input, min, tipo }) => {
      const valor = input.value.trim();

      // Validar longitud mínima
      if (valor.length < min) {
        input.classList.add("verificar");
        hayError = true;
        return;
      }

      // Validar tipo de dato
      let regex;
      if (tipo === "numero") regex = /^[0-9]+$/;
      else if (tipo === "letras") regex = /^[a-zA-Z\s]+$/; 

      if (!regex.test(valor)) {
        input.classList.add("verificar");
        hayError = true;
      } else {
        input.classList.remove("verificar");
      }
    });

    if (hayError) {
      verificarLabel.classList.add("activo");
    } else {
      verificarLabel.classList.remove("activo");
    }
  }

  if (hayError) return;
});

//Pedido realizado (mensaje)
document.addEventListener("click", (e) => {
  if (e.target && e.target.id === "btn-procederPago") {
    if(!hayError)
    {
      function mensajeTemporal(texto) {
      const msg = document.createElement("div");
      msg.classList.add("msgPedido");
      msg.textContent = texto;
      document.body.appendChild(msg);
      
      setTimeout(() => {
        msg.remove();
        location.reload(); 
      }, 2000);
      }

      if (!hayError) {
        mensajeTemporal("¡El pedido se realizó con éxito ✓!");
      }
    }
}});

cargarCarrito();
