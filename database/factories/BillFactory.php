<?php

namespace Database\Factories;

use App\Enums\BillStatus;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\BillDetailOption;
use App\Models\Customer;
use App\Models\Food;
use App\Models\FoodVariation;
use App\Models\Location;
use App\Models\Restaurant;
use App\Models\Shipper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Bill>
 */
class BillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Bill>
     */
    protected $model = Bill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = $this->faker->numberBetween(50000, 500000);
        $discount = $this->faker->optional(0.3)->numberBetween(5000, 50000) ?? 0;
        $totalFinal = max(0, $total - $discount);

        return [
            'customer_id' => Customer::inRandomOrder()->value('id') ?? Customer::factory(),
            'restaurant_id' => Restaurant::inRandomOrder()->value('id') ?? Restaurant::factory(),
            'shipper_id' => Shipper::inRandomOrder()->value('id'),
            'code' => strtoupper('BILL-' . Str::random(8)),
            'voucher_code' => $this->faker->optional(0.2)->bothify('VOUCHER-??##'),
            'location_id' => Location::whereNull('parent_id')->inRandomOrder()->value('id'),
            'address' => $this->faker->address(),
            'total' => $total,
            'discount' => $discount,
            'total_final' => $totalFinal,
            'note' => $this->faker->optional(0.3)->sentence(),
            'status' => $this->faker->randomElement(BillStatus::cases()),
        ];
    }

    /**
     * Configure factory to create bill details after creating bill.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Bill $bill) {
            $restaurant = Restaurant::with('foods.variations')->find($bill->restaurant_id);
            $foods = $restaurant?->foods;

            if (! $foods || $foods->isEmpty()) {
                $foods = Food::with('variations')->inRandomOrder()->take(3)->get();
            }

            if ($foods->isEmpty()) {
                return;
            }

            $selectedFoods = $foods->random(min($foods->count(), $this->faker->numberBetween(1, 3)));

            foreach ($selectedFoods as $food) {
                $price = $food->price;
                $quantity = $this->faker->numberBetween(1, 4);
                $itemTotal = $price * $quantity;

                $detail = BillDetail::create([
                    'bill_id' => $bill->id,
                    'food_id' => $food->id,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ]);

                $variations = $food->variations;
                if ($variations->isNotEmpty()) {
                    $selectedVariations = $variations->random(min($variations->count(), $this->faker->numberBetween(0, 2)));
                    foreach ($selectedVariations as $variation) {
                        BillDetailOption::create([
                            'bill_detail_id' => $detail->id,
                            'option_id' => $variation->id,
                        ]);
                    }
                }
            }
        });
    }

    /**
     * State for a pending bill.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BillStatus::PENDING,
            'shipper_id' => null,
        ]);
    }

    /**
     * State for a delivered bill.
     */
    public function delivered(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BillStatus::DELIVERED,
        ]);
    }

    /**
     * State for a cancelled bill.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BillStatus::CANCELLED,
            'shipper_id' => null,
        ]);
    }
}
