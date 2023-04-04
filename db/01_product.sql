CREATE TABLE IF NOT EXISTS product
(
	id          uuid           NOT NULL PRIMARY KEY,
	name        varchar(128)   NOT NULL,
	description text           NOT NULL,
	price       decimal(10, 2) NOT NULL,
	created_at  timestamp(6)   NOT NULL
);

INSERT INTO product(id, name, description, price, created_at)
VALUES (uuid_generate_v4(), 'Hnede boty', 'Velikost 42', 1000, CURRENT_TIMESTAMP(6)),
       (uuid_generate_v4(), 'Cerne boty', 'Velikost 42', 800, CURRENT_TIMESTAMP(6)),
       (uuid_generate_v4(), 'Sedive boty', 'Velikost 42', 1200, CURRENT_TIMESTAMP(6))
;