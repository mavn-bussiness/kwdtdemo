# KWDT Routes Reference

Based on the scraped website navigation, here are all the routes you need to implement:

## Route Map

```php
<?php

// HOME & MAIN PAGES
Route::get('/', 'HomeController@index')->name('home');

// ABOUT SECTION
Route::prefix('about')->group(function () {
    Route::get('/', 'AboutController@index')->name('about.index');                    // /who-we-are
    Route::get('who-we-are', 'AboutController@index')->name('about.index');           // Alias
    Route::get('what-we-do', 'AboutController@whatWeDo')->name('about.what-we-do');
});

// PROJECTS
Route::prefix('projects')->group(function () {
    Route::get('/', 'ProjectController@index')->name('projects.index');                    // /ongoing-projects
    Route::get('upcoming', 'ProjectController@index')->name('projects.index');             // Alias
    Route::get('{project:slug}', 'ProjectController@show')->name('projects.show');
});

// RESOURCES
Route::get('awards-and-recognition', 'AwardController@index')->name('awards');
Route::get('gallery', 'GalleryController@index')->name('gallery');
Route::get('annual-reports', 'ReportController@index')->name('reports');

// NEWS & CONTENT
Route::prefix('blog')->group(function () {
    Route::get('/', 'BlogController@index')->name('blog.index');
    Route::get('{content:slug}', 'BlogController@show')->name('blog.show');
});

Route::get('job-vacancies', 'CareerController@index')->name('careers');

// DONATIONS
Route::get('donate', 'DonateController@index')->name('donate');
Route::post('donate/paypal', 'DonateController@processPaypal')->name('donate.paypal');
Route::post('donate/mtn', 'DonateController@processMtn')->name('donate.mtn');
Route::post('donate/airtel', 'DonateController@processAirtel')->name('donate.airtel');

// LEGAL & STATIC
Route::get('privacy-policy', 'PageController@privacy')->name('privacy');
```

## URLs Generated

| Page | Route Name | URL | Controller Method |
|------|-----------|-----|------------------|
| Home | `home` | `/` | `HomeController@index` |
| Who We Are | `about.index` | `/who-we-are` or `/about` | `AboutController@index` |
| What We Do | `about.what-we-do` | `/about/what-we-do` | `AboutController@whatWeDo` |
| Projects | `projects.index` | `/projects` or `/ongoing-projects` | `ProjectController@index` |
| Project Detail | `projects.show` | `/projects/{slug}` | `ProjectController@show` |
| Blog | `blog.index` | `/blog` | `BlogController@index` |
| Blog Post | `blog.show` | `/blog/{slug}` | `BlogController@show` |
| Awards | `awards` | `/awards-and-recognition` | `AwardController@index` |
| Gallery | `gallery` | `/gallery` | `GalleryController@index` |
| Annual Reports | `reports` | `/annual-reports` | `ReportController@index` |
| Careers | `careers` | `/job-vacancies` | `CareerController@index` |
| Donate | `donate` | `/donate` | `DonateController@index` |
| Donate (PayPal) | `donate.paypal` | `/donate/paypal` | `DonateController@processPaypal` |
| Donate (MTN) | `donate.mtn` | `/donate/mtn` | `DonateController@processMtn` |
| Donate (Airtel) | `donate.airtel` | `/donate/airtel` | `DonateController@processAirtel` |
| Privacy | `privacy` | `/privacy-policy` | `PageController@privacy` |

## Data Sources for Each Route

### Home (`/`)
- Featured blog posts: `Content::where('type', 'blog')->latest()->take(4)`
- Hero images: Media model
- Job alert: `Career::active()->first()`
- Organization info: `config('kwdt.*')`

### About - Who We Are (`/who-we-are`)
- Team members: `TeamMember::active()->orderBy('order')`
- Partners: `Partner::active()->orderBy('order')`
- Organization history: `config('kwdt.*')`

