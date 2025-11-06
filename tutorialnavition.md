# Tutorial Lengkap Filament PHP Navigation

Berikut adalah panduan lengkap untuk mengatur dan menyesuaikan navigasi di Laravel Filament v4, berdasarkan dokumentasi resmi yang Anda berikan.[1]

## Dasar-Dasar Navigation

### 1. Mengubah Label Navigasi

Secara default, Filament menggunakan nama resource sebagai label navigasi. Anda bisa mengubahnya dengan dua cara:[2][3]

**Cara 1: Menggunakan Property**
```php
// app/Filament/Resources/UserResource.php
protected static ?string $navigationLabel = 'Pengguna';
```

**Cara 2: Menggunakan Method**
```php
public static function getNavigationLabel(): string
{
    return 'Daftar Pengguna';
}
```

### 2. Menambahkan Icon Navigasi

Icon menggunakan Heroicons secara default:[3][4]

```php
protected static ?string $navigationIcon = 'heroicon-o-users';
```

**Icon Aktif (Berbeda Saat Dipilih)**
```php
protected static ?string $navigationIcon = 'heroicon-o-document-text';
protected static ?string $activeNavigationIcon = 'heroicon-s-document-text';
```

### 3. Mengatur Urutan Navigasi

Secara default, navigasi diurutkan berdasarkan abjad. Anda bisa mengatur urutan custom:[2][3]

```php
protected static ?int $navigationSort = 1; // Semakin kecil angka, semakin atas posisinya
```

**Contoh:**
```php
// app/Filament/Resources/ProductResource.php
protected static ?int $navigationSort = 1;

// app/Filament/Resources/CategoryResource.php
protected static ?int $navigationSort = 2;

// app/Filament/Resources/OrderResource.php
protected static ?int $navigationSort = 3;
```

### 4. Menambahkan Badge

Badge berguna untuk menampilkan notifikasi atau jumlah data:[5][2]

**Badge Sederhana**
```php
public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}
```

**Badge dengan Warna**
```php
public static function getNavigationBadge(): ?string
{
    return static::getModel()::where('status', 'pending')->count();
}

public static function getNavigationBadgeColor(): ?string
{
    $count = static::getModel()::where('status', 'pending')->count();
    
    return $count > 10 ? 'warning' : 'primary';
}
```

**Pilihan Warna Badge:**
- `primary` (biru)
- `success` (hijau)
- `warning` (kuning)
- `danger` (merah)
- `gray` (abu-abu)
- `info` (biru muda)

**Badge dengan Tooltip**
```php
protected static ?string $navigationBadgeTooltip = 'Total pengguna terdaftar';

// atau dengan method
public static function getNavigationBadgeTooltip(): ?string
{
    return 'Jumlah pesanan tertunda';
}
```

## Navigation Groups (Pengelompokan Menu)

### 1. Membuat Group Sederhana

Kelompokkan resource yang sejenis:[4][3][2]

```php
// app/Filament/Resources/ProductResource.php
protected static ?string $navigationGroup = 'Toko';

// app/Filament/Resources/CategoryResource.php
protected static ?string $navigationGroup = 'Toko';

// app/Filament/Resources/OrderResource.php
protected static ?string $navigationGroup = 'Toko';
```

### 2. Mengatur Urutan dan Icon Group

Di `app/Providers/Filament/AdminPanelProvider.php`:[6][3][4]

```php
use Filament\Navigation\NavigationGroup;
use Filament\Panel;

public function panel(Panel $panel): Panel
{
    return $panel
        // ... konfigurasi lain
        ->navigationGroups([
            NavigationGroup::make()
                ->label('Toko')
                ->icon('heroicon-o-shopping-cart')
                ->collapsible(),
            
            NavigationGroup::make()
                ->label('Blog')
                ->icon('heroicon-o-pencil')
                ->collapsed(), // Collapsed secara default
            
            NavigationGroup::make()
                ->label('Pengaturan')
                ->icon('heroicon-o-cog-6-tooth')
                ->collapsible(false), // Tidak bisa di-collapse
        ]);
}
```

### 3. Urutan Group Sederhana

Jika hanya ingin mengatur urutan tanpa konfigurasi lain:[3][6]

```php
$panel->navigationGroups([
    'Toko',
    'Blog',
    'Pengaturan',
])
```

### 4. Menggunakan Enum untuk Group

Cara yang lebih terorganisir:[6]

**Buat Enum:**
```php
// app/Enums/NavigationGroup.php
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;

enum NavigationGroup: string implements HasLabel, HasIcon
{
    case Shop = 'shop';
    case Blog = 'blog';
    case Settings = 'settings';
    
    public function getLabel(): string
    {
        return match($this) {
            self::Shop => 'Toko',
            self::Blog => 'Blog',
            self::Settings => 'Pengaturan',
        };
    }
    
    public function getIcon(): ?string
    {
        return match($this) {
            self::Shop => 'heroicon-o-shopping-cart',
            self::Blog => 'heroicon-o-pencil',
            self::Settings => 'heroicon-o-cog-6-tooth',
        };
    }
}
```

**Gunakan di Resource:**
```php
use App\Enums\NavigationGroup;

protected static ?NavigationGroup $navigationGroup = NavigationGroup::Shop;
```

## Custom Navigation Items

### 1. Menambahkan Link External

Di `AdminPanelProvider.php`:[4]

