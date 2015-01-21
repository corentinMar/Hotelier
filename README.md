HOTELIER : Gestionnaire d'hôtels
==========
**Hotelier** est la solution pour gérer tous vos hôtels en un clin d'oeil !

Introduction
----------
Bienvenue dans notre projet de *gestionnaire d'hôtels*.

Installation
----------
Ce project requiert :
* PHP (version >= 5.3.3)
* ZendFramework (version 2.3.*)
* ~~Doctrine (version 2.3.0)~~

L'installation peut se faire via Composer (non obligatoire car plus besoin de Doctrine !) : 

### Installer Composer
Téléchargez et installez *Composer* à l'adresse suivante : https://getcomposer.org/download/
(si vous êtes sous Windows, choisissez *Windows Installer*)

Ensuite rendez-vous dans le dossier source *hotelier/* via un terminal et tapez la commande suivante :
```
composer install
```

Puis via PhpMyAdmin, créez un base nommée 'hotelier' et exécutez le script situé dans le dossier source *hotelier/hotelier.sql*

N'oubliez pas de modifier votre *username* et *password* dans le fichier *hotelier/config/autoload/local.php* pour qu'ils correspondent à votre accès en base de données

Si besoin, pour modifier le répertoire où seront écrit les logs, modifiez la ligne 29 située dans *hotelier/config/autoload/global.php*

Utilisation
----------
Vous avez la possibilité de créer un compte ou de vous connecter avec les identifiants déjà existants :

- Compte administrateur
* Nom : admin
* Mot de passe : admin


- Compte utilisateur
* Nom : test
* Mot de passe : test


Merci ! :-)
