<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//use DB;
//use App\Mail;
//
//
//// Load Models
use App\Applications\cadWebSupport\Models\cadWebEmail;


class importCadWebEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blanck:importCadWebEmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Cad Web emails to cad-wev-support db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        echo "hello";
        $box = new \App\Mail\imapReader("PBCEOCEXCH01.pbcgov.org",995,'kblanck@pbcgov.org', 'KBmb#17$');
        //$box = new imapReader("PBCEOCEXCH01.pbcgov.org",110,'kblanck@pbcgov.org', 'KBmb#17$');
        $box
            ->connect()
            ->fetchAllHeaders("{PBCEOCEXCH01.pbcgov.org:995/pop/ssl/novalidate-cert}INBOX")
        ;

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
            echo "Number of attachments : " . count($msg->attachments) . "<br />";
            foreach ($msg->attachments as $key => $attachment)
            {
                echo "\tAttachment " . ($key + 1) . " :<br />";
                echo "\t\tAttachment type : {$attachment->type}<br />";
                echo "\t\tContent type : {$attachment->mime}<br />";
                echo "\t\tFile name : {$attachment->name}<br />";
                echo "\t\tFile size : {$attachment->size}<br />";
            }
            echo "<br />";

            $fromAddress = $msg->fromaddress."@".$msg->fromhost;

            $date = explode(' ',$msg->date);
            $date1 = explode('/',$date[0]);
            $finalDate = $date1[2]."-".$date1[1]."-".$date1[0]." ".$date[1];

            $cadWebEmailSelect = new cadWebEmail;
            $cadWebEmailCheck = $cadWebEmailSelect::where('from', '=', $fromAddress)
                ->where('emailDate', '=', $finalDate)->get();



            //print_r($cadWebEmailCheck);

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
            }

            //dd($cadWebEmailCheck);

        }



    }
}
