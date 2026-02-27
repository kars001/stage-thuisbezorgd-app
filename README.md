# Thuisbezorgd App

A Laravel-based application for managing orders, customers, products, and restaurants, featuring a robust admin panel powered by Filament 4.

<img width="3810" height="1806" alt="image" src="https://github.com/user-attachments/assets/186d53b2-eedc-4b60-b5df-141806afaf95" />

## Overview

This repository contains the backend and administrative interface for a delivery service platform. It uses a domain-driven structure and integrates several modern Laravel ecosystem packages for authentication, settings management, and API capabilities.

- **Framework**: Laravel 12.x
- **Admin Panel**: Filament 4.x
- **Authentication**: Laravel Fortify & Passport
- **Database**: MySQL/MariaDB (default)
- **Frontend/Assets**: Vite, Tailwind CSS 4.x

## Requirements

- **PHP**: ^8.2
- **Composer**: ^2.0
- **Node.js & npm**: Recent LTS versions
- **Database**: MySQL or MariaDB
- **Docker** For macos OrbStack is recommended

## Setup & Installation

### Local Development

1. **Clone the repository**:
   ```bash
   git clone https://github.com/kars001/stage-thuisbezorgd-app.git
   cd stage-thuisbezorgd-app
   ```

2. **Setup Docker**:
   Change the container_name for the laravel container

3. **Run**
    ```bash
    docker-compose up -d
    ```

4. **Enter the container**
   ```bash
   docker exec -it <CONTAINER_NAME> zsh
   ```

5. **Run**
   ```bash
   composer i
   ```

6. **Run**
   ```bash
   npm i
   ```

7. **Run**
   ```bash
   php artisan key:generate
   ```

8. **Setup the env**
   Edit .env make sure DB_HOST=mysql8, DB_USER=root, DB_PASSWORD=root and DB_NAME something sensible

9. **Run**
    ```bash
    php artisan migrate:fresh --seed
    ```

10. **Run**
    ```bash
    npm run build
    ```

## Project Structure

The project follows a modified DDD (Domain Driven Design) structure within the `src/` directory to separate concerns:

- `src/App`: Infrastructure, HTTP Controllers, Middleware, Routes, and Filament Resources.
  - `src/App/Admin`: Filament admin panel implementation.
  - `src/App/Api`: API specific logic and controllers.
  - `src/App/routes`: Web, API, and Console route definitions.
- `src/Domain`: Core business logic, Models, Actions, and Data Transfer Objects, organized by domain:
  - `Bestellingen`
  - `Klanten`
  - `Producten`
  - `Restaurants`
  - `Users`
- `database/`: Migrations, Factories, and Seeders.
