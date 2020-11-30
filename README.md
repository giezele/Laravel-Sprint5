# Laravel Sprint 5

### Task

Make the Information system (IS) for collecting, processing, storeing, and distributing information. Use Laravel framework, involve entities, realations, CRUD.


## Features


Information System for travel agency:
- Create, update, delete and view a list of possible countries;
- Create, update, delete and view a list of towns and assign them to countries available;
- Create, update, delete and view a list of customers and assign them to countries available;
- Filter customers by selected country;
- View customer data and details of selected trip on one card;
- Authenticated login for company-approved managers only;

## Setup

1. In localhost directory run CLI comand `php composer.phar create-project laravel/laravel choose_name}`
2. Inside your new-app-directory run CLI commands:

```
    - php composer.phar require laravel/ui

    - php artisan ui vue --auth

    - npm install && npm run dev
```

3. Clone this repository `https://github.com/giezele/Laravel-Sprint5`
4. You need to copy+paste **vendor** folder from your previous project.
5. Make a copy of .env.example and erase the ".example" extention.
6. Update .env file with your credentials:
```
    DB_DATABASE={enter_your_DB_name} //must be the same as Schema name in step 5  
    DB_USERNAME=root
    DB_PASSWORD={your_password} 
```
7. Create "new Schema" in MySQL Workbench (must be same name as in  `DB DATABASE=` )
8. Run `php artisan migrate` in CLI inside your project.
9. Run `php artisan db:seed --class=UserSeeder`
10. Run `php artisan serve` and click on the link to view the app in your browser.
11. Expect this exception - hit `Generate app key`

    <img src="https://user-images.githubusercontent.com/26652268/100551382-b8111380-3288-11eb-8c06-22faf5704ae2.png" width="300">

12. LOGIN Email --> admin@admin.com
13. LOGIN Pass --> admin
14. In case of success you will see this:

    <img src="https://user-images.githubusercontent.com/26652268/100551481-82205f00-3289-11eb-91dc-99dd234499a4.png" width="600">

