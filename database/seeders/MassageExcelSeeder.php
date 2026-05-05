<?php

namespace Database\Factories;

use App\Models\MassageExcel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MassageExcel>
 *
 * Run:
 *   php artisan db:seed --class=MassageExcelSeeder
 */
class MassageExcelFactory extends Factory
{
    protected $model = MassageExcel::class;

    // -------------------------------------------------------------------------
    // Static data pools — mirrors the structure found in your $massage_excels
    // -------------------------------------------------------------------------

    public static array $states = [
        'WA' => [
            'state_id'       => '3906',
            'territory_name' => 'Western Australia',
            'suburbs' => [
                ['suburb' => 'Perth',              'post_code' => '6000'],
                ['suburb' => 'East Perth',         'post_code' => '6004'],
                ['suburb' => 'West Perth',         'post_code' => '6005'],
                ['suburb' => 'Northbridge',        'post_code' => '6003'],
                ['suburb' => 'Subiaco',            'post_code' => '6008'],
                ['suburb' => 'Nedlands',           'post_code' => '6009'],
                ['suburb' => 'Cottesloe',          'post_code' => '6011'],
                ['suburb' => 'Fremantle',          'post_code' => '6160'],
                ['suburb' => 'Osborne Park',       'post_code' => '6017'],
                ['suburb' => 'Doubleview',         'post_code' => '6018'],
                ['suburb' => 'Scarborough',        'post_code' => '6019'],
                ['suburb' => 'Victoria Park',      'post_code' => '6100'],
                ['suburb' => 'East Victoria Park', 'post_code' => '6101'],
                ['suburb' => 'Cannington',         'post_code' => '6107'],
                ['suburb' => 'Lynwood',            'post_code' => '6147'],
                ['suburb' => 'Bentley',            'post_code' => '6102'],
                ['suburb' => 'Belmont',            'post_code' => '6104'],
                ['suburb' => 'Midland',            'post_code' => '6056'],
                ['suburb' => 'Joondalup',          'post_code' => '6027'],
                ['suburb' => 'Rockingham',         'post_code' => '6168'],
                ['suburb' => 'Mandurah',           'post_code' => '6210'],
                ['suburb' => 'Armadale',           'post_code' => '6112'],
                ['suburb' => 'Karrinyup',          'post_code' => '6018'],
                ['suburb' => 'Claremont',          'post_code' => '6010'],
                ['suburb' => 'Mount Lawley',       'post_code' => '6050'],
            ],
            'streets' => [
                'Murray St', 'Hay St', 'Albany Hwy', 'Railway Pde', 'Scarborough Beach Rd',
                'Stirling Hwy', 'Canning Hwy', 'Great Eastern Hwy', 'Wanneroo Rd',
                'Beaufort St', 'William St', 'Barrack St', 'King St', 'Adelaide Terrace',
                'Wellington St', 'St Georges Terrace', 'Roe St', 'Newcastle St',
                'Fitzgerald St', 'Oxford St', 'Rokeby Rd', 'High St', 'Bennett St',
                'Gordon Rd', 'Lynwood Ave',
            ],
        ],
        'VIC' => [
            'state_id'       => '3903',
            'territory_name' => 'Victoria',
            'suburbs' => [
                ['suburb' => 'Melbourne',       'post_code' => '3000'],
                ['suburb' => 'Prahran',         'post_code' => '3181'],
                ['suburb' => 'Footscray',       'post_code' => '3011'],
                ['suburb' => 'Richmond',        'post_code' => '3121'],
                ['suburb' => 'Fitzroy',         'post_code' => '3065'],
                ['suburb' => 'St Kilda',        'post_code' => '3182'],
                ['suburb' => 'South Yarra',     'post_code' => '3141'],
                ['suburb' => 'Collingwood',     'post_code' => '3066'],
                ['suburb' => 'Carlton',         'post_code' => '3053'],
                ['suburb' => 'Brunswick',       'post_code' => '3056'],
                ['suburb' => 'Coburg',          'post_code' => '3058'],
                ['suburb' => 'Preston',         'post_code' => '3072'],
                ['suburb' => 'Heidelberg',      'post_code' => '3084'],
                ['suburb' => 'Box Hill',        'post_code' => '3128'],
                ['suburb' => 'Doncaster',       'post_code' => '3108'],
                ['suburb' => 'Glen Waverley',   'post_code' => '3150'],
                ['suburb' => 'Dandenong',       'post_code' => '3175'],
                ['suburb' => 'Frankston',       'post_code' => '3199'],
                ['suburb' => 'Sunshine',        'post_code' => '3020'],
                ['suburb' => 'Altona',          'post_code' => '3018'],
                ['suburb' => 'Ringwood',        'post_code' => '3134'],
                ['suburb' => 'Camberwell',      'post_code' => '3124'],
                ['suburb' => 'Hawthorn',        'post_code' => '3122'],
                ['suburb' => 'Essendon',        'post_code' => '3040'],
                ['suburb' => 'Moonee Ponds',    'post_code' => '3039'],
            ],
            'streets' => [
                'Collins St', 'Bourke St', 'Swanston St', 'Chapel St', 'Nicholson St',
                'Flinders St', 'Spencer St', 'King St', 'Elizabeth St', 'Russell St',
                'Lygon St', 'Sydney Rd', 'High St', 'Bridge Rd', 'Victoria St',
                'Smith St', 'Brunswick St', 'Glenferrie Rd', 'Camberwell Rd',
                'Whitehorse Rd', 'Station St', 'Bay St', 'Nepean Hwy', 'Dandenong Rd',
                'Canterbury Rd',
            ],
        ],
        'NSW' => [
            'state_id'       => '3909',
            'territory_name' => 'New South Wales',
            'suburbs' => [
                ['suburb' => 'Sydney',           'post_code' => '2000'],
                ['suburb' => 'Bondi Junction',   'post_code' => '2022'],
                ['suburb' => 'Parramatta',       'post_code' => '2150'],
                ['suburb' => 'Chatswood',        'post_code' => '2067'],
                ['suburb' => 'Newtown',          'post_code' => '2042'],
                ['suburb' => 'Surry Hills',      'post_code' => '2010'],
                ['suburb' => 'Darlinghurst',     'post_code' => '2010'],
                ['suburb' => 'Paddington',       'post_code' => '2021'],
                ['suburb' => 'Glebe',            'post_code' => '2037'],
                ['suburb' => 'Leichhardt',       'post_code' => '2040'],
                ['suburb' => 'Strathfield',      'post_code' => '2135'],
                ['suburb' => 'Burwood',          'post_code' => '2134'],
                ['suburb' => 'Hurstville',       'post_code' => '2220'],
                ['suburb' => 'Kogarah',          'post_code' => '2217'],
                ['suburb' => 'Rockdale',         'post_code' => '2216'],
                ['suburb' => 'Bankstown',        'post_code' => '2200'],
                ['suburb' => 'Liverpool',        'post_code' => '2170'],
                ['suburb' => 'Penrith',          'post_code' => '2750'],
                ['suburb' => 'Blacktown',        'post_code' => '2148'],
                ['suburb' => 'Castle Hill',      'post_code' => '2154'],
                ['suburb' => 'Hornsby',          'post_code' => '2077'],
                ['suburb' => 'Manly',            'post_code' => '2095'],
                ['suburb' => 'Dee Why',          'post_code' => '2099'],
                ['suburb' => 'Mosman',           'post_code' => '2088'],
                ['suburb' => 'North Sydney',     'post_code' => '2060'],
            ],
            'streets' => [
                'George St', 'Pitt St', 'Oxford St', 'Church St', 'Victoria Ave',
                'King St', 'Elizabeth St', 'Sussex St', 'York St', 'Clarence St',
                'Hunter St', 'Market St', 'Liverpool St', 'Castlereagh St',
                'Crown St', 'Riley St', 'Cleveland St', 'Enmore Rd', 'Illawarra Rd',
                'Parramatta Rd', 'Broadway', 'Pacific Hwy', 'Military Rd',
                'Victoria Rd', 'Canterbury Rd',
            ],
        ],
        'QLD' => [
            'state_id'       => '3901',
            'territory_name' => 'Queensland',
            'suburbs' => [
                ['suburb' => 'Brisbane City',    'post_code' => '4000'],
                ['suburb' => 'South Brisbane',   'post_code' => '4101'],
                ['suburb' => 'West End',         'post_code' => '4101'],
                ['suburb' => 'Fortitude Valley', 'post_code' => '4006'],
                ['suburb' => 'New Farm',         'post_code' => '4005'],
                ['suburb' => 'Paddington',       'post_code' => '4064'],
                ['suburb' => 'Milton',           'post_code' => '4064'],
                ['suburb' => 'Toowong',          'post_code' => '4066'],
                ['suburb' => 'Indooroopilly',    'post_code' => '4068'],
                ['suburb' => 'Taringa',          'post_code' => '4068'],
                ['suburb' => 'Kenmore',          'post_code' => '4069'],
                ['suburb' => 'Carindale',        'post_code' => '4152'],
                ['suburb' => 'Wynnum',           'post_code' => '4178'],
                ['suburb' => 'Chermside',        'post_code' => '4032'],
                ['suburb' => 'Aspley',           'post_code' => '4034'],
                ['suburb' => 'Northgate',        'post_code' => '4013'],
                ['suburb' => 'Nundah',           'post_code' => '4012'],
                ['suburb' => 'Lutwyche',         'post_code' => '4030'],
                ['suburb' => 'Spring Hill',      'post_code' => '4000'],
                ['suburb' => 'Woolloongabba',    'post_code' => '4102'],
                ['suburb' => 'Moorooka',         'post_code' => '4105'],
                ['suburb' => 'Sunnybank',        'post_code' => '4109'],
                ['suburb' => 'Eight Mile Plains','post_code' => '4113'],
                ['suburb' => 'Calamvale',        'post_code' => '4116'],
                ['suburb' => 'Logan Central',    'post_code' => '4114'],
            ],
            'streets' => [
                'Queen St', 'George St', 'Adelaide St', 'Ann St', 'Brunswick St',
                'Wickham St', 'Lutwyche Rd', 'Gympie Rd', 'Sandgate Rd',
                'Newmarket Rd', 'Kelvin Grove Rd', 'Given Terrace', 'Latrobe Terrace',
                'Coronation Dr', 'Milton Rd', 'Moggill Rd', 'Logan Rd',
                'Ipswich Rd', 'Beaudesert Rd', 'Mount Gravatt-Capalaba Rd',
                'Old Cleveland Rd', 'Creek Rd', 'Wynnum Rd', 'Manly Rd', 'Bay Rd',
            ],
        ],
        'SA' => [
            'state_id'       => '3902',
            'territory_name' => 'South Australia',
            'suburbs' => [
                ['suburb' => 'Adelaide',         'post_code' => '5000'],
                ['suburb' => 'North Adelaide',   'post_code' => '5006'],
                ['suburb' => 'Norwood',          'post_code' => '5067'],
                ['suburb' => 'Unley',            'post_code' => '5061'],
                ['suburb' => 'Glenelg',          'post_code' => '5045'],
                ['suburb' => 'Semaphore',        'post_code' => '5019'],
                ['suburb' => 'Port Adelaide',    'post_code' => '5015'],
                ['suburb' => 'Prospect',         'post_code' => '5082'],
                ['suburb' => 'Marden',           'post_code' => '5070'],
                ['suburb' => 'Kensington',       'post_code' => '5068'],
                ['suburb' => 'Burnside',         'post_code' => '5066'],
                ['suburb' => 'Mitcham',          'post_code' => '5062'],
                ['suburb' => 'Marion',           'post_code' => '5043'],
                ['suburb' => 'Morphett Vale',    'post_code' => '5162'],
                ['suburb' => 'Noarlunga Centre', 'post_code' => '5168'],
                ['suburb' => 'Elizabeth',        'post_code' => '5112'],
                ['suburb' => 'Modbury',          'post_code' => '5092'],
                ['suburb' => 'Tea Tree Gully',   'post_code' => '5091'],
                ['suburb' => 'Paradise',         'post_code' => '5075'],
                ['suburb' => 'Campbelltown',     'post_code' => '5074'],
                ['suburb' => 'Tranmere',         'post_code' => '5073'],
                ['suburb' => 'Windsor Gardens',  'post_code' => '5087'],
                ['suburb' => 'Salisbury',        'post_code' => '5108'],
                ['suburb' => 'Munno Para',       'post_code' => '5115'],
                ['suburb' => 'Gawler',           'post_code' => '5118'],
            ],
            'streets' => [
                'King William St', 'Rundle St', 'Hindley St', 'Gouger St', 'Grenfell St',
                'Currie St', 'Franklin St', 'Waymouth St', 'Flinders St', 'Wakefield St',
                'Hutt St', 'Pulteney St', 'Frome St', 'East Terrace', 'South Terrace',
                'West Terrace', 'North Terrace', 'The Parade', 'Unley Rd',
                'Goodwood Rd', 'Glen Osmond Rd', 'Magill Rd', 'Portrush Rd',
                'Glynburn Rd', 'Payneham Rd',
            ],
        ],
    ];

