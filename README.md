# Laravel Request Filters

A simple and elegant way to map request queries to database queries in Laravel, following single responsibility principles.

## Installation

```bash
composer require curvestech/laravel-request-filters
```

The service provider will be automatically registered via Laravel's package auto-discovery.

## Usage

### 1. Generate a Filter

```bash
php artisan make:filter UserFilter
```

Or with a model reference:

```bash
php artisan make:filter UserFilter --model=User
```

This creates a filter class in `app/Http/Filters/UserFilter.php`.

### 2. Add the Filterable Trait to Your Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Curvestech\LaravelRequestFilters\Traits\Filterable;

class User extends Model
{
    use Filterable;
}
```

### 3. Use in Your Controller

```php
<?php

namespace App\Http\Controllers;

use App\Http\Filters\UserFilter;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter(new UserFilter($request))->get();
        
        return response()->json($users);
    }
}
```

### 4. Filter Methods

Each public method in your filter class corresponds to a query parameter:

```php
<?php

namespace App\Http\Filters;

use Curvestech\LaravelRequestFilters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    // URL: ?name=john
    public function name(Builder $builder, $value): Builder
    {
        return $builder->where('name', 'like', '%' . $value . '%');
    }

    // URL: ?status=active
    public function status(Builder $builder, $value): Builder
    {
        return $builder->where('status', $value);
    }

    // URL: ?created_from=2023-01-01
    public function createdFrom(Builder $builder, $value): Builder
    {
        return $builder->where('created_at', '>=', $value);
    }
}
```

## Examples

### Basic Filtering

```
GET /users?name=john&status=active
```

### Date Range Filtering

```
GET /users?created_from=2023-01-01&created_to=2023-12-31
```

### Multiple Values

```
GET /users?ids=1,2,3
# or
GET /users?ids[]=1&ids[]=2&ids[]=3
```

## Requirements

- PHP ^8.0
- Laravel ^8.0|^9.0|^10.0|^11.0|^12.0

## License

MIT
