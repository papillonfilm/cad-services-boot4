<?php

namespace App\Applications\cadWebSupport\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Applications\cadWebSupport\Rules\ValidateUserForDelete;

use DB;
use Validator;
Use Session;
use App\Mail;


// Load Models
use App\Applications\cadWebSupport\Models\cadEmailTemplate;
use App\Applications\cadWebSupport\Models\cadWebEmail;

class cadWebSupportController extends Controller{ 

	public function __construct(){

	}


    public function index(){
        //Main page for cad-web support

        //unset session variables
//        if(Session::has('loadCadEmailVars')) {
//            Session::forget('loadCadEmailVars');
//        }
//
        Session::forget('loadCadEmailVars');
        Session::forget('cadFrom');
        Session::forget('cadName');
        Session::forget('cadCc');
        Session::forget('cadSubject');
        Session::forget('cadBodyText');

        return view('cadWebSupport::cadIndex');



    }


    public function findAccount(){
        //find account for delete

        return view('cadWebSupport::deleteAccount/findAccount');



    }


    public function listAccount(Request $request){
        //list account for delete

        //echo "listAccount";

        //validate fields


        $this->validate($request, [
            'userId' => [
                //'sometimes','nullable','numeric',
                new ValidateUserForDelete($request->input('barNum'), $request->input('email'), 'User Id', 'numeric')
            ],
            'barNum' => [
                'sometimes','nullable','numeric'
            ],
            'email' => [
                'sometimes','nullable','email'
            ]
        ]);

//        $validator = Validator::make(
//            $request->All()
//            ,[
//            'userId'=> new ValidateUserForDelete($request->input('barNum'), $request->input('email'), 'User Id', 'numeric'),
//            'barNum'=>'sometimes','nullable','numeric',
//            'email'=>'sometimes','nullable','email'
//        ] )->validate();


        $users = array();
        //lookup by user id

//        $users = Users::orderBy('user_id')->get() ;
//        $users = Users::where('user_id','=','24564')->get();

        if (!empty($request->userId)) {
            $users1 = DB::connection('mysqlols')->table('users')->
            join('email_addresses','email_addresses.email_addr_id','users.login_id')->
            join('law_firms','law_firms.lawfirm_id','users.lawfirm_id')->
            select('users.user_id', 'users.bar_num', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.login_id',
                'email_addresses.email_addr','email_addresses.email_addr_id','law_firms.lawfirm_name')->
            //where('user_id','=','24549')->get();
            where('users.user_id','=',$request->userId)->get();
        }

        //lookup by bar num
        if (!empty($request->barNum)) {
            $users2 = DB::connection('mysqlols')->table('users')->
            join('email_addresses','email_addresses.email_addr_id','users.login_id')->
            join('law_firms','law_firms.lawfirm_id','users.lawfirm_id')->
            select('users.user_id', 'users.bar_num', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.login_id',
                'email_addresses.email_addr','email_addresses.email_addr_id','law_firms.lawfirm_name')->
            //where('user_id','=','24549')->get();
            where('users.bar_num','=',$request->barNum)->get();
        }

        //lookup by email
        if (!empty($request->email)) {
            $users3 = DB::connection('mysqlols')->table('users')->
            join('email_addresses','email_addresses.email_addr_id','users.login_id')->
            join('law_firms','law_firms.lawfirm_id','users.lawfirm_id')->
            select('users.user_id', 'users.bar_num', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.login_id',
                'email_addresses.email_addr','email_addresses.email_addr_id','law_firms.lawfirm_name')->
            //where('user_id','=','24549')->get();
            where('email_addresses.email_addr','=',$request->email)->get();
        }

        $users = array();
        $i = 0;
        if (isset($users1)) {
             foreach ($users1 as $user1) {
                 $users[$i] = $user1;
                 $i++;
             }
        }

        if (isset($users2)) {
            foreach ($users2 as $user2) {
                $users[$i] = $user2;
                $i++;
            }
        }


        if (isset($users3)) {
            foreach ($users3 as $user3) {
                $users[$i] = $user3;
                $i++;

            }
        }
        //compare records to see if multiple - instead list all


        return view('cadWebSupport::deleteAccount/listAccount', ['users'=>$users,'userId'=>$request->userId,'barNum'=>$request->barNum,'email'=>$request->email]);

    }

