# CultureMarketPlace
## Lien du site :
[vps-356a325d.vps.ovh.net](http://vps-356a325d.vps.ovh.net/)

## Intégrants : 
- [Nicolas Calvelo](https://github.com/NicoCalvelo)
- [Mathieu Keca](https://github.com/matk92)
- [Rémy Saguez](https://github.com/RemySaguez)

## Description du projet

Description courte du projet : Un site web pour gérer vos ventes de produits culturels de votre pays ! Ils vous suffit d'installer le projet, le configurer par rapport à votre style et commencer à charger les produits que vous souhaitez vendre !

## Fonctionnalités

**Gestion des avis** : ajouter commentaires sur les produits vendus + notationt étoiles(0 à 5), supprimer, signalement


**Gestion des clients** : les utilisateurs peuvent créer un compte client pour effectuer des achats sur le site web. Les informations des clients sont stockées dans une base de données sécurisée.

**Gestion des produits** : les utilisateurs peuvent ajouter, modifier et supprimer des produits culturels à vendre sur le site web. Les produits sont affichés avec des images, des descriptions et des prix.

**Gestion des ventes** :  Les informations de vente sont stockées dans une base de données sécurisée et reçoivent un mail de confirmation.

**Système de paiement** : le site web est équipé d'un système de paiement fictif pour permettre aux clients d'effectuer des achats en ligne. Les paiements sont traités par des prestataires de paiement tiers.

**Interface d'administration** : les administrateurs du site web peuvent accéder à une interface d'administration pour gérer les produits, les clients et les ventes. Cette interface est sécurisée par un système d'authentification.

**Personnalisation du site web** : les utilisateurs peuvent personnaliser le site web en modifiant les couleurs, les polices et les images. Cette personnalisation est facile à effectuer grâce à un système de thèmes.

## Guide d’installation :

Pour lancer le projet il est necessaire d'avoir docker et docker-compose d'installé sur votre machine.

Instructions d'installation du projet :

- Cloner le projet 
- Lancer la commande suivante 
  ```
  docker compose up
  ```

## Guide de Modification :

Pour modifier le projet, vous devez avoir Node.js installé sur votre machine et un gestionnaire de paquets comme npm ou yarn.

Après avoir cloné le projet et d'avoir lancé la commande docker compose, up lançez les commandes suivantes a la racine du projet pour installer les dépendances et lancer le projet :

```bash
    yarn install
ou
    npm install
```

```bash
    yarn watch
ou
    npm run watch
```


Pour avoir de données vidons pour realiser des tests, vous pouvez decomenter la ligne 24 du fichier docker-compose.yml
```yml
    - ./postgres/inserts.sql:/docker-entrypoint-initdb.d/inserts.sql
```


## Base de données :

Pour la base de données, nous avons utilisé PostgreSQL. Vous pouvez trouver le schéma de la base de données dans le fichier BDD_schema.excalidraw qui se trouve à la racine du projet.

Voici les tables de la base de données :

- [User](#User)-> [id](#id), [firstName](#firstName), [lastName](#lastName), [email](#email), [pwd](#pwd), [status](#status), [isDeleted](#isDeleted), [inserted](#inserted), [role](#role), [verificationcode](#verificationcode)
- [Category](#Category) -> [id](#id), [name](#name), [amount](#amount), [unit](#unit), [isdeleted](#isdeleted)
- [Product](#Product) -> [id](#id), [name](#name), [image](#image), [description](#description), [price](#price), [stock](#stock), [categoryId](#categoryId), [inserted](#inserted), [updated](#updated), [isdeleted](#isdeleted)
- [Review](#Review) -> [id](#id), [userId](#userId), [productId](#productId), [rating](#rating), [comment](#comment), [isApproved](#isApproved), [inserted](#inserted), [updated](#updated)
- [Order](#Order) -> [id](#id), [userId](#userId), [status](#status), [inserted](#inserted), [updated](#updated)
- [Order Slot](#Order_Slot) -> [id](#id), [orderId](#orderId), [productId](#productId), [quantity](#quantity)
- [Payment Method Type](#Payment_Method_Type) -> [id](#id), [name](#name), [description](#description)
- [Payment Method](#Payment_Method) -> [id](#id), [userId](#userId), [paymentMethodTypeId](#paymentMethodTypeId), [cardNumber](#cardNumber), [expirationDate](#expirationDate), [securityCode](#securityCode), [cardHolderName](#cardHolderName), [cardHolderAddress](#cardHolderAddress), [cardHolderZipCode](#cardHolderZipCode), [cardHolderCity](#cardHolderCity), [cardHolderCountry](#cardHolderCountry), [updated](#updated)
- [Payment](#Payment) -> [id](#id), [paymentMethodId](#paymentMethodId), [orderId](#orderId), [status](#status), [inserted](#inserted)

## Outils utilisés

On a utilise [Figma](https://www.figma.com/file/iBrfxsfLp4shl8cxopUqxX/Cultural-Market-Place?type=design&node-id=0%3A1&mode=design&t=wgcVl0hETZCVDtAX-1) pour le design guide et les differentes pages du site web.

On a utilise [Trello](https://trello.com/b/SBasrghg) pour la gestion des taches et des differentes etapes du projet. (Pour visualizer le projet il faut demander l'acces)

On a utilise Discord pour la communication entre les membres de l'equipe et on a configure un bot pour nous prevenir des commits fait sur le projet.


## Technologies utilisées

- [Chart.js](https://www.chartjs.org/)
- [Sass](https://sass-lang.com/)
- [Vite](https://vitejs.dev/)
- [PhpMailer](https://packagist.org/packages/phpmailer/phpmailer)
- [yaml](https://pecl.php.net/package/yaml)
