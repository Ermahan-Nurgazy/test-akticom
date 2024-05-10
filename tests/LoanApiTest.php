<?php

namespace Tests;

use App\Models\Loan;
use Illuminate\Support\Str;

class LoanApiTest extends TestCase
{
    public function test_create_loan_successfully()
    {
        $response = $this->post('/api/loans', [
            'name' => Str::random(10),
            'sum' => rand(1000, 9999)
        ]);

        $response->seeStatusCode(201)
            ->seeJsonStructure([
                'success',
                'loan' => [
                    'name',
                    'sum'
                ]
            ]);
    }

    public function test_create_loan_unsuccessfully()
    {
        $response = $this->post('/api/loans', [
            'name' => '',
            'sum' => ''
        ]);

        $response->seeStatusCode(422)
            ->seeJsonStructure([
                'name',
                'sum'
            ]);
    }

    public function test_get_loan_info()
    {
        $loan = Loan::factory()->create();
        $response = $this->get('/api/loans/'.$loan->id);
        $response->seeStatusCode(200)
            ->seeJsonStructure([
                'success',
                'loan' => [
                    'id',
                    'name',
                    'sum'
                ]
            ]);
    }

    public function test_update_loan_successfully()
    {
        $loan = Loan::factory()->create();
        $response = $this->put('/api/loans/'.$loan->id, [
            'name' => Str::random(10),
            'sum' => rand(1000, 9999)
        ]);

        $response->seeStatusCode(200)
            ->seeJsonStructure([
                'success',
                'loan' => [
                    'id',
                    'name',
                    'sum'
                ]
            ]);
    }

    public function test_update_loan_unsuccessfully()
    {
        $loan = Loan::factory()->create();
        $response = $this->put('/api/loans/'.$loan->id, [
            'name' => '',
            'sum' => ''
        ]);

        $response->seeStatusCode(422)
            ->seeJsonStructure([
                'name',
                'sum'
            ]);
    }

    public function test_delete_loan()
    {
        $loan = Loan::factory()->create();
        $response = $this->delete('/api/loans/'.$loan->id);

        $response->seeStatusCode(200)
            ->seeJsonStructure([
                'success'
            ]);

        $this->missingFromDatabase('loans', ['id' => $loan->id]);
    }

    public function test_get_loans()
    {
        $response = $this->get('/api/loans');

        $response->seeStatusCode(200)
            ->seeJsonStructure([
                'success',
                'loans' => [
                    [
                        'name',
                        'sum'
                    ],
                    [
                        'name',
                        'sum'
                    ]
                ]
            ]);
    }
}
