const addToShoppingCartButtons = document.querySelectorAll('.addToCart');
addToShoppingCartButtons.forEach((addToCartButton) => {
  addToCartButton.addEventListener('click', addToCartClicked);
});

const comprarButton = document.querySelector('.comprarButton');
comprarButton.addEventListener('click', comprarButtonClicked);

const shoppingCartItemsContainer = document.querySelector(
  '.shoppingCartItemsContainer'
);

//shoppingCartTotal

function addToCartClicked(event) {
  const button = event.target;
  const item = button.closest('.item');

  const itemTitle = item.querySelector('.item-title').textContent;
  const itemPrice = item.querySelector('.item-price').textContent;
  const itemImage = item.querySelector('.item-image').src;

  addItemToShoppingCart(itemTitle, itemPrice, itemImage);
}

function addItemToShoppingCart(itemTitle, itemPrice, itemImage) {
  const elementsTitle = shoppingCartItemsContainer.getElementsByClassName(
    'shoppingCartItemTitle'
  );
  for (let i = 0; i < elementsTitle.length; i++) {
    if (elementsTitle[i].innerText === itemTitle) {
      let elementQuantity = elementsTitle[
        i
      ].parentElement.parentElement.parentElement.querySelector(
        '.shoppingCartItemQuantity'
      );
      elementQuantity.value++;
      $('.toast').toast('show');
      updateShoppingCartTotal();
      return;
    }
  }

  const shoppingCartRow = document.createElement('div');
  const shoppingCartContent = `
  <div class="row shoppingCartItem">
        <div class="col-4">
            <div class="shopping-cart-item d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                <img src=${itemImage} class="shopping-cart-image">
                <h6 class="shopping-cart-item-title shoppingCartItemTitle text-truncate ml-3 mb-0">${itemTitle}</h6>
            </div>
        </div>
        <div class="col-2">
            <div class="shopping-cart-price d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                <p class="item-price mb-0 shoppingCartItemPrice">${itemPrice}</p>
            </div>
        </div>
        <div class="col-2">
            <div 
                class="shopping-cart-quantity d-flex justify-content-between align-items-center h-100 border-bottom pb-2 pt-3">
                <input style="width:50px;" class="shopping-cart-quantity-input shoppingCartItemQuantity" type="number"
                    value="1">
            </div>
        </div>

        <div class="col-2">
            <div class="shopping-cart-price d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                 <button class="btn btn-danger buttonDelete" type="button">🗑️</button>
            </div>
        </div>

    </div>`;
  shoppingCartRow.innerHTML = shoppingCartContent;
  shoppingCartItemsContainer.append(shoppingCartRow);

  shoppingCartRow
    .querySelector('.buttonDelete')
    .addEventListener('click', removeShoppingCartItem);

  shoppingCartRow
    .querySelector('.shoppingCartItemQuantity')
    .addEventListener('change', quantityChanged);

  updateShoppingCartTotal();
}

function updateShoppingCartTotal() {
  let total = 0;
  const shoppingCartTotal = document.querySelector('.shoppingCartTotal');

  const shoppingCartItems = document.querySelectorAll('.shoppingCartItem');

  shoppingCartItems.forEach((shoppingCartItem) => {
    const shoppingCartItemPriceElement = shoppingCartItem.querySelector(
      '.shoppingCartItemPrice'
    );
    const shoppingCartItemPrice = Number(
      shoppingCartItemPriceElement.textContent.replace('$', '')
    );
    const shoppingCartItemQuantityElement = shoppingCartItem.querySelector(
      '.shoppingCartItemQuantity'
    );
    const shoppingCartItemQuantity = Number(
      shoppingCartItemQuantityElement.value
    );
    total = total + shoppingCartItemPrice * shoppingCartItemQuantity;
  });
  shoppingCartTotal.innerHTML = `$${total.toFixed()}`;
}

//Funcion encargada de remover productos del carrito
function removeShoppingCartItem(event) {
  const buttonClicked = event.target;
  buttonClicked.closest('.shoppingCartItem').remove();
  updateShoppingCartTotal();
}

//Funcion encargada de sumar los precios
function quantityChanged(event) {
  const input = event.target;
  input.value <= 0 ? (input.value = 1) : null;
  updateShoppingCartTotal();
}

//Funcion encargada agregar los productos
function comprarButtonClicked() {
  shoppingCartItemsContainer.innerHTML = '';
  updateShoppingCartTotal();
}

//Función para mostrar la factura..............................................................................................
function mostrarFactura() {
  const factura = document.querySelector(".factura");
  factura.style.display = "block";

  // Copiar y pegar los elementos del carrito en la factura
  const carritoItems = document.querySelectorAll(".shoppingCartItem");
  const facturaList = factura.querySelector("#carritoFactura");
  facturaList.innerHTML = ''; // Limpia la factura antes de agregar los elementos

  let totalCompra = 0; // Inicializa el total de la compra

  carritoItems.forEach((carritoItem) => {
    const itemTitle = carritoItem.querySelector(".shoppingCartItemTitle").textContent;
    const itemPriceString = carritoItem.querySelector(".shoppingCartItemPrice").textContent;
    const itemPrice = parseFloat(itemPriceString.replace('$', ''));
    const itemQuantity = parseInt(carritoItem.querySelector(".shoppingCartItemQuantity").value, 10);

    // Redondea el precio al número entero más cercano y conviértelo en cadena
    const formattedPrice = String(Math.round(itemPrice));
    
    const facturaRow = document.createElement("tr");
    facturaRow.innerHTML = `
      <td>${itemTitle}</td>
      <td>${formattedPrice}</td>
      <td>${itemQuantity}</td>
    `;
    
    facturaList.appendChild(facturaRow);
     totalCompra += itemPrice * itemQuantity; // Suma el subtotal al total de la compra
  });

  updateFacturaTotal(totalCompra); // Actualiza el total de la factura
}


function updateFacturaTotal(total) {
  const totalCompra = document.querySelector('.factura #totalCompra');
  
  // Redondea el total al número entero más cercano y conviértelo en cadena
  const formattedTotal = String(Math.round(total));
  
  totalCompra.textContent = `$${formattedTotal}`;
}

// Función para cerrar la factura
function cerrarFactura() {
  const factura = document.querySelector(".factura");
  factura.style.display = "none";
}

// Función para imprimir la factura
function imprimirFactura() {
  const factura = document.querySelector(".factura");
  factura.style.display = "block";
  window.print(); // Abre el cuadro de diálogo de impresión
}