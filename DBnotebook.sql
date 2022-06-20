DROP DATABASE IF exists notebook;
CREATE DATABASE notebook;
USE notebook;

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes`(
	`id` SERIAL PRIMARY KEY,
	`name` VARCHAR(250) NOT NULL,
	`company` VARCHAR(100),
	`phone` VARCHAR(15) NOT NULL,
	`email` VARCHAR(120) NOT NULL,
	`birthday` VARCHAR(20)
);

INSERT INTO `notes` (`id`, `name`, `company`, `phone`, `email`, `birthday`)
VALUES 
(1,'Василий Васильев','Васильев&КО','121212','Vasiliy@Vasiliy.com','01.02.1989'),
(2,'Анатолий Толянов','Topol','342334','Tolia@Tolia.com','03.04.1990'),
(3,'Екатерина Катина','IntKat','454455','Katina@katina.com','08.03.1985'),
(4,'Мария Машина','','766776','Mashina@Mashina.com','09.12.1995'),
(5,'Константин Костин','Кость','344356','Kostin@Kostin.com','12.11.1985'),
(6,'Анна Васильевна Топина','','234543','Anna@Topina.com','15.08.1975');