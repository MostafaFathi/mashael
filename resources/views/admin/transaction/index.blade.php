@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">


                <h4 class="card-title">{{__('Transactions')}}</h4>

                <h6 class="card-subtitle"> {{__('Transactions descriptions')}} </h6>

                    <div class="panel-body">

                        @if( $transactions )

                        <table class="table table-hover" >

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Transaction id')}}</th>
                                    <th>{{__('Response message')}}</th>
                                    <th>{{__('Customer name')}}</th>
                                    <th>{{__('Customer email')}}</th>
                                    <th>{{__('Customer phone')}}</th>
                                    <th>{{__('Transaction amount')}}</th>
                                    <th>{{__('transaction currency')}}</th>
                                    <th>{{__('trans date')}}</th>
                                </tr>
                            </thead>

                            <tbody class="m-datatable__body" style="">

        						@foreach( $transactions as $transaction )
                                <tr>
                                    <th scope="row">{{ $transaction->id }}</th>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>{{ $transaction->response_message }}</td>
                                    <td>{{ $transaction->customer_name }}</td>
                                    <td>{{ $transaction->customer_email }}</td>
                                    <td>{{ $transaction->customer_phone }}</td>
                                    <td>{{ $transaction->transaction_amount }}</td>
                                    <td>{{ $transaction->transaction_currency }}</td>
                                    <td>{{ $transaction->trans_date }}</td>

                                </tr>

                                @endforeach


                            </tbody>

                        </table>



                        {{ $transactions->appends(request()->input())->links() }}



                        @else
                            <div class="alert alert-danger">{{__('Empty data')}}</div>
                        @endif

                </div>

            </div>

        </div>

    </div>

</div>



@endsection







@section('footer')

    <link rel="stylesheet" type="text/css" href="https://wfolly.firebaseapp.com/node_modules/sweetalert/dist/sweetalert.css">
    <script src="https://wfolly.firebaseapp.com/node_modules/sweetalert/dist/sweetalert.min.js"></script>


    <script type="text/javascript">
        var Confirm = false;
        $('.Delete').submit(function(){
            var selectDelete = this;
            if(Confirm === false){
                swal({
                        title: "{{__('Are you sure ?')}}",
                        text: "{{__('You will delete')}}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "{{__('Yes')}}",
                        cancelButtonText: "{{__('No')}}",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            Confirm = true;
                            $(selectDelete).submit();
                        } else {
                            return false;
                        }
                    });
                return false;
            }
        });

        $('.Approve').submit(function(){
            var selectDelete = this;
            if(Confirm === false){
                swal({
                        title: "{{__('Are you sure ?')}}",
                        text: "{{__('You will approve')}}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "{{__('Yes')}}",
                        cancelButtonText: "{{__('No')}}",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            Confirm = true;
                            $(selectDelete).submit();
                        } else {
                            return false;
                        }
                    });
                return false;
            }
        });

        $('.Cancel').submit(function(){
            var selectDelete = this;
            if(Confirm === false){
                swal({
                        title: "{{__('Are you sure ?')}}",
                        text: "{{__('You will cancel')}}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "{{__('Yes')}}",
                        cancelButtonText: "{{__('No')}}",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            Confirm = true;
                            $(selectDelete).submit();
                        } else {
                            return false;
                        }
                    });
                return false;
            }
        });

    </script>



@endsection
