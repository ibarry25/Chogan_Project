<?php
session_start();

// Récupère l'utilisateur connecté si présent
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <base target="_self">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chogan - Parfums, Soins et Cosmétiques</title>
    <meta name="description" content="Découvrez les parfums et cosmétiques Chogan. Rejoignez notre équipe de distributeurs pour une aventure entrepreneuriale enrichissante.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#1a365d",
                        secondary: "#2d3748",
                        accent: "#d69e2e"
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600;700&display=swap');

        body { font-family: 'Montserrat', sans-serif; }
        h1,h2,h3,h4 { font-family: 'Playfair Display', serif; }

        .hero-gradient { background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%); }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); background-color: #1a365d; }
        .transition-all { transition: all 0.3s ease; }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
<!-- Header -->
<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="index.php" class="text-2xl font-bold text-primary">UNIVERS CHOGAN</a>
        </div>

        <div class="hidden md:flex space-x-8">
            <a href="#products" class="text-gray-700 hover:text-primary transition-all">Produits</a>
            <a href="#univers" class="text-gray-700 hover:text-primary transition-all">Univers</a>
            <a href="#blog" class="text-gray-700 hover:text-primary transition-all">Conseils</a>
            <a href="#recrutement" class="text-gray-700 hover:text-primary transition-all">Rejoindre l'équipe</a>
            <a href="#about" class="text-gray-700 hover:text-primary transition-all">Notre histoire</a>
        </div>

        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-700 hover:text-primary">
                <i class="fas fa-search"></i>
            </a>
            <a href="#" class="text-gray-700 hover:text-primary">
                <i class="fas fa-shopping-cart"></i>
            </a>

            <?php if($user): ?>
                <span class="text-gray-700">Bonjour, <?= htmlspecialchars($user['name']); ?> !</span>
                <a href="../src/routes.php?action=logout" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">Se déconnecter</a>
            <?php else: ?>
                <a href="login.html" class="bg-primary text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-800 transition-all">Connexion</a>
                <a href="register.html" class="border border-primary text-primary px-4 py-2 rounded-md text-sm font-semibold hover:bg-primary hover:text-white transition-all">Inscription</a>
            <?php endif; ?>

            <!-- Menu burger mobile -->
            <button class="md:hidden text-gray-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
</header>

<!-- Hero Section -->
<section class="hero-gradient text-white py-16 md:py-24">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-8 md:mb-0">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Découvrez l'univers Chogan</h1>
            <p class="text-xl mb-8">Parfums d'exception, soins innovants et une opportunité business unique</p>
            <div class="flex space-x-4">
                <a href="#products" class="bg-accent text-white px-6 py-3 rounded-md font-semibold hover:bg-yellow-600 transition-all">Découvrir les produits</a>
                <a href="#recrutement" class="border-2 border-white text-white px-6 py-3 rounded-md font-semibold hover:bg-white hover:text-primary transition-all">Rejoindre l'équipe</a>
            </div>
        </div>
        <div class="md:w-1/2">
            <img src="https://picsum.photos/600/400?random=1" alt="Collection de parfums Chogan" class="rounded-lg shadow-xl">
        </div>
    </div>
</section>

