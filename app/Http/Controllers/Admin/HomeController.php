<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('admin::transaction.index');
        return view('admin.home');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function settings_post()
    {


        if(request('logo')) {
            $logo = Setting::where('key', 'logo')->first();
            if ($logo) {
                Setting::where('key', 'logo')->update(['value' => request('logo')->store('logo')]);
            } else {
                Setting::insert(['key' => 'logo', 'value' => request('logo')->store('logo')]);
            }
        }


        $name = Setting::where('key', 'name')->first();
        if ($name) {
            Setting::where('key', 'name')->update(['value' => request('name')]);
        } else {
            Setting::insert(['key' => 'name', 'value' => request('name')]);
        }


        $email = Setting::where('key', 'email')->first();
        if ($email) {
            Setting::where('key', 'email')->update(['value' => request('email')]);
        } else {
            Setting::insert(['key' => 'email', 'value' => request('email')]);
        }


        $whatsapp = Setting::where('key', 'whatsapp')->first();
        if ($whatsapp) {
            Setting::where('key', 'whatsapp')->update(['value' => request('whatsapp')]);
        } else {
            Setting::insert(['key' => 'whatsapp', 'value' => request('whatsapp')]);
        }

        $phone = Setting::where('key', 'phone')->first();
        if ($phone) {
            Setting::where('key', 'phone')->update(['value' => request('phone')]);
        } else {
            Setting::insert(['key' => 'phone', 'value' => request('phone')]);
        }

        $fax = Setting::where('key', 'fax')->first();
        if ($fax) {
            Setting::where('key', 'fax')->update(['value' => request('fax')]);
        } else {
            Setting::insert(['key' => 'fax', 'value' => request('fax')]);
        }

        $address = Setting::where('key', 'address')->first();
        if ($address) {
            Setting::where('key', 'address')->update(['value' => request('address')]);
        } else {
            Setting::insert(['key' => 'address', 'value' => request('address')]);
        }

        $location = Setting::where('key', 'location')->first();
        if ($location) {
            Setting::where('key', 'location')->update(['value' => request('location')]);
        } else {
            Setting::insert(['key' => 'location', 'value' => request('location')]);
        }

        $Years_of_experience = Setting::where('key', 'Years_of_experience')->first();
        if ($Years_of_experience) {
            Setting::where('key', 'Years_of_experience')->update(['value' => request('Years_of_experience')]);
        } else {
            Setting::insert(['key' => 'Years_of_experience', 'value' => request('Years_of_experience')]);
        }

        $Training_course = Setting::where('key', 'Training_course')->first();
        if ($Training_course) {
            Setting::where('key', 'Training_course')->update(['value' => request('Training_course')]);
        } else {
            Setting::insert(['key' => 'Training_course', 'value' => request('Training_course')]);
        }

        $Workshop = Setting::where('key', 'Workshop')->first();
        if ($Workshop) {
            Setting::where('key', 'Workshop')->update(['value' => request('Workshop')]);
        } else {
            Setting::insert(['key' => 'Workshop', 'value' => request('Workshop')]);
        }

        $Book_and_article = Setting::where('key', 'Book_and_article')->first();
        if ($Book_and_article) {
            Setting::where('key', 'Book_and_article')->update(['value' => request('Book_and_article')]);
        } else {
            Setting::insert(['key' => 'Book_and_article', 'value' => request('Book_and_article')]);
        }

       $clients = Setting::where('key', 'clients')->first();
        if ($clients) {
            Setting::where('key', 'clients')->update(['value' => request('clients')]);
        } else {
            Setting::insert(['key' => 'clients', 'value' => request('clients')]);
        }

        $facebook = Setting::where('key', 'facebook')->first();
        if ($facebook) {
            Setting::where('key', 'facebook')->update(['value' => request('facebook')]);
        } else {
            Setting::insert(['key' => 'facebook', 'value' => request('facebook')]);
        }

        $twitter = Setting::where('key', 'twitter')->first();
        if ($twitter) {
            Setting::where('key', 'twitter')->update(['value' => request('twitter')]);
        } else {
            Setting::insert(['key' => 'twitter', 'value' => request('twitter')]);
        }

        $linkedin = Setting::where('key', 'linkedin')->first();
        if ($linkedin) {
            Setting::where('key', 'linkedin')->update(['value' => request('linkedin')]);
        } else {
            Setting::insert(['key' => 'linkedin', 'value' => request('linkedin')]);
        }

        $youtube = Setting::where('key', 'youtube')->first();
        if ($youtube) {
            Setting::where('key', 'youtube')->update(['value' => request('youtube')]);
        } else {
            Setting::insert(['key' => 'youtube', 'value' => request('youtube')]);
        }
        return redirect()->route('admin::settings')->with('success', 'updated');
    }

}
