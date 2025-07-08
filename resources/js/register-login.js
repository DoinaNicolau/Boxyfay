

        // Icone e-commerce per l'animazione
        const ecommerceIcons = ['🛒', '💳', '🎁', '📦', '⭐', '🚚', '💰', '🏷️', '👜', '🛍️'];

        // Inizializza icone e-commerce fluttuanti
        function createEcommerceIcons() {
            const iconsContainer = document.querySelector('.ecommerce-icons');
            for (let i = 0; i < 15; i++) {
                const icon = document.createElement('div');
                icon.className = 'ecommerce-icon';
                icon.textContent = ecommerceIcons[Math.floor(Math.random() * ecommerceIcons.length)];
                icon.style.left = Math.random() * 100 + '%';
                icon.style.top = Math.random() * 100 + '%';
                icon.style.animationDelay = Math.random() * 8 + 's';
                icon.style.animationDuration = (Math.random() * 4 + 6) + 's';
                iconsContainer.appendChild(icon);
            }
        }
         createEcommerceIcons();

       