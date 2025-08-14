<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;

class DynamicEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $template;
    public $data;
    public $subject;

    public function __construct($template, $data)
    {
        $this->template = $template;
        $this->data = $data;

        $emailTemplate = EmailTemplate::where('slug', $this->template)->firstOrFail();
        $this->subject = $emailTemplate->subject ?? 'VPN';
    }

    /**
     * Get the message envelope.
     */
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $emailTemplate = EmailTemplate::where('slug', $this->template)->firstOrFail();
        $content = $emailTemplate->content;
        
        // Replace placeholders with actual data
        foreach ($this->data as $key => $value) {
            $content = str_replace("{{ $key }}", $value, $content);
            // Allow HTML content replacement
            if (strpos($content, "{{ $key }}") === false) {
                $content = str_replace("{!! $key !!}", $value, $content);
            }
        }

        return new Content(
            view: 'emails.dynamic-template',
            with: ['content' => $content]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
