-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 16, 2022 at 03:49 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_co` int(11) NOT NULL,
  `produit` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_co`, `produit`, `quantite`) VALUES
(23, 'CHUCK TAYLOR ALL STAR UNISEX - Baskets montantes', 5);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `couleur` set('blanc','noir','marron','rose','rouge','vert','bleu','gris','jaune','violet','orange') NOT NULL,
  `type` set('lifestyle','talons','chaussures plates','sport') NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `image`, `nom`, `prix`, `description`, `couleur`, `type`, `stock`) VALUES
(1, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/9ab66d6f-8282-4f0d-a915-7a3c3578b0cb/chaussure-air-force-1-pour-bvwgdr.png', 'Nike Air Force 1', 110, 'À vous offrir ou à offrir à un ami. Des détails colorés festifs sur la languette et au talon s’associent à une touche de rouge sur le cuir épuré, pour un look inédit et des sensations exceptionnelles.', 'blanc', 'lifestyle', 21),
(5, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5,q_80/9412d221-4a00-434b-9a7b-08c7f86121f7/chaussure-de-running-sur-route-air-zoom-pegasus-38-ekiden-pour-4H7XCX.png', 'Nike Air Zoom Pegasus 38 Ekiden \'\'', 210, ' Chaussure de course conçue pour vous porter kilomètre après kilomètre, la Nike Air Zoom Pegasus 38 Ekiden continue d\'apporter du rebond à votre foulée en conservant la même mousse réactive que le modèle précédent. L\'empeigne en mesh vous offre tout le confort et la résistance dont vous avez besoin avec une coupe qui rappelle la Pegasus classique.', 'jaune', 'sport', 11),
(6, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/a5fbfbd7-ca76-4703-83a3-fcc9f82f7255/chaussures-air-force-1-07-pour-kdPWF0.png', 'Nike Air Force 1 \'07', 100, ' Le charme continue d\'opérer avec la Nike Air Force 1 ’07. Cette silhouette emblématique du basketball revisite ses éléments les plus célèbres : les renforts cousus résistants, les finitions sobres et juste ce qu\'il faut d\'éclat pour vous faire briller. Les différents logos Swoosh sur le côté vous permettent d’afficher votre passion pour la marque.', 'blanc', 'lifestyle', 9),
(8, 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/5ded7992-ca1c-4ddd-bff2-3c7062782fbf/chaussure-de-running-sur-route-air-zoom-pegasus-38-pour-dfGzpq.png', 'Nike Air Zoom Pegasus 38', 119, ' La chaussure ailée ultra-performante est de retour. La Nike Air Zoom Pegasus 38 continue d\'apporter du rebond à votre foulée en conservant la même mousse réactive que le modèle précédent. L\'empeigne en mesh respirant vous offre le confort et la durabilité dont vous avez besoin, avec une coupe plus large au niveau des orteils.', 'rouge', 'sport', 38),
(18, 'https://img01.ztat.net/article/spp-media-p1/4217d72b75703f32a8c2551a4ff7c754/2fb0283033024b3b86edaffe89443e03.jpg?imwidth=1800&filter=packshot', 'Sandales à talons hauts', 25.99, 'Bout de la chaussure: Ouvert  \r\nFermeture: Boucle  \r\nMotif / Couleur: Couleur unie ', 'noir', 'talons', 30),
(19, 'https://www.lamodeuse.com/326332-thickbox_default/bottes-noires-a-talon-avec-bords-arrondis.jpg', 'Bottes noires à talon avec bords arrondis', 35.99, 'Bottes en simili à bout pointu et talon carré.\r\n\r\nBords arrondis avec languette de chaque côté.\r\nDotées d\'une fermeture à glissière côté intérieur.\r\n\r\nIntérieur légèrement fourré pour plus de confort.\r\nTige, semelle intérieure & extérieure : synthétique.', 'noir', 'talons', 25),
(20, 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_2000,h_2000/global/376381/01/sv01/fnd/EEA/fmt/png/Chaussures-d\'athl%C3%A9tisme-evoSPEED-Tokyo-Future-JUMP', 'Chaussures d\'athlétisme evoSPEED Tokyo Future JUMP', 150, 'Besoin d\'une vitesse maximale sur la piste ? À la recherche du décollage le plus puissant possible ? Ces chaussures d\'athlétisme validées par World Athletics sont la solution idéale pour les perchistes ou sauteurs en longueur désireux de placer la barre encore plus haut. Une plaque de fibre de carbone est intégrée du milieu du pied à l\'avant-pied pour vous offrir une propulsion parfaite. De plus, la tige est dotée de la technologie Matryx Micro de PUMA, qui offre un soutien supplémentaire lors du saut. Avec leurs crampons légers, ces chaussures vous aideront à sauter plus haut et plus loin que jamais.', 'vert', 'sport', 55),
(21, 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_2000,h_2000/global/380190/03/sv01/fnd/EEA/fmt/png/Baskets-CA-Pro-Classic', 'Baskets CA Pro Classic', 85, 'Depuis que la première PUMA California a fait son apparition dans les années 1980, elle s’est fait une place dans les rues. Toutes nouvelles parmi la collection de chaussures, les baskets CA Pro Classic présentent toutes les caractéristiques de la silhouette emblématique, telles que des lignes épurées, mais comprennent également des perforations parfaites et une semelle intermédiaire moulée. Inspirées de notre héritage mais parfaites pour notre époque, ces baskets à l’ambiance West Coast apporte de l’élégance à la simplicité.', 'blanc', 'lifestyle', 13),
(22, 'https://img01.ztat.net/article/spp-media-p1/289d73fc9aa2494eb5104c146f929b7b/f21555d17cba40919864dc5fda0f8866.jpg?imwidth=762&filter=packshot', 'VANS AUTHENTIC - Baskets basses', 62.15, 'Bout de la chaussure: Rond\r\nForme du talon: Plat\r\nFermeture: Laçage\r\nFermeture: Laçage\r\nMotif / Couleur: Couleur unie', 'marron', 'chaussures plates', 63),
(23, 'https://img01.ztat.net/article/spp-media-p1/ed304c90238f4ecca553544e55df338b/3498aafc1ca24fb99da48625222016a7.jpg?imwidth=762&filter=packshot', 'Baskets basses vertes', 25.99, 'Bout de la chaussure: Rond\r\nFermeture: Laçage\r\nMotif / Couleur: Couleur unie', 'vert', 'lifestyle', 35),
(24, 'https://img01.ztat.net/article/spp-media-p1/9482761f653446399b39c9c797dc2c82/1a5503684e7245e2af76ea8cac69c98e.jpg?imwidth=1800&filter=packshot', 'CHUCK TAYLOR ALL STAR UNISEX - Baskets montantes', 85.95, 'Bout de la chaussure: Rond\r\nForme du talon: Plat\r\nFermeture: Laçage\r\nMotif / Couleur: Imprimé', 'blanc', 'chaussures plates', 48);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `email`, `mdp`, `prenom`, `nom`) VALUES
(12, 'admin@admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_co`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_co` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
