


DROP TABLE IF EXISTS heating_fuel;

CREATE TABLE heating_fuel(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE heating_fuel OWNER TO group09_admin;

INSERT INTO heating_fuel (value, property) VALUES (1, 'gas');

INSERT INTO heating_fuel (value, property) VALUES (2, 'electric');

INSERT INTO heating_fuel (value, property) VALUES (4, 'oil');

INSERT INTO heating_fuel (value, property) VALUES (8, 'geothermal');
