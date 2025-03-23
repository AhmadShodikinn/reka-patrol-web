<?php

namespace App\Services;

use App\Models\SafetyPatrol;
use App\Traits\HandleImage;

class SafetyPatrolService
{
    use HandleImage;

    public function handleSafetyPatrolImageUpload(array $data, SafetyPatrol $safetyPatrol = null): array {
        $data = $this->handleImageUpload(data: $data, keyOrModel: $safetyPatrol, imageField: 'findings_path', customPath: 'safety-patrol/findings');
        $data = $this->handleImageUpload(data: $data, keyOrModel: $safetyPatrol, imageField: 'action_path', customPath: 'safety-patrol/actions');
        return $data;
    }

    public function create(array $data): ?SafetyPatrol {
        $data = $this->handleSafetyPatrolImageUpload($data);
        if (!isset($data['worker_id'])) {
            $data['worker_id'] = auth()->id();
        }
        return SafetyPatrol::create($data);
    }

    public function update(SafetyPatrol $safetyPatrol, array $data): ?SafetyPatrol {
        $data = $this->handleSafetyPatrolImageUpload($data, $safetyPatrol);
        return tap($safetyPatrol)->update($data);
    }

    public function delete(SafetyPatrol $safetyPatrol): bool {
        $this->deleteImage($safetyPatrol->findings_path);
        $this->deleteImage($safetyPatrol->action_path);
        return $safetyPatrol->delete();
    }
}
