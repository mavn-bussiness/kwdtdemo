<?php

namespace App\Filament\Resources\Donations\Pages;

use App\Filament\Resources\Donations\DonationResource;
use Filament\Resources\Pages\ListRecords;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    // No CreateAction — donations come via the public payment flow
    protected function getHeaderActions(): array
    {
        return [];
    }
}
