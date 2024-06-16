document.addEventListener('DOMContentLoaded', function() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Función para agregar un producto al carrito
    function addToCart(product) {
        const existingProduct = cart.find(item => item.id === product.id);
        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cart.push(product);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart();
        showNotification(`${product.name} ha sido añadido al carrito.`);
    }

    // Función para mostrar los productos en el carrito
    function displayCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Tu carrito está vacío.</p>';
            return;
        }

        let totalUnits = 0;
        let totalPrice = 0;

        cart.forEach(item => {
            totalUnits += item.quantity;
            totalPrice += item.price * item.quantity;

            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <img src="../Assets/images/uploads/${item.image}" alt="${item.name}" class="me-3" style="max-width: 60px;">
                        <div>
                            <p>${item.name}</p>
                            <p>€${item.price} x ${item.quantity}</p>
                        </div>
                    </div>
                    <button class="btn btn-danger btn-sm remove-from-cart" data-product-id="${item.id}"><i class="fas fa-trash-alt"></i></button>
                </div>
            `;
            cartItemsContainer.appendChild(cartItem);
        });

        document.getElementById('total-units').innerText = totalUnits;
        document.getElementById('total-price').innerText = `€${totalPrice.toFixed(2)}`;

        // Añadir evento para eliminar productos del carrito
        const removeFromCartButtons = document.querySelectorAll('.remove-from-cart');
        removeFromCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = button.getAttribute('data-product-id');
                removeFromCart(productId);
            });
        });
    }

    // Función para eliminar un producto del carrito
    function removeFromCart(productId) {
        const productIndex = cart.findIndex(item => item.id === productId);
        if (productIndex !== -1) {
            cart.splice(productIndex, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        }
    }

    // Función para mostrar la notificación
    function showNotification(message) {
        const notificationMessage = document.getElementById('notificationMessage');
        notificationMessage.textContent = message;

        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
        notificationModal.show();

        setTimeout(() => {
            notificationModal.hide();
        }, 3000); // Ocultar el modal después de 3 segundos
    }

    // Añadir eventos a los botones "Añadir al carrito"
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productPrice = button.getAttribute('data-product-price');
            const productImage = button.getAttribute('data-product-image');

            const product = {
                id: productId,
                name: productName,
                price: parseFloat(productPrice),
                quantity: 1,
                image: productImage
            };

            addToCart(product);
        });
    });

    document.getElementById('viewCartButton').addEventListener('click', function() {
        window.location.href = '../views/cart/cart_view.php';  // Actualiza la ruta según sea necesario
    });

    // Mostrar el carrito cuando se abre el modal
    const cartModal = document.getElementById('cartModal');
    cartModal.addEventListener('shown.bs.modal', displayCart);
});