<?php

// database/seeders/ArticleSeeder.php
// Seeds all 15 articles with their full content in ES, EN, and FR.
// Data extracted from the original mundo-roblox.html JavaScript objects:
//   - articles: body content (ES only in original, duplicated for EN/FR as placeholder)
//   - translations: titles and descriptions in all 3 locales

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $trucos   = Category::where('slug', 'trucos')->first();
        $guias    = Category::where('slug', 'guias')->first();
        $noticias = Category::where('slug', 'noticias')->first();

        // Each article: [slug, category, translations per locale]
        $articles = [

            // ─── TRUCOS ───────────────────────────────────────────────────
            [
                'slug'        => 'robux',
                'category_id' => $trucos->id,
                'translations' => [
                    'es' => [
                        'title'       => '5 trucos secretos para conseguir Robux rápido',
                        'description' => 'Aprende cómo obtener Robux gratis de forma legal y mejorar tu juego.',
                        'content'     => '<p>Aprende cómo obtener Robux gratis de forma legal y mejorar tu juego.</p><h3>🔥 Trucos exclusivos para Robux:</h3><ul><li><strong>Completa misiones diarias:</strong> Gana hasta 100 Robux diarios completando tareas simples</li><li><strong>Participa en eventos especiales:</strong> Los eventos de temporada ofrecen recompensas generosas</li><li><strong>Crea y vende accesorios:</strong> Diseña items únicos y véndelos en el marketplace</li><li><strong>Únete a grupos premium:</strong> Muchos grupos ofrecen Robux como beneficio</li><li><strong>Canjea códigos promocionales:</strong> Sigue a Roblox en redes para obtener códigos exclusivos</li></ul><h3>⚠️ Métodos a evitar</h3><ul><li>Sitios que prometen "Robux gratis instantáneo"</li><li>Generadores de Robux online</li><li>Ofertas de Robux a precios irrealmente bajos</li><li>Apps que piden tu contraseña de Roblox</li></ul><p><strong>💡 Consejo final:</strong> La paciencia es clave. Construye tu fortuna de Robux de forma legítima y sostenible.</p>',
                    ],
                    'en' => [
                        'title'       => '5 secret tricks to get Robux fast',
                        'description' => 'Learn how to get free Robux legally and improve your game.',
                        'content'     => '<p>Learn how to get free Robux legally and improve your game.</p><h3>🔥 Exclusive Robux tricks:</h3><ul><li><strong>Complete daily missions:</strong> Earn up to 100 Robux daily by completing simple tasks</li><li><strong>Participate in special events:</strong> Seasonal events offer generous rewards</li><li><strong>Create and sell accessories:</strong> Design unique items and sell them on the marketplace</li><li><strong>Join premium groups:</strong> Many groups offer Robux as a benefit</li><li><strong>Redeem promotional codes:</strong> Follow Roblox on social media for exclusive codes</li></ul><h3>⚠️ Methods to avoid</h3><ul><li>Sites that promise "instant free Robux"</li><li>Online Robux generators</li><li>Robux offers at unrealistically low prices</li><li>Apps that ask for your Roblox password</li></ul><p><strong>💡 Final tip:</strong> Patience is key. Build your Robux fortune legitimately and sustainably.</p>',
                    ],
                    'fr' => [
                        'title'       => '5 astuces secrètes pour obtenir des Robux rapidement',
                        'description' => 'Apprenez à obtenir des Robux gratuits légalement et améliorer votre jeu.',
                        'content'     => '<p>Apprenez à obtenir des Robux gratuits légalement et améliorer votre jeu.</p><h3>🔥 Astuces exclusives pour les Robux:</h3><ul><li><strong>Complétez des missions quotidiennes:</strong> Gagnez jusqu\'à 100 Robux par jour</li><li><strong>Participez aux événements spéciaux:</strong> Les événements saisonniers offrent des récompenses généreuses</li><li><strong>Créez et vendez des accessoires:</strong> Concevez des objets uniques et vendez-les sur le marketplace</li><li><strong>Rejoignez des groupes premium:</strong> Beaucoup de groupes offrent des Robux comme avantage</li><li><strong>Échangez des codes promotionnels:</strong> Suivez Roblox sur les réseaux sociaux</li></ul>',
                    ],
                ],
            ],

            [
                'slug'        => 'blox',
                'category_id' => $trucos->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Sube de nivel rápido en Blox Fruits',
                        'description' => 'Guía paso a paso para avanzar en Blox Fruits y dominar los niveles.',
                        'content'     => '<p>Guía paso a paso para avanzar en Blox Fruits y dominar los niveles.</p><h3>⚔️ Estrategias para dominar Blox Fruits:</h3><ul><li><strong>Elige la fruta correcta:</strong> Cada fruta tiene habilidades únicas</li><li><strong>Granja eficiente:</strong> Encuentra los mejores spots para farmear</li><li><strong>Combos de habilidades:</strong> Aprende combos devastadores</li><li><strong>Trabajo en equipo:</strong> Únete a squads para mazmorras</li><li><strong>Actualización de stats:</strong> Prioriza las estadísticas importantes</li></ul><h3>🏝️ Mejores lugares para farmear</h3><ul><li>Isla inicial (Niveles 1-50)</li><li>Desierto (Niveles 50-150)</li><li>Arctic (Niveles 150-300)</li><li>Legendary Island (Niveles 300+)</li></ul><h3>⚡ Tips avanzados</h3><ul><li>Usa habilidades de área para grupos de enemigos</li><li>Aprovecha los eventos dobles de XP</li><li>Completa todas las misiones diarias</li><li>Participa en raids de bosses</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Level up fast in Blox Fruits',
                        'description' => 'Step-by-step guide to advance in Blox Fruits and master the levels.',
                        'content'     => '<p>Step-by-step guide to advance in Blox Fruits and master the levels.</p><h3>⚔️ Strategies to dominate Blox Fruits:</h3><ul><li><strong>Choose the right fruit:</strong> Each fruit has unique abilities</li><li><strong>Efficient farming:</strong> Find the best spots to farm</li><li><strong>Skill combos:</strong> Learn devastating combos</li><li><strong>Teamwork:</strong> Join squads for dungeons</li><li><strong>Stats upgrade:</strong> Prioritize important statistics</li></ul><h3>🏝️ Best farming spots</h3><ul><li>Starting Island (Levels 1-50)</li><li>Desert (Levels 50-150)</li><li>Arctic (Levels 150-300)</li><li>Legendary Island (Levels 300+)</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Montez de niveau rapidement dans Blox Fruits',
                        'description' => 'Guide étape par étape pour progresser dans Blox Fruits et maîtriser les niveaux.',
                        'content'     => '<p>Guide étape par étape pour progresser dans Blox Fruits et maîtriser les niveaux.</p><h3>⚔️ Stratégies pour dominer Blox Fruits:</h3><ul><li><strong>Choisissez le bon fruit:</strong> Chaque fruit a des capacités uniques</li><li><strong>Farming efficace:</strong> Trouvez les meilleurs endroits pour farmer</li><li><strong>Combos de compétences:</strong> Apprenez des combos dévastateurs</li></ul>',
                    ],
                ],
            ],

            [
                'slug'        => 'adopt',
                'category_id' => $trucos->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Las mejores mascotas de Adopt Me y cómo conseguirlas',
                        'description' => 'Todo sobre las mascotas raras de Adopt Me y dónde encontrarlas.',
                        'content'     => '<p>Todo sobre las mascotas raras de Adopt Me y dónde encontrarlas.</p><h3>🐾 Mascotas Legendarias</h3><ul><li><strong>Shadow Dragon:</strong> Obtenible durante Halloween</li><li><strong>Giraffe:</strong> Solo disponible en safaris africanos</li><li><strong>Elf Hedgehog:</strong> Evento de Navidad exclusivo</li><li><strong>Bat Dragon:</strong> Halloween 2019 - muy raro</li><li><strong>Evil Unicorn:</strong> Evento especial de Halloween</li></ul><h3>🎯 Estrategias de obtención</h3><ul><li><strong>Trading:</strong> Intercambia con otros jugadores</li><li><strong>Eventos:</strong> Participa en eventos temporales</li><li><strong>Huevos:</strong> Compra huevos de ediciones limitadas</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'The best Adopt Me pets and how to get them',
                        'description' => 'All about rare Adopt Me pets and where to find them.',
                        'content'     => '<p>All about rare Adopt Me pets and where to find them.</p><h3>🐾 Legendary Pets</h3><ul><li><strong>Shadow Dragon:</strong> Obtainable during Halloween</li><li><strong>Giraffe:</strong> Only available in African safaris</li><li><strong>Elf Hedgehog:</strong> Exclusive Christmas event</li><li><strong>Bat Dragon:</strong> Halloween 2019 - very rare</li><li><strong>Evil Unicorn:</strong> Special Halloween event</li></ul><h3>🎯 Obtaining strategies</h3><ul><li><strong>Trading:</strong> Trade with other players</li><li><strong>Events:</strong> Participate in seasonal events</li><li><strong>Eggs:</strong> Buy limited edition eggs</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Les meilleurs animaux Adopt Me et comment les obtenir',
                        'description' => 'Tout sur les animaux rares Adopt Me et où les trouver.',
                        'content'     => '<p>Tout sur les animaux rares Adopt Me et où les trouver.</p><h3>🐾 Animaux Légendaires</h3><ul><li><strong>Shadow Dragon:</strong> Obtenu pendant Halloween</li><li><strong>Giraffe:</strong> Disponible uniquement en safari</li></ul>',
                    ],
                ],
            ],

            [
                'slug'        => 'trading',
                'category_id' => $trucos->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Master del Trading: Cómo negociar como un profesional',
                        'description' => 'Estrategias avanzadas para maximizar tus ganancias en el marketplace.',
                        'content'     => '<p>Estrategias avanzadas para maximizar tus ganancias en el marketplace.</p><h3>📊 Principios del Trading</h3><ul><li><strong>Oferta y demanda:</strong> Entiende el valor real</li><li><strong>Paciencia:</strong> No aceptes la primera oferta</li><li><strong>Investigación:</strong> Conoce los precios del mercado</li><li><strong>Red de contactos:</strong> Construye relaciones</li></ul><h3>💎 Items más valiosos</h3><ul><li><strong>Limited Items:</strong> Ediciones limitadas</li><li><strong>Vintage:</strong> Items antiguos</li><li><strong>Collections:</strong> Series completas</li></ul><h3>⚠️ Señales de alerta</h3><ul><li>Ofertas demasiado buenas para ser verdad</li><li>Usuarios con cuentas nuevas</li><li>Presión para aceptar rápidamente</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Trading Master: How to negotiate like a pro',
                        'description' => 'Advanced strategies to maximize your earnings in the marketplace.',
                        'content'     => '<p>Advanced strategies to maximize your earnings in the marketplace.</p><h3>📊 Trading Principles</h3><ul><li><strong>Supply and demand:</strong> Understand real value</li><li><strong>Patience:</strong> Don\'t accept the first offer</li><li><strong>Research:</strong> Know market prices</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Maître du Trading: Comment négocier comme un professionnel',
                        'description' => 'Stratégies avancées pour maximiser vos gains sur le marketplace.',
                        'content'     => '<p>Stratégies avancées pour maximiser vos gains sur le marketplace.</p><h3>📊 Principes du Trading</h3><ul><li><strong>Offre et demande:</strong> Comprenez la valeur réelle</li><li><strong>Patience:</strong> N\'acceptez pas la première offre</li></ul>',
                    ],
                ],
            ],

            [
                'slug'        => 'mobile',
                'category_id' => $trucos->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Roblox Mobile: Optimiza tu experiencia móvil',
                        'description' => 'Configuraciones y trucos para jugar Roblox en tu teléfono.',
                        'content'     => '<p>Configuraciones y trucos para jugar Roblox en tu teléfono.</p><h3>📱 Configuración óptima</h3><ul><li><strong>Gráficos:</strong> Ajusta según tu dispositivo</li><li><strong>Controles:</strong> Personaliza la interfaz</li><li><strong>Sensibilidad:</strong> Encuentra tu punto ideal</li></ul><h3>🔧 Mejoras de rendimiento</h3><ul><li>Cierra apps en segundo plano</li><li>Usa WiFi cuando sea posible</li><li>Limpia caché regularmente</li></ul><h3>🎮 Controles táctiles</h3><ul><li>Usa ambos pulgares para mayor precisión</li><li>Personaliza tamaño de botones</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Roblox Mobile: Optimize your mobile experience',
                        'description' => 'Settings and tricks to play Roblox on your phone.',
                        'content'     => '<p>Settings and tricks to play Roblox on your phone.</p><h3>📱 Optimal configuration</h3><ul><li><strong>Graphics:</strong> Adjust for your device</li><li><strong>Controls:</strong> Customize the interface</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Roblox Mobile: Optimisez votre expérience mobile',
                        'description' => 'Paramètres et astuces pour jouer à Roblox sur votre téléphone.',
                        'content'     => '<p>Paramètres et astuces pour jouer à Roblox sur votre téléphone.</p><h3>📱 Configuration optimale</h3><ul><li><strong>Graphiques:</strong> Ajustez selon votre appareil</li></ul>',
                    ],
                ],
            ],

            // ─── GUIAS ────────────────────────────────────────────────────
            [
                'slug'        => 'studio',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Guía completa de Roblox Studio para principiantes',
                        'description' => 'Aprende a crear tus propios juegos desde cero con herramientas profesionales.',
                        'content'     => '<p>Aprende a crear tus propios juegos desde cero con herramientas profesionales.</p><h3>🎨 Interfaz de Roblox Studio</h3><ul><li><strong>Explorer:</strong> Navegación de objetos del juego</li><li><strong>Properties:</strong> Configuración de elementos</li><li><strong>Toolbox:</strong> Biblioteca de modelos y assets</li><li><strong>Script Editor:</strong> Programación en Lua</li><li><strong>Test Mode:</strong> Prueba tu juego en tiempo real</li></ul><h3>🔧 Herramientas esenciales</h3><ul><li><strong>Select Tool:</strong> Seleccionar y mover objetos</li><li><strong>Move Tool:</strong> Precisión en el posicionamiento</li><li><strong>Scale Tool:</strong> Ajustar tamaño de objetos</li><li><strong>Rotate Tool:</strong> Rotar elementos con precisión</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Complete Roblox Studio guide for beginners',
                        'description' => 'Learn to create your own games from scratch with professional tools.',
                        'content'     => '<p>Learn to create your own games from scratch with professional tools.</p><h3>🎨 Roblox Studio Interface</h3><ul><li><strong>Explorer:</strong> Game object navigation</li><li><strong>Properties:</strong> Element configuration</li><li><strong>Toolbox:</strong> Model and asset library</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Guide complet de Roblox Studio pour débutants',
                        'description' => 'Apprenez à créer vos propres jeux à partir de zéro avec des outils professionnels.',
                        'content'     => '<p>Apprenez à créer vos propres jeux à partir de zéro avec des outils professionnels.</p><h3>🎨 Interface de Roblox Studio</h3><ul><li><strong>Explorer:</strong> Navigation des objets du jeu</li></ul>',
                    ],
                ],
            ],

            [
                'slug'        => 'scripting',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Programación en Lua: Scripts esenciales para tu juego',
                        'description' => 'Aprende los fundamentos de scripting y crea mecánicas increíbles.',
                        'content'     => '<p>Aprende los fundamentos de scripting y crea mecánicas increíbles.</p><h3>📝 Conceptos básicos de Lua</h3><ul><li><strong>Variables:</strong> Almacenamiento de datos</li><li><strong>Funciones:</strong> Bloques de código reutilizables</li><li><strong>Eventos:</strong> Respuesta a acciones del juego</li><li><strong>Condicionales:</strong> if/else para tomar decisiones</li><li><strong>Bucles:</strong> for y while para repetir acciones</li></ul><h3>🎮 Scripts esenciales</h3><ul><li><strong>LocalScript:</strong> Se ejecuta en el cliente del jugador</li><li><strong>Script:</strong> Se ejecuta en el servidor</li><li><strong>ModuleScript:</strong> Código reutilizable entre scripts</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Lua Programming: Essential scripts for your game',
                        'description' => 'Learn scripting fundamentals and create amazing mechanics.',
                        'content'     => '<p>Learn scripting fundamentals and create amazing mechanics.</p><h3>📝 Lua basics</h3><ul><li><strong>Variables:</strong> Data storage</li><li><strong>Functions:</strong> Reusable code blocks</li><li><strong>Events:</strong> Response to game actions</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Programmation Lua: Scripts essentiels pour votre jeu',
                        'description' => 'Apprenez les fondamentaux du scripting et créez des mécaniques incroyables.',
                        'content'     => '<p>Apprenez les fondamentaux du scripting et créez des mécaniques incroyables.</p><h3>📝 Bases de Lua</h3><ul><li><strong>Variables:</strong> Stockage de données</li></ul>',
                    ],
                ],
            ],

            [
                'slug'        => 'avatar',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Personalización Avatar: Crea un estilo único',
                        'description' => 'Descubre cómo personalizar tu avatar con outfits y accesorios exclusivos.',
                        'content'     => '<p>Descubre cómo personalizar tu avatar con outfits y accesorios exclusivos.</p><h3>👗 Componentes del Avatar</h3><ul><li><strong>Cabeza:</strong> Sombreros, peinados, caras</li><li><strong>Cuerpo:</strong> Ropa, capas, accesorios</li><li><strong>Extremidades:</strong> Guantes, botas, brazales</li></ul><h3>🎨 Estilos populares</h3><ul><li><strong>Streetwear:</strong> Ropa urbana y moderna</li><li><strong>Fantasy:</strong> Elementos mágicos y épicos</li><li><strong>Cyberpunk:</strong> Tecnología y neon</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Avatar Customization: Create a unique style',
                        'description' => 'Discover how to customize your avatar with exclusive outfits and accessories.',
                        'content'     => '<p>Discover how to customize your avatar with exclusive outfits and accessories.</p><h3>👗 Avatar Components</h3><ul><li><strong>Head:</strong> Hats, hairstyles, faces</li><li><strong>Body:</strong> Clothing, layers, accessories</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Personnalisation Avatar: Créez un style unique',
                        'description' => 'Découvrez comment personnaliser votre avatar avec des tenues et accessoires exclusifs.',
                        'content'     => '<p>Découvrez comment personnaliser votre avatar avec des tenues et accessoires exclusifs.</p>',
                    ],
                ],
            ],

            [
                'slug'        => 'games',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Top 10 juegos populares que debes probar ahora',
                        'description' => 'Los mejores juegos de Roblox con guías rápidas para empezar.',
                        'content'     => '<p>Los mejores juegos de Roblox con guías rápidas para empezar.</p><h3>🏆 Top 10 Juegos</h3><ul><li><strong>1. Brookhaven:</strong> Simulación de vida urbana</li><li><strong>2. Tower of Hell:</strong> Parkour extremo</li><li><strong>3. Piggy:</strong> Survival horror</li><li><strong>4. Adopt Me:</strong> Mascotas y familia</li><li><strong>5. Royale High:</strong> Escuela de fantasía</li><li><strong>6. MeepCity:</strong> Social y construcción</li><li><strong>7. Jailbreak:</strong> Policías vs ladrones</li><li><strong>8. Murder Mystery 2:</strong> Misterio y deducción</li><li><strong>9. Arsenal:</strong> Shooter competitivo</li><li><strong>10. Welcome to Bloxburg:</strong> Simulación de vida</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Top 10 popular games you should play now',
                        'description' => 'The best Roblox games with quick start guides.',
                        'content'     => '<p>The best Roblox games with quick start guides.</p><h3>🏆 Top 10 Games</h3><ul><li><strong>1. Brookhaven:</strong> Urban life simulation</li><li><strong>2. Tower of Hell:</strong> Extreme parkour</li><li><strong>3. Piggy:</strong> Survival horror</li><li><strong>4. Adopt Me:</strong> Pets and family</li><li><strong>5. Royale High:</strong> Fantasy school</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Top 10 jeux populaires à essayer maintenant',
                        'description' => 'Les meilleurs jeux Roblox avec des guides de démarrage rapides.',
                        'content'     => '<p>Les meilleurs jeux Roblox avec des guides de démarrage rapides.</p><h3>🏆 Top 10 Jeux</h3><ul><li><strong>1. Brookhaven:</strong> Simulation de vie urbaine</li></ul>',
                    ],
                ],
            ],

            [
                'slug'        => 'security',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Guía de seguridad: Protege tu cuenta de hackers',
                        'description' => 'Consejos esenciales para mantener tu cuenta Roblox segura.',
                        'content'     => '<p>Consejos esenciales para mantener tu cuenta Roblox segura.</p><h3>🔒 Configuración de seguridad</h3><ul><li><strong>2FA:</strong> Autenticación de dos factores</li><li><strong>Contraseña fuerte:</strong> Mínimo 12 caracteres</li><li><strong>Email verificado:</strong> Confirma tu correo</li><li><strong>PIN de cuenta:</strong> Código de seguridad adicional</li></ul><h3>⚠️ Señales de peligro</h3><ul><li>Ofertas de Robux gratis</li><li>Peticiones de contraseña</li><li>Links sospechosos</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Security Guide: Protect your account from hackers',
                        'description' => 'Essential tips to keep your Roblox account safe.',
                        'content'     => '<p>Essential tips to keep your Roblox account safe.</p><h3>🔒 Security setup</h3><ul><li><strong>2FA:</strong> Two-factor authentication</li><li><strong>Strong password:</strong> Minimum 12 characters</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Guide de Sécurité: Protégez votre compte des pirates',
                        'description' => 'Conseils essentiels pour maintenir votre compte Roblox en sécurité.',
                        'content'     => '<p>Conseils essentiels pour maintenir votre compte Roblox en sécurité.</p>',
                    ],
                ],
            ],

            [
                'slug'        => 'building',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Arquitectura Roblox: Construye mundos impresionantes',
                        'description' => 'Técnicas avanzadas de construcción y diseño de mapas.',
                        'content'     => '<p>Técnicas avanzadas de construcción y diseño de mapas.</p><h3>🏗️ Principios de diseño</h3><ul><li><strong>Balance:</strong> Simetría y proporción</li><li><strong>Flujo:</strong> Guía del jugador</li><li><strong>Atmósfera:</strong> Iluminación y ambiente</li></ul><h3>🎨 Técnicas avanzadas</h3><ul><li><strong>Terraforming:</strong> Modelado de terrenos</li><li><strong>Lighting:</strong> Iluminación profesional</li><li><strong>Mesh editing:</strong> Modelado 3D personalizado</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Roblox Architecture: Build impressive worlds',
                        'description' => 'Advanced building and map design techniques.',
                        'content'     => '<p>Advanced building and map design techniques.</p><h3>🏗️ Design principles</h3><ul><li><strong>Balance:</strong> Symmetry and proportion</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Architecture Roblox: Construisez des mondes impressionnants',
                        'description' => 'Techniques avancées de construction et de design de cartes.',
                        'content'     => '<p>Techniques avancées de construction et de design de cartes.</p>',
                    ],
                ],
            ],

            [
                'slug'        => 'monetization',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Monetización: Gana dinero con tus creaciones',
                        'description' => 'Estrategias para convertir tus juegos en una fuente de ingresos.',
                        'content'     => '<p>Estrategias para convertir tus juegos en una fuente de ingresos.</p><h3>💰 Métodos de monetización</h3><ul><li><strong>Game Passes:</strong> Ventas de acceso premium</li><li><strong>Developer Products:</strong> Compras dentro del juego</li><li><strong>Clothing:</strong> Diseño y venta de ropa</li></ul><h3>📈 Estrategias de éxito</h3><ul><li>Crea contenido de alta calidad</li><li>Actualiza regularmente tu juego</li><li>Escucha feedback de la comunidad</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Monetization: Earn money with your creations',
                        'description' => 'Strategies to turn your games into an income source.',
                        'content'     => '<p>Strategies to turn your games into an income source.</p><h3>💰 Monetization methods</h3><ul><li><strong>Game Passes:</strong> Premium access sales</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Monétisation: Gagnez de l\'argent avec vos créations',
                        'description' => 'Stratégies pour transformer vos jeux en source de revenus.',
                        'content'     => '<p>Stratégies pour transformer vos jeux en source de revenus.</p>',
                    ],
                ],
            ],

            [
                'slug'        => 'performance',
                'category_id' => $guias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Optimización: Mejora el rendimiento de tu juego',
                        'description' => 'Técnicas para que tu juego corra fluido en todos los dispositivos.',
                        'content'     => '<p>Técnicas para que tu juego corra fluido en todos los dispositivos.</p><h3>⚡ Optimización de scripts</h3><ul><li><strong>RemoteEvents:</strong> Reduce tráfico de red</li><li><strong>Object pooling:</strong> Reutiliza objetos</li><li><strong>Coroutine:</strong> Ejecución eficiente</li></ul><h3>🎨 Optimización gráfica</h3><ul><li><strong>LOD:</strong> Level of Detail</li><li><strong>Occlusion culling:</strong> Ocultación de objetos</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Optimization: Improve your game\'s performance',
                        'description' => 'Techniques to make your game run smoothly on all devices.',
                        'content'     => '<p>Techniques to make your game run smoothly on all devices.</p><h3>⚡ Script optimization</h3><ul><li><strong>RemoteEvents:</strong> Reduce network traffic</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Optimisation: Améliorez les performances de votre jeu',
                        'description' => 'Techniques pour que votre jeu fonctionne parfaitement sur tous les appareils.',
                        'content'     => '<p>Techniques pour que votre jeu fonctionne parfaitement sur tous les appareils.</p>',
                    ],
                ],
            ],

            // ─── NOTICIAS ─────────────────────────────────────────────────
            [
                'slug'        => 'events',
                'category_id' => $noticias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Eventos especiales: No te pierdas recompensas exclusivas',
                        'description' => 'Calendario de eventos y cómo aprovechar cada oportunidad.',
                        'content'     => '<p>Calendario de eventos y cómo aprovechar cada oportunidad.</p><h3>🎅 Eventos de temporada</h3><ul><li><strong>Halloween:</strong> Items temáticos de terror</li><li><strong>Navidad:</strong> Mascotas navideñas exclusivas</li><li><strong>Pascua:</strong> Huevos de Pascua coleccionables</li><li><strong>Verano:</strong> Accesorios playeros</li></ul><h3>📅 Calendario recomendado</h3><ul><li>Enero: Evento de Año Nuevo</li><li>Marzo: Festival de primavera</li><li>Julio: Summer Games</li><li>Octubre: Halloween Month</li><li>Diciembre: Winter Festival</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Special Events: Don\'t miss exclusive rewards',
                        'description' => 'Event calendar and how to take advantage of every opportunity.',
                        'content'     => '<p>Event calendar and how to take advantage of every opportunity.</p><h3>🎅 Seasonal events</h3><ul><li><strong>Halloween:</strong> Horror themed items</li><li><strong>Christmas:</strong> Exclusive Christmas pets</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Événements Spéciaux: Ne manquez pas les récompenses exclusives',
                        'description' => 'Calendrier des événements et comment profiter de chaque opportunité.',
                        'content'     => '<p>Calendrier des événements et comment profiter de chaque opportunité.</p>',
                    ],
                ],
            ],

            [
                'slug'        => 'social',
                'category_id' => $noticias->id,
                'translations' => [
                    'es' => [
                        'title'       => 'Comunidad Roblox: Crea amigos y únete a grupos',
                        'description' => 'Cómo socializar y encontrar jugadores con tus mismos intereses.',
                        'content'     => '<p>Cómo socializar y encontrar jugadores con tus mismos intereses.</p><h3>👥 Construye tu red social</h3><ul><li><strong>Amigos:</strong> Añade jugadores compatibles</li><li><strong>Grupos:</strong> Únete a comunidades activas</li><li><strong>Discord:</strong> Comunidades externas</li></ul><h3>💡 Tips de socialización</h3><ul><li>Sé respetuoso con todos</li><li>Participa en conversaciones</li><li>Ofrece ayuda a nuevos jugadores</li></ul>',
                    ],
                    'en' => [
                        'title'       => 'Roblox Community: Make friends and join groups',
                        'description' => 'How to socialize and find players with similar interests.',
                        'content'     => '<p>How to socialize and find players with similar interests.</p><h3>👥 Build your social network</h3><ul><li><strong>Friends:</strong> Add compatible players</li><li><strong>Groups:</strong> Join active communities</li></ul>',
                    ],
                    'fr' => [
                        'title'       => 'Communauté Roblox: Créez des amis et rejoignez des groupes',
                        'description' => 'Comment socialiser et trouver des joueurs avec des intérêts similaires.',
                        'content'     => '<p>Comment socialiser et trouver des joueurs avec des intérêts similaires.</p>',
                    ],
                ],
            ],

        ];

        foreach ($articles as $data) {
            $article = Article::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'category_id'  => $data['category_id'],
                    'cover_image'  => null,
                    'is_published' => true,
                    'published_at' => now(),
                ]
            );

            foreach ($data['translations'] as $locale => $translation) {
                $article->translations()->firstOrCreate(
                    ['locale' => $locale],
                    $translation
                );
            }
        }
    }
}
