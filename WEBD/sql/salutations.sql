


DROP TABLE IF EXISTS salutations;

CREATE TABLE salutations(
	value VARCHAR(10) 
);

ALTER TABLE salutations OWNER TO group09_admin;

INSERT INTO salutations VALUES ('Mr.');
INSERT INTO salutations VALUES ('Mister');
INSERT INTO salutations VALUES ('Miss');
INSERT INTO salutations VALUES ('Mrs.');
INSERT INTO salutations VALUES ('Ms.');