### About - What We Do (`/what-we-do`)
- Thematic areas: `Content::where('type', 'thematic_area')->orderBy('order')`

### Projects (`/projects`)
- All projects: `Project::with('content')->orderBy('order')`

### Project Detail (`/projects/{slug}`)
- Single project: `Project::with('content')->where('slug', $slug)->firstOrFail()`

### Awards (`/awards-and-recognition`)
- Awards: `Award::orderBy('year', 'desc')`

### Blog (`/blog`)
- Posts: `Content::where('type', 'blog')->published()->latest()->paginate(10)`

### Blog Post (`/blog/{slug}`)
- Single post: `Content::where('type', 'blog')->where('slug', $slug)->published()->firstOrFail()`

### Careers (`/job-vacancies`)
- Openings: `Career::active()->where('status', 'open')`

### Donate (`/donate`)
- Static page with payment gateway buttons

### Privacy (`/privacy-policy`)
- Static page or `Content::where('type', 'privacy')->first()`

## Navigation Menu Structure

```php
// Main Navigation
[
    'Home'           => route('home'),
    'About'          => [
        'Who We Are'      => route('about.index'),
        'What We Do'      => route('about.what-we-do'),
        'Privacy Policy'  => route('privacy'),
    ],
    'Projects'       => route('projects.index'),
    'Donate'         => route('donate'),
    'Resources'      => [
        'Awards'         => route('awards'),
        'Gallery'        => route('gallery'),
        'Annual Reports' => route('reports'),
    ],
    'News & Updates' => [
        'Blog'           => route('blog.index'),
        'Job Vacancies'  => route('careers'),
    ],
]
```

## Route Groups for Organization

```php
// Suggested grouping in routes/web.php
Route::middleware('web')->group(function () {
    // Public pages
    Route::get('/', 'HomeController@index')->name('home');
    
    // Static pages
    Route::get('privacy-policy', 'PageController@privacy')->name('privacy');
    
    // About section
    Route::prefix('about')->group(function () {
        // ...
    });
    
    // Content (blog, projects, etc.)
    Route::prefix('content')->group(function () {
        // ...
    });
    
    // Donations
    Route::prefix('donate')->group(function () {
        // ...
    });
});

// Optional: Admin routes (Filament)
Route::prefix('admin')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        // Filament admin routes
    });
```

## Example Implementation

### HomeController.php
```php
class HomeController extends Controller
{
    public function index()
    {
        $featured_posts = Content::where('type', 'blog')
            ->published()
            ->latest()
            ->take(4)
            ->get();
        
        $job_alert = Career::active()->first();
        
        return view('home', [
            'featured_posts' => $featured_posts,
            'job_alert' => $job_alert,
            'kwdt' => config('kwdt'),
        ]);
    }
}
```

### ProjectController.php
```php
class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('content')
            ->orderBy('order')
            ->paginate(10);
        
        return view('projects.index', ['projects' => $projects]);
    }
    
    public function show(Project $project)
    {
        return view('projects.show', ['project' => $project]);
    }
}
```

## URL Examples Generated

```
https://kwdt.org/                          # Home
https://kwdt.org/who-we-are               # About - Who We Are
https://kwdt.org/about/what-we-do         # What We Do
https://kwdt.org/projects                 # All Projects
https://kwdt.org/projects/micro-credit-loans-scheme  # Project Detail
https://kwdt.org/blog                     # Blog
https://kwdt.org/blog/hahhyp5x0jf0h81jkzpvuavqu5gusj  # Blog Post
https://kwdt.org/awards-and-recognition   # Awards
https://kwdt.org/gallery                  # Gallery
https://kwdt.org/annual-reports           # Annual Reports
https://kwdt.org/job-vacancies            # Job Vacancies
https://kwdt.org/donate                   # Donate
https://kwdt.org/privacy-policy           # Privacy
```

---

**Ready to implement!** Copy the route structure above and start building your controllers and views.

