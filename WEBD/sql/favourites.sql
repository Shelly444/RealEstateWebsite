DROP TABLE IF EXISTS favourites CASCADE;

CREATE TABLE favourites(
    user_id       VARCHAR(20)	NOT NULL PRIMARY KEY REFERENCES users(user_id),
    listing_id      INTEGER 	NOT NULL REFERENCES listings(listing_id)
);
