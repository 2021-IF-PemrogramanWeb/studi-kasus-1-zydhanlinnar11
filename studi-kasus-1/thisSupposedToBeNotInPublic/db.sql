CREATE DATABASE `pweb_php`;
USE `pweb_php`;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
); 

CREATE TABLE JML_MHS (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    periode VARCHAR(15) NOT NULL UNIQUE,
    val INT NOT NULL
);

INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2009', 915);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2009', 696);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2010', 986);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2010', 884);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2011', 845);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2011', 643);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2012', 993);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2012', 506);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2013', 950);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2013', 699);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2014', 814);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2014', 189);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2015', 871);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2015', 870);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2016', 787);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2016', 777);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2017', 701);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2017', 895);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2018', 895);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2018', 749);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2019', 930);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2019', 815);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2020', 942);
INSERT INTO JML_MHS (periode, val) VALUES ('Genap 2020', 931);
INSERT INTO JML_MHS (periode, val) VALUES ('Ganjil 2021', 1030);