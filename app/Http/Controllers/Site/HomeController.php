<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\CommonQuestion;
use App\Contact;
use App\Course;
use App\Email;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Myshare;
use App\Order;
use App\Page;
use App\Question;
use App\Rate;
use App\Session;
use App\Trainer;
use App\Transaction;
use App\UserCourse;
use App\Workshop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index()
    {
        $categories = \App\Category::get();
        $pages['intro'] = Page::where('id', 1)->first();
        $pages['workshop'] = Page::where('id', 2)->first();
        $pages['courses'] = Page::where('id', 3)->first();
        $pages['views'] = Page::where('id', 4)->first();
        $pages['about'] = Page::where('id', 5)->first();
        return view('site.home', ['categories' => $categories, 'pages' => $pages]);
    }

    public function search()
    {
        $courses = Course::where('name','like','%'.request('search').'%')->get();
        $workshops = Course::where('name','like','%'.request('search').'%')->get();
        return view('site.search', ['courses' => $courses, 'workshops' => $workshops]);
    }

    public function category($id)
    {
        $category = Category::find($id);
        return view('site.category', ['category' => $category]);
    }

    public function courses()
    {
        $courses = new Course();

        $courses = $courses->paginate(10);
        return view('site.courses', ['courses' => $courses]);
    }

    public function course($id)
    {
        $course = Course::findOrFail($id);
        return view('site.course', ['course' => $course]);
    }


    public function myshares()
    {
        $myshares = Myshare::query();
        if(request('type')){
            $myshares = $myshares->where('type',request('type'));
        }
        $myshares = $myshares->paginate(10);
        return view('site.myshares', ['myshares' => $myshares]);
    }

    public function myshare($id)
    {
        $myshare = Myshare::findOrFail($id);
        return view('site.myshare', ['myshare' => $myshare]);
    }

    public function comment($id)
    {
        $course = Course::findOrFail($id);
        return view('site.comment', ['course' => $course]);
    }

    public function comment_workshop($id)
    {
        $workshop = Workshop::find($id);
        return view('site.commentWorkshop', ['workshop' => $workshop]);
    }


    public function workshops()
    {
        $workshops = new Workshop();
        $workshops = $workshops->paginate(10);
        return view('site.workshops', ['workshops' => $workshops]);
    }

    public function workshop($id)
    {
        $workshop = Workshop::findOrFail($id);
        return view('site.workshop', ['workshop' => $workshop]);
    }

    public function lesson($id)
    {
        $lesson = Lesson::find($id);

        return view('site.lesson', ['lesson' => $lesson]);
    }

    public function order($id)
    {
        if(in_array($id,auth()->user()->courses->pluck('course_id')->toArray())){
            return redirect()->back()->withErrors(['انت مشترك في هذه الدورة']);
        }
        $course = Course::find($id);
        if($course->register_status == 0){
            return redirect()->back()->withErrors(['انتهى التسجيل الرجاء المحاولة فيما بعد']);
        }
        return view('site.order', ['course' => $course]);
    }

    public function orderPost($id)
    {
        $course = Course::findOrFail($id);

        if($course->persons != 0 and $course->persons <= $course->orders->count()){
            return redirect()->route('site::workshop', $id)->withErrors(["العدد مكتمل"]);
        }


//        UserCourse::updateOrCreate(
//            ['user_id' => auth()->user()->id, 'course_id' => $lesson->course->id ],
//            ['user_id' => auth()->user()->id, 'course_id' => $lesson->course->id ]
//        );

        $order = Order::create([
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
            'description' => request('description'),
            'price' => $course->price,
            'status' => 'pending'
        ]);

        Mail::send('emails.order', ['course' => $course,'order' => $order], function ($message) use ($order)
        {
            $message->from('mashael@coachmashael.com', 'coach mashael');
            $message->subject("coach mashael");
            $message->to($order->user->email);
        });

        return redirect()->route('site::course', $id)->with('success', "تم الاشتراك بنجاح");
    }


    public function workshopOrder($id)
    {
        if(in_array($id,auth()->user()->courses->pluck('workshop_id')->toArray())){
            return redirect()->back()->withErrors(['انت مشترك في وشرة العمل']);
        }

        $workshop = Workshop::find($id);
        return view('site.workshopOrder', ['workshop' => $workshop]);
    }

    public function workshopOrderPost($id)
    {
        $workshop = Workshop::findOrFail($id);

        if($workshop->persons != 0 and $workshop->persons <= $workshop->orders->count()){
            return redirect()->route('site::workshop', $id)->withErrors(["العدد مكتمل"]);
        }
//        UserCourse::updateOrCreate(
//            ['user_id' => auth()->user()->id, 'workshop_id' => $lesson->workshop->id ],
//            ['user_id' => auth()->user()->id, 'workshop_id' => $lesson->workshop->id ]
//        );

        $order = Order::create([
            'workshop_id' => $workshop->id,
            'user_id' => auth()->user()->id,
            'description' => request('description'),
            'price' => $workshop->price,
            'status' => 'pending'
        ]);

        Mail::send('emails.orderWorkshop', ['workshop' => $workshop,'order' => $order], function ($message) use ($order)
        {
            $message->from('mashael@coachmashael.com', 'coach mashael');
            $message->to($order->user->email);
        });


        return redirect()->route('site::workshop', $id)->with('success', "تم الاشتراك بنجاح");
    }



    public function sessionOrder($id)
    {
        if(in_array($id,auth()->user()->courses->pluck('session_id')->toArray())){
            return redirect()->back()->withErrors(['انت مشترك في الجلسة']);
        }

        $session = Session::find($id);
        $select = Session::find(request('id'));
        return view('site.sessionOrder', ['session' => $session,'select' => $select]);
    }


    public function getSession()
    {
        $date = Carbon::createFromTimestampMs(request('date'))->format('Y-m-d');
        $sessions = Session::with('session_type')->where('id' , '>' ,10)->whereDate('date_time', '=', $date)->doesntHave('orders')->orderBy('interval_time','asc')->get();
return $sessions;
//        $session = Session::find(request('id'));
//        if($session) {
//            $id = Session::where('id' , '>' ,10)->whereDate('date_time', '=', $session->date_time->format('Y-m-d'))->doesntHave('orders')->get();
//            if($id) {
//                return [ 'id' => request('id'), 'date'=> $session->date_time->format('Y-m-d'),'data' => Session::where('id', '<', 10)->get()];
//            }
//
//        }


        //return Session::get();

    }

    public function sessionOrderPost($id)
    {
        $session = Session::find($id);

//        UserCourse::updateOrCreate(
//            ['user_id' => auth()->user()->id, 'session_id' => $lesson->session->id ],
//            ['user_id' => auth()->user()->id, 'session_id' => $lesson->session->id ]
//        );

        $order = Order::create([
            'session_id' => $session->id,
            'user_id' => auth()->user()->id,
            'description' => 'بتاريخ: '.request('date') . '  ' .request('description'),
            'price' => $session->price,
            'status' => 'pending'
        ]);

        Mail::send('emails.orderSession', ['session' => $session,'order' => $order], function ($message) use ($order)
        {
            $message->from('mashael@coachmashael.com', 'coach mashael');
            $message->to($order->user->email);
        });

        return redirect()->route('site::workshop', $id)->with('success', "تم الاشتراك بنجاح");
    }


    public function page($id)
    {
        $page = Page::find($id);
        return view('site.page', ['page' => $page]);
    }

    public function trainer()
    {
        $trainer = Trainer::where('id',1)->first();
        $page = Page::where('id',7)->first();
//        $page2 = Page::where('id',8)->first();
//        $page3 = Page::where('id',13)->first();
//        $page4 = Page::where('id',14)->first();
        return view('site.trainer', ['trainer' => $trainer,'page' => $page/*,'page2' => $page2,'page3' => $page3,'page4' => $page4*/]);
    }


    public function contactus()
    {
        $page = Page::where('id',9)->first();
        return view('site.contactus', ['page' => $page]);
    }

    public function addEmail()
    {
        $validatedData = request()->validate([
            'email' => 'required|email|unique:emails|max:255',
        ]);
        Email::insert(['email' => request('email'), 'created_at' => date('Y-m-d H:i:s')]);
        return redirect()->back()->with('success', __('Email added'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('site.profile', ['user' => $user]);
    }

    public function postProfile()
    {
        $user = auth()->user();
        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->email = request('email');
        $user->mobile = request('mobile');
        $user->birthday = request('birthday');
        $user->street = request('street');
        $user->city = request('city');
        $user->post_code = request('post_code');
        $user->country = request('country');
        $user->area = request('area');

        if(request()->file('image')){
            $user->image = request()->file('image')->store('user');
        }
        $user->save();
        return redirect()->back()->with('success',"تم التعديل بنجاح");
    }

    public function profileQuestions()
    {
        $user = auth()->user();
        return view('site.profileQuestion', ['user' => $user]);
    }
    public function askMashael()
    {
        $questions = Question::all();
        $user = auth()->user();
        return view('site.askMashael', ['user' => $user,'questions'=>$questions]);
    }
    public function commonQuestions()
    {
        $questions = CommonQuestion::all();
        $user = auth()->user();
        return view('site.commonQuestions', ['user' => $user,'questions'=>$questions]);
    }

    public function addQuestion()
    {
        $user = auth()->user();
        return view('site.profileAddQuestion', ['user' => $user]);
    }

    public function postQuestion()
    {
        request()->validate( [
            'title' => 'required',
            'question' => 'required',
        ]);

        $question = new Question();
        $question->title = request('title');
        $question->question = request('question');
        $question->user_id = auth()->user()->id;
        $question->save();
        return redirect()->back()->with('success',"تم اضافة السؤال بنجاح");
    }


    public function profileCourse()
    {
        $user = auth()->user();
        return view('site.profileCourse', ['user' => $user]);
    }


    public function postComment($id)
    {
        request()->validate( [
            'comment' => 'required',
            'rate' => 'required_without:comment',
        ]);

        if( !in_array($id , auth()->user()->courses->pluck('id')->toArray() ) ){
          return redirect()->back()->withErrors(['يجب عليك الاشتراك لاضافة تعليق او تقييم']);
        }

        $rate = new Rate();
        $rate->parent_id = $id;
        $rate->type = 'course';
        $rate->rate = request('rate') ? request('rate') : 0;
        $rate->comment = request('comment');
        $rate->user_id = auth()->user()->id;
        $rate->save();
        return redirect()->back()->with('success',"تم اضافة التعليق والتقييم بنجاح");
    }

    public function contactPost()
    {

        request()->validate( [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->first_name = request('first_name');
        $contact->last_name = request('last_name');
        $contact->email = request('email');
        $contact->title = request('title');
        $contact->message = request('message');
        $contact->status = "Pending";
        $contact->save();
        return redirect()->back()->with('success',"تم ارسال الرسالة بنجاح سيتم التوصل معك في اقرب وقت ممكن");
    }

    function callback()
    {

        $transaction = Transaction::insert(request()->input());
        $array = explode("-", request()->input('order_id'));
        if ($array[0] == "session"){
            $session = Session::find($array[1]);

            $order = Order::create([
                'session_id' => $session->id,
                'user_id' => $array[2],
                'description' => 'بتاريخ: '.request('date') . '  ' .request('description'),
                'price' => $session->price,
                'status' => 'pending',
                'transaction_id' => request('transaction_id')
            ]);

            Mail::send('emails.orderSession', ['session' => $session,'order' => $order], function ($message) use ($order)
            {
                $message->from('mashael@coachmashael.com', 'coach mashael');
                $message->to($order->user->email);
            });

            return redirect()->route("site::home")->with("success","تمت عملية الدفع بنجاح سيتم مراجعة طلبك والمتابعة معك في اقرب وقت ممكن");
        }elseif ($array[0] == "course"){
            $course = Course::find($array[1]);
            $order = Order::create([
                'course_id' => $course->id,
                'user_id' => $array[2],
                'description' => request('description'),
                'price' => $course->price,
                'status' => 'pending',
                'transaction_id' => request('transaction_id')
            ]);

            Mail::send('emails.order', ['course' => $course,'order' => $order], function ($message) use ($order)
            {
                $message->from('mashael@coachmashael.com', 'coach mashael');
                $message->to($order->user->email);
            });

            return redirect()->route("site::".$array[0],$array[1])->with("success","تمت عملية الدفع بنجاح سيتم مراجعة طلبك والمتابعة معك في اقرب وقت ممكن");
        }else{

            $workshop = Course::find($array[1]);

            $order = Order::create([
                'workshop_id' => $workshop->id,
                'user_id' => $array[2],
                'description' => request('description'),
                'price' => $workshop->price,
                'status' => 'pending',
                'transaction_id' => request('transaction_id')
            ]);

            Mail::send('emails.orderWorkshop', ['workshop' => $workshop,'order' => $order], function ($message) use ($order)
            {
                $message->from('mashael@coachmashael.com', 'coach mashael');
                $message->to($order->user->email);
            });

            return redirect()->route("site::".$array[0],$array[1])->with("success","تمت عملية الدفع بنجاح سيتم مراجعة طلبك والمتابعة معك في اقرب وقت ممكن");
        }
     }
}
