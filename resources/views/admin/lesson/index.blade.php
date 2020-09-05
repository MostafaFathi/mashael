@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <a class="btn btn-info d-lg-block m-l-15 pull-right" href="{{route('admin::lesson.create')}}"> <i class="fa fa-plus-circle"></i> {{__('Add new')}}</a>

                <h4 class="card-title">{{__('Lessons')}}</h4>

                <h6 class="card-subtitle"> {{__('Lessons description')}} </h6>

                    <div class="panel-body">
                        @if( $lessons )

                        <table class="table table-hover" >

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>{{__('Name')}}</th>

                                    <th>{{__('Image')}}</th>

                                    <!-- <th>{{__('Video url')}}</th> -->

                                    <th>{{__('Course')}}</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody class="m-datatable__body" style="">


        						@foreach( $lessons as $lesson )

                                <tr>

                                    <th scope="row">{{ $lesson->id }}</th>

                                    <td>{{ $lesson->name }}</td>

                                    <td><img width="40" src="{{ url('storage/app/'.$lesson->image) }}" /></td>

                                   <!--  <td>{{ $lesson->video_url }}</td> -->

                                    <td>{{ $lesson->course->name }}</td>

                                    <td style="width: 180px;">

                                        <a href="{{ route('admin::lesson.edit' , $lesson->id ) }}" class="btn btn-xs btn-info" title="Edit details"><i class="fa fa-edit"></i> {{__('Edit')}}</a>

                                        <form action="{{ route('admin::lesson.destroy' ,$lesson->id ) }}" method="post" class="Delete" style="display: inline-block;" >

                                            {{ csrf_field() }}

                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {{__('Delete')}}</button>

                                        </form>

                                    </td>



                                </tr>

                                @endforeach

                            </tbody>

                        </table>



                        {{ $lessons->appends(request()->input())->links() }}

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

        })

    </script>



@endsection
