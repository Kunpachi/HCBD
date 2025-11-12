## Quick context

This repository is a Laravel 11 web application (PHP 8.2). It uses the standard Laravel MVC layout with Vite + Tailwind for frontend assets. Key locations:

- Controllers: `app/Http/Controllers` (example: `UserController.php` returns view `users.index`).
- Routes: `routes/web.php` (routes are flat, e.g. `Route::get('/users', [UserController::class, 'index'])`).
- Views: `resources/views/*` (Blade templates; `resources/views/users/index.blade.php` is in use).
- Models: `app/Models` (Eloquent models; `User.php` shows project-specific casting via a `casts()` method).
- DB / seeds / tests: `database/migrations`, `database/factories`, `database/seeders`, and `tests/`.

## Big-picture architecture notes for code generation

- Follow Laravel's MVC pattern. Controllers orchestrate data and return Blade views or JSON.
- Data layer uses Eloquent models (`app/Models/*`). Example: `User` is an `Authenticatable` model with `$fillable`/`$hidden` and a `casts()` method rather than a `$casts` property — preserve that style when modifying model code.
- Routing is file-based in `routes/web.php`. Add new web routes there and keep REST-style controller methods in `app/Http/Controllers`.
- Frontend assets are Vite-driven. Blade templates reference built assets via the Laravel Vite plugin.

## Developer workflows and exact commands (Windows PowerShell)

Use these exact, tested commands when performing environment setup or running the app locally.

1) Install PHP dependencies and node modules, create .env, and generate app key:

```powershell
composer install
Copy-Item .env.example .env -ErrorAction SilentlyContinue
php artisan key:generate
```

2) If you want a local database quickly (project expects sqlite in some scripts):

```powershell
if (-not (Test-Path database\database.sqlite)) { New-Item database\database.sqlite -ItemType File | Out-Null }
php artisan migrate
```

3) Run dev environment (the repository provides a convenience composer script that starts multiple processes):

```powershell
composer run-script dev
# or run frontend only:
npm install
npm run dev
```

4) Run tests (platform-agnostic):

```powershell
php artisan test
```

Notes: `composer run-script dev` uses `npx concurrently` to run `php artisan serve`, `php artisan queue:listen`, `php artisan pail` and `npm run dev` in parallel — useful for full local dev but heavier than running frontend only.

## Patterns & conventions observed (stay consistent)

- Controllers sometimes return simple arrays to views for demos (see `UserController::index`). When replacing with real DB data, return Eloquent collections (e.g. `User::all()`) and paginate where appropriate.
- Models use typed properties and a `casts()` method instead of the `$casts` property — keep that pattern when adding casts to other models.
- Tests use Laravel's usual location (`tests/Feature`, `tests/Unit`) and phpunit.xml sets test env variables (notably `QUEUE_CONNECTION=sync`, `MAIL_MAILER=array`). Use `php artisan test` so those env settings are respected.

## Integration points & external deps to be careful about

- Frontend: `vite`, `tailwindcss`, and `laravel-vite-plugin` (see `package.json` and `vite.config.js`). When changing asset paths, update the plugin usage in Blade templates.
- Queues: `php artisan queue:listen` and `QUEUE_CONNECTION` config — tests run with sync queue. If adding async jobs, ensure local developer scripts can run the chosen driver.
- Dev tools: `laravel/pail` (used in composer dev script) and `laravel/pint` are present as dev dependencies; keep formatting and log-tail behaviors in mind.

## Helpful file references (examples to read before editing)

- `app/Http/Controllers/UserController.php` — shows a simple controller that returns `view('users.index', compact('users'))` with an inline users array.
- `routes/web.php` — where HTTP routes are declared.
- `app/Models/User.php` — model conventions and the `casts()` method example.
- `phpunit.xml` — testing environment variables and test suites.
- `composer.json` and `package.json` — scripts and dev tooling (see `dev` composer script and Vite scripts).

## Typical change guidance for AI edits

- When adding code, prefer minimal, focused changes (small PRs). Follow existing style: PSR-12 for PHP and Blade conventions in templates.
- Run `php artisan test` after changes that touch backend behavior. Run `npm run dev` / `vite build` after assets changes.
- If edits touch DB shape, add a migration in `database/migrations` and include a brief note in the PR description.

If anything here is unclear or you'd like this file to include additional examples (e.g., common scaffolded tests, sample Blade fragments, or preferred commit message format), tell me which section to expand and I'll iterate.
