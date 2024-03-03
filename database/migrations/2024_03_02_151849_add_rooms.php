<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('beds')->truncate();
        DB::table('rooms')->truncate();
        $beds = [];
        $rooms = [];
        $alphabet = range('A', 'Z');
        for($i=0;$i<=5;$i++){
            $rooms[] = [
                'address'=>$alphabet[$i]
            ];

            if($i === 2){
            }
            else if($i === 3 || $i === 4){
                for($j=1;$j<=12;$j++){
                    $beds[] = [
                        'room_id'=>$i+1,
                        'address'=>$j
                    ];
                }
            }else{
                for($j=1;$j<=8;$j++){
                    $beds[] = [
                        'room_id'=>$i+1,
                        'address'=>$j
                    ];
                }
            }
        }
        DB::table('rooms')->insert(
            $rooms
        );
        DB::table('beds')->insert(
            $beds
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
