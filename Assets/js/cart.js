let products = JSON.parse(localStorage.getItem('cart')) || [];
const proceedButton = document.getElementById('proceedToCheckoutButton');

function updateCart() {
    let cartBody = document.getElementById('cartBody');
    cartBody.innerHTML = '';
    let subtotal = 0;

    products.forEach((product, index) => {
        let productRow = `<tr>
            <td><button class="remove-btn" onclick="removeItem(${index})">X</button></td>
            <td><img src="../../Assets/images/uploads/${product.image}" class="product-image" alt="${product.name}"/> ${product.name}</td>
            <td>${product.price}€</td>
            <td>
                <div class="quantity-controls">
                    <button onclick="changeQuantity('decrease', ${index})">-</button>
                    <input type="text" value="${product.quantity}" id="quantity-${index}" readonly>
                    <button onclick="changeQuantity('increase', ${index})">+</button>
                </div>
            </td>
            <td>${product.price * product.quantity}€</td>
        </tr>`;
        cartBody.innerHTML += productRow;
        subtotal += product.price * product.quantity;
    });

    document.getElementById('subtotal').innerText = subtotal + '€';
    document.getElementById('total').innerText = subtotal + '€';
}

function changeQuantity(action, index) {
    if (action === 'increase') {
        products[index].quantity++;
    } else if (action === 'decrease' && products[index].quantity > 1) {
        products[index].quantity--;
    }
    localStorage.setItem('cart', JSON.stringify(products));
    updateCart();
    checkStock();
}

function removeItem(index) {
    products.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(products));
    updateCart();
    checkStock();
}

async function checkStock() {
    try {
        const response = await fetch('../../controllers/CheckoutController.php?action=checkStock', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(products)
        });

        const result = await response.json();

        if (result.success) {
            proceedButton.disabled = false;
            proceedButton.classList.remove('disabled');
        } else {
            proceedButton.disabled = true;
            proceedButton.classList.add('disabled');
            alert(result.message);

            // Actualizar el carrito con la cantidad máxima disponible
            result.insufficientStock.forEach(item => {
                const product = products.find(p => p.id === item.id);
                if (product) {
                    product.quantity = item.available;
                }
            });

            localStorage.setItem('cart', JSON.stringify(products));
            updateCart();
        }
    } catch (error) {
        console.error('Error al verificar el stock:', error);
        alert('Ocurrió un error al verificar el stock. Por favor, intenta nuevamente.');
    }
}

document.getElementById('proceedToCheckoutButton').addEventListener('click', function() {
    if (!isUserLoggedIn) {
        window.location.href = '../../controllers/Auth_Controller.php?action=login';
    } else {
        // Enviar los datos del carrito al servidor mediante un formulario oculto
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '../../controllers/CheckoutController.php?action=processCheckout';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'products';
        input.value = JSON.stringify(products);

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    updateCart();
    checkStock();
});
