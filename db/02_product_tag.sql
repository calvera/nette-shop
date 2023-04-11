CREATE TABLE IF NOT EXISTS tag
(
	id          uuid         NOT NULL PRIMARY KEY,
	name        varchar(128) NOT NULL,
	description text         NOT NULL,
	created_at  timestamp(6) NOT NULL
);

CREATE TABLE IF NOT EXISTS product_tag
(
	product_id uuid NOT NULL CONSTRAINT fk_product_tag_product_id REFERENCES product(id),
	tag_id     uuid NOT NULL CONSTRAINT fk_product_tag_tag_id REFERENCES tag(id),
	PRIMARY KEY (product_id, tag_id)
);
CREATE INDEX IF NOT EXISTS idx_product_tag_tag_id ON product_tag (tag_id);
CREATE INDEX IF NOT EXISTS idx_product_tag_product_id ON product_tag (product_id);

INSERT INTO tag(id, name, description, created_at)
VALUES (uuid_generate_v4(), 'shoes', 'Boty', CURRENT_TIMESTAMP(6)),
       (uuid_generate_v4(), 'dark', 'Tmave', CURRENT_TIMESTAMP(6)),
       (uuid_generate_v4(), 'light', 'Svetle', CURRENT_TIMESTAMP(6))
;

INSERT INTO product_tag(product_id, tag_id)
select p.id, t.id
from product p
    ,tag t
where t.name = 'shoes';

INSERT INTO product_tag(product_id, tag_id)
select p.id, t.id
from product p
    ,tag t
where t.name = 'dark'
and p.name = 'Cerne boty';

INSERT INTO product_tag(product_id, tag_id)
select p.id, t.id
from product p
    ,tag t
where t.name = 'light'
and p.name = 'Sedive boty';