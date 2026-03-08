<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Webhooks\AirtelWebhookController;
use App\Http\Controllers\Webhooks\MtnWebhookController;
use App\Http\Controllers\Webhooks\PaypalWebhookController;
use Illuminate\Support\Facades\Route;

// ── Public pages ──────────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('about')->name('about.')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('index');
    Route::get('/what-we-do', [AboutController::class, 'whatWeDo'])->name('what-we-do');
});

Route::get('/awards-and-recognition', [AboutController::class, 'awards'])->name('awards');

Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProjectController::class, 'show'])->name('show');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/reports', [ReportController::class,  'index'])->name('reports');
Route::get('/careers', [CareerController::class,  'index'])->name('careers');

Route::get('/contact', fn () => view('pages.contact'))->name('contact');
Route::get('/privacy-policy', fn () => view('pages.privacy'))->name('privacy');
Route::get('/terms-of-service', fn () => view('pages.terms'))->name('terms');

// ── Donation ──────────────────────────────────────────────────────────────────

Route::get('/donate', [DonateController::class, 'index'])->name('donate');
Route::get('/donate/gateway/{donation}', [DonateController::class, 'gateway'])->name('donate.gateway');

Route::prefix('donate')->name('donate.')->group(function () {

    // Outcome pages
    Route::get('/success', fn () => view('pages.donate-success'))->name('success');
    Route::get('/failed', fn () => view('pages.donate-failed'))->name('failed');
    Route::get('/pending', fn () => view('pages.donate-pending'))->name('pending');

    // ── PayPal ────────────────────────────────────────────────────────────────
    // 1. Donor is sent here → creates PayPal order → redirects to PayPal
    Route::get('/paypal/{donation}', [PaypalWebhookController::class, 'redirect'])->name('paypal');
    // 2. PayPal sends donor back after approval
    Route::get('/paypal/{donation}/capture', [PaypalWebhookController::class, 'capture'])->name('paypal.capture');
    // 3. PayPal server-to-server webhook
    Route::post('/webhook/paypal', [PaypalWebhookController::class, 'handle'])->name('webhook.paypal');

    // ── MTN Mobile Money ──────────────────────────────────────────────────────
    // 1. Triggers USSD push to donor's phone
    Route::get('/mtn/{donation}', [MtnWebhookController::class, 'redirect'])->name('mtn');
    // 2. Polling page — auto-refreshes until resolved
    Route::get('/mtn/{donation}/status', [MtnWebhookController::class, 'status'])->name('mtn.status');
    // 3. MTN server-to-server webhook
    Route::post('/webhook/mtn', [MtnWebhookController::class, 'handle'])->name('webhook.mtn');

    // ── Airtel Money ──────────────────────────────────────────────────────────
    // 1. Triggers USSD push to donor's phone
    Route::get('/airtel/{donation}', [AirtelWebhookController::class, 'redirect'])->name('airtel');
    // 2. Polling page — auto-refreshes until resolved
    Route::get('/airtel/{donation}/status', [AirtelWebhookController::class, 'status'])->name('airtel.status');
    // 3. Airtel server-to-server webhook
    Route::post('/webhook/airtel', [AirtelWebhookController::class, 'handle'])->name('webhook.airtel');
});
