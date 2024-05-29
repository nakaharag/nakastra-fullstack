# Fullstack batch processing example

## About The Project

### Built With

* [React](https://reactjs.org/)
* [PHP Laravel](https://laravel.com/)
* [Typescript](https://www.typescriptlang.org/)
* [Redis](https://redis.io/)
* [MySQL](https://www.mysql.com/)
* [NGNIX](https://nginx.org/)
* [Docker Compose](https://docs.docker.com/compose/)
* [Supervisor](http://supervisord.org/)
* [Tailwindcss](https://tailwindcss.com/)
* [Vite](https://vitejs.dev)
* [shadcn/ui](https://ui.shadcn.com/)
* [bun](https://bun.sh/) (But you can use [Node.js](https://nodejs.org/en) instead)

## Unit testing

## Running the project
### First steps:
`git clone git@github.com:nakaharag/nakastra-fullstack.git`

`cp .env.example .env`

`docker-compose up -d`

`cp backend/.env.example backend/.env`

Edit the .env with credentials if needed:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_username_password

QUEUE_CONNECTION=redis

REDIS_CLIENT=predis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```
### Running:
- Install frontend dependencies with `bun install` 
- Build frontend with `bun run dev`
- Run backend install routines:
  - `docker-compose exec backend composer install `
  - `docker-compose exec backend php artisan key:generate`
  - `docker-compose exec backend php artisan migrate`
- Use the input example file
- Run laravel queue `docker exec backend php artisan queue:work` or simply activate by `docker exec backend php artisan queue:listen`

#### Edit docker-compose file if you need change ports
Backend: [http://localhost:8000](http://localhost:8000)
Frontend: [http://localhost:8888](http://localhost:8888)