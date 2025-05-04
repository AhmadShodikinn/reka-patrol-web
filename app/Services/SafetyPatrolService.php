<?php

namespace App\Services;

use App\Models\SafetyPatrol;
use App\Traits\HandleImage;
use Illuminate\Support\Arr;

class SafetyPatrolService
{
    use HandleImage;

    public function handleSafetyPatrolImageUpload(array $data, SafetyPatrol $safetyPatrol = null): array {
        $data = $this->handleArrayImageUpload(data: $data, keyOrModel: $safetyPatrol, relation: 'findings', imageField: 'finding_paths', customPath: 'safety-patrol/findings');
        $data = $this->handleImageUpload(data: $data, keyOrModel: $safetyPatrol, imageField: 'action_path', customPath: 'safety-patrol/actions');
        return $data;
    }

    public function create(array $data): ?SafetyPatrol {
        $data = $this->handleSafetyPatrolImageUpload($data);
        if (!isset($data['worker_id'])) {
            $data['worker_id'] = auth()->id();
        }
        $safetyPatrol = SafetyPatrol::create(
            Arr::except($data, ['finding_paths'])
        );
        $safetyPatrol->findings()->createMany(
            collect($data['finding_paths'])
                ->map(fn($path, $key) => [
                    'image_path' => $path,
                ])
                ->toArray()
        );
        return $safetyPatrol;
    }

    public function update(SafetyPatrol $safetyPatrol, array $data): ?SafetyPatrol {
        $data = $this->handleSafetyPatrolImageUpload($data, $safetyPatrol);
        $safetyPatrol->update(Arr::except($data, ['finding_paths']));
        if (isset($data['finding_paths'])) {
            $findings = $safetyPatrol->findings()->get();
            $findings->each(fn($finding, $key) => ($key > count($data['finding_paths']) - 1) ? $finding->delete() : $finding->update(['image_path' => $data['finding_paths'][$key]]));
            if ($findings->count() < count($data['finding_paths'])) {
                $safetyPatrol->findings()->createMany(
                    collect($data['finding_paths'])
                        ->skip($findings->count())
                        ->map(fn($path, $key) => [
                            'image_path' => $path,
                        ])->toArray()
                );
            }
        }
        return $safetyPatrol;
    }

    public function delete(SafetyPatrol $safetyPatrol): bool {
        $safetyPatrol->findings()->each(fn($finding) => $finding->delete());
        $this->deleteImage($safetyPatrol->action_path);
        return $safetyPatrol->delete();
    }
}
