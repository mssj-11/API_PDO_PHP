DROP DATABASE if EXISTS exampleapipdo;
CREATE DATABASE if NOT EXISTS exampleapipdo DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE exampleapipdo;
CREATE TABLE if NOT EXISTS clients(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    telephone VARCHAR(255) NOT NULL
);