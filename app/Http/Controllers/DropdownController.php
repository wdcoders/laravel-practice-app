<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class DropdownController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return view('dropdown', compact('countries'));
    }

    public function state($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        $data = array("data" => $states);
        return response()->json($data);
    }

    public function city($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        $data = array("data" => $cities);
        return response()->json($data);
    }
}
