# CultureMarketPlace
## Lien du site :
vps-356a325d.vps.ovh.net

## Intégrants : 
- Nicolas Calvelo
- Mathieu Keca
- Rémy Saguez 

## Description du projet

Description courte du projet : Un site web pour gérer vos ventes de produits culturels d’un pays. Ils vous suffit d'installer le projet, le configurer par rapport à votre pays et commencer à charger les produits que vous souhaitez vendre.

## Fonctionnalités

**Gestion des avis** : ajouter commentaires sur les produits vendus + notationt étoiles(0 à 5), supprimer, signalement


**Gestion des clients** : les utilisateurs peuvent créer un compte client pour effectuer des achats sur le site web. Les informations des clients sont stockées dans une base de données sécurisée.

**Gestion des produits** : les utilisateurs peuvent ajouter, modifier et supprimer des produits culturels à vendre sur le site web. Les produits sont affichés avec des images, des descriptions et des prix.

**Gestion des ventes** :  Les informations de vente sont stockées dans une base de données sécurisée et reçoivent un mail de confirmation.

**Système de paiement** : le site web est équipé d'un système de paiement fictif pour permettre aux clients d'effectuer des achats en ligne. Les paiements sont traités par des prestataires de paiement tiers.

**Interface d'administration** : les administrateurs du site web peuvent accéder à une interface d'administration pour gérer les produits, les clients et les ventes. Cette interface est sécurisée par un système d'authentification.

**Personnalisation du site web** : les utilisateurs peuvent personnaliser le site web en modifiant les couleurs, les polices et les images. Cette personnalisation est facile à effectuer grâce à un système de thèmes.



## Table des matières :

- [User](#User)-> [id](#id), [firstName](#firstName), [lastName](#lastName), [email](#email), [pwd](#pwd), [status](#status), [isDeleted](#isDeleted), [inserted](#inserted), [role](#role), [verificationcode](#verificationcode)
- [Category](#Category) -> [id](#id), [name](#name), [amount](#amount), [unit](#unit), [isdeleted](#isdeleted)
- [Product](#Product) -> [id](#id), [name](#name), [image](#image), [description](#description), [price](#price), [stock](#stock), [categoryId](#categoryId), [inserted](#inserted), [updated](#updated), [isdeleted](#isdeleted)
- [Review](#Review) -> [id](#id), [userId](#userId), [productId](#productId), [rating](#rating), [comment](#comment), [isApproved](#isApproved), [inserted](#inserted), [updated](#updated)
- [Order](#Order) -> [id](#id), [userId](#userId), [status](#status), [inserted](#inserted), [updated](#updated)
- [Order Slot](#Order_Slot) -> [id](#id), [orderId](#orderId), [productId](#productId), [quantity](#quantity)
- [Payment Method Type](#Payment_Method_Type) -> [id](#id), [name](#name), [description](#description)
- [Payment Method](#Payment_Method) -> [id](#id), [userId](#userId), [paymentMethodTypeId](#paymentMethodTypeId), [cardNumber](#cardNumber), [expirationDate](#expirationDate), [securityCode](#securityCode), [cardHolderName](#cardHolderName), [cardHolderAddress](#cardHolderAddress), [cardHolderZipCode](#cardHolderZipCode), [cardHolderCity](#cardHolderCity), [cardHolderCountry](#cardHolderCountry), [updated](#updated)
- [Payment](#Payment) -> [id](#id), [paymentMethodId](#paymentMethodId), [orderId](#orderId), [status](#status), [inserted](#inserted)


## Guide d’installation :

Instructions d'installation du projet :

- Cloner le projet
- Docker-compose up

## Guide de Modification :

Instructions de modification du projet :

- yarn install ou npm install
- yarn run build ou npm run build


## Base de données :

BDD utilisée.

## Outils utilisés

Figma,
Trello,
Discord,
Bot discord
## Langages utilisés
PHP, HTML, SASS, JS, PostgreSQL


## 

- Front= Rémy
- Back = Nicolas et Mathieu






