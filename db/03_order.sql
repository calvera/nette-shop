CREATE TABLE IF NOT EXISTS "order"
(
	id           uuid         NOT NULL PRIMARY KEY DEFAULT uuid_generate_v4(),
	name         varchar(50)  NOT NULL,
	phone_number varchar(50)  NOT NULL,
	email        varchar(256) NOT NULL,
	created_at   timestamp(6) NOT NULL             DEFAULT CURRENT_TIMESTAMP(6)
);

CREATE TABLE IF NOT EXISTS "order_item"
(
	id         uuid NOT NULL PRIMARY KEY DEFAULT uuid_generate_v4(),
	order_id   uuid NOT NULL REFERENCES "order" (id),
	line	   int  NOT NULL,
	product_id uuid NOT NULL REFERENCES product (id),
	quantity   int  NOT NULL
);

CREATE UNIQUE INDEX IF NOT EXISTS "idx_order_item_order_id" ON "order_item" (order_id, line);
