-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Machine: localhost:3306
-- Gegenereerd op: 13 jun 2015 om 21:22
-- Serverversie: 5.5.38
-- PHP-versie: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `dhz`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_newsletter_subscriptions`
--

CREATE TABLE `dhz_newsletter_subscriptions` (
`id` int(11) NOT NULL,
  `e_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_newsletter_subscriptions`
--

INSERT INTO `dhz_newsletter_subscriptions` (`id`, `e_mail`) VALUES
(1, 'katia.smet@student.howest.be'),
(2, 'sofie@gmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_orders`
--

CREATE TABLE `dhz_orders` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_orders`
--

INSERT INTO `dhz_orders` (`id`, `user_id`, `creation_date`) VALUES
(1, 1, '2015-06-18'),
(2, 1, '2015-06-26'),
(17, 1, '2015-06-11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_order_items`
--

CREATE TABLE `dhz_order_items` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_order_items`
--

INSERT INTO `dhz_order_items` (`id`, `order_id`, `package_id`, `amount`) VALUES
(1, 1, 1, 2),
(2, 2, 5, 1),
(6, 11, 1, 1),
(7, 12, 2, 1),
(8, 13, 3, 1),
(9, 14, 4, 1),
(10, 15, 3, 1),
(11, 16, 3, 1),
(12, 17, 3, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_packages`
--

