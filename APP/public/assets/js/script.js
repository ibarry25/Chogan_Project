// Données des produits (à compléter avec les vrais produits)
const products = [
    {
        id: 1,
        name: "Parfum Signature Homme",
        description: "Une fragrance boisée et épicée pour l'homme moderne",
        price: "59,90€",
        rating: 4.8,
        reviews: 124,
        image: "https://picsum.photos/400/300?random=6",
        category: "homme"
    },
    {
        id: 2,
        name: "Soin Hydratant Intense",
        description: "Hydratation 24h pour une peau nourrie et radieuse",
        price: "42,50€",
        rating: 4.9,
        reviews: 87,
        image: "https://picsum.photos/400/300?random=7",
        category: "soins"
    },
    {
        id: 3,
        name: "Parfum Fleuri Femme",
        description: "Une fragrance florale et envoûtante pour la femme contemporaine",
        price: "62,00€",
        rating: 4.7,
        reviews: 156,
        image: "https://picsum.photos/400/300?random=8",
        category: "femme"
    }
];

// Redirection vers le site officiel Chogan avec l'identifiant distributeur
function redirectToChogan(productId) {
    // Remplacer par votre identifiant distributeur réel
    const distributorId = "VOTRE_ID_DISTRIBUTEUR";
    // URL de redirection vers le site officiel Chogan avec l'identifiant
    window.open(`https://www.chogan.com/produit/${productId}?distributor=${distributorId}`, '_blank');
}

// Gestion du formulaire de recrutement
document.getElementById('recruitment-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Récupération des données du formulaire
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        message: document.getElementById('message').value
    };

    // Ici, vous ajouteriez le code pour envoyer ces données à votre système
    // Par exemple via EmailJS, Formspree, ou votre backend

    alert("Merci pour votre intérêt ! Nous vous contacterons très rapidement.");
    this.reset();
});

// Navigation fluide
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});