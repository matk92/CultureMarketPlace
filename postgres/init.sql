DROP TABLE IF EXISTS rbnm_user;
DROP TABLE IF EXISTS rbnm_review;
DROP TABLE IF EXISTS rbnm_categorie;
DROP TABLE IF EXISTS rbnm_product;
DROP TABLE IF EXISTS rbnm_order_slot;

CREATE TABLE rbnm_user (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(25) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(320) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    status SMALLINT NOT NULL DEFAULT 0,
    isDeleted BOOLEAN NOT NULL DEFAULT 0,
    insertedAt timestamp NOT NULL DEFAULT current_timestamp(),
    updatedAt timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
);

CREATE TABLE rbnm_review (
    id SERIAL PRIMARY KEY,
    userId INT NOT NULL,
    productId INT NOT NULL,
    rating INT NOT NULL,
    comment VARCHAR(255) NOT NULL,
    insertedAt timestamp NOT NULL DEFAULT current_timestamp(),
    updatedAt timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    FOREIGN KEY (userId) REFERENCES rbnm_user(id),
    FOREIGN KEY (productId) REFERENCES rbnm_product(id)
);

CREATE TABLE rbnm_categorie (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    amount INT NOT NULL,
    unit VARCHAR(15) NOT NULL
);

CREATE TABLE rbnm_product (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    categoryId INT NOT NULL,
    insertedAt timestamp NOT NULL DEFAULT current_timestamp(),
    updatedAt timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    FOREIGN KEY (categoryId) REFERENCES rbnm_categorie(id)
);

CREATE TABLE rbnm_order_slot (
    id SERIAL PRIMARY KEY,
    orderId INT NOT NULL,
    productId INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (orderId) REFERENCES rbnm_orders(id),
    FOREIGN KEY (productId) REFERENCES rbnm_product(id)
);

CREATE TABLE rbnm_orders (
    id SERIAL PRIMARY KEY,
    userId INT NOT NULL,
    status SMALLINT NOT NULL DEFAULT 0,
    insertedAt timestamp NOT NULL DEFAULT current_timestamp(),
    updatedAt timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    FOREIGN KEY (userId) REFERENCES rbnm_user(id)
);

CREATE TABLE rbnm_payement_method_type (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL
);

CREATE TABLE rbnm_payment_method (
    id SERIAL PRIMARY KEY,
    userId INT NOT NULL,
    paymentMethodTypeId INT NOT NULL,
    cardNumber VARCHAR(16) NOT NULL,
    expirationDate VARCHAR(5) NOT NULL,
    securityCode VARCHAR(3) NOT NULL,
    cardHolderName VARCHAR(50) NOT NULL,
    cardHolderAddress VARCHAR(255) NOT NULL,
    cardHolderZipCode VARCHAR(5) NOT NULL,
    cardHolderCity VARCHAR(50) NOT NULL,
    cardHolderCountry VARCHAR(50) NOT NULL,
    cardHolderPhone VARCHAR(10) NOT NULL,
    cardHolderEmail VARCHAR(320) NOT NULL,
    insertedAt timestamp NOT NULL DEFAULT current_timestamp(),
    updatedAt timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    FOREIGN KEY (userId) REFERENCES rbnm_user(id),
    FOREIGN KEY (paymentMethodTypeId) REFERENCES rbnm_payement_method_type(id)
);

CREATE TABLE rbnm_payment (
    id SERIAL PRIMARY KEY,
    paymentMethodId INT NOT NULL,
    orderId INT NOT NULL,
    amount INT NOT NULL,
    date timestamp NOT NULL DEFAULT current_timestamp(),
    status SMALLINT NOT NULL DEFAULT 0,
    insertedAt timestamp NOT NULL DEFAULT current_timestamp(),
    updatedAt timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
    FOREIGN KEY (paymentMethodId) REFERENCES rbnm_payment_method(id),
    FOREIGN KEY (orderId) REFERENCES rbnm_orders(id)
);