CREATE TABLE `dhz_packages` (
`id` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8_unicode_ci NOT NULL,
  `small_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `large_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_packages`
--

INSERT INTO `dhz_packages` (`id`, `views`, `title`, `short_description`, `long_description`, `small_image`, `large_image`, `price`, `promo`) VALUES
(1, 74, 'waterpret-pakket', 'Vorm je mini-waterpretpark met of zonder zwembad.', '<p>Vorm je mini-waterpretpark met of zonder zwembad.</p>\r\n<ul class="custom-list">\r\n<li>stel je glijbaan samen in verschillende vormen en lengtes</li>\r\n<li>versnel het tempo met groen slijm </li>\r\n<li>val aan met het waterpistool</li>\r\n</ul>', 'img/waterpret/small.svg', 'img/waterpret/large.svg', 175.00, ''),
(2, 8, 'hoog in de wolken-pakket', 'Lanceer jezelf in de lucht en zweef boven je buurt. ', '<p>Lanceer jezelf in de lucht en zweef boven je buurt. </p>\r\n<ul class="custom-list">\r\n<li>Lancering met rubber lint</li>\r\n<li>Blijven zweven met je parachute</li>\r\n<li>Zachte landing in het opvangnet</li>\r\n</ul>', 'img/hoogindewolken/small.svg', 'img/hoogindewolken/large.svg', 210.00, 'parachute-accessoires'),
(3, 8, 'snelheidsduivels-pakket', 'Stel een snelle achtbaan op je in je achtertuin.', '<p>Stel een snelle achtbaan op je in je achtertuin.</p>\r\n<ul class="custom-list">\r\n<li>Bouw een houten parcours op jouw maat</li>\r\n<li>Personaliseer je wagon vanbinnen en vanbuiten</li>\r\n<li>Rek de aandrijfrekker uit en laat los tegen volle snelheid</li>\r\n</ul>', 'img/snelheidsduivels/small.gif', 'img/snelheidsduivels/large.svg', 385.00, ''),
(4, 2, 'beestenboel-pakket', 'Een mini-dierentuin met vissen, reptielen of knaagdieren in je woonkamer.', '<p>Een mini-dierentuin met vissen, reptielen of knaagdieren in je woonkamer.</p>\r\n<ul class="custom-list">\r\n<li>Baken je terrein af met cellofaan</li>\r\n<li>Gebruik de voorraadpot als aquarium of terrarium</li>\r\n<li>Naai een gezellige hoek in fleece</li>\r\n</ul>', 'img/beestenboel/small.svg', 'img/beestenboel/large.svg', 80.00, 'voedselpakket'),
(5, 10, 'casino-pakket ', 'Ontwerp je flipperkast en beheers je eigen spel. ', '<p>Lanceer jezelf in de lucht en zweef boven je buurt.</p>\r\n<ul class="custom-list"> \r\n<li>Lancering met rubber lint</li>\r\n<li>Blijven zweven met je parachute</li>\r\n<li>Zachte landing in het opvangnet</li>\r\n</ul>', 'img/casino/small.svg', 'img/casino/large.svg', 145.00, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_package_items`
--

CREATE TABLE `dhz_package_items` (
`id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_package_items`
--

INSERT INTO `dhz_package_items` (`id`, `package_id`, `item`, `description`, `image`) VALUES
(1, 1, 'set leidingbuizen ', 'Uitschuifbaar in verschillende lengtes. Zowel gebogen als rechte exemplaren.', 'img/waterpret/1.svg'),
(2, 1, 'waterzeil ', 'Extra snel in de buis of op de grond. ', 'img/waterpret/2.svg'),
(3, 1, '5l groen slijm', 'Om snelheid te maken of zeepbellen te blazen. ', 'img/waterpret/3.svg'),
(4, 1, 'waterpistool ', 'Val aan op het juiste moment.', 'img/waterpret/4.svg'),
(5, 1, 'grote kantelemmer', 'Ophangen en constant vullen met water tot hij kantelt. Spring jij op tijd weg?', 'img/waterpret/5.svg'),
(6, 2, 'opvangnet van 3m diameter', 'bestand tegen allerlei weersomstandigheden. Vangt je op of lanceert je opnieuw. ', 'img/hoogindewolken/1.svg'),
(7, 2, 'rekbaar rubberen lint', 'Een stevige lancering van de grond naar de lucht.', 'img/hoogindewolken/2.svg'),
(8, 2, 'veiligheidspamper', 'Bevestig jezelf aan het rubberen lint met de pamper.', 'img/hoogindewolken/3.svg'),
(9, 2, 'knotsgekke helm', 'Hoog in de wolken, liever niet in de bomen. ', 'img/hoogindewolken/4.svg'),
(10, 2, 'parachuttestof ', 'Zweef en geniet na met de parachute.', 'img/hoogindewolken/5.svg'),
(11, 2, '<span class="promo">promo:</span>parachute-accessoires', 'Bestel nu en verfijn je parachute met veilige accessoires. ', 'img/hoogindewolken/6.svg'),
(12, 3, 'rubberen aandrijfrekker', 'Te bevestigen op de juiste plaats, loslaten op het ideale moment', 'img/snelheidsduivels/1.svg'),
(13, 3, 'rechthoekige kist ', 'Inrichten in je eigen thema of de wagon rechtsreeks in gebruik nemen.', 'img/snelheidsduivels/2.svg'),
(14, 3, 'houten minilooping', 'Moeilijke constructie op een veilige manier', 'img/snelheidsduivels/3.svg'),
(15, 3, 'halve maan-brug', 'Extra snelheid tijdens de daling. ', 'img/snelheidsduivels/4.svg'),
(16, 3, 'set rails', 'bouw je eigen parcours. Verschillende lengtes zowel recht als gebogen. ', 'img/snelheidsduivels/5.svg'),
(17, 4, 'grote voorraadpot ', 'Dik kwaliteitsglas en voorzien van een multifunctioneel deksel met voldoende oxidatie voor jouw dier. De basis van jouw terrarium of aquarium.', 'img/beestenboel/1.svg'),
(18, 4, 'pak omheiningscellofaan ', 'Makkelijk in vorm knippen en te gebruiken als omheining of beschermende bodem. ', 'img/beestenboel/2.svg'),
(19, 4, 'set ijsstokjes ', 'Eenvoudig te verwerken in speelgoed of omheining. Stevig, makkelijk aan te vullen en makkelijk te beschilderen. ', 'img/beestenboel/3.svg'),
(20, 4, 'terracottapot', 'Waterdicht om te gebruiken als vijver of drinkbak. Te beschilderen in jouw thema. ', 'img/beestenboel/4.svg'),
(21, 4, '1m gezellige fleecestof ', 'Naai een slaaphoek of bescherm je bodem. ', 'img/beestenboel/5.svg'),
(22, 4, '<span class="promo">promo:</span> voedselpakket', 'Bestel nu en ontvang een voedselpakket voor knaagdieren. ', 'img/beestenboel/6.svg'),
(23, 5, 'blanco themakaart', 'Ontwerp je eigen thema met een materiaal naar keuze.', 'img/casino/1.svg'),
(24, 5, 'bonustoeter', 'Bij elke bonus getoeter en gejuich. ', 'img/casino/2.svg'),
(25, 5, 'set fimo-klei', 'Vorm pionnen in fimo-klei en bak af. ', 'img/casino/3.svg'),
(26, 5, 'krulbare schietstaven', 'Vermijd een game-over met ronde of rechte schietstaven.', 'img/casino/4.svg'),
(27, 5, 'behuizingsonderdelen', 'Stevige behuizing met de nodige elektronica. ', 'img/casino/5.svg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_reviews`
--

CREATE TABLE `dhz_reviews` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  `review` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_reviews`
--

INSERT INTO `dhz_reviews` (`id`, `user_id`, `package_id`, `creation_date`, `review`) VALUES
(1, 5, 2, '2015-06-09', 'Mijn kinderen vinden onze nieuwe attractie echt top. '),
(2, 2, 5, '2015-06-10', 'Samen met de buurt verzorgen we ons nieuw dierenpark. '),
(3, 4, 1, '2015-06-24', 'Ons zwembad is een heus waterparadijs in de zomer. '),
(4, 3, 2, '2015-06-29', 'Veilig en fantastisch gevoel. '),
(5, 1, 5, '2015-06-09', 'Makkelijke handleiding. De gepersonaliseerde flipperkast is echt fantastisch.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_users`
--

CREATE TABLE `dhz_users` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visible_map` tinyint(4) NOT NULL,
  `contact_possible` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_users`
--

INSERT INTO `dhz_users` (`id`, `first_name`, `last_name`, `adres`, `postal_code`, `city`, `e_mail`, `password`, `visible_map`, `contact_possible`) VALUES
(1, 'Katia', 'Smet', 'Martelaarslaan 369', 9000, 'Gent', 'katia.smet@student.howest.be', '$2y$12$LQG6Go1/zMhzAu8q8QHXMu5Ubw/G98A0E0kOkbjbpvBy8PG5.sNAu', 1, 1),
(2, 'Valerie', 'Vercruysen', 'Ijzeren Kaai 2', 2000, 'Antwerpen', 'valerie.vc@gmail.com', '$2y$12$9ndqbs.98kcpF1OOCj.DPeUZ6fIQSO6aIyEu89R9tjQsdSzSvZoNS', 0, 0),
(3, 'Ben', 'Driessens', 'Kerkstraat 5', 8500, 'Kortrijk', 'ben@gmail.com', '$2y$12$X5HUOBs.3lMCcYq.PGsmbeTnMTIVlP86lU0xCLBwJqgtldESYq.Uu', 0, 0),
(4, 'Elise', 'Taelman', 'Parklaan 5', 9800, 'Deinze', 'elise@hotmail.com', '$2y$12$3hWqK.bDoS61isUQe38YJuBE0vVzzFRssNnWEnDlPHEN9RW4Af1B2', 1, 0),
(5, 'Lukas', 'Martens', 'Leeflaan 16', 9000, 'Gent', 'lukas@hotmail.com', '$2y$12$2SnrDDGH5K.dnIxv5TydQuDrr/zksXQZIl6LLx6TeoybU6tMqDX9y', 0, 1),
(6, 'Bob', 'Vercruysen', 'Nieuwewandeling 2', 9000, 'Gent', 'bob@gmail.com', '$2y$12$KoEjokEtEuNsJQmzv4KVAuYDyxJnQGNJtFORBdsgI0CLodn2sb/yi', 1, 1),
(7, 'Stan', 'Verdiest', 'Hogebokstraat 95', 9111, 'Belsele', 'stan@gmail.com', '$2y$12$UX5LSifVGiqdafmQp27GZuE6U8s0p80m87YWsh.1rXwCA18WRSoCi', 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_workshops`
--

CREATE TABLE `dhz_workshops` (
`id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `workshop_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_hr` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_owners` decimal(10,2) NOT NULL,
  `max_subscriptions` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_workshops`
--

INSERT INTO `dhz_workshops` (`id`, `package_id`, `workshop_title`, `short_description`, `long_description`, `image`, `location`, `date_hr`, `price`, `price_owners`, `max_subscriptions`) VALUES
(1, 3, 'parcours bouwen - workshop', 'Rechte of gebogen sporen, leer alle geheimen van achtbanen. ', '<p>Rechte of gebogen sporen, leer alle geheimen van achtbanen. </p>\r\n<ul class="custom-list">\r\n<li>sporen verlengen en verkorten</li>\r\n<li>parcours berekening</li>\r\n<li>bouwen van veilige steunpilaren</li>\r\n</ul>', 'img/workshops/parcours.svg', 'Duboisstraat 4<br />\r\n2060 Antwerpen', '2015-06-18 14:00:00', 50.00, 20.00, 20),
(2, 5, 'werken met fimo-klei - workshop', 'Fimo-klei verwerken, vervormen en afbakken. ', '<p>Fimo-klei verwerken, vervormen en afbakken. </p>\r\n<ul class="custom-list">\r\n<li>fimo-klei verwerken en vervormen</li>\r\n<li>kleuren vermengen</li>\r\n<li>afbakken: juiste baktijd en temperatuur</li>\r\n</ul>', 'img/workshops/fimo-klei.svg', 'Pintestraat 5<br />\r\n9840 De Pinte', '2015-08-01 14:00:00', 50.00, 20.00, 20);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dhz_workshop_subscriptions`
--

CREATE TABLE `dhz_workshop_subscriptions` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `workshop_id` int(11) NOT NULL,
  `owner_price` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `dhz_workshop_subscriptions`
--

INSERT INTO `dhz_workshop_subscriptions` (`id`, `user_id`, `workshop_id`, `owner_price`) VALUES
(1, 5, 1, 0),
(2, 6, 1, 0),
(10, 1, 1, 1),
(11, 1, 2, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `dhz_newsletter_subscriptions`
--
ALTER TABLE `dhz_newsletter_subscriptions`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_orders`
--
ALTER TABLE `dhz_orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_order_items`
--
ALTER TABLE `dhz_order_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_packages`
--
ALTER TABLE `dhz_packages`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_package_items`
--
ALTER TABLE `dhz_package_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_reviews`
--
ALTER TABLE `dhz_reviews`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_users`
--
ALTER TABLE `dhz_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_workshops`
--
ALTER TABLE `dhz_workshops`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dhz_workshop_subscriptions`
--
ALTER TABLE `dhz_workshop_subscriptions`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `dhz_newsletter_subscriptions`
--
ALTER TABLE `dhz_newsletter_subscriptions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `dhz_orders`
--
ALTER TABLE `dhz_orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT voor een tabel `dhz_order_items`
--
ALTER TABLE `dhz_order_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `dhz_packages`
--
ALTER TABLE `dhz_packages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `dhz_package_items`
--
ALTER TABLE `dhz_package_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT voor een tabel `dhz_reviews`
--
ALTER TABLE `dhz_reviews`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `dhz_users`
--
ALTER TABLE `dhz_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `dhz_workshops`
--
ALTER TABLE `dhz_workshops`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `dhz_workshop_subscriptions`
--
ALTER TABLE `dhz_workshop_subscriptions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
