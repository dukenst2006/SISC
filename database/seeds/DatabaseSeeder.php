<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   // Users
        $this->call(UsersTableSeeder::class);

        // Companies
        $this->call(CompaniesTableSeeder::class);

        // Products
        $this->call(ProductsTableSeeder::class);

        // Customers
        $this->call(CustomersTableSeeder::class);

        // Shipping Methods
        $this->call(ShippingMethodsTableSeeder::class);

        // Invoices
        $this->call(InvoicesTableSeeder::class);
    }
}
