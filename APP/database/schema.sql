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

-- ✅ Table des utilisateurs (clients, filleuls, etc.)
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(255) NOT NULL,
                       email VARCHAR(255) UNIQUE NOT NULL,
                       phone VARCHAR(50),
                       password VARCHAR(255), -- si tu veux gérer une authentification
                       sponsor_id INT DEFAULT NULL, -- parrainage
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       FOREIGN KEY (sponsor_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ✅ Table des recrutements (formulaire de candidature)
CREATE TABLE recruits (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          full_name VARCHAR(255) NOT NULL,
                          email VARCHAR(255) NOT NULL,
                          phone VARCHAR(50),
                          message TEXT,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ✅ Table des commandes (si tu veux gérer un suivi de ventes)
CREATE TABLE orders (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        product_id INT NOT NULL,
                        quantity INT DEFAULT 1,
                        total_price DECIMAL(10,2) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
