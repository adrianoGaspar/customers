<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    private $customer;

    /**
     * CustomerController constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $customers = $this->customer->get();
        return response()->json(['data'=>$customers], 200)->withCallback();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if($request->input('image')) {
            $image = $request->input('photo');
            list($type, $image) = explode(';', $image);
            list(, $image) = explode(',', $image);
            $image = base64_decode($image);
            $image_name = time() . '.png';
            $request->merge(array('photo' => $image_name));
            Storage::disk('public')->put($image_name,  $image);
        } else {
            $request->merge(array('photo' => null));
        }
        $customer = $this->customer->create($request->all());

        return response()
            ->json([
                'message' => 'Cliente cadastrado com sucesso!',
                'title' => 'Sucesso',
                'class_icon' => 'fas fa-check-circle fa-3x',
            ],200)->withCallback();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $customer = $this->customer->find($id);
        return view('customer.show')->with(compact('customer'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $customer = $this->customer->find($id);

            $image = $request->input('photo');
            list($type, $image) = explode(';', $image);
            list(, $image) = explode(',', $image);
            $image = base64_decode($image);
            $image_name = time() . '.png';
            $request->merge(array('photo' => $image_name));
            $exists = Storage::disk('public')->exists($customer->photo);
            if($exists){
                Storage::disk('public')->delete($customer->photo);
            }
            Storage::disk('public')->put($image_name,  $image);

        if ($customer->fill($request->input())->save()) {
            return response()
                ->json([
                    'message' => 'Cliente alterado com sucesso!',
                    'title' => 'Sucesso',
                    'class_icon' => 'fas fa-check-circle fa-3x',
                ],200)->withCallback();
        }
    }



    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $customer = $this->customer->find($id);
        $exists = Storage::disk('public')->exists($customer->photo);
        if($exists){
            Storage::disk('public')->delete($customer->photo);
        }
        $customer->delete();
        return response()
            ->json([
                'message' => 'Cliente excluído com sucesso!',
                'title' => 'Sucesso',
                'class_icon' => 'fas fa-check-circle fa-3x',
            ],200)->withCallback();
    }

}
