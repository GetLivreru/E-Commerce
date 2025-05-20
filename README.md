# E-Commerce Platform

Современная платформа электронной коммерции, построенная на Laravel с интегрированной админ-панелью Orchid для удобного управления товарами и заказами.

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Orchid Platform](https://img.shields.io/badge/Orchid-14.52-8A2BE2?style=for-the-badge)

## 🚀 Функциональность

- **Управление продуктами**: Создание, редактирование, удаление и просмотр товаров через админ-панель
- **Корзина покупок**: Система добавления товаров в корзину и оформления заказов
- **Пользователи и роли**: Управление правами доступа и ролями пользователей
- **Админ-панель Orchid**: Интуитивно понятный интерфейс для управления всем магазином
- **RESTful API**: API для мобильных и веб-клиентов

## 📋 Требования

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL / PostgreSQL
- Git

## 🔧 Установка

### Клонирование репозитория

```bash
git clone <repository-url>
cd E-Commerce
```

### Установка зависимостей

```bash
composer install
npm install
```

### Настройка окружения

```bash
cp .env.example .env
php artisan key:generate
```

Отредактируйте `.env` файл, указав параметры подключения к базе данных:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

### Миграции и сиды

```bash
php artisan migrate
php artisan db:seed
```

### Запуск проекта

```bash
npm run dev
php artisan serve
```

## 🏗️ Структура проекта

```
E-Commerce/
├── app/                 # Основной код приложения
│   ├── Models/          # Модели Eloquent
│   ├── Http/            # Контроллеры, Middleware и т.д.
│   └── Orchid/          # Компоненты админ-панели Orchid
│       ├── Screens/     # Экраны Orchid
│       ├── Layouts/     # Layouts компоненты
│       └── Filters/     # Фильтры для админ-панели
├── config/              # Файлы конфигурации
├── database/            # Миграции и сиды
├── public/              # Публичные файлы
├── resources/           # Ресурсы (views, assets, lang)
├── routes/              # Маршруты приложения
└── tests/               # Тесты
```

## 🌐 Маршруты (Routes)

- `GET /`: Главная страница магазина
- `GET /products`: Список всех товаров
- `GET /products/{id}`: Детальная страница товара
- `GET /cart`: Корзина покупателя
- `GET /admin`: Доступ к админ-панели (Orchid)

## 🔐 Доступ к админ-панели

Админ-панель доступна по адресу: `http://your-app-url/admin`

Учетные данные по умолчанию:
- Email: admin@example.com
- Password: password

## 📱 API Endpoints

- `GET /api/products`: Получить список товаров
- `GET /api/products/{id}`: Получить данные конкретного товара
- `POST /api/cart`: Добавить товар в корзину
- `GET /api/cart`: Получить содержимое корзины

## 🛠️ Разработка

### Компиляция ассетов

```bash
npm run dev    # Для разработки
npm run build  # Для продакшена
```

### Запуск тестов

```bash
php artisan test
```

### Docker

Проект также может быть запущен с помощью Docker:

```bash
docker-compose up -d
```

## 📚 Документация

- [Laravel документация](https://laravel.com/docs)
- [Orchid Platform документация](https://orchid.software/en/docs)

## 🤝 Вклад в проект

Вклады приветствуются! Пожалуйста, ознакомьтесь с нашими правилами разработки перед созданием pull request.

## 📄 Лицензия

[MIT](LICENSE)

---

Разработано с ❤️ на Laravel и Orchid Platform
