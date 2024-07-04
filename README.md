Document instruction
Docker is now supported and improved.

How To Set Up Laravel, Nginx, and MySQL With Docker Compose on Ubuntu 20.04

With the improved Docker setup, you will get:

Nginx
PHP 7.4
MySQL 5.7
Steps to install:
Clone or download the repository.

Create purify folder in storage/app/ directory.

Run cp .env.example .env.

Run docker-compose up -d.

Run docker exec -it db sh. Inside the shell, run:

:/# mysql -u root -p
Mysql Root password: your_mysql_root_password in the docker-compose.yml file. Then run following commands:

mysql> SHOW DATABASES;
mysql> GRANT ALL ON unifiedtransform.* TO 'unifiedtransform'@'%' IDENTIFIED BY 'secret';
mysql> FLUSH PRIVILEGES;
mysql> EXIT;
Finally, exit the container by running exit in the container shell.

Run docker exec -it app sh. Inside the shell, run following commands:

:/# composer install
:/# php artisan key:generate
:/# php artisan config:cache
:/# php artisan migrate:fresh --seed
Then exit from the container.

Visit http://localhost:8080. Admin login credentials:

Email: admin@ut.com
Password: password
Steps to follow: