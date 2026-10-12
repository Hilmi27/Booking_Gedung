<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;

class PaymentDetailController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('admin');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentDetails = PaymentDetail::all();
        return view('admin.payment-details.index', compact('paymentDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment-details.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bank_name'      => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'account_name'   => 'required|string|max:255',
            'is_active'      => 'boolean',
        ]);

        PaymentDetail::create([
            'bank_name'      => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name'   => $request->account_name,
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect()->route('admin.payment-details.index')
            ->with('success', 'Detail pembayaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentDetail $paymentDetail)
    {
        return view('admin.payment-details.edit', compact('paymentDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentDetail $paymentDetail)
    {
        $request->validate([
            'bank_name'      => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'account_name'   => 'required|string|max:255',
            'is_active'      => 'boolean',
        ]);

        $paymentDetail->update([
            'bank_name'      => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name'   => $request->account_name,
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect()->route('admin.payment-details.index')
            ->with('success', 'Detail pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentDetail $paymentDetail)
    {
        $paymentDetail->delete();

        return redirect()->route('admin.payment-details.index')
            ->with('success', 'Detail pembayaran berhasil dihapus.');
    }
}
