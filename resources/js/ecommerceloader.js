    class EcommerceLoader {
    constructor() {
        this.overlay = null;
        this.isVisible = false;
        this.init();
    }

    init() {
        // Crea il loader HTML
        this.createLoaderHTML();
        
        // Intercetta form submissions
        this.interceptForms();
        
        // Intercetta link con classe specifica
        this.interceptLinks();
        
        // Intercetta richieste AJAX/fetch globalmente (opzionale)
        this.interceptAjax();
    }

    createLoaderHTML() {
        const loaderHTML = `
            <div id="ecommerce-loader-overlay" class="ecommerce-loader-overlay" style="display: none;">
                <div class="ecommerce-loader-container">
                    <!-- Shopping Bag Loader Animation -->
                    <div class="shopping-loader">
                        <div class="shopping-bag">
                            <div class="bag-body"></div>
                            <div class="bag-handle bag-handle-left"></div>
                            <div class="bag-handle bag-handle-right"></div>
                            <div class="bag-items">
                                <div class="item item-1"></div>
                                <div class="item item-2"></div>
                                <div class="item item-3"></div>
                            </div>
                        </div>
                        
                        <!-- Floating Products -->
                        <div class="floating-products">
                            <div class="product-icon product-1">📱</div>
                            <div class="product-icon product-2">👕</div>
                            <div class="product-icon product-3">🎧</div>
                            <div class="product-icon product-4">📚</div>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill"></div>
                        </div>
                    </div>
                    
                    <!-- Loading Text -->
                    <div class="loading-text">
                        <span id="loader-message">Caricamento in corso...</span>
                        <div class="dots">
                            <span>.</span>
                            <span>.</span>
                            <span>.</span>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Aggiungi al body
        document.body.insertAdjacentHTML('beforeend', loaderHTML);
        this.overlay = document.getElementById('ecommerce-loader-overlay');
    }

    show(message = 'Caricamento in corso...', type = 'default') {
        if (this.isVisible) return;
        
        this.isVisible = true;
        const messageEl = document.getElementById('loader-message');
        
        // Aggiorna il messaggio
        messageEl.textContent = this.getMessageByType(message, type);
        
        // Mostra con animazione
        this.overlay.style.display = 'flex';
        setTimeout(() => {
            this.overlay.classList.add('show');
        }, 200);
    }

    hide() {
        if (!this.isVisible) return;
        
        this.isVisible = false;
        this.overlay.classList.remove('show');
        
        setTimeout(() => {
            this.overlay.style.display = 'none';
        }, 300);
    }

    getMessageByType(message, type) {
        if (message && message !== 'default') return message;
        
        const messages = {
            'cart': 'Aggiornamento carrello...',
            'checkout': 'Elaborazione ordine...',
            'product': 'Caricamento prodotti...',
            'search': 'Ricerca in corso...',
            'payment': 'Elaborazione pagamento...',
            'login': 'Accesso in corso...',
            'register': 'Registrazione...',
            'upload': 'Caricamento file...',
            'delete': 'Eliminazione...',
            'save': 'Salvataggio...',
            'default': 'Caricamento in corso...'
        };
        
        return messages[type] || messages.default;
    }

    interceptForms() {
        // Intercetta tutti i form con attributo data-loader
        document.addEventListener('submit', (e) => {
            const form = e.target;
            
            if (form.hasAttribute('data-loader')) {
                const message = form.getAttribute('data-loader-message') || 'default';
                const type = form.getAttribute('data-loader-type') || 'default';
                
                this.show(message, type);
                
                // Nascondi loader se la pagina non cambia (per AJAX forms)
                setTimeout(() => {
                    if (this.isVisible) {
                        this.hide();
                    }
                }, 5000);
            }
        });
    }

    interceptLinks() {
        // Intercetta link con classe loader-link
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[data-loader], button[data-loader]');
            
            if (link) {
                const message = link.getAttribute('data-loader-message') || 'default';
                const type = link.getAttribute('data-loader-type') || 'default';
                
                this.show(message, type);
                
                // Per link normali, il loader si nasconderà al cambio pagina
                // Per azioni AJAX, nascondilo dopo un timeout
                if (link.hasAttribute('data-ajax')) {
                    setTimeout(() => {
                        this.hide();
                    }, 3000);
                }
            }
        });
    }

    interceptAjax() {
        // Intercetta jQuery AJAX (se presente)
        if (window.jQuery) {
            const self = this;
            
            jQuery(document).ajaxStart(function() {
                if (jQuery('[data-auto-loader="true"]').length > 0) {
                    self.show('Elaborazione richiesta...', 'default');
                }
            });
            
            jQuery(document).ajaxStop(function() {
                self.hide();
            });
        }

        // Intercetta fetch globalmente (opzionale)
        const originalFetch = window.fetch;
        const self = this;
        
        window.fetch = function(...args) {
            const url = args[0];
            const options = args[1] || {};
            
            // Controlla se la richiesta ha il flag per il loader
            if (options.showLoader !== false && 
                (options.showLoader || url.includes('/api/') || options.method === 'POST')) {
                
                const message = options.loaderMessage || 'Elaborazione richiesta...';
                const type = options.loaderType || 'default';
                
                self.show(message, type);
            }
            
            return originalFetch.apply(this, args)
                .then(response => {
                    if (options.showLoader !== false) {
                        self.hide();
                    }
                    return response;
                })
                .catch(error => {
                    if (options.showLoader !== false) {
                        self.hide();
                    }
                    throw error;
                });
        };
    }

    // Metodi pubblici per controllo manuale
    static show(message, type) {
        if (window.ecommerceLoader) {
            window.ecommerceLoader.show(message, type);
        }
    }

    static hide() {
        if (window.ecommerceLoader) {
            window.ecommerceLoader.hide();
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    
    // Inizializza il loader
    window.ecommerceLoader = new EcommerceLoader();
    
    // Metodi globali per facilità d'uso
    window.showLoader = (message, type) => EcommerceLoader.show(message, type);
    window.hideLoader = () => EcommerceLoader.hide();
});

// Export per uso come modulo
if (typeof module !== 'undefined' && module.exports) {
    module.exports = EcommerceLoader;
}