    //
    public function deleteAccountEmail($id, $loginId){
        //display email sending for delete

        //echo "selectEmailTemplate";

//        if (Session::has('email')) {
//            echo Session::get('email');
//        }

        $cadFrom = "";
        $cadName = "";
        $cadCc = "";
        $cadSubject = "";
        $cadBodyText = "";

        $check = Session::get('loadCadEmailVars');

        if ($check == 'Y') {
            $cadFrom = Session::get('cadFrom');
            $cadName = Session::get('cadName');
            $cadCc = Session::get('cadCc');
            $cadSubject = Session::get('cadSubject');
            $cadBodyText = Session::get('cadBodyText');
        }

        //get delete email template
        $cadEmailTemplate = cadEmailTemplate::find(1);

        $message = "";
        if (!empty($cadName)) {
            $message .= $cadName.', <br /><br />';
        }
//        $message .= 'In a case like this, we need to reset the account so you can re-register with your new email address.';
//        $message .= ' Since you wrote from the same email domain as what you have registered with the Florida Bar, we have';
//        $message .= ' reset your account. You can now re-register with your new email address.';
//        $message .= ' <br /><br />Thank you';
//        $message .= ' <br /><br /><strong>How do I Register?</strong>';
//        $message .= ' <br /><br />';
//        $message .= ' <ol>';
//        $message .= ' <li>From https://e-services.co.palm-beach.fl.us/scheduling/login.php:</li>';
//        $message .= ' <li>Click on "Register a New User".</li>';
//        $message .= ' <li>Fill out the information and click Submit.</li>';
//        $message .= ' <li>You will get an email message to with a confirmation number.</li>';
//        $message .= ' <li>Go Back to  https://e-services.co.palm-beach.fl.us/scheduling/login.php:</li>';
//        $message .= ' <li>Click "Confirm and Activate Account."</li>';
//        $message .= ' <li>Enter the email address you created account with, the confirmation number you received it the
//                             confirmation email and the password you created.  </li>';
//        $message .= ' <li>Click “Confirm Account.”</li>';
//        $message .= ' </ol>';

        //$message .= $cadBodyText;

        $cadEmailTemplate->emailTemplate = $message .= $cadEmailTemplate->emailTemplate;

        //TODO: what to do here?
//        if(!$cadEmailTemplate){
//            return redirect()->route('templateIndex')->with('alert-error','Template not found.');
//        }

        //dd($emailTemplate);

        return view('cadWebSupport::deleteAccount/deleteAccountEmail')->with('cadEmailTemplate', $cadEmailTemplate)
            ->with('cadFrom', $cadFrom)
            ->with('cadName', $cadName)
            ->with('cadCc', $cadCc)
            ->with('cadSubject', $cadSubject)
            ->with('cadBodyText', $cadBodyText)
            ->with('userId', $id)
            ->with('loginId', $loginId);





    }



    public function deleteAccount(Request $request){
        //reset account and send confirmation email

        //echo "deleteAccount";

        //dd($request);

        $validator = Validator::make(
            $request->All()
            ,[
            'respondToEmail'=> 'required','email',
            'respondToName'=>'required',
            'subject'=>'required',
            'userId'=>'required','numeric',
            'loginId'=>'required','numeric'
        ] )->validate();


//        echo "u - ".$request->formUserId."<br>";
//        echo "eid - ".$request->formLoginId."<br>";
//        echo "e - ".$request->formEmail."<br>";
//        echo "n - ".$request->formName."<br>";

        $userId = $request->userId;
        $emailId = $request->loginId;

        $respondToEmail = $request->respondToEmail;
        $name = $request->respondToName;


//        # Make it a transaction.
//        $dbh->{AutoCommit} = 0;

        // First, we need to delete from confirmations, password_resets, secondary_emails
        // and default_addresses.
        $tables = array("confirmations","case_emails","password_resets","secondary_emails","default_addresses");
        foreach ($tables as $table) {
            DB::connection('mysqlols')->table($table)->
            where('user_id', '=', $userId)->
            delete();
        }

        // Remove any case emails, default addresses or secondary emails that reference this account
        $tables = array("case_emails","secondary_emails","default_addresses");
        foreach ($tables as $table) {
            DB::connection('mysqlols')->table($table)->
            where('email_addr_id', '=', $emailId)->
            delete();
        }


        // And then disable the account
        DB::connection('mysqlols')->table('users')->
        where('user_id', '=', $userId)->
        update(['user_type' => 2, 'bar_num' => null, 'disabled' => 1]);


        //send email
        $email = $respondToEmail;
        $subject = "Account Reset";
        $subject = $request->subject;

//        $message = "";
//        if (!empty($name)) {
//            $message .= $name.', <br /><br />';
//        }
//        $message .= 'In a case like this, we need to reset the account so you can re-register with your new email address.';
//        $message .= ' Since you wrote from the same email domain as what you have registered with the Florida Bar, we have';
//        $message .= ' reset your account. You can now re-register with your new email address.';
//        $message .= ' <br /><br />Thank you';
//        $message .= ' <br /><br /><strong>How do I Register?</strong>';
//        $message .= ' <br /><br />';
//        $message .= ' <ol>';
//        $message .= ' <li>From https://e-services.co.palm-beach.fl.us/scheduling/login.php:</li>';
//        $message .= ' <li>Click on "Register a New User".</li>';
//        $message .= ' <li>Fill out the information and click Submit.</li>';
//        $message .= ' <li>You will get an email message to with a confirmation number.</li>';
//        $message .= ' <li>Go Back to  https://e-services.co.palm-beach.fl.us/scheduling/login.php:</li>';
//        $message .= ' <li>Click "Confirm and Activate Account."</li>';
//        $message .= ' <li>Enter the email address you created account with, the confirmation number you received it the
//                             confirmation email and the password you created.  </li>';
//        $message .= ' <li>Click “Confirm Account.”</li>';
//        $message .= ' </ol>';

        $message = $request->emailTemplate.$request->cadBodyText;

        $fromAddress = "cad-web@pbcgov.org";

        $emailVals = array(
            'to'=>$email,
            'subject'=>$subject,
            'msg'=>$message,
            'fromAddress'=>$fromAddress
        );

        sendEmail($emailVals);

        logAction('Account deleted [ ' .$userId . ' ]',9 );

        //send success message
        $request->session()->flash('alert-success', 'Account successfully deleted.');
        return redirect()->route('cadWebSupport');


    }

