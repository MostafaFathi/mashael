@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">


                <h4 class="card-title">{{__('Emails')}}</h4>

                <h6 class="card-subtitle"> {{__('Emails descriptions')}} </h6>

                    <div class="panel-body">

                        @if( $emails )
                        <a class="btn btn-success" href="?download=1">{{__('Export')}}</a>
                        <table class="table table-hover" >

                            <thead>
                                <tr>
                                    <th>{{__('#')}}</th>
                                    <th>{{__('Email')}}</th>
                                </tr>
                            </thead>

                            <tbody class="m-datatable__body" style="">

        						@foreach( $emails as $email )
                                <tr>
                                    <th scope="row">{{ $email->id }}</th>
                                    <td>{{ $email->email }}</td>
                                </tr>

                                @endforeach


                            </tbody>

                        </table>



                        {{ $emails->appends(request()->input())->links() }}



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
        $('.Delete').submit(function(){
            var selectDelete = this;
            if(Confirm === false){
                Swal.fire({
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
                Swal.fire({
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
                Swal.fire({
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
