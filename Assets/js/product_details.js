document.addEventListener("DOMContentLoaded", function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');
            const product = {
                id: productId,
                name: productName,
                price: parseFloat(productPrice),
                image: productImage,
                quantity: 1
            };

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingProductIndex = cart.findIndex(item => item.id === productId);

            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity += 1;
            } else {
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Producto añadido al carrito');
        });
    });
});
