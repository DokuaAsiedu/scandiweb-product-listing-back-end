DROP DATABASE IF EXISTS product_listing;
CREATE DATABASE product_listing;
USE product_listing;
-- USE heroku_f4a3ac240ad2a25;

CREATE TABLE main_info (
    product_type varchar(255) NOT NULL,
	product_sku varchar(255) NOT NULL,
    product_name varchar(255) NOT NULL,
    product_price decimal(9, 2) unsigned NOT NULL,
    PRIMARY KEY (product_sku)
);

INSERT INTO main_info VALUES ('DVD', 'JVC200123', 'Acme DISC', 1);
INSERT INTO main_info VALUES ('Book', 'GGWP0007', 'War and Peace', 20);
INSERT INTO main_info VALUES ('Furniture', 'TR120555', 'Chair', 40);
INSERT INTO main_info VALUES ('DVD', '0N3EU3PC', 'Avatar', 38.00);
INSERT INTO main_info VALUES ('DVD', '7X1L1RC4', 'Paranormal', 50.00);
INSERT INTO main_info VALUES ('DVD', 'JT4R7FGE', 'Paranormal', 62.00);

CREATE TABLE dvd_details (
	product_sku varchar(255) NOT NULL,
    dvd_size int unsigned NOT NULL,
    FOREIGN KEY (product_sku) REFERENCES main_info(product_sku)
);

INSERT INTO dvd_details VALUES ('JVC200123', 700);
INSERT INTO dvd_details VALUES ('0N3EU3PC', 1200);
INSERT INTO dvd_details VALUES ('7X1L1RC4', 994);
INSERT INTO dvd_details VALUES ('JT4R7FGE', 800);


CREATE TABLE book_details (
	product_sku varchar(255) NOT NULL,
    book_weight int unsigned NOT NULL,
    FOREIGN KEY (product_sku) REFERENCES main_info(product_sku)
);

INSERT INTO book_details VALUES ('GGWP0007', 2);

CREATE TABLE furniture_details (
	product_sku varchar(255) NOT NULL,
    furniture_height int unsigned NOT NULL,
    furniture_width int unsigned NOT NULL,
    furniture_length int unsigned NOT NULL,
    FOREIGN KEY (product_sku) REFERENCES main_info(product_sku)
);

INSERT INTO furniture_details VALUES ('TR120555', 24, 45, 15);


CREATE VIEW combined_data AS
SELECT main_info.*, dvd_details.dvd_size, book_details.book_weight, furniture_details.furniture_height, furniture_details.furniture_width, furniture_details.furniture_length
FROM main_info
LEFT JOIN dvd_details
ON main_info.product_sku = dvd_details.product_sku
LEFT JOIN book_details
ON main_info.product_sku = book_details.product_sku
LEFT JOIN furniture_details
ON main_info.product_sku = furniture_details.product_sku
ORDER BY main_info.product_sku;