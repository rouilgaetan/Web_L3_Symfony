-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Mar 02 Avril 2019 à 19:11
-- Version du serveur :  5.5.62-0+deb8u1
-- Version de PHP :  5.6.40-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `grouil`
--

-- --------------------------------------------------------

--
-- Structure de la table `l31819_utilisateurs`
--

DROP TABLE l31819_panier;
DROP TABLE l31819_produits;

DROP TABLE l31819_utilisateurs;


CREATE TABLE l31819_utilisateurs (
  id int(11) NOT NULL,
  identifiant varchar(30) NOT NULL COMMENT 'sert de login',
  motdepasse varchar(60) NOT NULL COMMENT 'mot de passe crypté : il faut une taille assez grande pour ne pas le tronquer',
  nom varchar(30) DEFAULT NULL,
  prenom varchar(30) DEFAULT NULL,
  anniversaire date DEFAULT NULL,
  isadmin tinyint(1) NOT NULL DEFAULT 0,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des utilisateurs du site';

--
-- Contenu de la table `l31819_utilisateurs`
--

INSERT INTO l31819_utilisateurs (id, identifiant, motdepasse, nom, prenom, anniversaire, isadmin, created, modified) VALUES
(1, 'admin', 'a4cbb2f3933c5016da7e83fd135ab8a48b67bf61', NULL, NULL, NULL, 1, '2019-02-18 19:16:50', '2019-02-18 19:16:50'),
(2, 'gilles', 'ab9240da95937a0d51b41773eafc8ccb8e7d58b5', 'Subrenat', 'Gilles', '2000-01-01', 0, '2019-02-18 19:21:16', '2019-02-18 19:21:16'),
(3, 'rita', 'b734b62dedffaef8acaa43ad1c62ff213553aea9', 'Rita', 'Zrour', '2001-01-02', 0, '2019-02-18 19:21:16', '2019-02-18 19:21:16'),
(20, 'Propeace', '8296f90eee1f2da0f02ebf96c807ad45236a9667', 'RacaPe', 'TriStan', '2019-04-02', 0, '2019-04-02 18:34:25', '2019-04-02 18:34:25');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `l31819_utilisateurs`
--
ALTER TABLE l31819_utilisateurs
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY UNIQ_98F914AEC90409EC (identifiant);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `l31819_utilisateurs`
--
ALTER TABLE l31819_utilisateurs
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Structure de la table `l31819_produits`
--



CREATE TABLE l31819_produits (
  id int(11) NOT NULL,
  libelle varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  prix double NOT NULL,
  quantite int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `l31819_produits`
--

INSERT INTO l31819_produits (id, libelle, prix, quantite) VALUES
(1, 'cartable', 35, 181),
(2, 'Huîtres(à la douzaine)', 15, 13),
(3, 'Fontaine', 15000, 5),
(5, 'Poule aux oeufs d\'or', 750, 50),
(6, 'étagère KALLAX', 30, 1500);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `l31819_produits`
--
ALTER TABLE l31819_produits
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY UNIQ_C48349B3A4D60759 (libelle);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `l31819_produits`
--
ALTER TABLE l31819_produits
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



--
-- Structure de la table `l31819_panier`
--


CREATE TABLE l31819_panier (
  id int(11) NOT NULL,
  id_utilisateurs int(11) NOT NULL,
  id_produits int(11) NOT NULL,
  quantite_com int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `l31819_panier`
--
ALTER TABLE l31819_panier
  ADD PRIMARY KEY (id),
  ADD KEY IDX_89113E0B6ABA442C (id_utilisateurs),
  ADD KEY IDX_89113E0BEEF63319 (id_produits);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `l31819_panier`
--
ALTER TABLE l31819_panier
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `l31819_panier`
--
ALTER TABLE l31819_panier
  ADD CONSTRAINT FK_3A6F75FE6ABA442C FOREIGN KEY (id_utilisateurs) REFERENCES l31819_utilisateurs (id),
  ADD CONSTRAINT FK_3A6F75FEEEF63319 FOREIGN KEY (id_produits) REFERENCES l31819_produits (id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
