<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function addNewsletter(Request $request){
        $this->validate($request, [
            'email' => 'bail|required|unique:newsletters'
        ]);
        $add_newsletter = Newsletter::create([
            'email' => $request->email
        ]);
        if ($add_newsletter){
            return redirect()->back()->with('success', "Email Successfully added to the Newsletter Subscription list");
        }
        else{
            return redirect()->back()->with('failure', "Email could not be added");
        }
    }
}
