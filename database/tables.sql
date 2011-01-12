-- Database and Information Systems 1
-- Database Construction Queries

-- First create database and grant privileges as root like:
-- CREATE DATABASE dbase1;
-- GRANT ALL PRIVILEGES ON nis.* to 'abgabe';
-- after that, all sql files can be executed like this:
-- mysql -u abgabe nis < tables.sql
-- Definition of the database schema

CREATE TABLE Offers (
  o_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  o_name VARCHAR(50) NULL,
  max_participants INTEGER UNSIGNED NULL,
  PRIMARY KEY(o_id)
);

CREATE TABLE Persons (
  p_nr INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NULL,
  PRIMARY KEY(p_nr)
);

CREATE TABLE Abilities (
  a_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  a_name VARCHAR(50) NULL,
  PRIMARY KEY(a_id)
);

CREATE TABLE Persons_Abilities (
  Persons_p_nr INTEGER UNSIGNED NOT NULL,
  Abilities_a_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Persons_p_nr, Abilities_a_id)
);

CREATE TABLE Accountings (
  ac_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Offers_o_id INTEGER UNSIGNED NOT NULL,
  Persons_p_nr INTEGER UNSIGNED NOT NULL,
  date DATE NULL,
  PRIMARY KEY(ac_id)
);

CREATE TABLE Offer_Abilities (
  Abilities_a_id INTEGER UNSIGNED NOT NULL,
  Offers_o_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Abilities_a_id, Offers_o_id)
);


