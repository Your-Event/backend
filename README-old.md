# YourEvent Docker Setup

This project uses a **single unified Docker container** to run both Laravel backend and Next.js frontend with MySQL database and Redis cache.

## Quick Start

### Development Environment

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd YourEvent
   ```

2. **Copy environment files**
   ```bash
   cp backend/.env.example backend/.env
   cp frontend/.env.example frontend/.env.local
   ```

3. **Start the unified development environment**
   ```bash
   docker-compose up -d
   ```

4. **Setup Laravel inside the container**
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   docker-compose exec app npm install
   docker-compose exec app npm run build
   ```

5. **Install frontend dependencies**
   ```bash
   docker-compose exec app bash -c "cd frontend && npm install"
   ```

6. **Access your application**
   - **Main Application**: http://localhost:80 (Laravel + Nginx)
   - **Next.js Dev Server**: http://localhost:3000 (for development)
   - **MySQL**: localhost:3306
   - **Redis**: localhost:6379

### Production Environment

1. **Create production environment file**
   ```bash
   cp docker-compose.prod.yml docker-compose.override.yml
   ```

2. **Set environment variables**
   ```bash
   echo "DB_PASSWORD=your_secure_password" >> .env
   echo "DB_ROOT_PASSWORD=your_root_password" >> .env
   ```

3. **Build and start production containers**
   ```bash
   docker-compose --profile production up -d --build
   ```

## Services

### Unified Application Container
- **Main Port**: 80 (Laravel + Nginx)
- **Dev Port**: 3000 (Next.js Dev Server)
- **PHP Version**: 8.2
- **Node.js Version**: 18
- **Frameworks**: Laravel 12 + Next.js 16
- **Styling**: TailwindCSS 4
- **Web Server**: Nginx + PHP-FPM
- **Process Manager**: Supervisor

### Database (MySQL)
- **Port**: 3306
- **Version**: 8.0
- **Database**: yourevent
- **Default Credentials**: root/root (development)

### Cache (Redis)
- **Port**: 6379
- **Version**: 7

## Useful Commands

### Docker Compose
```bash
# Start all services
docker-compose up -d

# Stop all services
docker-compose down

# View logs
docker-compose logs -f

# Rebuild containers
docker-compose up -d --build

# Access unified application container
docker-compose exec app bash

# Access MySQL
docker-compose exec mysql mysql -u root -p

# Access Redis
docker-compose exec redis redis-cli
```

### Laravel Commands (inside app container)
```bash
# Run migrations
docker-compose exec app php artisan migrate

# Create new migration
docker-compose exec app php artisan make:migration create_table_name

# Clear cache
docker-compose exec app php artisan cache:clear

# Queue worker
docker-compose exec app php artisan queue:work
```

### Frontend Commands (inside app container)
```bash
# Install dependencies
docker-compose exec app bash -c "cd frontend && npm install"

# Run development server
docker-compose exec app bash -c "cd frontend && npm run dev"

# Build for production
docker-compose exec app bash -c "cd frontend && npm run build"
```

## Environment Variables

### Backend (.env)
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=yourevent
DB_USERNAME=root
DB_PASSWORD=root

REDIS_HOST=redis
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Frontend (.env.local)
```env
NEXT_PUBLIC_API_URL=http://localhost:8000
NEXT_PUBLIC_APP_NAME="YourEvent"
NEXT_PUBLIC_APP_ENV=development
```

## Docker Volumes

- `mysql_data`: Persistent MySQL data
- `redis_data`: Persistent Redis data
- `backend/storage`: Laravel storage files
- `backend/vendor`: PHP dependencies
- `frontend/node_modules`: Node.js dependencies

## Troubleshooting

### Common Issues

1. **Port conflicts**: Make sure ports 3000, 8000, 3306, and 6379 are available
2. **Permission issues**: Ensure proper file permissions for storage directories
3. **Database connection**: Verify MySQL container is running before accessing backend
4. **Build failures**: Check Docker logs for specific error messages

### Reset Everything
```bash
docker-compose down -v
docker system prune -f
docker-compose up -d --build
```

## Development Workflow

1. Make changes to your code
2. Frontend changes auto-reload (Next.js hot reload on port 3000)
3. Backend changes may require container restart:
   ```bash
   docker-compose restart app
   ```
4. For database changes:
   ```bash
   docker-compose exec app php artisan migrate
   ```

## Architecture Overview

This unified Docker setup runs both Laravel and Next.js in a single container using:

- **Multi-stage Docker build** for optimized image size
- **Supervisor** to manage multiple processes (PHP-FPM, Nginx, Queue Worker, Next.js Dev)
- **Nginx** as reverse proxy for Laravel and frontend
- **Shared volumes** for live code editing
- **Process isolation** for stable development environment

## Production Considerations

- Use HTTPS with SSL certificates
- Set strong database passwords
- Enable proper logging and monitoring
- Use environment-specific configurations
- Regular backups of MySQL data
- Implement proper CI/CD pipeline
