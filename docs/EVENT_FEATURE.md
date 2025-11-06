# Event Feature Documentation

## Overview
The Event feature allows the school to manage and display upcoming events, past events, and cancelled events on the website.

## Backend (Admin Panel)

### Event Management
Access via Filament Admin Panel under "Konten" → "Event"

#### Fields:
- **Judul** (Title) - Required
- **Slug** - Auto-generated from title (can be manually overridden)
- **Deskripsi** (Description) - Rich text editor
- **Mulai** (Start Date/Time) - Required
- **Selesai** (End Date/Time) - Optional
- **Lokasi** (Location) - Optional text field
- **Gambar** (Image) - File upload, stored in `public/events/`
- **Status** - Dropdown with options:
  - Dijadwalkan (Scheduled) - Default
  - Dibatalkan (Cancelled)
  - Selesai (Completed)
- **Dipublikasikan** (Published At) - Optional datetime

### Automatic Features
- **Slug Generation**: Automatically generated from title using `SlugObserver`
- **Image Storage**: Images stored in `storage/app/public/events/`
- **URL Helper**: `featured_image` accessor handles both uploaded files and external URLs

## Frontend Pages

### Events Index Page
**URL**: `/events`  
**Route Name**: `events.index`

#### Features:
- Grid layout (3 columns on desktop, 2 on tablet, 1 on mobile)
- Event cards with:
  - Featured image or placeholder with calendar icon
  - Status badge (color-coded: green=scheduled, gray=completed, red=cancelled)
  - Start date and time
  - Location with pin icon
  - Event title (clickable to detail page)
  - Description excerpt (120 characters)
- Pagination (9 events per page)
- Empty state with icon when no events exist
- Hover effects (shadow, scale image, color title)

### Event Detail Page
**URL**: `/events/{event}`  
**Route Name**: `events.show`

#### Features:
- Breadcrumb navigation
- Large featured image (96 height)
- Status badge overlay on image
- Event title (large, bold)
- Information grid with icons:
  - Start date and time
  - End date and time (if set)
  - Location (if set)
- Full event description with prose styling
- "Back to Event List" button

## Navigation
- Added to main navbar (both desktop and mobile)
- Link: "Event"
- Active state highlighting when on event pages

## Database

### Table: `events`
```php
- id (bigint, primary key)
- title (varchar)
- slug (varchar, unique)
- description (text, nullable)
- starts_at (datetime)
- ends_at (datetime, nullable)
- location (varchar, nullable)
- image_url (varchar, nullable)
- status (enum: scheduled, cancelled, completed) - default: scheduled
- published_at (datetime, nullable)
- created_at, updated_at (timestamps)
```

## Controller Logic

### EventController::index
- Filters: Only published events (published_at is null OR <= now())
- Sorting: Order by `starts_at` (ascending, soonest first)
- Pagination: 9 events per page

### EventController::show
- Displays single event detail
- No publication date check (allows direct access via URL)

## Styling & Design

### Colors
- Primary: Indigo (for links, hover states)
- Status Colors:
  - Green (#10B981): Scheduled events
  - Gray (#6B7280): Completed events
  - Red (#EF4444): Cancelled events
- Background icons: Light gradients (blue-100 to indigo-100)

### Icons
- Calendar icon for dates
- Clock icon for time
- Location pin for venue
- Arrow for back button

### Responsive Design
- Mobile-first approach
- Grid columns adjust: 1 → 2 → 3
- Touch-friendly card sizes
- Readable font sizes on all devices

## Usage Examples

### Creating an Event in Admin
1. Go to Admin → Konten → Event
2. Click "New"
3. Enter title (slug auto-generates)
4. Add description with rich editor
5. Set start date/time
6. Optionally add end date, location, image
7. Set status (defaults to "Dijadwalkan")
8. Optionally set published date (blank = published immediately)
9. Save

### Viewing Events on Frontend
1. Navigate to `/events` from navbar "Event" link
2. Browse event cards
3. Click any event to see full details
4. Use breadcrumb or "Back" button to return

## Future Enhancements (Optional)
- [ ] Add event categories/tags
- [ ] Calendar view of events
- [ ] Event registration/RSVP functionality
- [ ] Email notifications for upcoming events
- [ ] Integration with Google Calendar
- [ ] Event search and filtering
- [ ] Unsplash image picker (similar to Articles/Extracurriculars)
- [ ] Event gallery with multiple images
- [ ] Recurring events support

## Files Modified/Created

### Models
- `app/Models/Event.php` - Event model with fillables, casts, and accessors

### Controllers
- `app/Http/Controllers/EventController.php` - Frontend event pages

### Filament Resources
- `app/Filament/Resources/Events/EventResource.php` - Admin CRUD
- `app/Filament/Resources/Events/Pages/ListEvents.php`
- `app/Filament/Resources/Events/Pages/CreateEvent.php`
- `app/Filament/Resources/Events/Pages/EditEvent.php`

### Views
- `resources/views/events/index.blade.php` - Event listing page
- `resources/views/events/show.blade.php` - Event detail page
- `resources/views/layouts/app.blade.php` - Updated with Event nav link

### Migrations
- `database/migrations/2025_11_06_194645_create_events_table.php`

### Providers
- `app/Providers/AppServiceProvider.php` - Registered SlugObserver for Event

### Routes
- `routes/web.php` - Added events.index and events.show routes

## Testing Checklist
- [x] Create event in admin panel
- [x] Verify slug auto-generation
- [x] Upload event image
- [x] View events list on frontend
- [x] View event detail page
- [x] Check mobile responsive design
- [x] Verify status badges display correctly
- [x] Test pagination
- [x] Check empty state message
- [x] Verify navbar link works
- [x] Test breadcrumb navigation
- [x] Verify published_at filtering

## Notes
- Events use same observer pattern as Articles, Extracurriculars for slug generation
- Image handling follows the same pattern as other content types
- Published date filtering allows events to be scheduled for future publication
- Status field allows manual marking of completed/cancelled events
