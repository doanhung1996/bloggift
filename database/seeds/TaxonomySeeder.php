<?php

use App\Domain\Taxonomy\Models\Taxon;
use App\Domain\Taxonomy\Models\Taxonomy;
use Illuminate\Database\Seeder;

class TaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxonomy = factory(Taxonomy::class)->create(['name' => 'Categories']);
        $firstTaxon = factory(Taxon::class)->create(['name' => $taxonomy->name, 'taxonomy_id' => $taxonomy->id]);
        $taxonList = [
            ['name' => 'Value of the Day', 'childs' => []],
            ['name' => 'Top 100 Offers', 'childs' => []],
            ['name' => 'New Arrivals', 'childs' => []],
            [
                'name' => 'Computers & Accessories',
                'childs' => [
                    [
                        'name' => 'Computers & Accessories',
                        'childs' => [
                            ['name' => 'All Computers & Accessories', 'childs' => []],
                            ['name' => 'Laptops, Desktops & Monitors', 'childs' => []],
                            ['name' => 'Printers & Ink', 'childs' => []],
                            ['name' => 'Networking & Internet Devices', 'childs' => []],
                            ['name' => 'Computer Accessories', 'childs' => []],
                            ['name' => 'Software', 'childs' => []],
                            ['name' => 'Software', 'childs' => []],
                        ],
                    ],
                    [
                        'name' => 'Office & Stationery',
                        'childs' => [
                            ['name' => 'All Office & Stationery', 'childs' => []],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Cameras, Audio & Video',
                'childs' => [
                    [
                        'name' => 'Cameras, Audio & Video',
                        'childs' => [
                            ['name' => 'Cameras & Photography', 'childs' => []],
                            ['name' => 'Lenses', 'childs' => []],
                            ['name' => 'Camera Accessories', 'childs' => []],
                            ['name' => 'Security & Surveillance', 'childs' => []],
                            ['name' => 'Binoculars & Telescopes', 'childs' => []],
                            ['name' => 'Camcorders', 'childs' => []],
                            ['name' => 'Software', 'childs' => []],
                        ],
                    ],
                    [
                        'name' => 'Audio & Video',
                        'childs' => [
                            ['name' => 'All Audio & Video', 'childs' => []],
                            ['name' => 'Headphones & Speakers', 'childs' => []],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Mobiles & Tablets',
                'childs' => [
                    [
                        'name' => 'Mobiles & Tablets',
                        'childs' => [
                            ['name' => 'All Mobile Phones', 'childs' => []],
                            ['name' => 'Smartphones', 'childs' => []],
                            ['name' => 'Refurbished Mobiles', 'childs' => []],
                            ['name' => 'All Mobile Accessories', 'childs' => []],
                            ['name' => 'Cases & Covers', 'childs' => []],
                            ['name' => 'Cases & Covers', 'childs' => []],
                        ],
                    ],
                    [
                        'name' => 'All Tablets', 'childs' => [],
                    ],
                ],
            ],
            [
                'name' => 'Movies, Music & Video Game',
                'childs' => [
                    ['name' => 'Cameras, Audio & Video', 'childs' => []],
                ],
            ],
            [
                'name' => 'TV & Audio',
                'childs' => [
                    ['name' => 'Cameras, Audio & Video', 'childs' => []],
                ],
            ],
            [
                'name' => 'Watches & Eyewear',
                'childs' => [
                    ['name' => 'Cameras, Audio & Video', 'childs' => []],
                ],
            ],
            [
                'name' => 'Car, Motorbike & Industrial',
                'childs' => [
                    ['name' => 'Cameras, Audio & Video', 'childs' => []],
                ],
            ],
            [
                'name' => 'Gadgets',
                'childs' => [
                    ['name' => 'Cameras, Audio & Video', 'childs' => []],
                ],
            ],
            [
                'name' => 'Printers & Inks',
                'childs' => [
                    ['name' => 'Cameras, Audio & Video', 'childs' => []],
                ],
            ],
            [
                'name' => 'Accessories',
                'childs' => [
                    ['name' => 'Cameras, Audio & Video', 'childs' => []],
                ],
            ],

        ];
        foreach ($taxonList as $data) {
            $root = Taxon::create(['name' => $data['name'], 'taxonomy_id' => $firstTaxon->taxonomy_id, 'parent_id' => $firstTaxon->id]);
            $this->createChild($root, $data['childs'], $firstTaxon);
        }
    }

    private function createChild($root, $childs, $firstTaxon)
    {
        if (count($childs) > 0) {
            foreach ($childs as $child) {
                $newRoot = Taxon::create(['name' => $child['name'], 'taxonomy_id' => $firstTaxon->taxonomy_id, 'parent_id' => $root->id]);
                $this->createChild($newRoot, $child['childs'], $firstTaxon);
            }
        }
    }
}