    public function deleteAccountOld(Request $request){
        //reset account and send confirmation email

        //echo "deleteAccount";

        //dd($request);

//        echo "u - ".$request->formUserId."<br>";
//        echo "eid - ".$request->formLoginId."<br>";
//        echo "e - ".$request->formEmail."<br>";
//        echo "n - ".$request->formName."<br>";

        $userId = $request->formUserId;
        $emailId = $request->formLoginId;
        $respondToEmail = $request->formEmail;
        $name = $request->formName;


//        # Make it a transaction.
//        $dbh->{AutoCommit} = 0;

        // First, we need to delete from confirmations, password_resets, secondary_emails
        // and default_addresses.
        $tables = array("confirmations","case_emails","password_resets","secondary_emails","default_addresses");
        foreach ($tables as $table) {
            DB::connection('mysqlols')->table($table)->
            where('user_id', '=', $userId)->
            delete();
        }

        // Remove any case emails, default addresses or secondary emails that reference this account
        $tables = array("case_emails","secondary_emails","default_addresses");
        foreach ($tables as $table) {
            DB::connection('mysqlols')->table($table)->
            where('email_addr_id', '=', $emailId)->
            delete();
        }


        // And then disable the account
        DB::connection('mysqlols')->table('users')->
        where('user_id', '=', $userId)->
        update(['user_type' => 2, 'bar_num' => null, 'disabled' => 1]);


        //send email
        $email = $respondToEmail;
        $subject = "Account Reset";
        $message = "";
        if (!empty($name)) {
            $message .= $name.', <br /><br />';
        }
        $message .= 'In a case like this, we need to reset the account so you can re-register with your new email address.';
        $message .= ' Since you wrote from the same email domain as what you have registered with the Florida Bar, we have';
        $message .= ' reset your account. You can now re-register with your new email address.';
        $message .= ' <br /><br />Thank you';
        $message .= ' <br /><br /><strong>How do I Register?</strong>';
        $message .= ' <br /><br />';
        $message .= ' <ol>';
        $message .= ' <li>From https://e-services.co.palm-beach.fl.us/scheduling/login.php:</li>';
        $message .= ' <li>Click on "Register a New User".</li>';
        $message .= ' <li>Fill out the information and click Submit.</li>';
        $message .= ' <li>You will get an email message to with a confirmation number.</li>';
        $message .= ' <li>Go Back to  https://e-services.co.palm-beach.fl.us/scheduling/login.php:</li>';
        $message .= ' <li>Click "Confirm and Activate Account."</li>';
        $message .= ' <li>Enter the email address you created account with, the confirmation number you received it the
                             confirmation email and the password you created.  </li>';
        $message .= ' <li>Click “Confirm Account.”</li>';
        $message .= ' </ol>';



        $fromAddress = "cad-web@pbcgov.org";

        $emailVals = array(
            'to'=>$email,
            'subject'=>$subject,
            'msg'=>$message,
            'fromAddress'=>$fromAddress
        );

        sendEmail($emailVals);

        logAction('Account deleted [ ' .$userId . ' ]',9 );

        //send success message
        $request->session()->flash('alert-success', 'Account successfully deleted.');
        return redirect()->route('cadWebSupport');


    }



    public function findAccountRP(){
        //finf account for reset password

        return view('cadWebSupport::resetPassword/findAccount');

    }

