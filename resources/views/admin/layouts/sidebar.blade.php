<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url(config('app.admin_prefix'))}}" aria-expanded="false">
                <i class="fa fa-home"></i> {{__('Dashboard')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::administrator.index') }}">
                <i class="fa fa-user"></i> {{__('Administrators')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::page.index') }}"><i
                    class="fa fa-file-text"></i> {{__('Pages')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::category.index') }}"><i
                    class="fa fa-list"></i> {{__('Categories')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::trainer.index') }}"><i
                    class="fa fa-black-tie"></i> {{__('Trainers')}}</a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('admin::type.index') }}"><i--}}
{{--                    class="fa fa-key"></i> {{__('Types')}}</a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::course.index') }}"><i
                    class="fa fa-certificate"></i> {{__('Courses')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::lesson.index') }}"><i
                    class="fa fa-video-camera"></i> {{__('Lessons')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::workshop.index') }}"><i
                    class="fa fa-shopping-bag"></i> {{__('Workshops')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::session.index') }}"><i
                    class="fa fa-clock-o"></i> {{__('Sessions')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::user.index') }}"><i
                    class="fa fa-users"></i> {{__('Users')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::testimonial.index') }}"><i
                    class="fa fa-commenting"></i> {{__('Testimonials')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::partner.index') }}"><i
                    class="fa fa-user-plus"></i> {{__('Partners')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::order.index') }}"><i
                    class="fa fa-users"></i> {{__('Orders')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::contact.index') }}"><i
                    class="fa fa-phone-square"></i> {{__('Contacts')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::question.index') }}"><i
                    class="fa fa-question-circle"></i> {{__('Questions')}}</a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('admin::certificate.index') }}"><i--}}
{{--                    class="fa fa-id-card-o"></i> {{__('Certificates')}}</a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::transaction.index') }}"><i
                    class="fa fa-credit-card"></i> {{__('Transactions')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::email.index') }}"><i
                    class="fa fa-envelope"></i> {{__('Emails')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin::myshare.index') }}"><i
                    class="fa fa-podcast"></i> {{__('My shares')}}</a>
        </li>
    </ul>
</nav>
