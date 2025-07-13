# Company Profile - Spatie Laravel Permission Setup

## Overview
Sistem ini menggunakan Spatie Laravel Permission untuk mengatur role dan permission dalam aplikasi company profile.

## Role Structure

### 1. Superadmin
- **Permission**: Akses penuh ke semua fitur (menggunakan Gate::before() intercept)
- **Fungsi**: Administrator tertinggi sistem
- **Email**: superadmin@company.com
- **Password**: password

### 2. Company Admin
- **Permission**: Hampir semua akses kecuali beberapa yang dibatasi untuk superadmin
- **Fungsi**: Administrator internal perusahaan
- **Email**: admin@company.com
- **Password**: password

**Permissions:**
- `manage users` - Mengelola user internal perusahaan
- `edit company profile` - Edit logo, nama perusahaan, visi misi
- `view company profile`
- `edit about company`
- `edit banner`
- `manage gallery`
- `manage pricing catalog`
- `manage blog`, `view blog`
- `edit company address`
- `edit contact info`
- `manage faq`
- `view dashboard`

### 3. Company User
- **Permission**: Akses terbatas untuk user perusahaan
- **Fungsi**: Staff perusahaan dengan akses terbatas
- **Email**: user@company.com
- **Password**: password

**Permissions:**
- `view company profile`
- `edit about company`
- `edit banner`
- `manage gallery`
- `manage pricing catalog`
- `manage blog`, `view blog`
- `edit company address`
- `edit contact info`
- `manage faq`
- `view dashboard`

**Perbedaan dengan Company Admin:**
- Tidak bisa `manage users`
- Tidak bisa `edit company profile` (logo, nama, visi misi)

## Usage

### 1. Dalam Controller
```php
// Menggunakan authorize method
$this->authorize('edit company profile');

// Menggunakan middleware di constructor
public function __construct()
{
    $this->middleware('permission:view dashboard');
}

// Checking permission dalam method
if (!auth()->user()->can('manage users')) {
    abort(403, 'Unauthorized');
}
```

### 2. Dalam Blade Template
```php
@can('edit company profile')
    <a href="{{ route('admin.company-profile.edit') }}">Edit Profile</a>
@endcan

@cannot('manage users')
    <p>You don't have permission to manage users</p>
@endcannot

@role('superadmin')
    <p>Welcome Superadmin!</p>
@endrole
```

### 3. Dalam Route
```php
// Single permission
Route::get('/admin/users', [AdminController::class, 'users'])
    ->middleware('permission:manage users');

// Multiple routes dengan permission yang sama
Route::middleware('permission:manage gallery')->group(function () {
    Route::get('/gallery', [AdminController::class, 'gallery']);
    Route::post('/gallery', [AdminController::class, 'store']);
});
```

### 4. Helper Functions
```php
// Check permission
if (canAccess('edit company profile')) {
    // User can access
}

// Check role
if (hasRole('company admin')) {
    // User has role
}

// Specific role checks
if (isSuperAdmin()) {
    // User is superadmin
}

if (isCompanyAdmin()) {
    // User is company admin
}

// Get user permissions
$permissions = getUserPermissions();

// Get user roles
$roles = getUserRoles();
```

## Migration & Seeding

### 1. Run Migration
```bash
php artisan migrate:fresh --seed
```

### 2. Manual Seeding
```bash
php artisan db:seed --class=RolePermissionSeeder
```

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       └── AdminController.php
│   └── Middleware/
│       └── CheckPermission.php
├── Models/
│   └── User.php (dengan HasRoles trait)
├── Providers/
│   └── AppServiceProvider.php (Gate::before untuk superadmin)
└── Helpers/
    └── PermissionHelper.php

database/
└── seeders/
    ├── RolePermissionSeeder.php
    └── DatabaseSeeder.php

resources/
└── views/
    └── admin/
        └── dashboard.blade.php

routes/
└── admin.php
```

## Permissions List

| Permission | Description |
|------------|-------------|
| `manage users` | Kelola user internal perusahaan |
| `edit company profile` | Edit logo, nama, visi misi perusahaan |
| `view company profile` | Lihat profil perusahaan |
| `edit about company` | Edit tentang perusahaan |
| `edit banner` | Edit banner website |
| `manage gallery` | Kelola galeri foto |
| `manage pricing catalog` | Kelola katalog harga |
| `manage blog` | Kelola artikel blog (create, edit, delete) |
| `view blog` | Lihat artikel blog |
| `edit company address` | Edit alamat perusahaan |
| `edit contact info` | Edit informasi kontak |
| `manage faq` | Kelola FAQ |
| `view dashboard` | Akses dashboard admin |

## Notes

1. **Superadmin** menggunakan `Gate::before()` intercept sehingga tidak perlu permission eksplisit
2. **Company Admin** memiliki akses penuh manajemen internal perusahaan
3. **Company User** memiliki akses konten management tanpa user management
4. Helper functions tersedia untuk memudahkan pengecekan permission
5. Middleware permission otomatis mengecek authentication
