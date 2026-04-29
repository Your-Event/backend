# YourEvent - Unified Docker Setup

This project uses a **clean, unified Docker architecture** with separate services for Laravel backend, Next.js frontend, MySQL database, and Redis cache.

## 🏗️ Architecture

```
├── backend/                 # Laravel application
├── frontend/                # Next.js application  
├── docker/                  # Docker configurations
│   ├── php/
│   │   ├── Dockerfile       # Laravel PHP-FPM
│   │   └── supervisor.conf  # Queue worker config
│   ├── nginx/
│   │   └── default.conf     # Nginx configuration
│   └── node/
│       └── Dockerfile       # Next.js Node.js
├── docker-compose.yml       # Main orchestration
└── README.md               # This file
```

## 🚀 Quick Start

### 1. Environment Setup
```bash
# Copy environment files
cp backend/.env.example backend/.env
cp frontend/.env.example frontend/.env.local
```

### 2. Start All Services
```bash
docker-compose up -d
```

### 3. Install Dependencies
```bash
# Laravel dependencies
docker-compose exec php composer install
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate

# Frontend dependencies  
docker-compose exec node npm install
```

### 4. Access Applications
- **Laravel API**: http://localhost:8080
- **Next.js Frontend**: http://localhost:3000
- **MySQL**: localhost:3306
- **Redis**: localhost:6379

## 📋 Services

| Service | Technology | Port | Purpose |
|---------|-------------|------|---------|
| `php` | Laravel 12 + PHP 8.2 | 9000 | Backend API + Queue Worker |
| `nginx` | Nginx Alpine | 8080 | Web server for Laravel |
| `node` | Next.js 16 + Node 18 | 3000 | Frontend application |
| `mysql` | MySQL 8.0 | 3306 | Database |
| `redis` | Redis 7 | 6379 | Cache & Sessions |

## 🔧 Development Workflow

### Laravel Commands
```bash
# Run migrations
docker-compose exec php php artisan migrate

# Create migration
docker-compose exec php php artisan make:migration create_table_name

# Clear cache
docker-compose exec php php artisan cache:clear

# Queue worker (runs automatically via supervisor)
docker-compose exec php php artisan queue:work
```

### Frontend Commands
```bash
# Install dependencies
docker-compose exec node npm install

# Development server (auto-reloads)
docker-compose exec node npm run dev

# Build for production
docker-compose exec node npm run build
```

### Docker Management
```bash
# View logs
docker-compose logs -f

# Restart specific service
docker-compose restart php

# Rebuild containers
docker-compose up -d --build

# Stop everything
docker-compose down
```

## 🌐 Networking & Communication

### Internal Service Communication
- **Laravel → MySQL**: `mysql:3306`
- **Laravel → Redis**: `redis:6379`
- **Next.js → Laravel**: `http://nginx:80`

### Environment Variables
```env
# Backend (.env)
DB_HOST=mysql
REDIS_HOST=redis

# Frontend (.env.local)
NEXT_PUBLIC_API_URL=http://nginx:80
```

## 🔄 Hot Reload & Development

- **Next.js**: Automatic hot reload on port 3000
- **Laravel**: Code changes reflected immediately (PHP-FPM)
- **Frontend assets**: Rebuild with `npm run build` in php container

## 📦 Volumes & Persistence

- **MySQL data**: `mysql_data` volume
- **Redis data**: `redis_data` volume  
- **Laravel code**: Mounted from `./backend`
- **Frontend code**: Mounted from `./frontend`
- **Node modules**: Isolated in container

## 🛠️ Production Considerations

- Use HTTPS with SSL certificates
- Set strong database passwords
- Enable proper logging and monitoring
- Use environment-specific configurations
- Regular backups of MySQL data

## 🧹 Cleanup

```bash
# Stop and remove all containers
docker-compose down -v

# Remove all Docker images
docker system prune -a

# Rebuild from scratch
docker-compose up -d --build
```

## 📁 Final Folder Structure

```
YourEvent/
├── backend/                 # Laravel application
│   ├── app/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   ├── storage/
│   ├── .env
│   ├── .env.example
│   ├── composer.json
│   └── package.json
├── frontend/                # Next.js application
│   ├── app/
│   ├── components/
│   ├── pages/
│   ├── public/
│   ├── .env.local
│   ├── .env.example
│   ├── next.config.js
│   └── package.json
├── docker/                  # Docker configurations
│   ├── php/
│   │   ├── Dockerfile       # Laravel PHP-FPM + Supervisor
│   │   └── supervisor.conf  # Queue worker config
│   ├── nginx/
│   │   └── default.conf     # Nginx configuration
│   └── node/
│       └── Dockerfile       # Next.js Node.js
├── docker-compose.yml       # Main orchestration file
└── README.md               # This documentation
```

## 🎯 Key Benefits

✅ **Clean separation** - Each service has its own container  
✅ **Scalable architecture** - Easy to scale individual services  
✅ **Developer friendly** - Hot reload and live code editing  
✅ **Production ready** - Proper networking and volume management  
✅ **Maintainable** - Clear folder structure and documentation
