Setup Guide:
1. Pull Repo
2. cp .env.example .env
3. php artisan key:generate
4. composer install
5. npm run dev
6. php artisan serve
7. create db: cookx
8. php artisan migrate
9. php artisan db:seed --class=UserSeeder
10a. Login 
Email: admin@mail.com
Password: password

OR

10b. http://cookx.test/register

Assumptions:
1. CookX will have unlimited amount of designers to attend to appointments
2. Appointment blocks are 30 minutes block
3. Runs on GMT+8 timezone

Dev Note:
1. Did not work on Google Calendar API due to time constraints
2. Operation rules have been implemented in front end

Screenshots
https://imgur.com/a/QoX0M4h