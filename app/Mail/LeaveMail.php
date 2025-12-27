<?php

namespace App\Mail;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $employee_code;
    public $employee_name;
    public $employee_id;
    public $start_date;
    public $end_date;
    public $total_days;
    public $attachment = [];
    public $name_bos;
    public $date_approve;
    public $status;
    public $email_atasan;
    public $id;
    public function __construct($employee_id, $start_date, $end_date, $total_days, $attachment, $email_atasan, $id)
    {
        $employee = Employee::findOrFail($employee_id);
        $atasan = Employee::where('email', $email_atasan)->first();
        $this->employee_code = $employee->employee_code;
        $this->employee_name = $employee->full_name;
        $this->employee_id = $employee_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->total_days = $total_days;
        $this->attachment = array($attachment);
        $this->name_bos = $atasan->full_name;
        $this->date_approve = Carbon::now();
        $this->status = 'approved';
        $this->email_atasan = $email_atasan;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email izin cuti',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {


        return new Content(
            view: 'emails.leave',
            with: [
                'employee_code' => $this->employee_code,
                'employee_name' => $this->employee_name,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_days' => $this->total_days,
                'name_bos' => $this->name_bos,
                'status' => $this->status,
                'employee_id' => $this->employee_id,
                'id_leave' => $this->id
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        $attachList = [];
        foreach ($this->attachment as $file) {
            $fullpath = storage_path('app/public/' . $file);
            if (file_exists($fullpath)) {
                $attachList[] = Attachment::fromPath($fullpath);
            }
        }

        return $attachList;
    }
}
