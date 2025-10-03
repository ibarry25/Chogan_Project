CREATE DATABASE Chogan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Chogan;

-- ✅ Table des produits
CREATE TABLE products (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255) NOT NULL,
                          description TEXT,
                          price DECIMAL(10,2) NOT NULL,
                          category VARCHAR(100),
                          image_url VARCHAR(255),
                          chogan_link VARCHAR(255), -- lien vers le site officiel
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ✅ Table des utilisateurs (clients, filleuls, distributeurs)
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(255) NOT NULL,
                       email VARCHAR(255) UNIQUE NOT NULL,
                       phone VARCHAR(50),
                       password VARCHAR(255), -- pour authentification
                       role ENUM('client','distributeur','admin') DEFAULT 'client',
                       sponsor_id INT DEFAULT NULL, -- parrainage
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       FOREIGN KEY (sponsor_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ✅ Table des recrutements (candidatures de futurs distributeurs)
CREATE TABLE recruits (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          full_name VARCHAR(255) NOT NULL,
                          email VARCHAR(255) NOT NULL,
                          phone VARCHAR(50),
                          message TEXT,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ✅ Table des commandes
CREATE TABLE orders (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        total_price DECIMAL(10,2) NOT NULL,
                        statut ENUM('en_attente','payee','expediee','livree','annulee') DEFAULT 'en_attente',
                        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ✅ Table des détails de commande (plus propre qu’un produit direct dans orders)
CREATE TABLE order_items (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             order_id INT NOT NULL,
                             product_id INT NOT NULL,
                             quantity INT DEFAULT 1,
                             price DECIMAL(10,2) NOT NULL, -- prix fixé au moment de la commande
                             FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
                             FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- ✅ Table des paiements
CREATE TABLE payments (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          order_id INT NOT NULL,
                          method ENUM('carte','paypal','virement') NOT NULL,
                          statut ENUM('en_attente','valide','echoue') DEFAULT 'en_attente',
                          amount DECIMAL(10,2) NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- ✅ Table des livraisons
CREATE TABLE deliveries (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            order_id INT NOT NULL,
                            adresse VARCHAR(255) NOT NULL,
                            ville VARCHAR(100) NOT NULL,
                            code_postal VARCHAR(20) NOT NULL,
                            pays VARCHAR(100) NOT NULL,
                            date_expedition TIMESTAMP NULL,
                            date_livraison TIMESTAMP NULL,
                            statut ENUM('en_preparation','expediee','livree') DEFAULT 'en_preparation',
                            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- ✅ Table des avis clients
CREATE TABLE reviews (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         product_id INT NOT NULL,
                         user_id INT NOT NULL,
                         note INT CHECK(note BETWEEN 1 AND 5),
                         commentaire TEXT,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
                         FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ✅ Table des articles de blog
CREATE TABLE articles (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          titre VARCHAR(255) NOT NULL,
                          contenu TEXT NOT NULL,
                          image_url VARCHAR(255),
                          auteur_id INT NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          FOREIGN KEY (auteur_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ✅ Table des commentaires sur articles
CREATE TABLE article_comments (
                                  id INT AUTO_INCREMENT PRIMARY KEY,
                                  article_id INT NOT NULL,
                                  user_id INT NOT NULL,
                                  contenu TEXT NOT NULL,
                                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                  FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
                                  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ✅ Table des abonnements newsletter
CREATE TABLE newsletter (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            email VARCHAR(255) UNIQUE NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
