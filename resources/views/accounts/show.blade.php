@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($accounts as $account)

                <div class="container">{!! 'Account type: ' !!}<b>{{ $account->type }}</b></div>
                {{$account->iban}} <b style="padding-left: 10px">{{$account->getBalance()." ".$account->currency}}</b>

                <form style="padding-left: 40px" method="POST" action="/send">
                    @csrf
                    <input style="width: 90px" type="number" min="0.01" step="0.01" name="amount" required>
                    <input type="hidden" name="currency" value="{{$account->currency}}">
                    <input type="hidden" name="sendFrom" value="{{$account->iban}}">
                    <input list="brow" name="sendTo">
                    <datalist id="brow">
                        @foreach($accounts as $acc)
                                <option value="{{$acc->iban}}">
                        @endforeach
                    </datalist>
                    <button type="submit">Send</button>
                </form>


                @if($debt == '0')
                    <div class="container" style="padding-top: 50px">
                        <div class="row justify-content-center">
                            <form method="GET" action="/debt">
                                @csrf
                                <button type="submit">Mega Credit</button>
                            </form>
                        </div>
                    </div>
                @endif

            @endforeach
        </div>
    </div>
@endsection
