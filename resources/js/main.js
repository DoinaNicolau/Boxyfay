


document.addEventListener('DOMContentLoaded', () => {

    
    // LOGICA 1: GALLERIA IMMAGINI E MODALE DI ZOOM
 
    const mainImage = document.getElementById('mainImage');
    const imageModal = document.getElementById('imageModal');

    // Esegue questo blocco solo se gli elementi della galleria esistono sulla pagina corrente
    if (mainImage && imageModal) {
        const miniatures = document.querySelectorAll('.immagine-miniatura');
        const modalImage = document.getElementById('modalImage');
        const modalClose = document.querySelector('.modal-close');

        if (miniatures.length > 0) {
            miniatures.forEach(img => {
                img.addEventListener('click', () => {
                    mainImage.src = img.src;
                });
            });
        }

        mainImage.addEventListener('click', () => {
            modalImage.src = mainImage.src;
            imageModal.classList.add('aperto');
        });

        imageModal.addEventListener('click', () => {
            imageModal.classList.remove('aperto');
        });

        if (modalClose) {
            modalClose.addEventListener('click', (event) => {
                event.stopPropagation();
                imageModal.classList.remove('aperto');
            });
        }
    }


  
    // LOGICA 2: EFFETTO PARALLASSE SU SFONDO VIDEO
  
    const videoContainer = document.getElementById('videoContainer');
    
    // Esegue questo blocco solo se il contenitore video esiste
    if (videoContainer) {
        const floatingBox = document.getElementById('floatingBox');
        if (floatingBox) {
            videoContainer.addEventListener('mousemove', (e) => {
                const rect = videoContainer.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const moveX = (x - centerX) / 80;
                const moveY = (y - centerY) / 80;
                floatingBox.style.transform = `translate(${moveX}px, ${moveY}px)`;
                
            });

            videoContainer.addEventListener('mouseleave', () => {
                floatingBox.style.transform = `translate(0, 0)`;
            });
        }
    }


  
    // LOGICA 3: CONFERMA RIFIUTO ARTICOLO
  
    const rejectForm = document.getElementById('rejectForm');

    // Esegue questo blocco solo se il form di rifiuto esiste
    if (rejectForm) {
        rejectForm.addEventListener('submit', function(event) {
            if (!confirm('Sei sicuro di voler rifiutare questo articolo?')) {
                event.preventDefault();
            }
        });
    }


  
    // LOGICA 4: ANIMAZIONE VERTICALE (fade-in e slide-up)
  
    const animatedElements = document.querySelectorAll('.anim-on-scroll');
    if (animatedElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                } else {
                    entry.target.classList.remove('is-visible');
                }
            });
        }, { threshold: 0.1 });

        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }

  
  
    // LOGICA 5: ANIMAZIONE LATERALE SFALSATA PER LA GRIGLIA
  
    const staggeredElements = document.querySelectorAll('.anim-slide-in');
    if (staggeredElements.length > 0) {
        const staggeredObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delayIndex = entry.target.dataset.delayIndex || 0;
                    const delay = delayIndex * 150;
                    entry.target.style.transitionDelay = `${delay}ms`;
                    entry.target.classList.add('is-visible');
                } else {
                    entry.target.classList.remove('is-visible');
                    entry.target.style.transitionDelay = '0ms';
                }
            });
        }, { threshold: 0.1 });

        staggeredElements.forEach(element => {
            staggeredObserver.observe(element);
        });
    }

    // LOGICA PER LA NAVBAR DINAMICA ON-SCROLL

        const navbar = document.querySelector('.navbar.fixed-top');

        // Esegui questo codice solo se la navbar esiste sulla pagina
        if (navbar) {
            window.addEventListener('scroll', () => {
                // Se l'utente ha scrollato più di 10px verso il basso...
                if (window.scrollY > 10) {
                    // ...aggiungi la classe 'scrolled'
                    navbar.classList.add('scrolled');
                } else {
                    // ...altrimenti, se è tornato in cima, rimuovila
                    navbar.classList.remove('scrolled');
                }
            });
        }

    // LOGICA 7: THEME TOGGLE (se lo usi)
    const themeToggle = document.getElementById('input');
    if (themeToggle) {
        // ... eventuale codice per il toggle del tema ...
    }
    
    let customRange2 = document.querySelector('#customRange2')
      let rangeInput = customRange2;
  let rangeOutput = document.getElementById('rangeValue');
  rangeOutput.textContent = rangeInput.value;
  rangeInput.addEventListener('input', function() {
    rangeOutput.textContent = this.value;
 })

}); // <-- Chiusura del singolo DOMContentLoaded