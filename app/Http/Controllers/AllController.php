<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AllController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json(compact('user'), 201);
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($request->isMethod('post')) {
            // $request->validate([
            //     "email" => ['required', 'email'],
            //     'password' => 'required',
            // ]);


            $credentials = $request->only('email', 'password');
            $validator = Validator::make($credentials, [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            // check if user exists
            // $users = DB::table('users')->where('votes', 100)->get();
            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();
                return response()->json(compact('user'), 201);
            };
            return response()->json(['error' => "Unauthorized"], 401);
        }
    }



    public function get_contact(Request $request, $id)
    {
        $contact = Contact::where(['id' => $id])->get();
        return response()->json($contact);
    }


    public function update_contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'email_or_phone' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            // 'apartment_address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(0, 400);
        }
        $id = $request->get("user_id");
        Contact::where('id', $id)->update($request->except("user_id"));

        return response()->json(compact('contact'), 201);
    }


    public function add_contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'email_or_phone' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            // 'apartment_address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $contact = Contact::create([
            'user_id' => $request->get('user_id'),
            'email_or_phone' => $request->get('email_or_phone'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address' => $request->get('address'),
            // 'apartment_address' => $request->get('apartment_address'),
            'city' => $request->get('city'),
            'country' => $request->get('country'),
            'postal_code' => $request->get('postal_code'),

        ]);
        return response()->json(compact('contact'), 201);
    }
    public function add_transaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'product_id' => 'required|string',
            'product_qty' => 'required|string',
            'product_price' => 'required|string',
            'product_total' => 'required|string',
            'trans_total' => 'required|string',
            'trans_ref' => 'required|string',
            'trans_status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $tansaction = Transaction::create([
            'user_id' => $request->get('user_id'),
            'product_id' => $request->get('product_id'),
            'product_qty' => $request->get('product_qty'),
            'product_price' => $request->get('product_price'),
            'product_total' => $request->get('product_total'),
            'trans_total' => $request->get('trans_total'),
            'trans_ref' => $request->get('trans_ref'),
            'trans_status' => $request->get('trans_status'),
        ]);
        return response()->json(compact('tansaction'), 201);
    }
    public function update_status(Request $request, $reference)
    {
        Transaction::where('trans_ref', $reference)->update(["trans_status" => "completed"]);

        return response()->json("success", 201);
    }

    public function products(Request $request)
    {
        return response()->json("PRODUCTS");
    }
}
