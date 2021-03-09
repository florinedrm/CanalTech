# CanalTech
Test technique

Procédure d’installation du projet :
1. Cloner le projet (ligne de commande) : git clone https://github.com/florinedrm/CanalTech.git
2. Se positionner dans le dossier CanalTech/app
3. Créer le fichier .env.local (copie de .env) et mettre à jour la DATABASE_URL (remplacer db_name par le nom de la base de donnée à créer)
4. Ligne de commande : composer install
5. Ligne de commande : npm install
6. Ligne de commande : npm run watch
7. Ligne de commande : php bin/console doctrine:database:create
8. LIgne de commande : php bin/console doctrine:migrations:migrate
7. Ligne de commande : php -S localhost:1234 -t public
8. Visualiser l'app dans le navigateur depuis l'url : localhost:1234
