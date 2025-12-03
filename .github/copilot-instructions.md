# Copilot Instructions for House of Hope Leeds

## Project Overview
A Laravel 12 + Livewire 3 web application for a church community. It manages events, sermons, members, and user authentication with role-based access control. The stack uses Vite for asset building, Tailwind CSS for styling, and Pest/PHPUnit for testing.

## Architecture

### Tech Stack
- **Backend**: Laravel 12, PHP 8.3+
- **Frontend**: Livewire 3, Volt, Flux UI components, Tailwind CSS 4
- **Assets**: Vite 7, Laravel Vite Plugin
- **Auth**: Laravel Fortify (two-factor auth, email verification)
- **Testing**: Pest 4, PHPUnit

### Key Components

**Models** (`app/Models/`):
- `User`: Extended with `TwoFactorAuthenticatable`, has `role` column (enum: admin, pastor, member)
- `Event`: Church events with date, time, location, description
- `Member`: Community member profiles with contact info
- `Sermon`: Preached sermons with pastor relationship

**Controllers** (`app/Http/Controllers/`):
- `EventController`: CRUD for events (admin-only)
- `SermonController`: CRUD for sermons (admin/pastor)
- `MemberController`: CRUD for members
- `AdminController`: Dashboard routing for different roles

**Routing** (`routes/web.php`):
- Public routes: `/`, `/about`, `/events`, `/sermons`, `/donate` (no auth required)
- Authenticated routes: `/dashboard`, `/profile` (verified email required)
- Admin routes: `/admin/*` prefix with `role:admin` middleware
- Role-based routing uses custom `RoleMiddleware` checking `auth()->user()->role`

**Frontend** (`resources/views/`):
- Blade templates in `public/` for public-facing pages (home, events, sermons, about)
- Livewire components in `resources/views/livewire/` for interactive features
- Admin templates in `resources/views/admin/` organized by resource (events, members, sermons)
- Flux UI component library for consistent styling

**Livewire Structure**:
- Forms: `app/Livewire/Forms/LoginForm.php` for reactive form handling
- Actions: `app/Livewire/Actions/` for business logic
- Settings: `app/Livewire/Settings/` for user preferences

## Database Schema
- `users`: id, name, email, password, role (string), two_factor_secret, two_factor_recovery_codes
- `events`: id, title, description, date, time, location, timestamps
- `members`: id, name, email, phone, address, dob, timestamps
- `sermons`: id, title, date, pastor_id (FK to users), timestamps
- Migrations in `database/migrations/` follow timestamp naming convention

## Developer Workflows

### Setup & Installation
```bash
composer install
php artisan key:generate
php artisan migrate
npm install
npm run build
```

### Development
```bash
npm run dev          # Start Vite dev server (hot reload)
php artisan serve    # Start Laravel server
php artisan tinker   # Interactive shell for testing
```

### Testing
```bash
php artisan test     # Run Pest tests (Feature + Unit)
php artisan test --filter=TestName
php artisan test tests/Feature/SpecificTest.php
```
- Tests use SQLite in-memory database (configured in `phpunit.xml`)
- Test structure: `tests/Feature/` for integration tests, `tests/Unit/` for unit tests
- Base test class: `Tests\TestCase` extending Laravel's TestCase

### Code Quality
```bash
./vendor/bin/pint              # Format code (Laravel Pint)
./vendor/bin/phpstan analyze   # Static analysis (if enabled)
```

### Database
```bash
php artisan migrate:refresh --seed   # Reset and seed
php artisan tinker < seed.php        # Run seeders manually
php artisan make:migration create_table_name
php artisan make:model ModelName -m  # Create model + migration
```

## Project-Specific Patterns

### Authentication & Authorization
- **Role System**: User model has a `role` column (check migrations). Use `RoleMiddleware` for route protection:
  ```php
  Route::middleware('role:admin')->group(fn () => ...);
  ```
- **Two-Factor Auth**: Handled by Fortify, configured in `config/fortify.php`
- **Email Verification**: Required for accessing authenticated routes; migration adds `email_verified_at` timestamp

### Data Mapping & Validation
- Controllers validate request data explicitly (see `EventController::store()` for pattern)
- Field name mismatches are common: form sends `event_date` → stored as `date` column
- Always unset original request key after mapping to avoid mass assignment issues

### View Organization
- **Public Pages**: Blade templates in `public/` directory (not `resources/views/public/`)
- **Admin Pages**: Livewire components preferred; stored in `resources/views/admin/[resource]/`
- **Styling**: All pages use Tailwind CSS with Flux components; no custom CSS except in `resources/css/app.css`

### Livewire & Volt Integration
- Volt components combine PHP logic + Blade template in single `.php` files
- Use `app/Livewire/Forms/` for encapsulated form state management
- Reactive properties auto-update UI on data changes

### Database Queries
- Eager-load relationships to prevent N+1 queries: `Sermon::with('pastor')->get()`
- Use `orderBy()` consistently; see route examples for ordering direction expectations
- Pagination: `Event::paginate(10)` used in controllers

### JSON Casts & Type Hints
- User model casts `password` to `hashed` and dates to `datetime`
- Event model casts `date` to `date` type
- Use PHP 8 type hints and return type declarations throughout

## File Structure Quick Reference
```
app/
  Models/          → Event, Member, Sermon, User
  Http/
    Controllers/   → EventController, SermonController, etc.
    Middleware/    → RoleMiddleware, others from Laravel
  Livewire/        → Forms, Actions, Settings subdirectories
  Providers/       → ServiceProvider, FortifyServiceProvider, VoltServiceProvider
routes/
  web.php          → All routes; split by public/auth/admin groups
database/
  migrations/      → Ordered by timestamp
  factories/       → Seeders for testing/development
resources/
  views/
    public/        → Home, about, events, sermons (Blade)
    admin/         → Admin pages organized by resource
    livewire/      → Livewire components
  css/app.css      → Global Tailwind styles
  js/app.js        → JS entry point
tests/
  Feature/         → Integration tests
  Unit/            → Unit tests
  TestCase.php     → Base test class
```

## Critical Knowledge Areas
1. **Role-based routing**: Custom `RoleMiddleware` checks `auth()->user()->role` string. Ensure role values match exactly (case-sensitive).
2. **Public vs Admin pages**: Public routes live in `public/` directory, not in `resources/views/public/`
3. **Data transformation**: Controllers often map request fields to different column names; check validation rules against form submissions
4. **Livewire reactivity**: Component state updates automatically trigger re-renders; avoid manual DOM manipulation
5. **Asset compilation**: Always run `npm run build` before deployment; Vite entry point is `resources/js/app.js` and `resources/css/app.css`

## Common Commands
```bash
npm run dev                     # Dev server with hot reload
npm run build                   # Production build
php artisan serve              # Start local server
php artisan test               # Run all tests
php artisan tinker             # Interactive REPL
php artisan migrate            # Run pending migrations
php artisan cache:clear        # Clear application cache
php artisan key:generate       # Generate app key
```
