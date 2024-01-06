<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
    }

    public function show($id)
    {
        $expense = Expense::where("id", $id)->first();
        return response()->json($expense);
    }

    public function store(Request $request)
    {

        $expense = new Expense();
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->date = $request->date;
        $expense->save();

        $data = array("message" => "Expense Created Successfully", "data" => $expense);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::where("id", $id)->first();
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->date = $request->date;
        $expense->save();

        $data = array("message" => "Expense Updated Successfully", "data" => $expense);
        return response()->json($data);
    }

    public function delete($id)
    {
        $expense = Expense::where("id", $id)->first();
        $expense->delete();

        $data = array("message" => "Expense Deleted Successfully", "data" => $expense);
        return response()->json($data);
    }
}
