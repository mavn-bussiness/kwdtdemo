<?php

namespace App\Filament\Resources\Reports\Pages;

use App\Filament\Resources\Reports\ReportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditReport extends EditRecord
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $content = $this->record->content;

        return array_merge($data, [
            'title' => $content->title,
            'slug' => $content->slug,
            'publish_status' => $content->status,
            'published_at' => $content->published_at,
            'categories' => $content->categories->pluck('id')->toArray(),
        ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->content->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'status' => $data['publish_status'] ?? 'draft',
            'published_at' => $data['published_at'] ?? null,
        ]);

        $record->content->categories()->sync($data['categories'] ?? []);

        $record->update(
            Arr::only($data, ['report_year', 'file_path', 'file_name', 'file_type', 'file_size_kb'])
        );

        return $record;
    }
}
