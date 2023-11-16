DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS categories;

CREATE TABLE rbnm_users (
    id                  INT AUTO_INCREMENT,
    first_name          VARCHAR(64) NOT NULL,
    last_name           VARCHAR(64) NOT NULL,
    birthDate             DATE,
    mail                 VARCHAR(64) ,
    password             VARCHAR(64),
    address              VARCHAR(64),
    paymentsInfos         VARCHAR(64),
    PRIMARY KEY (id)
);

CREATE TABLE reviews (
    id        INT AUTO_INCREMENT,
    commentary             VARCHAR(300) NOT NULL,
    dateCommentary         date           NOT NULL,
    is_approved            BOOLEAN      NOT NULL,
    stars                INT             NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE products (
    id              INT AUTO_INCREMENT,
    category        ,
    name            VARCHAR(64) NOT NULL,
    date_upload     DATE        NOT NULL,
    image           VARCHAR(64) NOT NULL,
    price           DECIMAL(10,2) NOT NULL,
    description     VARCHAR(300) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE orders (
    id              INT AUTO_INCREMENT,
    date_order      DATE        NOT NULL,
    id_user         INT         NOT NULL,
    id_product      INT         NOT NULL,
    quantity        INT         NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE categories (
    id              INT AUTO_INCREMENT,
    name            VARCHAR(64) NOT NULL,
    unit            VARCHAR(64) NOT NULL,
    PRIMARY KEY (id)
);