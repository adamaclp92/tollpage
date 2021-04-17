CREATE TABLE `webprog2_beadando`.`users` 
( `id` INT NOT NULL AUTO_INCREMENT , 
`username` VARCHAR(255) NOT NULL , 
`password` VARCHAR(255) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `webprog2_beadando`.`categories` 
( `id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(255) NOT NULL , 
`description` VARCHAR(500) NOT NULL , 
`image` VARCHAR(255) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `categories` (`id`, `name`, `description`, `image`) VALUES 
(NULL, 'D1 kategória', 'A motorkerékpár, valamint a legfeljebb 3,5 tonna megengedett legnagyobb össztömegű, legfeljebb 7 személy szállítására alkalmas személygépkocsi és annak pótkocsija.', 'd1category.jpg'), 
(NULL, 'D2 kategória', 'Valamennyi olyan gépkocsi, amely nem tartozik egyéb díjkategóriába, és külön jogszabály alapján nem minősül útdíjköteles gépjárműnek. (Ha a gépjármű forgalmi engedélyében, a J (Járműkategória) mezőben N1 besorolás szerepel, akkor az adott jármű – a szállítható személyek számától függetlenül – D2 díjkategóriába tartozik.)', 'd2category.jpg'), 
(NULL, 'B2 kategória', 'Autóbusz: személyszállítás céljára készült olyan gépkocsi, amelyben a vezető ülését is beleértve 9-nél több állandó ülőhely található. ', 'b2category.jpg');

CREATE TABLE `webprog2_beadando`.`countries` 
( `id` INT NOT NULL AUTO_INCREMENT , 
`nationality_mark` VARCHAR(255) NOT NULL , 
`country` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `countries` (`id`, `nationality_mark`, `country`) VALUES 
(NULL, 'H', 'Magyarország'), 
(NULL, 'A', 'Ausztria'), 
(NULL, 'D', 'Németország'), 
(NULL, 'GB', 'Egyesült Királyság'), 
(NULL, 'I', 'Olaszország')


CREATE TABLE `webprog2_beadando`.`license_plates` 
( `id` INT NOT NULL AUTO_INCREMENT , 
`country_id` INT NOT NULL , 
`size` VARCHAR(500) NOT NULL , 
`format` VARCHAR(500) NOT NULL , 
`picture1` VARCHAR(255) NOT NULL , 
`picture2` VARCHAR(255) NOT NULL ,
`more_info` VARCHAR(255) NOT NULL ,
 PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `license_plates` 
ADD CONSTRAINT `FK_country_id` 
FOREIGN KEY (`country_id`) 
REFERENCES `countries`(`id`) 
ON DELETE RESTRICT ON UPDATE RESTRICT;


INSERT INTO `license_plates` (`id`, `country_id`, `size`, `format`, `picture1`, `picture2`, `more_info`) VALUES 
(NULL, '1', 'Az egysoros 520 mm * 110 mm (európai szabvány); 
a kétsoros: 280 mm * 200 mm; motorkerékékpáron: 240 mm * 130 mm. 
Különleges esetekben elöl használható öntapadós matrica, melynek mérete: 300 mm * 75 mm.', 
'Fényvisszaverős fehér alapon fekete karakterek, fekete keret; latinbetűs írás; kódolás: 
€ AAA-999; sorozatszámok növekedési sorrendje: 654-321. A hátsó rendszámon a kötőjel 
felett egy műszaki felülvizsgálati évente változó színű érvényesítő matricája, alatta 
pedig a környezetvédelmi felülvizsgálat zöld vagy sárga érvényesítő matricája található. 
2004. május 1. óta a rendszám bal szélén egy 40 mm széles függőleges kék sávban felül az Európai Unió zászlaja, 
alatta fehér színnel az H betű látható.', 'hungary1.jpg', 'hungary2.jpg', 'http://plates.gaja.hu/h/index.html'), 
(NULL, '2', 'Méretei megfelelnek az európai szabványnak: 520 mm * 120 mm; bár a kétsoros változat 
kis mértékben eltér attól: 200 mm * 300 mm (nem EU-s sorozat mérete: 270 mm * 200 mm); 
motorkerékpárokon: 2002 november előtt: 270 mm * 200 mm, 2003. 11.-2005.03.: 200 mm * 250 mm, 2005 áprilistól:
 210 mm * 170 mm.', 'Fényvisszaverős fehér alapon fekete karakterek, keret nélkül; 
 latin betűs írás; kódolás: a standard formátum € T*999AA vagy € TT*999AA (területkódok itt), 
 de a sorozatszám helyén gyakorlatilag maximum hat karakterig bármi állhat; sorozatszámok növekedési 
 sorrendje: alapesetben 32154; a területkód és a számok között a szövetségi tartomány címere, alatta 
 a teljes neve kapott helyet; 2002-től a bal szélén egy 40 mm széles függőleges kék sávban felül az 
 Európai Unió zászlaja, alatta fehérrel az A felirat található. A rendszám alsó és felső szélén vékony 
 piros-fehér-piros csík húzódik.', 'austria1.jpg', 'austria2.jpg', 'http://plates.gaja.hu/a/index.html'), 
 (NULL, '5', '360 mm * 110 mm; hátul az egysoros: 520 mm * 110 mm, a kétsoros: 297 mm * 214 mm.', 
 'Fényvisszaverős fehér alapon fekete karakterek, fekete keret; latinbetűs írás; kódolás: € AA*999AA €; 
 sorozatszámok növekedési sorrendje: 76 32154. A rendszám bal szélén egy 40 mm széles függőleges kék sávban 
 felül az Európai Unió zászlaja, alatta fehér színnel az I betű látható. A rendszám jobb szélén egy 40 mm 
 széles függőleges kék sávban felül egy okkersárga körben a rendszám kiadási évének utolsó két számjegye 
 okkersárgával, alatta fehér színnel a kétkarakteres területkód 
 látható.', 'italy1.jpg', 'italy2.jpg', 'http://plates.gaja.hu/i/index.html'),
(NULL, '3', 'Megfelelnek az európai szabványnak (1994-es sorozat): az egysoros 520 mm * 110 mm; 
  a kétsoros: 340 mm * 200 mm, motorkerékpár: 255 mm * 130 mm, moped: 240 mm * 130 mm.', 
  'Fényvisszaverős fehér alapon fekete karakterek, fekete keret; latinbetűs írás; kódolás: 
  €T*A@ &&&9 vagy €TT*A@ &&&9 vagy €TTT*A@ &&9 (területkódok itt); sorozatszámok növekedési
   sorrendje: 65 4321. 1994-től a rendszám bal szélén egy 40 mm széles függőleges kék sávban 
   felül az Európai Unió zászlaja, alatta fehér színnel a D felirat 
   is megtalálható.', 'germany1', 'germany2', 'http://plates.gaja.hu/d/index.html'), 
(NULL, '4', 'Általában: elöl 520 mm * 111 mm; hátul 520 mm * 111 mm vagy 285 mm * 
   203 mm vagy 533 mm * 152 mm; ettől eltérő méretben is találhatóak rendszámok, mert 
   a szabvány a méretet nem határozza meg.', 'Fényvisszaverős, elöl fehér, hátul 
   sárga alapon fekete karakterek, keret nélkül; latinbetűs írás; kódolás: € TTDD AAA 
   (területkódok itt; dátumkódok itt); sorozatszámok növekedési sorrendje: 321. A rendszám 
   bal szélén egy 40 mm széles függőleges kék sávban felül az Európai Unió zászlaja, alatta 
   fehér színnel az GB betű látható. Az Euroband nem kötelező 
   része a rendszámnak!', 'gb1.jpg', 'gb2.jpg', 'http://plates.gaja.hu/gb/index.html')