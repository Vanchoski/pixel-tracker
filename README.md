# pixel-tracker
- Required PHP >=7.2*
- Run composer install
- Create empty database with name grabit
- Change credintials in config/db.php
- Run migrations with this command:
  - ./vendor/bin/doctrine-migrations  --db-configuration=src/config/db.php  --configuration=src/Migrations/migrations.php  migrate
- Run command sudo chmod 600 public.key
- Run command for running php built-in server : php -S localhost:8888 -t web  web/index.php
- Authenticate through this route : http://localhost:8888/access_token
  with payload : 
	 - `{
	"grant_type":"client_credentials",
	"client_id" :"effc31d7516ff64893aec1c1888923c",
	"client_secret" :"19b2531f4f3b3938fe74ae29888c437fcd3142b67c8e98895f2e52b79ac9d04c"
}`
- Route for posting pixel tracking data is http://localhost:8888/pixel. 
- Use the `Bearer` token from the previous request in authorization header
