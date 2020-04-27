

DROP TABLE IF EXISTS garages;

CREATE TABLE garages(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE garages OWNER TO group09_admin;

INSERT INTO garages (value, property) VALUES (1, 'No garages');

INSERT INTO garages (value, property) VALUES (2, 'single garage');

INSERT INTO garages (value, property) VALUES (4, 'double garages');

INSERT INTO garages (value, property) VALUES (8, 'triple garages');

