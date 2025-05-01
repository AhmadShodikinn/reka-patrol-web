<?php

use App\Models\Finding;
use App\Models\Inspection;
use App\Models\SafetyPatrol;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('findings', function (Blueprint $table) {
            $table->id();
            $table->morphs('findable');
            $table->string('finding_path');
            $table->string('finding_description');
            $table->timestamps();
        });
        
        // copy findings from safety_patrols and inspections to findings table
        $success = false;
        DB::beginTransaction();
        try {
            SafetyPatrol::get()->each(function ($safetyPatrol) {
                Finding::create([
                    'findable_id' => $safetyPatrol->id,
                    'findable_type' => SafetyPatrol::class,
                    'finding_path' => $safetyPatrol->findings_path,
                    'finding_description' => $safetyPatrol->findings_description,
                ]);
            });
            Inspection::get()->each(function ($inspection) {
                Finding::create([
                    'findable_id' => $inspection->id,
                    'findable_type' => Inspection::class,
                    'finding_path' => $inspection->findings_path,
                    'finding_description' => $inspection->findings_description,
                ]);
            });
            DB::commit();
            $success = true;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        if ($success) {
            // remove findings_path and findings_description from safety_patrols and inspections
            Schema::table('safety_patrols', function (Blueprint $table) {
                $table->dropColumn(['findings_path', 'findings_description']);
            });
            Schema::table('inspections', function (Blueprint $table) {
                $table->dropColumn(['findings_path', 'findings_description']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('findings');
    }
};
