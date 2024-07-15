<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserInputTest extends TestCase
{
    /**
     * Test form submission with valid input.
     *
     * @return void
     */
    public function test_user_can_submit_form_with_valid_input()
    {
        // Simulate user input data
        $formData = [
            'startpoint' => 'UTAR Sungai Long Campus, Jalan Sungai Long, Bandar Sungai Long, Kajang, Selangor, Malaysia',
            'destination' => 'Pavilion Kuala Lumpur, Jalan Bukit Bintang, Bukit Bintang, Kuala Lumpur, Federal Territory of Kuala Lumpur, Malaysia',
            'money' => 100, // Sample amount
            'dateRange' => '2024-04-13 to 2024-04-15', // Sample date range
            'pickup_time' => '08:00', // Sample pickup time
            'return_time' => '18:00', // Sample return time
            'requirement' => 'Sample requirement',
            // Add more input fields as needed
        ];

        // Send POST request with form data
        $response = $this->post('/chooseDriver', $formData);
        dump($response->json());
        // Assert that the form submission was successful (e.g., redirect or response code)
        $response->assertStatus(200);
    }
}