<!-- Univers de produits -->
<section id="univers" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Explorez nos univers</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            $univers = ["Homme", "Femme", "Vegan", "Bien-être"];
            for($i=0;$i<count($univers);$i++):
                ?>
                <div class="relative group cursor-pointer">
                    <div class="overflow-hidden rounded-lg">
                        <img src="https://picsum.photos/300/300?random=<?= $i+2 ?>" alt="Univers <?= $univers[$i] ?>" class="w-full h-48 object-cover group-hover:scale-110 transition-all duration-500">
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                        <h3 class="text-white text-xl font-semibold"><?= $univers[$i] ?></h3>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Produits phares -->
<section id="products" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-4">Nos produits phares</h2>
        <p class="text-center text-gray-600 mb-12">Découvrez nos best-sellers et nouveautés</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $produits = [
                ["Parfum Signature Homme","Une fragrance boisée et épicée pour l'homme moderne","59,90€",6],
                ["Soin Hydratant Intense","Hydratation 24h pour une peau nourrie et radieuse","42,50€",7],
                ["Parfum Fleuri Femme","Une fragrance florale et envoûtante pour la femme contemporaine","62,00€",8]
            ];
            foreach($produits as $p):
                ?>
                <div class="bg-white rounded-lg overflow-hidden shadow-md product-card transition-all">
                    <img src="https://picsum.photos/400/300?random=<?= $p[3] ?>" alt="<?= $p[0] ?>" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2"><?= $p[0] ?></h3>
                        <p class="text-gray-600 mb-4"><?= $p[1] ?></p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-primary"><?= $p[2] ?></span>
                            <span class="text-sm text-gray-500">★ 4.8 (124 avis)</span>
                        </div>
                        <button onclick="alert('Redirection vers le produit');" class="w-full bg-primary text-white py-2 rounded-md hover:bg-blue-800 transition-all">Acheter maintenant</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-12">
            <a href="#" class="inline-block border-2 border-primary text-primary px-6 py-3 rounded-md font-semibold hover:bg-primary hover:text-white transition-all">Voir tout le catalogue</a>
        </div>
    </div>
</section>

<!-- Section Recrutement -->
<section id="recrutement" class="py-16 bg-primary text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h2 class="text-3xl font-bold mb-6">Rejoignez l'aventure Chogan</h2>
                <p class="text-lg mb-4">Devenez distributeur indépendant et construisez votre business à votre rythme</p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                        <span>Formation complète et accompagnement personnalisé</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                        <span>Rémunération attractive avec multiples sources de revenus</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                        <span>Flexibilité horaire et travail à distance</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                        <span>Communauté bienveillante et événements motivants</span>
                    </li>
                </ul>
            </div>
            <div class="md:w-1/2 bg-white text-gray-800 rounded-lg p-8 shadow-xl">
                <h3 class="text-2xl font-bold mb-6 text-center">Devenez distributeur Chogan</h3>
                <form id="recruitment-form" class="space-y-4">
                    <div>
                        <label for="name" class="block mb-1">Nom complet</label>
                        <input type="text" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
                    </div>
                    <div>
                        <label for="email" class="block mb-1">Email</label>
                        <input type="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
                    </div>
                    <div>
                        <label for="phone" class="block mb-1">Téléphone</label>
                        <input type="tel" id="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
                    </div>
                    <button type="submit" class="w-full bg-accent text-white py-2 rounded-md font-semibold hover:bg-yellow-600 transition-all">Je m'inscris</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-secondary text-white py-12">
    <div class="container mx-auto px-4 grid md:grid-cols-3 gap-8">
        <div>
            <h3 class="text-xl font-bold mb-4">UNIVERS CHOGAN</h3>
            <p>Parfums, soins et cosmétiques de qualité. Rejoignez notre communauté et vivez l'expérience Chogan.</p>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-4">Liens utiles</h3>
            <ul class="space-y-2">
                <li><a href="#products" class="hover:text-accent transition">Produits</a></li>
                <li><a href="#univers" class="hover:text-accent transition">Univers</a></li>
                <li><a href="#recrutement" class="hover:text-accent transition">Recrutement</a></li>
                <li><a href="#about" class="hover:text-accent transition">À propos</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-4">Contact</h3>
            <p>Email: contact@chogan.fr</p>
            <p>Téléphone: +33 1 23 45 67 89</p>
            <div class="flex space-x-4 mt-4">
                <a href="#" class="hover:text-accent transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-accent transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-accent transition"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <div class="text-center mt-12 text-gray-400">
        &copy; <?= date('Y'); ?> Univers Chogan. Tous droits réservés.
    </div>
</footer>

<script>
    document.getElementById('recruitment-form').addEventListener('submit', function(e){
        e.preventDefault();
        alert('Formulaire soumis !');
    });
</script>
</body>
</html>