```php
use Filament\Navigation\NavigationItem;

$panel->navigationItems([
    NavigationItem::make('Analytics')
        ->url('https://analytics.example.com', shouldOpenInNewTab: true)
        ->icon('heroicon-o-presentation-chart-line')
        ->group('Laporan')
        ->sort(10),
    
    NavigationItem::make('Dokumentasi')
        ->url('https://docs.example.com', shouldOpenInNewTab: true)
        ->icon('heroicon-o-book-open')
        ->sort(99),
])
```

### 2. Link ke Page Internal

```php
use App\Filament\Pages\Dashboard;
use function Filament\Support\original_request;

NavigationItem::make('Dashboard')
    ->label('Dashboard Utama')
    ->url(fn (): string => Dashboard::getUrl())
    ->icon('heroicon-o-home')
    ->isActiveWhen(fn () => original_request()->routeIs('filament.admin.pages.dashboard'))
    ->sort(1),
```

## Menyembunyikan Navigation Item

### 1. Sembunyikan Secara Permanen

```php
protected static bool $shouldRegisterNavigation = false;
```

### 2. Sembunyikan Berdasarkan Kondisi

```php
public static function shouldRegisterNavigation(): bool
{
    return auth()->user()->can('view-products');
}
```

**Atau untuk Custom Navigation Item:**
```php
NavigationItem::make('Admin Panel')
    ->visible(fn(): bool => auth()->user()->isAdmin())
    // atau
    ->hidden(fn(): bool => !auth()->user()->isAdmin())
```

## Konfigurasi Sidebar

### 1. Sidebar Collapsible di Desktop

```php
$panel->sidebarCollapsibleOnDesktop()
```

### 2. Sidebar Fully Collapsible

```php
$panel->sidebarFullyCollapsibleOnDesktop()
```

### 3. Mengatur Lebar Sidebar

```php
$panel
    ->sidebarWidth('20rem')
    ->collapsedSidebarWidth('5rem')
```

## Top Navigation (Menu di Atas)

Ubah dari sidebar ke top navigation:[4]

```php
$panel->topNavigation()
```

## Contoh Implementasi Lengkap

### Resource dengan Semua Fitur

```php
<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    
    // Label navigasi
    protected static ?string $navigationLabel = 'Produk';
    
    // Icon navigasi
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shopping-bag';
    
    // Urutan
    protected static ?int $navigationSort = 1;
    
    // Group
    protected static ?string $navigationGroup = 'Toko';
    
    // Badge
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('stock', '<', 10)->count();
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        $lowStock = static::getModel()::where('stock', '<', 10)->count();
        
        if ($lowStock > 20) {
            return 'danger';
        } elseif ($lowStock > 10) {
            return 'warning';
        }
        
        return 'success';
    }
    
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Produk dengan stok rendah';
    }
    
    // Sembunyikan berdasarkan permission
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('view_products');
    }
    
    // ... form, table, dll
}
```

### Panel Provider Lengkap

```php
<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Toko')
                    ->icon('heroicon-o-shopping-cart')
                    ->collapsed(false),
                    
                NavigationGroup::make()
                    ->label('Konten')
                    ->icon('heroicon-o-document-text'),
                    
                NavigationGroup::make()
                    ->label('Laporan')
                    ->icon('heroicon-o-chart-bar')
                    ->collapsed(),
                    
                NavigationGroup::make()
                    ->label('Pengaturan')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->navigationItems([
                NavigationItem::make('Analytics')
                    ->url('https://analytics.example.com', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-presentation-chart-line')
                    ->group('Laporan')
                    ->sort(1),
            ])
            ->sidebarCollapsibleOnDesktop()
            ->collapsedSidebarWidth('5rem');
    }
}
```

## Tips & Best Practices

1. **Konsisten dengan Icon**: Gunakan outline (`heroicon-o-*`) untuk icon biasa dan solid (`heroicon-s-*`) untuk active icon[5]
2. **Badge Real-time**: Gunakan badge untuk menampilkan data yang perlu perhatian pengguna[2]
3. **Group Logis**: Kelompokkan menu berdasarkan fungsi atau modul yang relean[3]
4. **Sorting**: Urutkan menu dari yang paling sering diakses ke yang jarang[2]
5. **Permission**: Selalu cek permission sebelum menampilkan menu sensitif[4]

Semoga tutorial ini membantu! Jika ada yang ingin ditanyakan lebih lanjut, silakan tanya.[6][3][2][4]

[1](https://filamentphp.com/docs/4.x/navigation/overview)
[2](https://www.youtube.com/watch?v=oEzLIVj7JFc)
[3](https://filamentexamples.com/tutorial/navigation-group-customization-main-things-to-know)
[4](https://filamentphp.com/docs/3.x/panels/navigation)
[5](https://filamentphp.com/docs/2.x/admin/navigation)
[6](https://filamentphp.com/docs/4.x/navigation/overview/)
[7](https://parsinta.com/videos/belajar-laravel-filament-dari-awal/14)
[8](https://www.youtube.com/watch?v=BFasYCVui9c)
[9](https://qadrlabs.com/post/panduan-lengkap-laravel-filament-untuk-pemula-studi-kasus-crud-product)
[10](https://neon.web.id/onphpid/laravel-filament-tutorial.html)
[11](https://www.zawata.co.id/tutorial-filament-laravel-panduan-lengkap/)