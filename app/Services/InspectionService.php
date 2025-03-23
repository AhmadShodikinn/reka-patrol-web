<?php

namespace App\Services;

use App\Models\Inspection;
use App\Traits\HandleImage;

class InspectionService
{
    use HandleImage;

    public function handleInspectionImageUpload(array $data, Inspection $inspection = null): array {
        $data = $this->handleImageUpload(data: $data, keyOrModel: $inspection, imageField: 'findings_path', customPath: 'inspection/findings');
        $data = $this->handleImageUpload(data: $data, keyOrModel: $inspection, imageField: 'action_path', customPath: 'inspection/actions');
        return $data;
    }

    public function create(array $data): ?Inspection {
        $data = $this->handleInspectionImageUpload($data);
        if (!isset($data['worker_id'])) {
            $data['worker_id'] = auth()->id();
        }
        return Inspection::create($data);
    }

    public function update(Inspection $inspection, array $data): ?Inspection {
        $data = $this->handleInspectionImageUpload($data, $inspection);
        return tap($inspection)->update($data);
    }

    public function delete(Inspection $inspection): bool {
        $this->deleteImage($inspection->findings_path);
        $this->deleteImage($inspection->action_path);
        return $inspection->delete();
    }
}
