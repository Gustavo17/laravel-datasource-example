<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function getusers(Request $request) 
    {
        if (isset($request->per_page)) {
            $per_page = $request->per_page;
        } else {
            $per_page = 15;
        }

        // Searching method
        // You can use a full-text-search Algolia, Elastic Search, etc ..
        $searching = $request->search;
        $data = User::search($searching)->paginate($per_page);

        return [
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
            'data' => $data->items()
        ];
    }
}
