<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Gender;
use App\Models\PostalCode;

class ContactController extends Controller
{
    public function index(){
        return view('index');
    }

    public function check(ContactRequest $request){
        $contact = $request->all();
        return view('check',compact('contact'));
    }

    public function send(Request $request){
        if($request->input('back') == 'back'){
            return redirect('/')->withInput();
        }
        $contact = $request->all();
        Contact::create($contact);
        return view('send');
    }

    public function search(){
        $Contacts = Contact::all();
        $Contacts = Contact::Paginate(10);
        $Genders = Gender::all();
        $Genders = Gender::Paginate(10);
        $data = [
            'Contacts'=>$Contacts,
            'Genders'=>$Genders,
        ];
        return view('management',$data);
    }

    public function search_post(Request $request){
        $data = $request->all();
        // 全て検索
        if($request->name && $request->gender_id && $request->first_created && $request->last_created && $request->email){
                $Contacts = Contact::where('first_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere('last_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere(DB::raw('CONCAT(first_name, last_name)'), 'LIKE BINARY', "%{$request->name}%")
                ->where('gender_id', $request->gender_id)
                ->WhereBetween("created_at", [$request->first_created, $request->last_created])
                ->Where('email', $request->email)
                ->paginate(10);
            $Genders = Gender::Paginate(10);
        // 名前以外、検索
        }elseif(!$request->name && $request->gender_id && $request->first_created && $request->last_created && $request->email){
            $Contacts = Contact::where('gender_id', $request->gender_id)
                ->WhereBetween("created_at", [$request->first_created, $request->last_created])
                ->Where('email', $request->email)
                ->paginate(10);
            $Genders = Gender::Paginate(10);
        // 性別以外、検索
        }elseif($request->name && !$request->gender_id && $request->first_created && $request->last_created && $request->email){
            $Contacts = Contact::where('first_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere('last_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere(DB::raw('CONCAT(first_name, last_name)'), 'LIKE BINARY', "%{$request->name}%")
                ->WhereBetween("created_at", [$request->first_created, $request->last_created])
                ->Where('email', $request->email)
                ->paginate(10);
            $Genders = Gender::Paginate(10);
        // メールアドレス以外、検索
        }elseif($request->name && $request->gender_id && $request->first_created && $request->last_created && !$request->email){
            $Contacts = Contact::where('first_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere('last_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere(DB::raw('CONCAT(first_name, last_name)'), 'LIKE BINARY', "%{$request->name}%")
                ->where('gender_id', $request->gender_id)
                ->WhereBetween("created_at", [$request->first_created, $request->last_created])
                ->paginate(10);
            $Genders = Gender::Paginate(10);
        // 名前のみ、検索
        }elseif($request->name && !$request->gender_id && $request->first_created && $request->last_created && !$request->email){
            $Contacts = Contact::where('first_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere('last_name', 'LIKE BINARY', "%{$request->name}%")
                ->orWhere(DB::raw('CONCAT(first_name, last_name)'), 'LIKE BINARY', "%{$request->name}%")
                ->WhereBetween("created_at", [$request->first_created, $request->last_created])
                ->paginate(10);
            $Genders = Gender::Paginate(10);
        // 性別のみ、検索
        }elseif(!$request->name && $request->gender_id && $request->first_created && $request->last_created && !$request->email){
            $Contacts = Contact::where('gender_id', $request->gender_id)
                ->WhereBetween("created_at", [$request->first_created, $request->last_created])
                ->paginate(10);
            $Genders = Gender::Paginate(10);
        // メールアドレスのみ、検索
        }elseif(!$request->name && !$request->gender_id && $request->first_created && $request->last_created && $request->email){
            $Contacts = Contact::WhereBetween("created_at", [$request->first_created, $request->last_created])
                ->Where('email', $request->email)
                ->paginate(10);
            $Genders = Gender::Paginate(10);
        }else{
            $Contacts = Contact::paginate(10);
            $Genders = Gender::Paginate(10);
        }

        $param = [
            'Contacts'=>$Contacts,
            'Genders'=>$Genders,
        ];

        return view('management',$param);
    }

    public function delete(Request $request){
        $delete_data = $request -> all();
        Contact::where('id', $request -> id)->delete();
        return redirect('/search');
    }
}