@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Withdrawals') }}</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td>{{ $withdrawal->id }}</td>
                                <td>${{ $withdrawal->amount }}</td>
                                <td>{{ $withdrawal->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
