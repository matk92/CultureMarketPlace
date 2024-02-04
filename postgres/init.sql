DROP TABLE IF EXISTS rbnm_user CASCADE;
DROP TABLE IF EXISTS rbnm_review CASCADE;
DROP TABLE IF EXISTS rbnm_category CASCADE;
DROP TABLE IF EXISTS rbnm_product CASCADE;
DROP TABLE IF EXISTS rbnm_order_slot CASCADE;
DROP TABLE IF EXISTS rbnm_order CASCADE;
DROP TABLE IF EXISTS rbnm_payement_method_type CASCADE;
DROP TABLE IF EXISTS rbnm_payment_method CASCADE;
DROP TABLE IF EXISTS rbnm_payment CASCADE;

CREATE TABLE rbnm_user (
    id SERIAL PRIMARY KEY,
    firstName VARCHAR(25) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(320) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    status SMALLINT NOT NULL DEFAULT 0,
    isDeleted BOOLEAN NOT NULL DEFAULT FALSE,
    inserted TIMESTAMP NOT NULL DEFAULT current_timestamp,
    role SMALLINT NOT NULL DEFAULT 0,
    verificationcode VARCHAR(255) NULL
);

CREATE TABLE rbnm_category (
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
    inserted TIMESTAMP NOT NULL DEFAULT current_timestamp,
    updated TIMESTAMP NULL,
    archived BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (categoryId) REFERENCES rbnm_category(id)
);

CREATE TABLE rbnm_review (
    id SERIAL PRIMARY KEY,
    userId INT NOT NULL,
    productId INT NOT NULL,
    rating INT NOT NULL,
    comment VARCHAR(255) NOT NULL,
    isApproved BOOLEAN DEFAULT NULL,
    inserted TIMESTAMP NOT NULL DEFAULT current_timestamp,
    updated TIMESTAMP NULL,
    FOREIGN KEY (userId) REFERENCES rbnm_user(id),
    FOREIGN KEY (productId) REFERENCES rbnm_product(id)
);

CREATE TABLE rbnm_order (
    id SERIAL PRIMARY KEY,
    userId INT NOT NULL,
    status SMALLINT NOT NULL DEFAULT 0,
    inserted TIMESTAMP NOT NULL DEFAULT current_timestamp,
    updated TIMESTAMP NULL,
    FOREIGN KEY (userId) REFERENCES rbnm_user(id)
);

CREATE TABLE rbnm_order_slot (
    id SERIAL PRIMARY KEY,
    orderId INT NOT NULL,
    productId INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (orderId) REFERENCES rbnm_order(id),
    FOREIGN KEY (productId) REFERENCES rbnm_product(id)
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
    updated TIMESTAMP NOT NULL DEFAULT current_timestamp,
    FOREIGN KEY (userId) REFERENCES rbnm_user(id),
    FOREIGN KEY (paymentMethodTypeId) REFERENCES rbnm_payement_method_type(id)
);

CREATE TABLE rbnm_payment (
    id SERIAL PRIMARY KEY,
    paymentMethodId INT NOT NULL,
    orderId INT NOT NULL,
    status SMALLINT NOT NULL DEFAULT 0,
    inserted TIMESTAMP NOT NULL DEFAULT current_timestamp,
    FOREIGN KEY (paymentMethodId) REFERENCES rbnm_payment_method(id),
    FOREIGN KEY (orderId) REFERENCES rbnm_order(id)
);
