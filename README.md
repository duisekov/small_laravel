##Laravel Support Service
#####Using Laravel, Passport, Vue.js, Vuex

<p>Installation</p>
1)Open cmd and type

 ```
 git clone https://github.com/duisekov/small_laravel.git
 ```

2)Open folder with project in cmd and type

```
composer install
```

3)Create .env file similar to .env.example and provide database information of  pre-created database

4)In cmd type

```
php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan passport:install

npm install

php artisan serve
```

There are three users:
```
Role:moderator
    email: moderator@ex.com
    password: moderator

Role:client
    email: client1@ex.com
    password: client1

    email: client2@ex.com
    password: client2
```

