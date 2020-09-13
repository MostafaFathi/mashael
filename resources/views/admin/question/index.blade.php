@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <!-- <a class="btn btn-info d-none d-lg-block m-l-15 pull-left" href="{{route('admin::question.create')}}"> <i class="fa fa-plus-circle"></i> {{__('Add new')}}</a> -->

                <h4 class="card-title">{{__('Question')}}</h4>

                <h6 class="card-subtitle"> {{__('Question descriptions')}} </h6>

                    <div class="panel-body">

                        @if( $questions )

                        <table class="table table-hover" >

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>{{__('Question')}}</th>
                                    <th>{{__('User')}}</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody class="m-datatable__body" style="">

        						@foreach( $questions as $question )

                                <tr>

                                    <th scope="row">{{ $question->id }}</th>
                                    <td>{{ $question->title ?? '' }}</td>
                                    <td>{{ $question->user->name ?? '' }}</td>
                                    <td>{{ $question->answers->count() > 0 ? "تمت الاجاية" : ""  }}</td>
                                    <td style="width: 180px;">

                                        <a href="{{ route('admin::question.edit' , $question->id ) }}" class="btn btn-xs btn-info" title="Edit details"><i class="fa fa-edit"></i> {{__('Answer')}}</a>

                                        <form action="{{ route('admin::question.destroy' ,$question->id ) }}" method="post" class="Delete" style="display: inline-block;" >

                                            {{ csrf_field() }}

                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {{__('Delete')}}</button>

                                        </form>

                                    </td>

                                </tr>

                                @endforeach


                            </tbody>

                        </table>



                        {{ $questions->appends(request()->input())->links() }}



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

        })

    </script>



@endsection
