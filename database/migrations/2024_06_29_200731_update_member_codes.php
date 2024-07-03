<?php

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::transaction(function () {
            $members = Member::all();

            foreach ($members as $member) {
                do {
                    $newCode = random_int(100000, 999999);
                } while (Member::where('code', '=', $newCode)->exists());

                $member->code = 'TCC'.$newCode;
                $member->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
