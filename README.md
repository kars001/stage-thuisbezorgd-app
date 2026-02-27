# Thuisbezorgd App

A Laravel-based application for managing orders, customers, products, and restaurants, featuring a robust admin panel powered by Filament 4.

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
- **Docker** For macos OrbStack is recccomended

## Setup & Installation

### Local Development

1. **Clone the repository**:
   ```bash
   git clone https://github.com/kars001/stage-thuisbezorgd-app.git
   cd stage-thuisbezorgd-app
   ```

2. **Run the setup script**:
   This custom composer script handles dependency installation, environment setup, key generation, migrations, and asset building.
   ```bash
   composer setup
   ```
   *Note: Ensure you have a database running and configured in your `.env` file before migrations run.*

3. **Configure Environment**:
   Edit the generated `.env` file to match your local database and service credentials.

4. **Start the development servers**:
   ```bash
   composer dev
   ```
   This command uses `concurrently` to start the PHP server, queue listener, logs (Pail), and Vite dev server.

### Docker Development

The project includes a `docker-compose.yaml` file.

```bash
docker-compose up -d
```

## Project Structure

The project follows a modified PSR-4 structure within the `src/` directory to separate concerns:

- `src/App`: Infrastructure, HTTP Controllers, Middleware, Routes, and Filament Resources.
  - `src/App/Admin`: Filament admin panel implementation.
  - `src/App/Api`: API specific logic and controllers.
  - `src/App/routes`: Web, API, and Console route definitions.
- `src/Domain`: Core business logic, Models, Actions, and Data Transfer Objects, organized by domain:
  - `Bestellingen` (Orders)
  - `Klanten` (Customers)
  - `Producten` (Products)
  - `Restaurants`
  - `Users`
- `database/`: Migrations, Factories, and Seeders.
