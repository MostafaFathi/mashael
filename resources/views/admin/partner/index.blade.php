@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <a class="btn btn-info d-none d-lg-block m-l-15 pull-left" href="{{route('admin::partner.create')}}"> <i class="fa fa-plus-circle"></i> {{__('Add new')}}</a>

                <h4 class="card-title">{{__('Partners')}}</h4>

                <h6 class="card-subtitle"> {{__('Partners descriptions')}} </h6>

                    <div class="panel-body">

                        @if( $partners )

                        <table class="table table-hover" >

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>{{__('Name')}}</th>

                                    <th>{{__('Url')}}</th>

                                    <th>{{__('Image')}}</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody class="m-datatable__body" style="">

        						@foreach( $partners as $partner )

                                <tr>

                                    <th scope="row">{{ $partner->id }}</th>

                                    <td>{{ $partner->name }}</td>

                                    <td>{{ $partner->url }}</td>

                                    <td><img width="40" src="{{ url('storage/app/'.$partner->image) }}" /></td>

                                    <td style="width: 180px;">

                                        <a href="{{ route('admin::partner.edit' , $partner->id ) }}" class="btn btn-xs btn-info" title="Edit details"><i class="fa fa-edit"></i> {{__('Edit')}}</a>

                                        <form action="{{ route('admin::partner.destroy' ,$partner->id ) }}" method="post" class="Delete" style="display: inline-block;" >

                                            {{ csrf_field() }}

                                            {{ method_field('DELETE') }}

                                            <button partner="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {{__('Delete')}}</button>

                                        </form>

                                    </td>

                                </tr>

                                @endforeach


                            </tbody>

                        </table>



                        {{ $partners->appends(request()->input())->links() }}



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


    <script partner="text/javascript">

        var Confirm = false;

        $('.Delete').submit(function(){

            var selectDelete = this;

            if(Confirm === false){

                swal({

                  title: "{{__('are_you_sure')}} ?",

                  text: "{{__('you_will_delete')}}",

                  partner: "warning",

                  showCancelButton: true,

                  confirmButtonClass: "btn-danger",

                  confirmButtonText: "{{__('yes')}}",

                  cancelButtonText: "{{__('no')}}",

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

        })

    </script>



@endsection
