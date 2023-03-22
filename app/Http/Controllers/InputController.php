<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function sayHello(Request $request): string
    {
        // $request->input() ambil semua inputan GET (query param) atau POST (form post)

        // =============kalo untuk ambil yang dari QUERY PARAM aja bisa pakai $request->query()======
        $name = $request->input('name');
        return "Hello $name";
    }

    // nested input
    // penggunaan liat di InputRequestTest -> testNestedInput
    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first');
        $lastName = $request->input('name.last');
        return "Hello $firstName $lastName";
    }

    // get all input
    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    // ambil semua value input dalam array
    // ambil semua value name di array products
    public function helloArray(Request $request): string
    {
        $productsName = $request->input('products.*.name');
        return json_encode($productsName);
    }

    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDay = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth-date' => $birthDay->format('Y-m-d')
        ]);
    }

    public function filterOnly(Request $request): string
    {
        $name = $request->only(['name.first', 'name.last']);
        return json_encode($name);
    }

    public function filterExcept(Request $request): string
    {
        $user = $request->except(['user.admin']);
        return json_encode($user);
    }

    public function filterMerge(Request $request): string
    {
        $request->merge(['admin' => false]);
        $user = $request->input();
        return json_encode($user);
    }

    public function filterMergeNested(Request $request): string
    {
        $request->merge(['user' => ['admin' => false]]);
        $user = $request->input();
        return json_encode($user);
    }
}
