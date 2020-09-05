@extends('admin.layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="card">

            <div class="card-body">

                <a class="btn btn-info d-none d-lg-block m-l-15 pull-left" href="{{route('admin::user.create')}}"> <i class="fa fa-plus-circle"></i> {{__('Add new')}}</a>

                <h4 class="card-title">{{__('Users')}}</h4>

                <h6 class="card-subtitle"> {{__('Users description')}} </h6>

                    <div class="panel-body">

                        <form class="form-group m-form__group row align-items-center">

                            <div class="col-md-3">

                                <div class="m-form__group m-form__group--inline">

                                    <div class="m-form__label">

                                        <label>{{__('Name')}}</label>

                                    </div>

                                    <div class="m-form__control">

                                        <div class="">

                                            <input type="text" name="name" value="{{ request('period') }}" class="form-control">

                                        </div>

                                    </div>

                                </div>

                                <div class="d-md-none m--margin-bottom-10"></div>

                            </div>

                            <div class="col-md-3">

                                <div class="m-form__group m-form__group--inline">

                                    <div class="m-form__label">

                                        <label>{{__('Email')}}</label>

                                    </div>

                                    <div class="m-form__control">

                                        <div class="">

                                            <input type="text" name="email" value="{{ request('email') }}" class="form-control">

                                        </div>

                                    </div>

                                </div>

                                <div class="d-md-none m--margin-bottom-10"></div>

                            </div>

                            <div class="col-md-2">

                                <div class="m-form__group m-form__group--inline">

                                    <div class="m-form__label">

                                        <label>{{__('Mobile')}}</label>

                                    </div>

                                    <div class="m-form__control">

                                        <div class="">

                                            <input type="text" name="mobile" value="{{ request('mobile') }}" class="form-control">

                                        </div>

                                    </div>

                                </div>

                                <div class="d-md-none m--margin-bottom-10"></div>

                            </div>

                            <div class="col-md-2 m--margin-top-320">

                                <div class="m-form__group m-form__group--inline">

                                    <div class="m-form__label">

                                        <label class="m-label m-label--single">{{__('Status')}} :</label>

                                    </div>

                                    <div class="m-form__control">

                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" name="status">

                                            <option value="">{{__('All')}}</option>

                                            <option value="Active" {{ request('status') == "Active" ? 'selected' : '' }}>{{__('Active')}}</option>

                                            <option value="Inactive" {{ request('status') == "Inactive" ? 'selected' : '' }}>{{__('Inactive')}}</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-2">

                                    <div class="m-form__label">

                                        <label class="m-label m-label--single" style="color: #fff;">.</label>

                                    </div>

                                <button type="submit" class="btn btn-warning " style="width: 100%;">{{__('Search')}}</button>

                            </div>

                            <hr>

                        </form>

                        <table class="table table-hover" >

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>{{__('First name')}}</th>

                                    <th>{{__('Last name')}}</th>

                                    <th>{{__('Gender')}}</th>

                                    <th>{{__('Email')}}</th>

                                    <th>{{__('Status')}}</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody class="m-datatable__body" style="">

        					@if( $users )

        						@foreach( $users as $user )

                                <tr>

                                    <th scope="row">{{ $user->id }}</th>

                                    <td>{{ $user->firstname }}</td>

                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->gender_name }}</td>

                                    <td>{{ $user->email }}</td>

                                    <td>{!! $user->status == "Active" ? '<span class="m-badge m-badge--success m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-success">'.__('Active').'</span>' : '<span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">'.__('Inactive').'</span>' !!}</td>

                                    <td style="width: 250px;text-align: center">

                                        <a href="{{ route('admin::user.edit' , $user->id ) }}" class="btn btn-xs btn-info" title="Edit details"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                        <a href="{{ route('admin::user.show' , $user->id ) }}" class="btn btn-xs btn-primary" title="Show"><i class="fa fa-list"></i> {{__('Show')}}</a>

                                        <form action="{{ route('admin::user.destroy' ,$user->id ) }}" method="post" class="Delete" style="display: inline-block;" >

                                            {{ csrf_field() }}

                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {{__('Delete')}}</button>

                                        </form>

                                    </td>



                                </tr>

                                @endforeach

                            @endif

                            </tbody>

                        </table>



                        {{ $users->appends(request()->input())->links() }}



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

                  text: "{{__(' you will delete ')}}",

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
