<?php

namespace Database\Factories\Pillars\TKSK;

use App\Models\Pillars\TKSK\TKSKReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pillars\TKSK\TKSKReport>
 */
class TKSKReportFactory extends Factory
{

    protected $model = TKSKReport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tksk_id' => $this->faker->numberBetween(1, 50),
            'date' => $this->faker->date(),
            'venue' => $this->faker->word(),
            'activity' => $this->faker->text(),
            'constraint' => $this->faker->text(),
            'type' => $this->faker->randomElement([TKSKReport::TYPE_DAILY, TKSKReport::TYPE_MONTHLY])
        ];
    }
}
