# Fei Fei Crab booking (Laravel)

These files are the app layer. Drop them into a fresh Laravel 11 or 12 project.

1. composer create-project laravel/laravel fei-fei-crab
2. Copy the app/, database/, resources/ and routes/ folders from this zip into that project (replace routes/web.php and DatabaseSeeder.php when asked).
3. cd fei-fei-crab, then: php artisan migrate --seed
4. php artisan serve, then open http://127.0.0.1:8000

Default admin: admin@feifeicrab.test / ChangeMe123!  (change it in database/seeders/DatabaseSeeder.php before seeding, or after login)

Login page: customers log in with phone number, anyone can continue as guest, admins log in with email + password and land on /admin/reservations.
