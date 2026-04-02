#!/bin/bash

# Portal Berita One-Script Installer
echo "🚀 Starting Portal Berita Installation..."

# 1. Check if Docker is installed
if ! [ -x "$(command -v docker)" ]; then
  echo '❌ Error: docker is not installed.' >&2
  exit 1
fi

# 2. Copy .env if not exists
if [ ! -f .env ]; then
    echo "📄 Creating .env file..."
    cp .env.example .env
    sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/g' .env
    sed -i 's/REDIS_HOST=127.0.0.1/REDIS_HOST=redis/g' .env
    sed -i 's/QUEUE_CONNECTION=sync/QUEUE_CONNECTION=redis/g' .env
fi

# 3. Build and Start Containers
echo "🐳 Building Docker containers..."
docker-compose up -d --build

# 4. Install PHP Dependencies
echo "📦 Installing PHP dependencies..."
docker-compose exec -T app composer install --no-interaction --prefer-dist --optimize-autoloader

# 5. Generate Application Key
echo "🔑 Generating application key..."
docker-compose exec -T app php artisan key:generate --force

# 6. Run Migrations
echo "🗄️ Running database migrations..."
docker-compose exec -T app php artisan migrate --force

# 7. Create Storage Link
echo "🔗 Creating storage link..."
docker-compose exec -T app php artisan storage:link

# 8. Build Frontend Assets
echo "🎨 Building frontend assets..."
docker run --rm -v $(pwd):/app -w /app node:20 npm install
docker run --rm -v $(pwd):/app -w /app node:20 npm run build

echo "✅ Installation Complete!"
echo "🌐 Access your portal at http://localhost:8181"
echo "🔑 Login at http://localhost:8181/login (test@example.com / password)"
