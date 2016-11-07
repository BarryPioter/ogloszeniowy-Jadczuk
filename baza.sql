CREATE TABLE IF NOT EXISTS `komentarze` (
  `id_kom` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tresc` mediumtext NOT NULL,
  PRIMARY KEY (`id_kom`),
  FOREIGN KEY (id) REFERENCES `ogloszenia` (id),
  FOREIGN KEY (id_user) REFERENCES `uzytkownicy` (id_user)
  )ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS `kategorie` (
  `id_kategorii` int(11) NOT NULL AUTO_INCREMENT,
  `kategoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategorii`)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS `ogloszenia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_kate` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `opis` mediumtext NOT NULL,
  `data` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
 FOREIGN KEY (id_user) REFERENCES `uzytkownicy` (id_user),
 FOREIGN KEY (id_kate) REFERENCES `kategorie` (id_kate)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(20) NOT NULL,
  `imie` varchar(15) NOT NULL,
  `nazwisko` varchar(35) NOT NULL,
  `haslo` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefon` int(9) NOT NULL,
  PRIMARY KEY (`id_user`)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
