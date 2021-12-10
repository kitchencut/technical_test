<?php

namespace Tests;

use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AcceptanceTests extends TestCase
{
    /**
     * @test
     * @group AcceptanceTests
     *
     * Application is reachable.
     */
    public function application_is_running()
    {
        $requestResponse = $this->get(route('healthcheck'));

        $requestResponse->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     * @group AcceptanceTests
     *
     * Create an Application that connects to MySQL.
     */
    public function application_can_connect_to_database()
    {

    }

    /**
     * @test
     * @group AcceptanceTests
     *
     * Create an API endpoint that receives: Range Date, Status and Location (The filters are not mandatory) and
     * return invoice's header data + total value.
     */
    public function api_endpoint_receives_range_date_status_and_location_and_return_invoice_header_data_total_value()
    {
        $requestPayload  = [
            'date_start' => '2021-07-01',
            'date_end'   => '2021-07-31',
            'status'     => 'draft',
            'location'   => 'LOCATION 001',
        ];

        $requestResponse = $this->getJson(
            route('invoices.store'),
            $requestPayload
        );

        $requestResponse->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     * @group AcceptanceTests
     *
     * Create an API endpoint that receives: Location ID and return the value sum of the Invoices grouped by status.
     */
    public function api_receives_location_id_and_return_the_value_sum_of_the_invoices_grouped_by_status()
    {

    }

    /**
     * @test
     * @group AcceptanceTests
     *
     * Create a simple list page to show the result of the endpoints
     */
    public function can_view_list_page()
    {

    }

    /**
     * @test
     * @group AcceptanceTests
     *
     * Create a SQL Query to return the total value sum and the total quantity (number of invoice lines) per Invoice
     */
    public function can_query_total_value_and_total_quantity_per_invoice()
    {

    }
}
