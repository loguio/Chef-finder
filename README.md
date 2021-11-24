# Chef-finder

Chef-finder est une plateforme mettant en relation des chefs et particuliers pour des cours de cusisine à domicile.


## Installation

* Ce projet utilise [composer](https://getcomposer.org/download/) ainsi que [npm](https://nodejs.org/en/download/) pour ses dépendances et disponibles à ces adresses.

* Voici les commandes permettant d'installer ces dépendances :

```bash
composer install

npm install
```

## Utilisation

-- Scripts --

Afin de compiler les différents assets du projet et écouter les changement de fichiers :

```bash
npm run watch
```

Afin de compiler et build le projet pour un environnement de production :


```bash
npm run build
```

Afin de démarrer le serveur intégré à PHP en local :


```bash
php -S localhost:8000 -t public
```


## Commandes Utiles


-- MakerBundle --

Commandes permettant de générer une entité :

```bash
php bin/console make:entity [NomEntité]
```


-- Migrations --

Générer un fichier de migration :

```bash
php bin/console make:migration
```

Exécuter les migrations :

```bash
php bin/console doctrine:migrations:migrate
```










