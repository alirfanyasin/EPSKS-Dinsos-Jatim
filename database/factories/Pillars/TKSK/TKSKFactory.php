<?php

namespace Database\Factories\Pillars\TKSK;

use App\Models\Pillars\Pillar;
use App\Models\Pillars\TKSK\TKSK;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TKSKFactory extends Factory
{

    protected $model = TKSK::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'mother_name' => $this->faker->name,
            'nik' => $this->faker->numberBetween(1000000000000000, 9999999999999999),
            'membership_number' => $this->faker->numberBetween(1000000000, 9999999999),
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement([TKSK::GENDER_MALE, TKSK::GENDER_FEMALE]),
            'religion' => $this->faker->randomElement([TKSK::RELIGION_ISLAM, TKSK::RELIGION_PROTESTANT, TKSK::RELIGION_CATHOLIC, TKSK::RELIGION_HINDU, TKSK::RELIGION_BUDDHA]),
            'address' => [
                'full_address' => $this->faker->address,
                'regency' => $this->faker->city,
                'district' => $this->faker->city,
                'village' => $this->faker->city,
                'rt' => $this->faker->numberBetween(1, 10),
                'rw' => $this->faker->numberBetween(1, 10),
            ],
            'duty_address' => [
                'regency' => $this->faker->city,
                'district' => $this->faker->city,
            ],
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'last_education' => $this->faker->randomElement([TKSK::EDUCATION_SMASMK, TKSK::EDUCATION_D1D2, TKSK::EDUCATION_D3, TKSK::EDUCATION_D4S1, TKSK::EDUCATION_S2S3]),
            'year_of_appointment' => $this->faker->year,
            'main_job' => $this->faker->jobTitle,
            'bank_accounts' => [
                'bank_jatim' => $this->faker->bankAccountNumber,
                'bank_bni' => $this->faker->bankAccountNumber,
            ],
            'is_active' => $this->faker->boolean,
            'annual_evaluation_grade' => $this->faker->randomElement([TKSK::GRADE_GOOD, TKSK::GRADE_ENOUGH, TKSK::GRADE_BAD]),
            'office_id' => $this->faker->randomElement([38, 16]) // surabaya | sidoarjo,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (TKSK $tksk) {
            $role = Role::query()->where('name', User::ROLE_EMPLOYEE)->first();

            $user = User::query()->create([
                'name' => $tksk->name,
                'nip' => $tksk->membership_number,
                'username' => $tksk->membership_number,
                'email' => $tksk->email ?? '',
                'password' => $tksk->membership_number,
                'office_id' => $tksk->office_id,
                'pillar_id' => Pillar::PILLAR_TKSK,
                'is_employee' => true,
            ]);

            $user->assignRole($role->name);
            $user->syncPermissions($role->permissions);

            // update the TKSK user_id
            $tksk->update([
                'user_id' => $user->id,
            ]);
        });
    }
}
