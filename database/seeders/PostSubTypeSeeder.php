<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostType;
use App\Models\PostSubType;

class PostSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subTypes = [
            'Event' => ['Wedding', 'Birthday', 'Corporate', 'Concert'],
            'Service' => ['Photography', 'Catering', 'Decoration', 'DJ'],
            'Rental' => ['Stage', 'Tent', 'Table', 'Chair'],
            'Product' => ['Lighting', 'Sound System', 'Flowers', 'Banner'],
            'Other' => ['Custom Request', 'Miscellaneous'],
        ];

        foreach ($subTypes as $typeTitle => $titles) {
            $type = PostType::where('title', $typeTitle)->first();

            if ($type) {
                foreach ($titles as $title) {
                    PostSubType::firstOrCreate([
                        'type_id' => $type->id,
                        'title' => $title,
                    ]);
                }
            }
        }
    }
}
