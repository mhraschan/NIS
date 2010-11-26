CREATE TABLE Offers (
  o_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  o_name VARCHAR NULL,
  max_participants INTEGER UNSIGNED NULL,
  PRIMARY KEY(o_id)
);

CREATE TABLE Persons (
  p_nr INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR NULL,
  PRIMARY KEY(p_nr)
);

CREATE TABLE Abilities (
  a_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  a_name VARCHAR NULL,
  PRIMARY KEY(a_id)
);

CREATE TABLE Persons_Abilities (
  Persons_p_nr INTEGER UNSIGNED NOT NULL,
  Abilities_a_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Persons_p_nr, Abilities_a_id),
  INDEX Persons_has_Abilities_FKIndex1(Persons_p_nr),
  INDEX Persons_has_Abilities_FKIndex2(Abilities_a_id),
  FOREIGN KEY(Persons_p_nr)
    REFERENCES Persons(p_nr)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Abilities_a_id)
    REFERENCES Abilities(a_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Accountings (
  ac_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Offers_o_id INTEGER UNSIGNED NOT NULL,
  Persons_p_nr INTEGER UNSIGNED NOT NULL,
  date DATE NULL,
  PRIMARY KEY(ac_id),
  INDEX Accountings_FKIndex1(Persons_p_nr),
  INDEX Accountings_FKIndex2(Offers_o_id),
  FOREIGN KEY(Persons_p_nr)
    REFERENCES Persons(p_nr)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Offers_o_id)
    REFERENCES Offers(o_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Offer_Abilities (
  Abilities_a_id INTEGER UNSIGNED NOT NULL,
  Offers_o_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Abilities_a_id, Offers_o_id),
  INDEX Abilities_has_Offers_FKIndex1(Abilities_a_id),
  INDEX Abilities_has_Offers_FKIndex2(Offers_o_id),
  FOREIGN KEY(Abilities_a_id)
    REFERENCES Abilities(a_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Offers_o_id)
    REFERENCES Offers(o_id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


