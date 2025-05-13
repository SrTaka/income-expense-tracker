# Income-Expense Tracker

A modern web application built with Laravel and Tailwind CSS to help you track your personal finances effectively.

![Dashboard Preview](docs/images/dashboard.png)
![Transaction History](docs/images/transactions.png)
![Reports View](docs/images/reports.png)

## Features

### User Features
- Track income and expenses with detailed categorization
- View financial summaries and analytics
- Responsive design for all devices
- Secure user authentication
- Real-time updates and notifications
- Export financial reports
- Profile management
- Commission tracking
- Category management

### Admin Features
- User management system
- Advanced reporting and analytics
- System settings configuration
- Product management
- Order tracking
- Notification management

## Tech Stack

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **Build Tool**: Vite
- **Role Management**: Spatie Permission Package

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Git

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/income-expense-tracker.git
cd income-expense-tracker
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create a copy of the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations and seeders:
```bash
php artisan migrate --seed
```

8. Start the development server:
```bash
php artisan serve
```

9. In a separate terminal, start Vite:
```bash
npm run dev
```

## API Endpoints

### Authentication
- `POST /api/login` - User login
- `POST /api/register` - User registration
- `POST /api/logout` - User logout

### Transactions
- `POST /income` - Add new income
- `POST /expense` - Add new expense
- `POST /commission` - Add new commission

### Categories
- `POST /categories` - Create new category

### Profile
- `GET /profile` - Get user profile
- `PATCH /profile` - Update user profile
- `DELETE /profile` - Delete user account

### Admin Endpoints
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - List all users
- `POST /admin/users` - Create new user
- `PUT /admin/users/{user}` - Update user
- `DELETE /admin/users/{user}` - Delete user
- `GET /admin/reports` - View reports
- `GET /admin/settings` - View settings
- `POST /admin/settings` - Update settings

## API Documentation

### Authentication Endpoints

#### Login
```http
POST /api/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password"
}
```
Response:
```json
{
    "token": "access_token_here",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "user@example.com"
    }
}
```

#### Register
```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "user@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

### Transaction Endpoints

#### Add Income
```http
POST /income
Content-Type: application/json
Authorization: Bearer {token}

{
    "amount": 1000.00,
    "category_id": 1,
    "description": "Monthly Salary",
    "date": "2024-03-20"
}
```

#### Add Expense
```http
POST /expense
Content-Type: application/json
Authorization: Bearer {token}

{
    "amount": 50.00,
    "category_id": 2,
    "description": "Grocery Shopping",
    "date": "2024-03-20"
}
```

#### Add Commission
```http
POST /commission
Content-Type: application/json
Authorization: Bearer {token}

{
    "amount": 100.00,
    "description": "Sales Commission",
    "date": "2024-03-20"
}
```

### Category Endpoints

#### Create Category
```http
POST /categories
Content-Type: application/json
Authorization: Bearer {token}

{
    "name": "Groceries",
    "type": "expense",
    "color": "#FF5733"
}
```

### Profile Endpoints

#### Update Profile
```http
PATCH /profile
Content-Type: application/json
Authorization: Bearer {token}

{
    "name": "John Doe",
    "email": "john@example.com",
    "current_password": "old_password",
    "new_password": "new_password"
}
```

## Advanced Configuration

### Database Configuration
```env
# MySQL Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# PostgreSQL Configuration
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Cache Configuration
```env
CACHE_DRIVER=file
CACHE_PREFIX=income_expense_
CACHE_TTL=3600
```

### Queue Configuration
```env
QUEUE_CONNECTION=redis
QUEUE_RETRY_AFTER=90
QUEUE_TIMEOUT=60
```

### Mail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Redis Configuration
```env
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis
```

### Session Configuration
```env
SESSION_DRIVER=redis
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
```

## Troubleshooting Guide

### Common Issues and Solutions

#### Database Connection Issues
1. **Error**: "SQLSTATE[HY000] [2002] Connection refused"
   - Solution: Check if MySQL/PostgreSQL service is running
   - Command: `sudo service mysql status` or `sudo service postgresql status`

2. **Error**: "Access denied for user"
   - Solution: Verify database credentials in `.env`
   - Ensure user has proper permissions

#### Cache Issues
1. **Error**: "Cache store [redis] is not defined"
   - Solution: Install Redis server
   - Run: `sudo apt-get install redis-server`

2. **Error**: "Permission denied"
   - Solution: Set proper permissions
   - Run: `chmod -R 775 storage bootstrap/cache`

#### Queue Issues
1. **Error**: "Queue worker not running"
   - Solution: Start queue worker
   - Run: `php artisan queue:work`

2. **Error**: "Failed to open stream"
   - Solution: Check storage permissions
   - Run: `chmod -R 775 storage`

### Performance Optimization

1. **Slow Page Load**
   - Enable route caching: `php artisan route:cache`
   - Enable config caching: `php artisan config:cache`
   - Enable view caching: `php artisan view:cache`

2. **High Memory Usage**
   - Optimize composer autoload: `composer dump-autoload -o`
   - Clear cache: `php artisan cache:clear`

## Development Guidelines

### Code Style
- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Add proper PHPDoc blocks
- Keep functions small and focused

### Git Workflow
1. Create feature branch from `develop`
   ```bash
   git checkout develop
   git pull origin develop
   git checkout -b feature/your-feature
   ```

2. Commit changes
   ```bash
   git add .
   git commit -m "feat: add new feature"
   ```

3. Push and create PR
   ```bash
   git push origin feature/your-feature
   ```

### Testing
1. Write unit tests for new features
   ```bash
   php artisan make:test YourFeatureTest
   ```

2. Run tests
   ```bash
   php artisan test
   ```

### Database Migrations
1. Create migration
   ```bash
   php artisan make:migration create_your_table
   ```

2. Run migrations
   ```bash
   php artisan migrate
   ```

3. Rollback if needed
   ```bash
   php artisan migrate:rollback
   ```

### Security Best Practices
1. Always validate user input
2. Use prepared statements for queries
3. Implement rate limiting
4. Use CSRF protection
5. Keep dependencies updated

### Deployment Checklist
1. Run tests
2. Clear cache
3. Update dependencies
4. Run migrations
5. Set proper permissions
6. Configure environment variables
7. Enable maintenance mode
8. Deploy code
9. Run post-deployment tasks
10. Disable maintenance mode

## Usage

### User Guide
1. Register a new account or login with existing credentials
2. Add your income and expense transactions
3. Categorize your transactions for better organization
4. View your financial summaries and reports
5. Export data when needed

### Admin Guide
1. Access the admin dashboard
2. Manage users and their permissions
3. Configure system settings
4. Generate and view reports
5. Monitor transactions and activities

## Configuration

### Environment Variables
Key environment variables to configure:
```
APP_NAME=IncomeExpenseTracker
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### File Permissions
Ensure proper permissions are set:
```bash
chmod -R 775 storage bootstrap/cache
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Security

If you discover any security related issues, please email security@example.com instead of using the issue tracker.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

If you encounter any issues or have questions:
1. Check the [documentation](docs/README.md)
2. Search through [existing issues](https://github.com/yourusername/income-expense-tracker/issues)
3. Create a new issue if needed

## Credits

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Spatie Permission](https://github.com/spatie/laravel-permission)
