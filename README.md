<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Unframed - Laravel Template

### Installed Packages

- Octane - High performance webserver | https://laravel.com/docs/12.x/octane
- Passport - OAuth2 Server | https://laravel.com/docs/12.x/passport
- Socialite - OAuth2 Client | https://laravel.com/docs/12.x/socialite
- Laravel permission - manage user permissions and roles in a database | https://spatie.be/docs/laravel-permission/v6/installation-laravel
- Filament - Full-stack UI framework | https://filamentphp.com/docs/4.x/introduction/overview
- PHPStan - Static analyser | run ./vendor/bin/phpstan
- PHPUnit - Automatic testing framework | run  ./vendor/bin/phpunit
- OTP - Simple OTP package | https://github.com/benbjurstrom/otpz?tab=readme-ov-file#usage

### Installation

1. Clone the repository: `git clone git@gitlab.unframed.app:tooling/laravel/laravel-template-v2.git`
2. Change the `container_name` for the `laravel` container
3. Run `docker-compose up -d`
4. Enter the container `docker exec -it <CONTAINER_NAME> zsh`
5. Run `composer install`
6. Run `npm install`
7. Run `php artisan key:generate`
8. Edit `.env` make sure `DB_HOST=mysql8`, `DB_USER=root`, `DB_PASSWORD=root` and `DB_NAME` something sensible 
9. Run `php artisan migrate` and `php artisan db:seed`
10. Run `npm run build`
11. Visit `https://<container-name>.unframed.local`
12. Login with credentials
    ### Filament user
        Name: Unframed
        Email: info@unframed.nl
        Password: {SEE LOGS FOR PASSWORD} (/storage/logs/laravel.log)
13. Configure packages as needed
