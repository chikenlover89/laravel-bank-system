@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($transactions as $transaction)

                <div class="container" style="padding-top: 10px">
                    {{"From "}} <b>{{$transaction->fromAccount}}</b> {{"to"}} <b>{{$transaction->toAccount}}</b> <b style="padding-left: 10px; padding-right: 10px">{{$transaction->getAmount()." ".$transaction->fromCurrency}}</b> {{$transaction->created_at}}
                </div>

            @endforeach
        </div>
    </div>
@endsection
