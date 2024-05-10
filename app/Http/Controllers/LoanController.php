<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:loans',
            'sum' => 'required'
        ]);

        $loan = Loan::create($request->all());

        return response()->json(['success' => true, 'loan' => $loan], 201);
    }

    public function getInfo($id)
    {
        $loan = Loan::find($id);

        if (! $loan) {
            return response()->json(['success' => false, 'message' => 'Loan not found']);
        }

        return response()->json(['success' => true, 'loan' => $loan]);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);

        if (! $loan) {
            return response()->json(['success' => false, 'message' => 'Loan not found']);
        }

        $this->validate($request, [
            'name' => 'required|unique:loans',
            'sum' => 'required'
        ]);

        $loan->update($request->all());

        return response()->json(['success' => true, 'loan' => $loan]);
    }

    public function delete($id)
    {
        $loan = Loan::find($id);

        if (! $loan) {
            return response()->json(['success' => false, 'message' => 'Loan not found']);
        }

        $loan->delete();

        return response()->json(['success' => true]);
    }

    public function getLoans(Request $request)
    {
        $loans = Loan::all();

        $params = $request->all();

        if (isset($params['date']) && $params['date'] === 'newest') {
            $loans = Loan::orderBy('id', 'desc')->get();
        }

        if (isset($params['min_sum']) && isset($params['max_sum'])) {
            $loans = Loan::whereBetween('sum', [$params['min_sum'], $params['max_sum']])->get();
        }

        return response()->json(['success' => true, 'loans' => $loans]);
    }
}