    public function listAccountRPPost(Request $request){
        //list user account for selection

        //echo "listAccount";

        //dd($request);

        //validate fields
        $validator = Validator::make(
            $request->All()
            ,[
            'email'=>'sometimes','nullable','email'
        ] )->validate();


        $cadFrom = Session::get('cadFrom');

        $users = array();

        //lookup by email
        if (!empty($request->email)) {
            $users = DB::connection('mysqlols')->table('users')->
            join('email_addresses','email_addresses.email_addr_id','users.login_id')->
            join('law_firms','law_firms.lawfirm_id','users.lawfirm_id')->
            select('users.user_id', 'users.bar_num', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.login_id',
                'email_addresses.email_addr','email_addresses.email_addr_id','law_firms.lawfirm_name')->
            //where('user_id','=','24549')->get();
            where('email_addresses.email_addr','=',$request->email)->get();
        }


        return view('cadWebSupport::resetPassword/listAccount', ['users'=>$users,'email'=>$request->email]);


    }
    public function listAccountRP(){
        //list user account for selection

        //echo "listAccount";

        //dd($request);

        //validate fields
//        $validator = Validator::make(
//            $request->All()
//            ,[
//            'email'=>'sometimes','nullable','email'
//        ] )->validate();


        $cadFrom = Session::get('cadFrom');

        $users = array();

        //lookup by email
        if (!empty($cadFrom)) {
            $users = DB::connection('mysqlols')->table('users')->
            join('email_addresses','email_addresses.email_addr_id','users.login_id')->
            join('law_firms','law_firms.lawfirm_id','users.lawfirm_id')->
            select('users.user_id', 'users.bar_num', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.login_id',
                'email_addresses.email_addr','email_addresses.email_addr_id','law_firms.lawfirm_name')->
            //where('user_id','=','24549')->get();
            where('email_addresses.email_addr','=',$cadFrom)->get();
        }


        return view('cadWebSupport::resetPassword/listAccount', ['users'=>$users,'email'=>$cadFrom]);


    }


    public function listAccountRPOld(Request $request){
        //list user account for selection

        //echo "listAccount";

        //dd($request);

        //validate fields
        $validator = Validator::make(
            $request->All()
            ,[
            'email'=>'sometimes','nullable','email'
        ] )->validate();


        $users = array();

        //lookup by email
        if (!empty($request->email)) {
            $users = DB::connection('mysqlols')->table('users')->
            join('email_addresses','email_addresses.email_addr_id','users.login_id')->
            join('law_firms','law_firms.lawfirm_id','users.lawfirm_id')->
            select('users.user_id', 'users.bar_num', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.login_id',
                'email_addresses.email_addr','email_addresses.email_addr_id','law_firms.lawfirm_name')->
            //where('user_id','=','24549')->get();
            where('email_addresses.email_addr','=',$request->email)->get();
        }


        return view('cadWebSupport::resetPassword/listAccount', ['users'=>$users,'email'=>$request->email]);


    }


    public function resetAccountEmail($id, $loginId){
        //display email for resetting password. Cannot display password message since it will have new password created in resetAccountPassword

        //echo "selectEmailTemplate";

//        if (Session::has('email')) {
//            echo Session::get('email');
//        }

        $cadFrom = "";
        $cadName = "";
        $cadCc = "";
        $cadSubject = "";
        $cadBodyText = "";

        $check = Session::get('loadCadEmailVars');

        if ($check == 'Y') {
            $cadFrom = Session::get('cadFrom');
            $cadName = Session::get('cadName');
            $cadCc = Session::get('cadCc');
            $cadSubject = Session::get('cadSubject');
            $cadBodyText = Session::get('cadBodyText');
        }

        $cadEmailTemplate = cadEmailTemplate::find(2);


        //TODO: what to do here?
//        if(!$cadEmailTemplate){
//            return redirect()->route('templateIndex')->with('alert-error','Template not found.');
//        }

        //dd($emailTemplate);

        return view('cadWebSupport::resetPassword/resetPwEmail')->with('cadEmailTemplate', $cadEmailTemplate)
            ->with('cadFrom', $cadFrom)
            ->with('cadName', $cadName)
            ->with('cadCc', $cadCc)
            ->with('cadSubject', $cadSubject)
            ->with('cadBodyText', $cadBodyText)
            ->with('userId', $id)
            ->with('loginId', $loginId);


    }



