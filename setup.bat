@ECHO OFF

ECHO "migrating"
php artisan migrate
ECHO Migrating done
ECHO "SEEDING BASIC SEEDERS"
php artisan db:seed
ECHO Seeding Done
php artisan key:generate
ECHO generated a new key
ECHO doing some extra seeding 100 citizens and 100 workers
php artisan db:seed --class="CitizensSeeder"
php artisan db:seed --class="WorkersSeeder"

ECHO Bye.