<?php

namespace App\Mail\Projects;

use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentsMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $purchased_project;
    private $files;

    public function __construct(User $user, PurchasedProject $purchased_project, array $files)
    {
        $this->user = $user;
        $this->purchased_project = $purchased_project;
        $this->files = $files;
    }


    public function build()
    {
        $user = $this->user;
        $purchased_project = $this->purchased_project;
        $files = $this->files;

        return $this->view('mail.projects.documents', compact('user', 'purchased_project', 'files'));
    }
}