    public function resetAccountPassword(Request $request){
        //reset password and send new password in email

//        echo "updateAccountPassword";

        //dd($request);
//        echo "p ".$request->formUserId."<br/>";
//        echo "n ".$request->formName."<br/>";
//        echo "e ".$request->formEmail;

        $validator = Validator::make(
            $request->All()
            ,[
            'respondToEmail'=> 'required','email',
            'respondToName'=>'required',
            'subject'=>'required',
            'emailTemplate'=>'required',
            'userId'=>'required','numeric',
            'loginId'=>'required','numeric'
        ] )->validate();


        $userId = $request->userId;
        $emailId = $request->loginId;


        //get new password - random 8 digits
        $newPassword = rand(10000000,99999999);
        $newPasswordEnc = base64_encode(sha1($newPassword, true));


////        # Make it a transaction.
////        $dbh->{AutoCommit} = 0;


        // reset the password
        DB::connection('mysqlols')->table('users')->
        where('user_id', '=', $userId)->
        update(['password' => $newPasswordEnc, 'pw_reset_required' => 1, 'confirmed' => 1]);


        //send email
        $email = $request->respondToEmail;
        $name = $request->respondToName;
        //$subject = "Account Reset";
        $subject = $request->subject;
        $message = "";
        if (!empty($name)) {
            $message .= $name.', <br /><br />';
        }
//        $message .= 'Since you wrote to us from the registered email address on your account,';
//        $message .= ' we have reset your password to a temporary password.';
//        $message .= ' The temporary password is: '.$newPassword;
//        $message .= ' You can log on with your email address and this temporary password';
//        $message .= ' and you will be prompted to change it when you log on.';
//        $message .= ' <br /><br />Thank you';


        $request->emailTemplate = preg_replace("/{newPassword}/", $newPassword, $request->emailTemplate);
        $message .= $request->emailTemplate.$request->cadBodyText;

        //dd($message);

        $fromAddress = "cad-web@pbcgov.org";

        $emailVals = array(
            'to'=>$email,
            'subject'=>$subject,
            'msg'=>$message,
            'fromAddress'=>$fromAddress
        );

        sendEmail($emailVals);

        logAction('Account password reset [ ' .$userId . ' ]',9 );

        //send success message
        $request->session()->flash('alert-success', 'Account successfully deleted.');
        return redirect()->route('cadWebSupport');


    }

    public function templateIndex(){
        //list email templates


        //unset session variables
//        Session::forget('cadFrom');
//        Session::forget('cadName');
//        Session::forget('cadCc');
//        Session::forget('cadSubject');
//        Session::forget('cadBodyText');

        $emailTemplates = cadEmailTemplate::get();

        //dd($emailTemplates);


        return view('cadWebSupport::emailTemplates/emailTemplateIndex', ['emailTemplates'=>$emailTemplates]);



    }



    public function createEmailTemplate(){
        //form for creating email template


        //echo "createEmailTemplate";

        //dd($emailTemplates);


        return view('cadWebSupport::emailTemplates/createEmailTemplate');



    }
    public function insertEmailTemplate(Request $request){
        //insert email template to db


        //echo "createEmailTemplate";

        $validator = Validator::make(
            $request->All()
            ,[
            'title'=>'required',
            'emailTemplate'=>'required'
        ] )->validate();


//        $cadEmailTemplate = new cadEmailTemplate([
//            'title' => $request->input('title'),
//            'emailTemplate' => $request->input('emailTemplate'),
//        ]);
//        $cadEmailTemplate->save();

        $cadEmailTemplate = new cadEmailTemplate;
        $cadEmailTemplate->title = $request->title;
        $cadEmailTemplate->emailTemplate = $request->emailTemplate;
        $cadEmailTemplate->save();

        logAction('Email template created [ ' .$cadEmailTemplate->id . ' ]',9 );

        $request->session()->flash('alert-success', 'Email Template successfully added.');
        return redirect()->route('templateIndex');



    }

    public function editEmailTemplate($id){
        //form to display single email template

        //echo "editEmailTemplate ".$id;

        $cadEmailTemplate = cadEmailTemplate::find($id);
        if(!$cadEmailTemplate){
            return redirect()->route('templateIndex')->with('alert-error','Template not found.');
        }

        //dd($emailTemplate);

        return view('cadWebSupport::emailTemplates/editEmailTemplate')->with('cadEmailTemplate', $cadEmailTemplate);


    }

    public function updateEmailTemplate(Request $request){
        //update email template in db


        //echo "createEmailTemplate ".$id;

        //dd($request);

        $validator = Validator::make(
            $request->All()
            ,[
            'title'=>'required',
            'emailTemplate'=>'required'
        ] )->validate();


//        $cadEmailTemplate = new cadEmailTemplate([
//            'title' => $request->input('title'),
//            'emailTemplate' => $request->input('emailTemplate'),
//        ]);
//        $cadEmailTemplate->save();

        $cadEmailTemplate = cadEmailTemplate::find($request->id);
        if(!$cadEmailTemplate){
            return redirect()->route('templateIndex')->with('alert-error','Template not found.');
        }
        $cadEmailTemplate->title = $request->title;
        $cadEmailTemplate->emailTemplate = $request->emailTemplate;
        $cadEmailTemplate->update();

        logAction('Email Template updated [ ' .$request->id . ' ]',9 );
        $request->session()->flash('alert-success', 'Email Template successfully updated.');
        return redirect()->route('templateIndex');



    }