    private static array $businessPrefixes = [
        'Thai', 'Asian', 'Oriental', 'Traditional', 'Classic', 'Royal', 'Golden',
        'Pure', 'Bliss', 'Zen', 'Serene', 'Divine', 'Sacred', 'Natural',
        'Harmony', 'Balance', 'Tranquil', 'Peaceful', 'Holistic', 'Healing',
        'Luxury', 'Premium', 'Elite', 'Urban', 'City', 'Relax', 'Rejuvenate',
        'Refresh', 'Revive', 'Restore', 'Renew', 'Siam', 'Bangkok', 'Lotus',
        'Orchid', 'Jasmine', 'Bamboo', 'Jade', 'Silk', 'Phuket', 'Chiang Mai',
        'Sukko', 'Piyawat', 'Airin', 'Tonic', 'Esquire', 'Body Heat', 'House of',
    ];

    private static array $businessSuffixes = [
        'Massage', 'Thai Massage', 'Massage Therapy', 'Massage Clinic',
        'Massage Centre', 'Day Spa', 'Wellness Spa', 'Healing Spa', 'Spa & Massage',
        'Body Therapy', 'Relaxation Centre', 'Wellness Centre', 'Health Spa',
        'Touch Therapy', 'Body Care', 'Wellness Studio', 'Therapy Centre',
        'Massage Studio', 'Spa Retreat', 'Healing Centre', 'Spa',
    ];

