DROP TABLE IF EXISTS offensives CASCADE;

CREATE TABLE offensives (
    user_id       VARCHAR(20)	NOT NULL REFERENCES users(user_id),
    listing_id    INTEGER 	NOT NULL REFERENCES listings(listing_id),
    reported_on	  DATE 		NOT NULL,
    status	  CHAR(1)	NOT NULL,
    PRIMARY KEY (user_id, listing_id)
);
