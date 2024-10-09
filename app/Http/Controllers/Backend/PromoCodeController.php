<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Runner\validate;
use function Spatie\Ignition\viewPath;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('query') ?? null;

        $title = 'Promo Code';

        $promoCodes = PromoCode::query()
            ->when($search, function ($query, $search){
                $query->search($search);
            })
            ->latest()
            ->paginate();

        return view('backend.promo-code.index',compact('title','promoCodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.promo-code.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'code' => 'required',
            'discount_type' => 'required',
            'discount_validity' => 'required',
            'amount' => 'required|int',
            'status' => 'required',
        ]);

        if($validator->fails()){
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }
        $input = $request->all();

        PromoCode::create([
            'name' => $input['name'],
            'code' => $input['code'],
            'discount_type' => $input['discount_type'],
            'validity' => $input['discount_validity'],
            'amount' => $input['amount'],
            'status' => $input['status'],
        ]);

        notify()->success('Item created successfully');

        return redirect()->route('admin.promo-code.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promoCode = PromoCode::find($id);
        return view('backend.promo-code.edit',compact('promoCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'code' => 'required',
            'discount_type' => 'required',
            'discount_validity' => 'required',
            'amount' => 'required|int',
            'status' => 'required',
        ]);

        if($validator->fails()){
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }
        $input = $request->all();
        $promoCode = PromoCode::find($id);
        $promoCode->update([
            'name' => $input['name'],
            'code' => $input['code'],
            'discount_type' => $input['discount_type'],
            'validity' => $input['discount_validity'],
            'amount' => $input['amount'],
            'status' => $input['status'],
        ]);
        notify()->success('Promo Code updated Successfully');
        return redirect()->route('admin.promo-code.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promoCode = PromoCode::find($id);
        $promoCode->delete();

        notify()->success('Item Deleted successfully');
        return redirect()->back();
    }
}
