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
            $table->string('image_path');
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
                    'image_path' => $safetyPatrol->findings_path,
                ]);
            });
            Inspection::get()->each(function ($inspection) {
                Finding::create([
                    'findable_id' => $inspection->id,
                    'findable_type' => Inspection::class,
                    'image_path' => $inspection->findings_path,
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
                $table->dropColumn(['findings_path']);
            });
            Schema::table('inspections', function (Blueprint $table) {
                $table->dropColumn(['findings_path']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safety_patrols', function (Blueprint $table) {
            $table->string('findings_path')->after('pic_id');
        });
        Schema::table('inspections', function (Blueprint $table) {
            $table->string('findings_path')->after('pic_id');
        });

        Finding::get()->each(function ($finding) {
            logger($finding);
            if ($finding->findable_type == SafetyPatrol::class) {
                $safety = SafetyPatrol::find($finding->findable_id);
                $safety->findings_path = $finding->image_path;
                $safety->save();
            } else if ($finding->findable_type == Inspection::class) {
                $inspection = Inspection::find($finding->findable_id);
                $inspection->findings_path = $finding->image_path;
                $inspection->save();
            }
        });
        
        Schema::dropIfExists('findings');
    }
};
