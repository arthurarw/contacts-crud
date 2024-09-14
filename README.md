# Laravel & Vue.js Project - Contacts Crud - Just 4Fun

This is a template project that integrates Laravel (backend) with Vue.js (frontend). Follow the instructions below to install and set up the project on your local machine.

## Prerequisites

Before you begin, make sure you have the following installed:

- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **Node.js** >= 16.0 (with npm)
- **Docker** - To setup backend project
- **Git** (optional, for version control)

## Installation

Follow these steps to install the project on your local environment.

### 1. Clone the Repository

If you haven't cloned the repository yet, do so with the following command:

```bash
git clone https://github.com/arthurarw/contacts-crud.git
```

Then navigate to the project folder:

```bash
cd contacts-crud/api
```

### 2. Create a .env file

```bash
cp .env.example .env
```

### 3. Set Up Environment Configuration


```dotenv
APP_NAME="Contacts Crud"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 4. Setup the containers to backend works

```sh
docker-compose up -d
```

Access the container:

```sh
docker-compose exec app bash
```

Install the dependencies 
```sh
composer install
```

Generate a key project
```sh
php artisan key:generate
```

Access the project: [http://localhost:8989/api](http://localhost:8989/api)


### 5. Run Database Migrations

The project have database migrations, run the following command to create the necessary tables:

```bash
php artisan migrate
```

I recommend to you run the seed command to generate a 1000 users with fake infos. Follow the command:

```bash
php artisan db:seed
```

### 6. Build Frontend Assets

Inside the `front` folder run this command

  ```bash
  npm install
  ```

Create a .env file:
```bash
cp .env.example .env
```

Just check the environments variables inside the file...

After installation, run:
  - For development:
    
    ```bash
    npm run dev
    ```

- For production:

    ```bash
    npm run build
    ```

### 7. Serve the Application

Visit `http://localhost:5173` in your browser to view the application.

## Contributing

Feel free to submit a pull request or open an issue if you find a bug or have a feature suggestion.

## License

This project is open-source and available under the [MIT License](LICENSE).
