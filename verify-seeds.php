#!/usr/bin/env php
<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Award;
use App\Models\Project;
use App\Models\Content;
use App\Models\TeamMember;
use App\Models\Partner;
use App\Models\Career;

echo "═══════════════════════════════════════════════════════\n";
echo "KWDT DATABASE SEEDING VERIFICATION\n";
echo "═══════════════════════════════════════════════════════\n\n";

echo "Awards:              " . Award::count() . " records (expected 13)\n";
echo "Projects:            " . Project::count() . " records (expected 5)\n";
echo "Blog Posts:          " . Content::where('type', 'blog')->count() . " records (expected 17)\n";
echo "Thematic Areas:      " . Content::where('type', 'thematic_area')->count() . " records (expected 5)\n";
echo "Team Members:        " . TeamMember::count() . " records (expected 12)\n";
echo "Partners:            " . Partner::count() . " records (expected 11)\n";
echo "Careers:             " . Career::count() . " records (expected 1)\n\n";

echo "═══════════════════════════════════════════════════════\n\n";

$errors = 0;
if (Award::count() != 13) $errors++;
if (Project::count() != 5) $errors++;
if (Content::where('type', 'blog')->count() != 17) $errors++;
if (Content::where('type', 'thematic_area')->count() != 5) $errors++;
if (TeamMember::count() != 12) $errors++;
if (Partner::count() != 11) $errors++;
if (Career::count() != 1) $errors++;

if ($errors === 0) {
    echo "✓ ALL SEEDERS COMPLETED SUCCESSFULLY!\n";
} else {
    echo "✗ ERRORS DETECTED: $errors mismatches\n";
}

echo "═══════════════════════════════════════════════════════\n";
?>
