# KWDT Database & Seeder Restructuring - Complete Guide

## Overview
Your Laravel application has been restructured to match the KWDT website scrape with all necessary models, migrations, and seeders for the Katosi Women Development Trust rebuild.

## What Was Added/Updated

### 1. **New Models** ✅
- **Award** (`app/Models/Award.php`) - Stores KWDT awards and recognition
- **ThematicArea** (`app/Models/ThematicArea.php`) - Stores thematic intervention areas

### 2. **New Migrations** ✅
- `2026_02_28_000001_create_awards_table.php` - Awards table
- `2026_02_28_000002_create_thematic_areas_table.php` - Thematic areas table
- **Updated** `2026_02_28_085342_create_careers_table.php` - Added `slug` and `is_active` fields

### 3. **New Seeders** ✅
- **AwardSeeder** - 13 awards from 2009-2023
- **PartnerSeeder** - 11 national & international partners
- **TeamMemberSeeder** - 12 team members
- **CareerSeeder** - Current job vacancy (Operations & Coordination Manager)

### 4. **Updated Seeders** ✅
- **ThematicAreaSeeder** - Now clears old data before seeding 5 thematic areas
- **BlogPostSeeder** - Now clears old data before seeding 17 blog posts
- **ProjectSeeder** - Now clears old data before seeding 5 projects
- **DatabaseSeeder** - Calls all seeders in proper order

### 5. **Configuration** ✅
- **Updated `.env`** with KWDT organization constants:
  - `APP_NAME` = "Katosi Women Development Trust"
  - `APP_SHORT_NAME` = "KWDT"
  - `APP_FOUNDED` = 1996
  - `APP_REGISTERED_NUMBER` = "S.5914/6911"
  - `APP_MEMBERS` = 1235
  - `APP_GROUPS` = 52
  - `APP_DISTRICTS` = "Mukono, Kalangala, Buvuma"
  - `APP_FEMALE_PERCENTAGE` = 88

- **New config file** `config/kwdt.php` - Central repository for KWDT constants with Vision, Mission, About statement

## Models & Database Schema

### Awards Table
```
id | title | year | awarding_organization | description | image_url | order | timestamps
```

### Thematic Areas Table
```
id | name | slug | description | icon | order | timestamps
```

### Careers Table (Updated)
```
id | title | slug | advert_number | description | pdf_url | status | is_active | posted_at | closed_at | timestamps
```

## Database/Seeder Hierarchy

```
DatabaseSeeder (Main)
├── AwardSeeder (13 awards)
├── ThematicAreaSeeder (5 areas - stored in Content table)
├── ProjectSeeder (5 projects - split across Content & Project tables)
├── BlogPostSeeder (17 blog posts - stored in Content table)
├── TeamMemberSeeder (12 members)
├── PartnerSeeder (11 partners)
└── CareerSeeder (1 job opening)
```

## Running Migrations & Seeds

### Fresh Database (Recommended for rebuilds)
```bash
php artisan migrate:fresh --seed
```

### Just Seeds (Update existing data)
```bash
php artisan db:seed
```

### Individual Seeders
```bash
php artisan db:seed --class=AwardSeeder
php artisan db:seed --class=PartnerSeeder
php artisan db:seed --class=TeamMemberSeeder
```

## Data Structure by Page

### HOME (`/`)
- Hero images: Stored via Media model
- Organization identity: From `config/kwdt.php`
- Membership stats: `APP_MEMBERS`, `APP_GROUPS` from config
- Featured blog posts: From `BlogPostSeeder` (4 latest)
- Job alert: From `CareerSeeder`

### WHO WE ARE (`/about.index`)
- History: From `config/kwdt.php`
- Partners: From `PartnerSeeder` (11 organizations)
- Team: From `TeamMemberSeeder` (12 members)

### WHAT WE DO (`/about.what-we-do`)
- Thematic areas: From `ThematicAreaSeeder` (5 areas)
- Each area has: name, slug, description

### ONGOING PROJECTS (`/projects.index`)
- 5 projects: From `ProjectSeeder`
- Each project split:
  - `Content` table: Title, slug, excerpt, body
  - `Project` table: Status, location, relationship

### AWARDS & RECOGNITION (`/awards`)
- 13 awards: From `AwardSeeder`
- Year-based filtering possible

### BLOG (`/blog.index`)
- 17 blog posts: From `BlogPostSeeder`
- Author: Admin user created in DatabaseSeeder

### JOB VACANCIES (`/careers`)
- 1 current vacancy: From `CareerSeeder`
- Can add more via seeder

## Used Constants in Config

Access in blade/controller:
```php
config('kwdt.name')              // "Katosi Women Development Trust"
config('kwdt.vision')            // Vision statement
config('kwdt.mission')           // Mission statement
config('kwdt.members')           // 1235
config('kwdt.districts')         // Array of districts
```

## Next Steps

1. ✅ **Migration complete** - Run `php artisan migrate:fresh --seed`
2. **Create Controllers** - For each page (Home, About, Projects, etc.)
3. **Create Routes** - According to route mapping in scrape document
4. **Create Views** - Using the Content/Project data from seeders
5. **Image Assets** - Download hero/gallery images from Squarespace CDN
6. **Blog Content** - Fetch full post bodies (scraped only titles/excerpts)
7. **Project Details** - Fetch full descriptions from `/ongoing-projects/{slug}`
8. **Filament Admin** - Setup admin panel for managing all content

## File Locations Summary

| File | Path |
|------|------|
| Award Model | `app/Models/Award.php` |
| ThematicArea Model | `app/Models/ThematicArea.php` |
| Award Migration | `database/migrations/2026_02_28_000001_create_awards_table.php` |
| ThematicArea Migration | `database/migrations/2026_02_28_000002_create_thematic_areas_table.php` |
| Award Seeder | `database/seeders/AwardSeeder.php` |
| Partner Seeder | `database/seeders/PartnerSeeder.php` |
| Team Seeder | `database/seeders/TeamMemberSeeder.php` |
| Career Seeder | `database/seeders/CareerSeeder.php` |
| KWDT Config | `config/kwdt.php` |
| Updated .env | `.env` |

---

**Last Updated:** February 28, 2026  
**Status:** Ready for migration and seeding
