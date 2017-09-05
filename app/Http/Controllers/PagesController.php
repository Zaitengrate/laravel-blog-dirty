<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller {

  public function getIndex() {
      $posts = Post::latest()->limit(4)->get();
      return view('pages.welcome')->withPosts($posts);
  }

  public function getAbout() {
      $first = 'Alex';
      $last = 'Sherstnev';

      $fullname = $first . " " . $last;
      $email = 'zaitengrate199@gmail.com';
      $data = [];
      $data['email'] = $email;
      $data['fullname'] = $fullname;
      return view('pages.about')->withData($data);

  }

  public function getContact() {
      return view('pages.contact');
  }

  public function postContact(Request $request) {
      $this->validate($request, array(
          'email' => 'required|email',
          'subject' => 'min:3',
          'message' => 'min:10'
      ));

      $data = array(
          'email' => $request->email,
          'subject' => $request->subject,
          'bodyMessage' => $request->message
      );

      Mail::send('emails.contact', $data, function($message) use($data){
          $message->from($data['email']);
          $message->to('chuvak199@gmail.com');
          $message->subject($data['subject']);

          Session::flash('success', 'You successfuly send email');

          return redirect('/');
      });
  }

}
?>
