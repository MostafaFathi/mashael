@extends('admin.layouts.app')

@section('content')

    <div class="row">

        <div class="col-sm-12">

            <div class="card">

                <div class="card-body">


                    <h4 class="card-title">{{__('Orders')}}</h4>

                    <h6 class="card-subtitle"> {{__('Orders descriptions')}} </h6>

                    <div class="panel-body">

                        @if( $orders )

                            <table class="table table-hover">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Subscribe')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody class="m-datatable__body" style="">

                                @foreach( $orders as $order )

                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>{{ $order->user ? $order->user->name : '' }}</td>
                                        <td>
                                            @if($order->course)
                                                {{ $order->course->name }}
                                            @elseif($order->worshop)
                                                {{ $order->worshop->name }}
                                            @elseif($order->session)
                                                {{ $order->session->name }}
                                            @else
                                                غير محدد
                                            @endif
                                        </td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ $order->status }}</td>

                                        <td style="width: 250px;">

                                            <form action="{{ route('admin::order.approve' ,$order->id ) }}"
                                                  method="post" class="Approve"
                                                  style="display: inline-block;width: 33.33%; text-align: center;float: right;">

                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-xs btn-success"><i
                                                        class="fa fa-check-circle-o"></i> {{__('Approve')}}</button>

                                            </form>

                                            <form action="{{ route('admin::order.cancel' ,$order->id ) }}" method="post"
                                                  class="Cancel"
                                                  style="display: inline-block;width: 33.33%; text-align: center;float: right;">

                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-xs btn-info"><i
                                                        class="fa fa-times-circle"></i> {{__('Cancel')}}</button>

                                            </form>

                                            <form action="{{ route('admin::order.destroy' ,$order->id ) }}"
                                                  method="post" class="Delete"
                                                  style="display: inline-block;width: 33.33%; text-align: center;float: right;">

                                                {{ csrf_field() }}

                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-trash"></i> {{__('Delete')}}</button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach


                                </tbody>

                            </table>



                            {{ $orders->appends(request()->input())->links() }}



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



    <script type="text/javascript">
        var Confirm = false;
        $('.Delete').submit(function () {
            var selectDelete = this;
            if (Confirm === false) {
                Swal.fire({
                    title: "{{__('Are you sure ?')}}",
                    text: "{{__('You will delete')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "{{__('Yes')}}",
                    cancelButtonText: "{{__('No')}}",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    preConfirm: (isConfirm) => {
                        if (isConfirm) {
                            Confirm = true;
                            $(selectDelete).submit();
                        } else {
                            return false;
                        }
                    }
                });
                return false;
            }
        });

        $('.Approve').submit(function () {
            var selectDelete = this;
            if (Confirm === false) {
                Swal.fire({
                    title: "{{__('Are you sure ?')}}",
                    text: "{{__('You will approve')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "{{__('Yes')}}",
                    cancelButtonText: "{{__('No')}}",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    preConfirm: (isConfirm) => {
                        if (isConfirm) {
                            Confirm = true;
                            $(selectDelete).submit();
                        } else {
                            return false;
                        }
                    }
                });
                return false;
            }
        });

        $('.Cancel').submit(function () {
            var selectDelete = this;
            if (Confirm === false) {
                Swal.fire({
                    title: "{{__('Are you sure ?')}}",
                    text: "{{__('You will cancel')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "{{__('Yes')}}",
                    cancelButtonText: "{{__('No')}}",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    preConfirm: (isConfirm) => {
                        if (isConfirm) {
                            Confirm = true;
                            $(selectDelete).submit();
                        } else {
                            return false;
                        }
                    }
                });
                return false;
            }
        });

    </script>



@endsection
