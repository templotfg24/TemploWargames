document.addEventListener("DOMContentLoaded", function() {
    const checkoutForm = document.getElementById('checkoutForm');
    const radios = document.querySelectorAll('input[type="radio"][name="paymentMethod"]');
    let selectedPaymentMethod = 1; // Default to the first payment method

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            selectedPaymentMethod = this.value;
        });
    });

    checkoutForm.addEventListener('submit', function(event) {
        event.preventDefault();

        if (selectedPaymentMethod != 1) {
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.show();
        } else {
            this.submit();
        }
    });

    document.getElementById('confirmPayment').addEventListener('click', function() {
        const paymentDetails = document.getElementById('paymentDetails').value;
        if (paymentDetails) {
            const paymentDetailsInput = document.createElement('input');
            paymentDetailsInput.type = 'hidden';
            paymentDetailsInput.name = 'paymentDetails';
            paymentDetailsInput.value = paymentDetails;
            checkoutForm.appendChild(paymentDetailsInput);
            checkoutForm.submit();
        } else {
            alert('Por favor, ingresa los detalles del pago.');
        }
    });

    // Población de datos de región y ciudad
    const regions = {
        "Andalucía": ["Sevilla", "Málaga", "Córdoba", "Granada", "Cádiz", "Huelva", "Jaén", "Almería"],
        "Aragón": ["Zaragoza", "Huesca", "Teruel"],
        "Asturias": ["Oviedo", "Gijón", "Avilés"],
        "Islas Baleares": ["Palma de Mallorca", "Ibiza", "Manacor"],
        "Canarias": ["Las Palmas de Gran Canaria", "Santa Cruz de Tenerife", "La Laguna"],
        "Cantabria": ["Santander", "Torrelavega", "Castro Urdiales"],
        "Castilla y León": ["Valladolid", "León", "Burgos", "Salamanca", "Segovia", "Soria", "Ávila", "Zamora", "Palencia"],
        "Castilla-La Mancha": ["Toledo", "Ciudad Real", "Albacete", "Guadalajara", "Cuenca"],
        "Cataluña": ["Barcelona", "Tarragona", "Lleida", "Girona"],
        "Extremadura": ["Mérida", "Badajoz", "Cáceres", "Plasencia"],
        "Galicia": ["Santiago de Compostela", "A Coruña", "Vigo", "Lugo", "Ourense", "Pontevedra", "Ferrol"],
        "Madrid": ["Madrid", "Alcalá de Henares", "Getafe", "Móstoles", "Alcorcón", "Leganés"],
        "Murcia": ["Murcia", "Cartagena", "Lorca"],
        "Navarra": ["Pamplona", "Tudela", "Burlada"],
        "La Rioja": ["Logroño", "Calahorra", "Arnedo"],
        "País Vasco": ["Bilbao", "San Sebastián", "Vitoria-Gasteiz", "Barakaldo"],
        "Comunidad Valenciana": ["Valencia", "Alicante", "Castellón de la Plana", "Elche", "Torrevieja"],
        "Ceuta": ["Ceuta"],
        "Melilla": ["Melilla"]
    };

    const regionSelect = document.getElementById('region');
    const citySelect = document.getElementById('ciudad');

    // Población inicial de regiones
    for (let region in regions) {
        const option = document.createElement('option');
        option.value = region;
        option.textContent = region;
        regionSelect.appendChild(option);
    }

    // Evento de cambio para actualizar las ciudades
    regionSelect.addEventListener('change', function() {
        const selectedRegion = this.value;
        const cities = regions[selectedRegion] || [];

        citySelect.innerHTML = '<option value="">Seleccione...</option>'; // Resetear opciones de ciudad
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });
    });

    // Población de los productos
    const products = JSON.parse(localStorage.getItem('cart')) || [];
    const productSummary = document.getElementById('productSummary');
    const productsInput = document.getElementById('products');
    let total = 0;

    products.forEach(product => {
        const productElement = document.createElement('div');
        productElement.classList.add('product-item');
        productElement.innerHTML = `
            <img src="../Assets/images/uploads/${product.image}" alt="${product.name}" style="width: 50px; height: auto; vertical-align: middle;">
            <p><strong>${product.name}</strong><br>${product.quantity} x ${product.price}€</p>
        `;
        productSummary.appendChild(productElement);
        total += product.quantity * product.price;
    });

    document.getElementById('subtotal').textContent = total;
    document.getElementById('total').textContent = total;
    productsInput.value = JSON.stringify(products);
});