    private static array $emailDomains = [
        'gmail.com', 'yahoo.com.au', 'hotmail.com', 'outlook.com',
        'bigpond.com', 'iinet.net.au', 'westnet.com.au',
    ];

    // -------------------------------------------------------------------------

    public function definition(): array
    {
        $stateAbbr = $this->faker->randomElement(array_keys(self::$states));
        return $this->buildRecord($stateAbbr);
    }

    // -------------------------------------------------------------------------
    // State-specific factory states
    // -------------------------------------------------------------------------

    public function westernAustralia(): static
    {
        return $this->state(fn () => $this->buildRecord('WA'));
    }

    public function victoria(): static
    {
        return $this->state(fn () => $this->buildRecord('VIC'));
    }

    public function newSouthWales(): static
    {
        return $this->state(fn () => $this->buildRecord('NSW'));
    }

    public function queensland(): static
    {
        return $this->state(fn () => $this->buildRecord('QLD'));
    }

    public function southAustralia(): static
    {
        return $this->state(fn () => $this->buildRecord('SA'));
    }

    /** Mark record as archived */
    public function archived(): static
    {
        return $this->state(['archive' => 'true']);
    }

    // -------------------------------------------------------------------------
    // Core builder
    // -------------------------------------------------------------------------

    private function buildRecord(string $stateAbbr): array
    {
        $stateData    = self::$states[$stateAbbr];
        $location     = $this->faker->randomElement($stateData['suburbs']);
        $street       = $this->faker->randomElement($stateData['streets']);
        $streetNo     = $this->faker->numberBetween(1, 599);

        $businessName = $this->faker->randomElement(self::$businessPrefixes)
            . ' '
            . $this->faker->randomElement(self::$businessSuffixes);

        // Replicate the sparse contact-field pattern seen in your real data
        $hasMobile    = $this->faker->boolean(60);
        $hasPhone     = $this->faker->boolean(50);
        $hasEmail     = $this->faker->boolean(55);
        $hasWebsite   = $this->faker->boolean(30);

        $slug         = strtolower(preg_replace('/[^a-z0-9]/i', '', $businessName));

        return [
            'bussiness_name'  => $businessName,   // note: typo kept to match your DB column
            'address'         => "{$streetNo} {$street} {$location['suburb']} {$stateAbbr} {$location['post_code']}",
            'post_code'       => $location['post_code'],
            'state_abbr'      => $stateAbbr,
            'state_id'        => $stateData['state_id'],
            'territory_name'  => $stateData['territory_name'],
            'mobile_number'   => $hasMobile  ? '04' . $this->faker->numerify('########') : '',
            'business_number' => $hasPhone   ? '0' . $this->faker->numerify('#########') : '',
            'email'           => $hasEmail   ? $slug . $this->faker->numberBetween(1, 99) . '@' . $this->faker->randomElement(self::$emailDomains) : '',
            'website'         => $hasWebsite ? 'www.' . $slug . '.com.au' : '',
            'archive'         => 'false',
        ];
    }
}