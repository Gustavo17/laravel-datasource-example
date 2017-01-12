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
        $data = User::where('name', 'LIKE', '%'.$searching.'%')
            ->orWhere('email', 'LIKE', '%'.$searching.'%')
            ->orWhere('city', 'LIKE', '%'.$searching.'%')
            ->orWhere('city', 'LIKE', '%'.$searching.'%')
            ->orWhere('company', 'LIKE', '%'.$searching.'%')
            ->orWhere('job', 'LIKE', '%'.$searching.'%');

        $collection = $data->paginate($per_page);

        return [
            'pagination' => [
                'total' => $collection->total(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage(),
                'next_page_url' => $collection->nextPageUrl(),
                'prev_page_url' => $collection->previousPageUrl(),
                'from' => $collection->firstItem(),
                'to' => $collection->lastItem(),
            ],
            'data' => $data->get()
        ];
    }
}
