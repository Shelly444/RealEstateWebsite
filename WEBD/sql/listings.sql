DROP TABLE IF EXISTS listings CASCADE;

DROP sequence if exists listing_id_seq;

CREATE sequence listing_id_seq;
SELECT setval('listing_id_seq', 10000);
ALTER sequence listing_id_seq OWNER TO group09_admin;

CREATE TABLE listings(
	listing_id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('listing_id_seq'),
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
	listing_status CHAR(1) NOT NULL,
	price numeric NOT NULL,
	headline VARCHAR(100) NOT NULL,
	description VARCHAR(1000) NOT NULL,
	postal_code CHAR(7) NOT NULL,
	images SMALLINT NOT NULL DEFAULT 0,
	city INTEGER NOT NULL,
	building_types INTEGER NOT NULL,
	property_options INTEGER NOT NULL,
	bedrooms INTEGER NOT NULL,
	bathrooms INTEGER NOT NULL,
	year_built INTEGER NOT NULL DEFAULT 0,
	lot_size INTEGER NOT NULL DEFAULT 0,
	square_feet INTEGER NOT NULL DEFAULT 0,
	heating_fuel INTEGER NOT NULL DEFAULT 0,
	garages INTEGER NOT NULL DEFAULT 0,
   	floors INTEGER NOT NULL DEFAULT 0

);