CREATE DATABASE WOWDB;
USE WOWDB;

CREATE TABLE averias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(50) NOT NULL,
    problema VARCHAR(100) NOT NULL,
    fechaHora DATETIME NOT NULL,
    status ENUM('pendiente', 'solucionado') DEFAULT 'pendiente'
);