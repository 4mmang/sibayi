### clone project
git clone url_repo
cd sibayi
composer install
cp .env.example .env
php artisan key:generate

### generate table databse
php artisan migrate

### router api
buka folder route > api.php