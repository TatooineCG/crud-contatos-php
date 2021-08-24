CREATE DATABASE COMPANY;

USE COMPANY;

CREATE TABLE PEOPLE (
    id int(11) auto_increment primary key,
    name varchar(255) not null,
    email varchar(255) not null
);