@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">


                <h4 class="card-title">{{__('Contacts')}}</h4>

                <h6 class="card-subtitle"> {{__('Contacts descriptions')}} </h6>

                    <div class="panel-body">

                        @if( $contacts )

                        <table class="table table-hover" >

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('First name')}}</th>
                                    <th>{{__('Last name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('title')}}</th>
                                      <th></th>
                                </tr>
                            </thead>

                            <tbody class="m-datatable__body" style="">

        						@foreach( $contacts as $contact )

                                <tr>
                                    <th scope="row">{{ $contact->id }}</th>
                                    <td>{{ $contact->first_name }}</td>
                                    <td>{{ $contact->last_name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->title }}</td>

                                    <td style="width: 180px;">


                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal{{ $contact->id }}"><i class="fa fa-check-circle-o"></i> {{__('Read')}}</button>

                                        <form action="{{ route('admin::contact.destroy' ,$contact->id ) }}" method="post" class="Delete" style="display: inline-block;" >

                                            {{ csrf_field() }}

                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {{__('Delete')}}</button>

                                        </form>

                                    </td>

                                </tr>

                                @endforeach


                            </tbody>

                        </table>

                            @foreach( $contacts as $contact )

                            <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">اسم المرسل:  {{$contact->first_name}} {{$contact->last_name}}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    {{$contact->message}}
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                             </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach

                        {{ $contacts->appends(request()->input())->links() }}

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