    public function selectEmailTemplate($id){
        //form to display selected email template to send email

        //echo "selectEmailTemplate";

//        if (Session::has('email')) {
//            echo Session::get('email');
//        }

        $cadFrom = "";
        $cadName = "";
        $cadCc = "";
        $cadSubject = "";
        $cadBodyText = "";

        $check = Session::get('loadCadEmailVars');

        if ($check == 'Y') {
            $cadFrom = Session::get('cadFrom');
            $cadName = Session::get('cadName');
            $cadCc = Session::get('cadCc');
            $cadSubject = Session::get('cadSubject');
            $cadBodyText = Session::get('cadBodyText');
        }

        $cadEmailTemplate = cadEmailTemplate::find($id);

        //$cadEmailTemplate->emailTemplate = html_entity_decode($cadEmailTemplate->emailTemplate);

        //$cadEmailTemplate->emailTemplate .= $cadBodyText;

        if(!$cadEmailTemplate){
            return redirect()->route('templateIndex')->with('alert-error','Template not found.');
        }

        //dd($emailTemplate);

        return view('cadWebSupport::emailTemplates/selectEmailTemplate')->with('cadEmailTemplate', $cadEmailTemplate)
            ->with('cadFrom', $cadFrom)
            ->with('cadName', $cadName)
            ->with('cadCc', $cadCc)
            ->with('cadSubject', $cadSubject)
            ->with('cadBodyText', $cadBodyText);


    }

    public function sendEmailTemplate(Request $request){
        //send email template

        //echo "selectEmailTemplate";

        $validator = Validator::make(
            $request->All()
            ,[
            'respondToEmail'=>'required|email',
            'respondToName'=>'required',
            'subject'=>'required',
            'title'=>'required',
            'emailTemplate'=>'required'
        ] )->validate();

        //send email
        $email = $request->respondToEmail;

        //$email = array("kblanck@pbcgov.org", "kenblanck@comcast.net");
        //$email = ['kblanck@pbcgov.org', 'kenblanck@comcast.net'];
        //$email = 'kblanck@pbcgov.org';
        $subject = $request->subject;
        $message = "";
        if (!empty($request->respondToName)) {
            $message .= $request->respondToName.', <br /><br />';
        }
        $message .= $request->emailTemplate.$request->cadBodyText;

        $fromAddress = "cad-web@pbcgov.org";
        //$ccAddress = ['kenblanck@comcast.net', 'kenblanck@gmail.com'];
        //$ccAddress = 'kenblanck@comcast.net';

        $emailVals = array(
            'to'=>$email,
            'subject'=>$subject,
            'msg'=>$message,
            'fromAddress'=>$fromAddress,
            //'ccAddress'=>$ccAddress
        );

        sendEmail($emailVals);

        //unset session variables
//        $cadFrom = Session::get('cadFrom');
//        $cadName = Session::get('cadName');
//        $cadCc = Session::get('cadCc');
//        $cadSubject = Session::get('cadSubject');
//        $cadBodyText = Session::get('cadBodyText');

        //send success message
        $request->session()->flash('alert-success', 'Mail successfully sent.');
        return redirect()->route('templateIndex');


    }



    public function cadEmailIndex(){
        //list of cad-web emails


        $cadEmails = cadWebEmail::get();

        //dd($emailTemplates);


        return view('cadWebSupport::cadEmails/cadEmailIndex', ['cadEmails'=>$cadEmails]);



    }


