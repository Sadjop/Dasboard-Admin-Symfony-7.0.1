# admin_dash_sy

## Description

`admin_dash_sy` est un projet de tableau de bord d'administration construit avec Symfony. Il fournit des fonctionnalités pour gérer les utilisateurs, les rôles, les permissions et d'autres fonctionnalités d'administration.

## Installation

1. Clonez le dépôt:

bash
git clone https://github.com/Sadjop/admin_dash_sy.git

2. Installez les dépendances:

```
cd admin_dash_sy
composer install
```

3. Configurez votre base de données dans le fichier .env.

4. Lancez les migrations:

```
php bin/console doctrine:migrations:migrate
```

5. Lancez le serveur de développement:

```
symfony server:start
```
## Utilisation
Ouvrez votre navigateur et accédez à http://localhost:8000 pour commencer à utiliser le tableau de bord d'administration.

## Contribution
Les contributions sont les bienvenues. Veuillez créer une issue ou une pull request pour toute contribution.
