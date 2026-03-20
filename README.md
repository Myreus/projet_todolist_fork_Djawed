# projet_todo
Projet de cours PHP POO todolist (DEV312503)

# optionnel
```sh
composer require symfony/var-dumper
```

## 1 Installer les dépendances :
```sh
composer install
```
## 2 Créer un fichier .env
```env
DATABASE_USERNAME=root
DATABASE_PASSWORD=
DATABASE_NAME=todolist
DATABASE_HOST=localhost:3306
```

## 2 démarrer le projet
```sh
php -S 127.0.0.1:8000 -t public
```

## 3 Créer le fichier .env et le remplir avec (à adapter si besoin)
```sh
# variable d'environnement
DATABASE_USERNAME=root
DATABASE_PASSWORD=root
DATABASE_NAME=todolist
DATABASE_HOST=localhost:3306
```

## 4 sert à retrouver le fichier .env (faire une recherche ?)
```sh
composer require vlucas/phpdotenv
```