    public function selectCadEmail($id){
        //display selected cad-web email

        //echo "selectEmailTemplate";

        $cadEmail = cadWebEmail::find($id);
        if(!$cadEmail){
            return redirect()->route('cadEmailIndex')->with('alert-error','Email not found.');
        }


        $attachments = array();
        $i= 0;

        $dir = "/var/www/html/kenlaraveldev/public/attachments/cadwebservices/". $id."/";
        echo $dir;
        if (is_dir($dir)){
            $ignoreList = array('.', '..');
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
//                    //echo "Filename: ".$file;
//                    //$pos = strpos($file, $id);
//                    //echo "pos ".$pos;
//                    //if ($pos === false) {
//                    //} else {
//                        echo "The string '$id' was found in the string '$file'";
//                        $attachments[$i]['dir'] = "/attachments/".$file;
//                        $attachments[$i]['filename'] = $file;
//                        $i++;
//
//                    //}
                    echo "Filename: ".$file;
                    $pos = strpos($file, $id);
                    echo "pos ".$pos;
                    if (!in_array($file, $ignoreList)) {
                        echo "The string '$id' was found in the string '$file'";
                        $attachments[$i]['dir'] = "/attachments/cadwebservices/". $id."/".$file;
                        $attachments[$i]['filename'] = $file;
                        $i++;

                    }
                }
                closedir($dh);
            }
        }



        return view('cadWebSupport::cadEmails/selectCadEmail')->with('cadEmail', $cadEmail)
            ->with('attachments', $attachments);


    }

    public function processCadEmailTemplate(Request $request){
        //load cad-web session variables prior to selecting email template email

        //dd($request);
        if(isset($request->cadFrom)) {
            //session(['cadFrom' => $request->cadFrom]);
            //Session::put('cadFrom', $request->cadFrom);
            Session(['cadFrom' => $request->cadFrom]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadName' => $request->cadName]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadCc' => $request->cadCc]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadSubject' => $request->cadSubject]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadBodyText' => "<br /><br />".$request->cadBodyText]);
        }

        session(['loadCadEmailVars' => 'Y']);



        $emailTemplates = cadEmailTemplate::get();

        //dd($emailTemplates);


        return view('cadWebSupport::emailTemplates/emailTemplateIndex', ['emailTemplates'=>$emailTemplates]);



    }

    public function processCadEmailDelete(Request $request){
        //load cad-web session variables prior to deleting account

        //dd($request);
        if(isset($request->cadFrom)) {
            //session(['cadFrom' => $request->cadFrom]);
            //Session::put('cadFrom', $request->cadFrom);
            Session(['cadFrom' => $request->cadFrom]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadName' => $request->cadName]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadCc' => $request->cadCc]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadSubject' => $request->cadSubject]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadBodyText' => "<br /><br />".$request->cadBodyText]);
        }

        session(['loadCadEmailVars' => 'Y']);


        //dd($emailTemplates);


        return view('cadWebSupport::deleteAccount/findAccount');



    }

    public function processCadEmailRP(Request $request){
        //load cad-web session variables prior to restting password

        //dd($request);
        if(isset($request->cadFrom)) {
            //session(['cadFrom' => $request->cadFrom]);
            //Session::put('cadFrom', $request->cadFrom);
            Session(['cadFrom' => $request->cadFrom]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadName' => $request->cadName]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadCc' => $request->cadCc]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadSubject' => $request->cadSubject]);
        }
        if(isset($request->cadFrom)) {
            Session(['cadBodyText' => "<br /><br />".$request->cadBodyText]);
        }

        session(['loadCadEmailVars' => 'Y']);



        $emailTemplates = cadEmailTemplate::get();

        //dd($request->cadFrom);


        //return view('cadWebSupport::resetPassword/listAccountRP');

        return redirect()->route('listAccountRP');





    }

    public function docIndex(){
        //list of documentation



        return view('cadWebSupport::cadIndex');



    }


    public function getEmails(){
        //import cad-web emails

        $box = new \App\Mail\imapReader("PBCEOCEXCH01.pbcgov.org",995,'kblanck@pbcgov.org', '');
        //$box = new imapReader("PBCEOCEXCH01.pbcgov.org",110,'kblanck@pbcgov.org', 'KBmb#17$');
        $box
            ->connect()
            ->fetchAllHeaders("{PBCEOCEXCH01.pbcgov.org:995/pop/ssl/novalidate-cert}INBOX")
        ;

//        $box = new \App\Mail\imapReader("imap.gmail.com",993,'kenblanck@gmail.com', 'P&lmb3ach');
//        //$box = new imapReader("PBCEOCEXCH01.pbcgov.org",110,'kblanck@pbcgov.org', 'KBmb#17$');
//        $box
//            ->connect();
//            ->fetchAllHeaders("imap.gmail.com:993/imap/ssl}INBOX")
//        ;
//
        echo $box->count() . " emails in mailbox<br /><br />";
        for ($i = 0; ($i < $box->count()); $i++)
        {
            $msg = $box->get($i);
            //print_r($msg);
            echo "Reception date : {$msg->date}<br />";
            echo "From : {$msg->from}<br />";
            echo "To : {$msg->to}<br />";
            echo "From Address : {$msg->fromaddress}<br />";
            echo "From Host : {$msg->fromhost}<br />";
            echo "CC Address : {$msg->ccaddress}<br />";
            echo "CC Host : {$msg->cchost}<br />";
            echo "Subject : {$msg->subject}<br />";
            $msg = $box->fetch($msg);
            echo "Number of readable contents : " . count($msg->content) . "<br />";
            $message = "";
            foreach ($msg->content as $key => $content)
            {
                echo "\tContent  " . ($key + 1) . " :<br />";
                echo "\t\tContent type : {$content->mime}<br />";
                echo "\t\tContent charset : {$content->charset}<br />";
                echo "\t\tContent size : {$content->size}<br />";
                echo "\t\tContent data : {$content->data}<br />";

                $message .= $content->data."<br />";
            }

            //echo $attachment."<br />";
            echo "<br />";

            $fromAddress = $msg->fromaddress."@".$msg->fromhost;

            $date = explode(' ',$msg->date);
            $date1 = explode('/',$date[0]);
            $finalDate = $date1[2]."-".$date1[1]."-".$date1[0]." ".$date[1];

            $cadWebEmailSelect = new cadWebEmail;
            $cadWebEmailCheck = $cadWebEmailSelect::where('from', '=', $fromAddress)
                ->where('emailDate', '=', $finalDate)->get();



            //print_r($cadWebEmailCheck);
            $lastInsertId = "";
            if(count($cadWebEmailCheck) < 1) {
                $cadWebEmail = new cadWebEmail;
                $cadWebEmail->from = $fromAddress;
                $cadWebEmail->to = $msg->to;
                $cadWebEmail->name = $msg->from;
                $cadWebEmail->cc = !empty($msg->ccaddress) ? ($msg->ccaddress . "@" . $msg->cchost) : ('');
                $cadWebEmail->subject = $msg->subject;
                $cadWebEmail->emailDate = $finalDate;
                $cadWebEmail->bodyText = $message;
                $cadWebEmail->save();
                $lastInsertId = $cadWebEmail->id;

                echo "Number of attachments : " . count($msg->attachments) . "<br />";
                $attachment = "";
                foreach ($msg->attachments as $key => $attachment)
                {

                    //print_r($attachment);
                    echo "\tAttachment " . ($key + 1) . " :<br />";
                    echo "\t\tAttachment type : {$attachment->type}<br />";
                    echo "\t\tContent type : {$attachment->mime}<br />";
                    echo "\t\tFile name : {$attachment->name}<br />";
                    echo "\t\tFile size : {$attachment->size}<br />";

                    //added for downloading attachments
                    $filename = $attachment->name;

                    if(empty($filename)) $filename = time() . ".dat";
                    //works
                    $folder = "/var/www/html/kenlaraveldev/public/attachments/cadwebservices/". $lastInsertId;
                    //dd($folder);

                    if(!is_dir($folder))
                    {
                        mkdir($folder);
                    }
                    //echo "folder ".$folder;
                    $fp = fopen($folder ."/". ($key + 1) . "-" . $filename, "w+");


                    fwrite($fp, $attachment->attachment['attachment']);
                    fclose($fp);


                    //write to cadwebemailattachments
                    //write record for each attachment with id, cadwebemailId and filename - ($key + 1) . "-" . $filename

                }

            }




//            $move = "INBOX/processed";
//            echo "trying to move:" . 1 . "<br>";
//            imap_mail_move($box(), 1, $move);

            //dd($cadWebEmailCheck);

        }



//
//        echo "Searching '*Ken*' ...<br />";
//        $results = $box->searchBy('*Ken*', imapReader::FROM);
//        foreach ($results as $result)
//        {
//            echo "\tMatched: {$result->from} - {$result->date} - {$result->subject}<br />";
//        }
//



    }



    public function getEmailsOld(){
        //import cad-web emails

        //for testing

        echo "getEmails";

        $user   = 'kblanck@pbcgov.org';
        $pass   = 'KBmb#17$';

        //$mbox = imap_open("{webmail.pbcgov.org:585}", $user, $pass);
        //$mbox = imap_open("{webmail.pbcgov.org:993/imap/ssl/novalidate-cert}", $user, $pass);

        //works on desktop
        //$mbox = imap_open ("{PBCEOCEXCH01.pbcgov.org:110/pop3}INBOX", $user, $pass);

        //works on ken test
        $mbox = imap_open("{PBCEOCEXCH01.pbcgov.org:995/pop/ssl/novalidate-cert}INBOX",  $user, $pass);


        $count = 0;
        $emails = imap_search($mbox,'ALL');
        if($emails)
        {
            $output = '';

            //rsort($emails);

            foreach($emails as $email_number) {
                $header = imap_headerinfo($mbox, $email_number);
                //$headerparse = imap_rfc822_parse_headers($header);
                print_r($header);
                echo "<br /><br /><br />";
                $fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                $overview = imap_fetch_overview($mbox, $email_number, 0);
                $subject = $overview[0]->subject . "<BR>";
                //$cc = $header->cc[0]->mailbox . "@" . $header->cc[0]->host;
                $replyto=$header->reply_to[0]->mailbox."@".$header->reply_to[0]->host;
                $datetime=date("Y-m-d H:i:s",$header->udate);

                echo "from" .$fromaddr."<br />";
                echo "Subject ".$subject."<br />";
                echo "reply to ".$replyto."<br />";
                //echo "cc ".$cc."<br />";
                echo "date ".$datetime."<br />";

                //get message body
                $message = quoted_printable_decode(imap_fetchbody($mbox,$email_number,1.1));
                if($message == '')
                {
                    $message = quoted_printable_decode(imap_fetchbody($mbox,$email_number,1));

                }
                echo $message."<br />";
                echo "<br /><br /><br />";

                $count++;
            }
        }
        echo "Count ".$count;



        imap_close($mbox);
        //return view('cadWebSupport::cadIndex');



    }

}
