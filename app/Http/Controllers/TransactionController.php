<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function deposits()
    {
        $deposits = Transaction::where('user_id', Auth::id())->where('type', 'deposit')->get();
        return view('transactions.deposits', compact('deposits'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function withdrawals()
    {
        $withdrawals = Transaction::where('user_id', Auth::id())->where('type', 'withdrawal')->get();
        return view('transactions.withdrawals', compact('withdrawals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $user = Auth::user();
        $user->balance += $request->amount;
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => $request->amount
        ]);

        return redirect()->route('deposits');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $user = Auth::user();
        $amount = $request->amount;
        $fee = 0;

        if ($user->account_type == 'Individual') {
            $fee = $this->calculateIndividualFee($amount);
        } else {
            $fee = $this->calculateBusinessFee($user, $amount);
        }

        if ($user->balance < $amount + $fee) {
            return back()->withErrors(['amount' => 'Insufficient funds']);
        }

        $user->balance -= ($amount + $fee);
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'amount' => $amount
        ]);

        return redirect()->route('withdrawals');
    }

    /**
     * Implement logic here for individual user  withdrawal conditions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function calculateIndividualFee($amount)
    {
        // Implement logic for free withdrawal conditions
        $dayOfWeek = now()->dayOfWeek;
        $freeFridays = $dayOfWeek == 5; // Friday

        if ($freeFridays || $amount <= 1000) {
            return 0;
        }

        $fee = ($amount - 1000) * 0.015 / 100;

        $currentMonth = now()->month;
        $totalMonthlyWithdrawal = Transaction::where('user_id', Auth::id())
            ->where('type', 'withdrawal')
            ->whereMonth('created_at', $currentMonth)
            ->sum('amount');


        if ($totalMonthlyWithdrawal + $amount <= 5000) {
            return 0;
        }

        return $fee;
    }

    /**
     * Implement logic here for Business user  withdrawal conditions
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function calculateBusinessFee($user, $amount)
    {
        $fee = $amount * 0.025 / 100;

        $totalWithdrawn = Transaction::where('user_id', $user->id)
            ->where('type', 'withdrawal')
            ->sum('amount');

        if ($totalWithdrawn + $amount >= 50000) {
            $fee = $amount * 0.015 / 100;
        }

        return $fee;
    }
}

