// Modal functionality for Web Roblox
document.addEventListener('DOMContentLoaded', function() {
    const startBtn = document.getElementById('startBtn');
    const articlesSection = document.querySelector('.articles-section');
    const mobileMenu = document.getElementById('mobile-menu');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');
    const authBtn = document.getElementById('authBtn');
    const readMoreBtns = document.querySelectorAll('.read-more-btn');
    
    // Modal functionality
    function createModal(type, data = {}) {
        // Remove existing modal
        const existingModal = document.querySelector('.modal');
        if (existingModal) {
            existingModal.remove();
        }
        
        const modal = document.createElement('div');
        modal.className = 'modal';
        
        let modalContent = '';
        
        switch(type) {
            case 'inicio':
                modalContent = `
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        <h2 class="modal-title">🏠 Bienvenido a Web Roblox</h2>
                        <div class="modal-body">
                            <p>Bienvenido a Web Roblox, tu lugar para aprender y mejorar en Roblox.</p>
                            <p>Aquí encontrarás los mejores trucos, guías y noticias para convertirte en un experto del mundo Roblox.</p>
                            <h3>¿Qué encontrarás?</h3>
                            <ul>
                                <li>Trucos secretos para conseguir Robux</li>
                                <li>Guías completas para dominar tus juegos favoritos</li>
                                <li>Últimas noticias y actualizaciones</li>
                                <li>Consejos de expertos y comunidad activa</li>
                            </ul>
                        </div>
                        <button class="modal-action-btn">Comenzar a explorar</button>
                    </div>
                `;
                break;
                
            case 'trucos':
                modalContent = `
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        <h2 class="modal-title">🎮 Trucos de Roblox</h2>
                        <div class="modal-body">
                            <p>Descubre los mejores trucos y secretos para dominar Roblox:</p>
                            <ul>
                                <li><strong>Conseguir Robux gratis:</strong> Completa misiones diarias y eventos especiales</li>
                                <li><strong>Atajos de teclado:</strong> Usa Ctrl+Shift+P para abrir el menú de herramientas</li>
                                <li><strong>Estrategias de juego:</strong> Aprende a farmear eficientemente en cualquier juego</li>
                                <li><strong>Personalización avanzada:</strong> Crea outfits únicos con capas y accesorios</li>
                                <li><strong>Optimización de rendimiento:</strong> Ajusta la configuración gráfica para mejor FPS</li>
                                <li><strong>Trucos de trading:</strong> Identifica items valiosos y negocia como un profesional</li>
                                <li><strong>Secretos de desarrolladores:</strong> Descubre comandos ocultos y funciones beta</li>
                            </ul>
                            <p><strong>💡 Pro tip:</strong> Siempre verifica la legitimidad de los métodos para conseguir Robux para evitar estafas.</p>
                        </div>
                        <button class="modal-action-btn">Ver más trucos</button>
                    </div>
                `;
                break;
                
            case 'guias':
                modalContent = `
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        <h2 class="modal-title">📚 Guías Completa</h2>
                        <div class="modal-body">
                            <p>Explora nuestras guías detalladas para dominar cada aspecto de Roblox:</p>
                            <h3>Guías para Principiantes</h3>
                            <ul>
                                <li>Cómo crear tu primer avatar personalizado</li>
                                <li>Guía básica de Roblox Studio</li>
                                <li>Navegación y menús principales</li>
                                <li>Seguridad y configuración de privacidad</li>
                            </ul>
                            <h3>Guías de Juegos Populares</h3>
                            <ul>
                                <li>Blox Fruits: Guía completa de fruits y niveles</li>
                                <li>Adopt Me: Cómo conseguir mascotas legendarias</li>
                                <li>Brookhaven: Comandos y secretos</li>
                                <li>Phantom Forces: Mejoras y estrategias</li>
                            </ul>
                            <h3>Guías de Desarrollo</h3>
                            <ul>
                                <li>Programación básica en Lua</li>
                                <li>Diseño de niveles y mapas</li>
                                <li>Creación de scripts y herramientas</li>
                                <li>Monetización y publicación de juegos</li>
                            </ul>
                        </div>
                        <button class="modal-action-btn">Explorar guías</button>
                    </div>
                `;
                break;
                
            case 'noticias':
                modalContent = `
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        <h2 class="modal-title">📰 Últimas Noticias</h2>
                        <div class="modal-body">
                            <p>Mantente al día con las últimas novedades del mundo Roblox:</p>
                            <h3>Actualizaciones Recientes</h3>
                            <ul>
                                <li><strong>Nueva actualización de avatar:</strong> Más opciones de personalización y animaciones mejoradas</li>
                                <li><strong>Roblox Studio 2.0:</strong> Herramientas avanzadas para creadores</li>
                                <li><strong>Eventos especiales:</strong> Summer Games 2024 con recompensas exclusivas</li>
                            </ul>
                            <h3>Nuevos Lanzamientos</h3>
                            <ul>
                                <li><strong>Juegos trending:</strong> Nueva generación de experiencias inmersivas</li>
                                <li><strong>Colecciones exclusivas:</strong> Items limitados de diseñadores famosos</li>
                                <li><strong>Colaboraciones:</strong> Marcas reconocidas llegan a Roblox</li>
                            </ul>
                            <h3>Eventos de la Comunidad</h3>
                            <ul>
                                <li><strong>Concursos de construcción:</strong> Premios de hasta 1M Robux</li>
                                <li><strong>Streaming tournaments:</strong> Competiciones profesionales con grandes premios</li>
                                <li><strong>Charlas con desarrolladores:</strong> Sesiones exclusivas para creadores</li>
                            </ul>
                        </div>
                        <button class="modal-action-btn">Ver todas las noticias</button>
                    </div>
                `;
                break;
                
            case 'contacto':
                modalContent = `
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        <h2 class="modal-title">📧 Contacto</h2>
                        <div class="modal-body">
                            <p>¿Tienes preguntas, sugerencias o quieres colaborar con nosotros? ¡Estamos aquí para ayudarte!</p>
                            <div class="modal-contact-info">
                                <div class="modal-contact-item">
                                    <strong>📧 Correo electrónico:</strong><br>
                                    <a href="mailto:tomasribes11@gmail.com">tomasribes11@gmail.com</a>
                                </div>
                                <div class="modal-contact-item">
                                    <strong>📱 Teléfono:</strong><br>
                                    <a href="tel:655186002">655 186 002</a>
                                </div>
                            </div>
                            <h3>¿Cómo podemos ayudarte?</h3>
                            <ul>
                                <li>Soporte técnico y resolución de problemas</li>
                                <li>Colaboraciones y partnerships</li>
                                <li>Sugerencias para mejorar la web</li>
                                <li>Reportar bugs o errores</li>
                                <li>Propuestas de contenido y guías</li>
                            </ul>
                            <p><strong>🕐 Horario de respuesta:</strong>通常 respondemos dentro de 24-48 horas hábiles.</p>
                        </div>
                        <button class="modal-action-btn">Enviar mensaje</button>
                    </div>
                `;
                break;
                
            case 'auth':
                modalContent = `
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        <h2 class="modal-title">🔐 Bienvenido a Web Roblox</h2>
                        <div class="modal-body">
                            <div class="auth-tabs">
                                <button class="auth-tab active" data-tab="login">Iniciar sesión</button>
                                <button class="auth-tab" data-tab="register">Crear cuenta</button>
                            </div>
                            
                            <form class="auth-form active" id="loginForm">
                                <div class="form-group">
                                    <label class="form-label" for="loginEmail">Email</label>
                                    <input type="email" class="form-input" id="loginEmail" placeholder="tu@email.com" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="loginPassword">Contraseña</label>
                                    <input type="password" class="form-input" id="loginPassword" placeholder="••••••••" required>
                                </div>
                                <button type="submit" class="modal-action-btn">Iniciar sesión</button>
                            </form>
                            
                            <form class="auth-form" id="registerForm">
                                <div class="form-group">
                                    <label class="form-label" for="registerEmail">Email</label>
                                    <input type="email" class="form-input" id="registerEmail" placeholder="tu@email.com" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="registerPassword">Contraseña</label>
                                    <input type="password" class="form-input" id="registerPassword" placeholder="Mínimo 8 caracteres" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="confirmPassword">Confirmar contraseña</label>
                                    <input type="password" class="form-input" id="confirmPassword" placeholder="••••••••" required>
                                </div>
                                <button type="submit" class="modal-action-btn">Crear cuenta</button>
                            </form>
                            
                            <div class="auth-message" id="authMessage"></div>
                        </div>
                    </div>
                `;
                break;
                
            case 'articulo':
                const articles = {
                    1: {
                        title: '5 trucos secretos para conseguir Robux rápido',
                        description: 'Aprende cómo obtener Robux gratis de forma legal y mejorar tu juego.',
                        image: 'robux-image',
                        content: `
                            <h3>🔥 Trucos exclusivos para Robux:</h3>
                            <ul>
                                <li><strong>Completa misiones diarias:</strong> Gana hasta 100 Robux diarios completando tareas simples</li>
                                <li><strong>Participa en eventos especiales:</strong> Los eventos de temporada ofrecen recompensas generosas</li>
                                <li><strong>Crea y vende accesorios:</strong> Diseña items únicos y véndelos en el marketplace</li>
                                <li><strong>Únete a grupos premium:</strong> Muchos grupos ofrecen Robux como beneficio</li>
                                <li><strong>Canjea códigos promocionales:</strong> Sigue a Roblox en redes para obtener códigos exclusivos</li>
                            </ul>
                            <h3>⚠️ Métodos a evitar</h3>
                            <ul>
                                <li>Sitios que prometen "Robux gratis instantáneo"</li>
                                <li>Generadores de Robux online</li>
                                <li>Ofertas de Robux a precios irrealmente bajos</li>
                                <li>Apps que piden tu contraseña de Roblox</li>
                            </ul>
                            <p><strong>💡 Consejo final:</strong> La paciencia es clave. Construye tu fortuna de Robux de forma legítima y sostenible.</p>
                        `
                    },
                    2: {
                        title: 'Sube de nivel rápido en Blox Fruits',
                        description: 'Guía paso a paso para avanzar en Blox Fruits y dominar los niveles.',
                        image: 'blox-fruits-image',
                        content: `
                            <h3>⚔️ Estrategias para dominar Blox Fruits:</h3>
                            <ul>
                                <li><strong>Elige el fruit adecuado:</strong> Cada fruit tiene diferentes fortalezas y debilidades</li>
                                <li><strong>Farmea en zonas correctas:</strong> Nivel 1-50: Sea of Kings, Nivel 50-150: Skylands</li>
                                <li><strong>Domina las combos:</strong> Combina habilidades para máximo daño</li>
                                <li><strong>Únete a un crew activo:</strong> Los crews ofrecen bonificaciones y ayuda en misiones</li>
                                <li><strong>Aprovecha eventos de bosses:</strong> Spawn cada 4 horas con recompensas valiosas</li>
                            </ul>
                            <h3>🎯 Guía de niveles rápida</h3>
                            <ul>
                                <li><strong>Niveles 1-50:</strong> Enfócate en misiones principales y bosses fáciles</li>
                                <li><strong>Niveles 50-150:</strong> Farmea en Skylands y completa misiones de elite</li>
                                <li><strong>Niveles 150-300:</strong> Explora Third Sea y desafía bosses legendarios</li>
                                <li><strong>Niveles 300+:</strong> Domina el PvP y participa en eventos especiales</li>
                            </ul>
                            <p><strong>💡 Pro tip:</strong> Guarda tus puntos de habilidad hasta nivel 50 para maximizar tu build.</p>
                        `
                    },
                    3: {
                        title: 'Las mejores mascotas de Adopt Me y cómo conseguirlas',
                        description: 'Todo sobre las mascotas raras de Adopt Me y dónde encontrarlas.',
                        image: 'adopt-me-image',
                        content: `
                            <h3>🐾 Mascotas legendarias de Adopt Me:</h3>
                            <ul>
                                <li><strong>Shadow Dragon:</strong> La mascota más rara, disponible en Halloween 2019</li>
                                <li><strong>Giraffe:</strong> Exclusiva de safaris antiguos, extremadamente valiosa</li>
                                <li><strong>Bat Dragon:</strong> Evento de Halloween 2019, muy buscada por coleccionistas</li>
                                <li><strong>Frost Dragon:</strong> Disponible en Navidad, con efectos de hielo únicos</li>
                                <li><strong>Golden Pets:</strong> Versiones doradas de mascotas comunes con 10x más valor</li>
                            </ul>
                            <h3>🎯 Cómo conseguirlas</h3>
                            <ul>
                                <li><strong>Eventos especiales:</strong> Participa en eventos de temporada y holidays</li>
                                <li><strong>Trading:</strong> Negocia con otros jugadores usando valores de mercado</li>
                                <li><strong>Robux:</strong> Compra packs de mascotas con Robux (método más rápido)</li>
                                <li><strong>Adoption Island:</strong> Explora constantemente en busca de spawns raros</li>
                                <li><strong>Neon y Mega Neon:</strong> Evoluciona 4 mascotas idénticas para crear versiones brillantes</li>
                            </ul>
                            <h3>💰 Valores aproximados</h3>
                            <ul>
                                <li>Shadow Dragon: 2-3 millones de Robux</li>
                                <li>Giraffe: 1-2 millones de Robux</li>
                                <li>Bat Dragon: 800k-1.5 millones de Robux</li>
                                <li>Golden Pets: 10x el valor de la versión normal</li>
                            </ul>
                        `
                    }
                };
                
                const article = articles[data.articleId];
                modalContent = `
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        <div class="modal-article-header">
                            <div class="modal-article-image ${article.image}"></div>
                            <h2 class="modal-article-title">${article.title}</h2>
                            <p class="modal-article-description">${article.description}</p>
                        </div>
                        <div class="modal-body">
                            ${article.content}
                        </div>
                        <button class="modal-action-btn">Compartir artículo</button>
                    </div>
                `;
                break;
        }
        
        modal.innerHTML = modalContent;
        document.body.appendChild(modal);
        
        // Add auth functionality if auth modal
        if (type === 'auth') {
            setupAuthModal(modal);
        }
        
        // Add share functionality if article modal
        if (type === 'articulo') {
            const shareBtn = modal.querySelector('.modal-action-btn');
            shareBtn.addEventListener('click', () => {
                if (navigator.share) {
                    navigator.share({
                        title: articles[data.articleId].title,
                        text: articles[data.articleId].description,
                        url: window.location.href
                    });
                } else {
                    navigator.clipboard.writeText(window.location.href);
                    shareBtn.textContent = '¡Enlace copiado!';
                    setTimeout(() => {
                        shareBtn.textContent = 'Compartir artículo';
                    }, 2000);
                }
            });
        }
        
        // Close modal functionality
        const closeBtn = modal.querySelector('.modal-close');
        closeBtn.addEventListener('click', () => {
            modal.style.animation = 'fadeOut 0.3s forwards';
            setTimeout(() => modal.remove(), 300);
        });
        
        // Close on background click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.animation = 'fadeOut 0.3s forwards';
                setTimeout(() => modal.remove(), 300);
            }
        });
        
        // Add fadeOut animation
        if (!document.querySelector('#fadeout-animation')) {
            const fadeStyle = document.createElement('style');
            fadeStyle.id = 'fadeout-animation';
            fadeStyle.textContent = `
                @keyframes fadeOut {
                    to { opacity: 0; }
                }
            `;
            document.head.appendChild(fadeStyle);
        }
    }
    
    // Setup auth modal functionality
    function setupAuthModal(modal) {
        const tabs = modal.querySelectorAll('.auth-tab');
        const forms = modal.querySelectorAll('.auth-form');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const targetTab = this.dataset.tab;
                
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                forms.forEach(form => {
                    form.classList.remove('active');
                    if (form.id === targetTab + 'Form') {
                        form.classList.add('active');
                    }
                });
                
                const messageEl = modal.querySelector('.auth-message');
                messageEl.classList.remove('show', 'success', 'error');
            });
        });
        
        const loginForm = modal.querySelector('#loginForm');
        const registerForm = modal.querySelector('#registerForm');
        const messageEl = modal.querySelector('#authMessage');
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            if (email && password) {
                showMessage('success', `¡Bienvenido de nuevo ${email}! 🎮`);
                authBtn.textContent = email.split('@')[0];
                authBtn.style.background = 'linear-gradient(45deg, #00ff88, #00d4ff)';
                
                setTimeout(() => {
                    modal.style.animation = 'fadeOut 0.3s forwards';
                    setTimeout(() => modal.remove(), 300);
                }, 2000);
            } else {
                showMessage('error', 'Por favor completa todos los campos');
            }
        });
        
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (!email || !password || !confirmPassword) {
                showMessage('error', 'Por favor completa todos los campos');
            } else if (password.length < 8) {
                showMessage('error', 'La contraseña debe tener al menos 8 caracteres');
            } else if (password !== confirmPassword) {
                showMessage('error', 'Las contraseñas no coinciden');
            } else {
                showMessage('success', `¡Cuenta creada exitosamente ${email}! 🎉`);
                authBtn.textContent = email.split('@')[0];
                authBtn.style.background = 'linear-gradient(45deg, #00ff88, #00d4ff)';
                
                setTimeout(() => {
                    modal.style.animation = 'fadeOut 0.3s forwards';
                    setTimeout(() => modal.remove(), 300);
                }, 2000);
            }
        });
        
        function showMessage(type, text) {
            messageEl.textContent = text;
            messageEl.className = `auth-message ${type} show`;
        }
    }
    
    // Navigation modal handlers
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Close mobile menu
            mobileMenu.classList.remove('active');
            navMenu.classList.remove('active');
            
            const modalType = this.dataset.modal;
            if (modalType) {
                createModal(modalType);
            }
        });
    });
    
    // Auth button handler
    authBtn.addEventListener('click', function() {
        createModal('auth');
    });
    
    // Read more buttons handlers
    readMoreBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const articleId = this.dataset.article;
            createModal('articulo', { articleId });
        });
    });
    
    // Mobile menu toggle
    mobileMenu.addEventListener('click', function() {
        this.classList.toggle('active');
        navMenu.classList.toggle('active');
    });
    
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        const scrolled = window.pageYOffset;
        
        if (scrolled > 50) {
            navbar.style.background = 'rgba(15, 15, 35, 0.98)';
            navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.5)';
        } else {
            navbar.style.background = 'rgba(15, 15, 35, 0.95)';
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.3)';
        }
    });
    
    // Add click event to the start button
    startBtn.addEventListener('click', function() {
        // Smooth scroll to articles section
        articlesSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
        
        // Add a pulse animation to the button
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 200);
    });
    
    // Add typing effect to the main title
    const mainTitle = document.querySelector('.main-title');
    const originalText = mainTitle.textContent;
    mainTitle.textContent = '';
    
    let charIndex = 0;
    function typeWriter() {
        if (charIndex < originalText.length) {
            mainTitle.textContent += originalText.charAt(charIndex);
            charIndex++;
            setTimeout(typeWriter, 100);
        }
    }
    
    // Start typing effect after a short delay
    setTimeout(typeWriter, 500);
    
    // Add parallax effect to hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero');
        const mainTitle = document.querySelector('.main-title');
        const startBtn = document.querySelector('.start-btn');
        
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
        
        if (mainTitle) {
            mainTitle.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
        
        if (startBtn) {
            startBtn.style.transform = `translateY(${scrolled * 0.2}px)`;
        }
    });
    
    // Add ripple effect to button
    startBtn.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        // Add ripple styles if not already present
        if (!document.querySelector('#ripple-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                .start-btn {
                    position: relative;
                    overflow: hidden;
                }
                .ripple {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    pointer-events: none;
                }
                @keyframes ripple-animation {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
    
    // Add share functionality for article pages
    const shareBtns = document.querySelectorAll('.share-btn');
    shareBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: 'Echa un vistazo a este artículo de Web Roblox',
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(window.location.href);
                this.textContent = '¡Enlace copiado!';
                setTimeout(() => {
                    this.textContent = 'Compartir artículo';
                }, 2000);
            }
        });
    });
});
