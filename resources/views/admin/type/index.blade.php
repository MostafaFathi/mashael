@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <a class="btn btn-info d-none d-lg-block m-l-15 pull-left" href="{{route('admin::type.create')}}"> <i class="fa fa-plus-circle"></i> {{__('Add new')}}</a>

                <h4 class="card-title">{{__('Types')}}</h4>

                <h6 class="card-subtitle"> {{__('Types descriptions')}} </h6>

                    <div class="panel-body">

                        @if( $types )

                        <table class="table table-hover" >

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>{{__('Name')}}</th>

                                    <th>{{__('Image')}}</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody class="m-datatable__body" style="">

        						@foreach( $types as $type )

                                <tr>

                                    <th scope="row">{{ $type->id }}</th>

                                    <td>{{ $type->name }}</td>

                                    <td><img width="40" src="{{ url('storage/app/'.$type->image) }}" /></td>

                                    <td style="width: 180px;">

                                        <a href="{{ route('admin::type.edit' , $type->id ) }}" class="btn btn-xs btn-info" title="Edit details"><i class="fa fa-edit"></i> {{__('Edit')}}</a>

                                        <form action="{{ route('admin::type.destroy' ,$type->id ) }}" method="post" class="Delete" style="display: inline-block;" >

                                            {{ csrf_field() }}

                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {{__('Delete')}}</button>

                                        </form>

                                    </td>

                                </tr>

                                @endforeach


                            </tbody>

                        </table>



                        {{ $types->appends(request()->input())->links() }}



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

                  title: "{{__('are_you_sure')}} ?",

                  text: "{{__('you_will_delete')}}",

                  type: "warning",

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
