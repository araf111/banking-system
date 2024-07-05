## Server Requirements

- PHP ^8.1

## Steps to install:

# Clone or download the repository.

<h3>Run following commands:</h3>

- run cp .env.example .env.
- npm install
- composer install
- php artisan key:generate
- php artisan config:cache
- php artisan migrate:fresh --seed

<h3>User login credentials:</h3>
<h5>Loing for Individual Account Type</h5>

- Email: john.doe@example.com
- Password: password123

<h5>Loing for Business Account Type</h5>

- Email: jane.smith@example.com
- Password: password123

<h3>or you can create new account with registration</h3>

<h5>After login You can see bellow screen and then you can any do operation from here.</h5>

<h1 align="center"><img src="public/images/bms.png"></h1>