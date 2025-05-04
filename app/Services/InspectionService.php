<?php

namespace App\Services;

use App\Models\Inspection;
use App\Traits\HandleImage;
use Illuminate\Support\Arr;

class InspectionService
{
    use HandleImage;

    public function handleInspectionImageUpload(array $data, Inspection $inspection = null): array {
        $data = $this->handleArrayImageUpload(data: $data, keyOrModel: $inspection, relation: 'findings', imageField: 'finding_paths', customPath: 'inspection/findings');
        $data = $this->handleImageUpload(data: $data, keyOrModel: $inspection, imageField: 'action_path', customPath: 'inspection/actions');
        return $data;
    }

    public function create(array $data): ?Inspection {
        $data = $this->handleInspectionImageUpload($data);
        if (!isset($data['worker_id'])) {
            $data['worker_id'] = auth()->id();
        }
        $inspection = Inspection::create(
            Arr::except($data, ['finding_paths'])
        );
        $inspection->findings()->createMany(
            collect($data['finding_paths'])
                ->map(fn($path, $key) => [
                    'image_path' => $path,
                ])
                ->toArray()
        );
        return $inspection;
    }

    public function update(Inspection $inspection, array $data): ?Inspection {
        $data = $this->handleInspectionImageUpload($data, $inspection);
        $inspection->update(Arr::except($data, ['finding_paths']));
        if (isset($data['finding_paths'])) {
            $findings = $inspection->findings()->get();
            $findings->each(fn($finding, $key) => ($key > count($data['finding_paths']) - 1) ? $finding->delete() : $finding->update(['image_path' => $data['finding_paths'][$key]]));
            if ($findings->count() < count($data['finding_paths'])) {
                $inspection->findings()->createMany(
                    collect($data['finding_paths'])
                        ->skip($findings->count())
                        ->map(fn($path, $key) => [
                            'image_path' => $path,
                        ])->toArray()
                );
            }
        }
        return $inspection;
    }

    public function delete(Inspection $inspection): bool {
        $inspection->findings()->each(fn($finding) => $finding->delete());
        $this->deleteImage($inspection->action_path);
        return $inspection->delete();
    }
}
