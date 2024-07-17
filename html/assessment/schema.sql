
--Here is to Create database 
CREATE DATABASE school;

USE school;

-- Here is to Create Tables Classes
CREATE TABLE Classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(50) NOT NULL,
    capacity INT NOT NULL
);

-- Here is to Create Tables Teachers
CREATE TABLE Teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    annual_salary DECIMAL(10, 2) NOT NULL,
    background_check BOOLEAN NOT NULL,
    class_id INT,
    FOREIGN KEY (class_id) REFERENCES Classes(id)
);

-- Here is to Create Tables Pupils
CREATE TABLE Pupils (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    medical_info TEXT,
    class_id INT,
    FOREIGN KEY (class_id) REFERENCES Classes(id)
);

-- Here is to Create Tables ParentsGuardians
CREATE TABLE ParentsGuardians (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    pupil_id INT,
    FOREIGN KEY (pupil_id) REFERENCES Pupils(id)
);
