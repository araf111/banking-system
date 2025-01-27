@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Transactions') }}</div>

            <div class="card-body">
                <h4>Account Type: {{ Auth::user()->account_type }}, Current Balance: ${{ Auth::user()->balance }}</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transactions->count() > 0)
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ ucfirst($transaction->type) }}</td>
                                    <td>${{ $transaction->amount }}</td>
                                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
