<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateTest extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $email;
    public $category;
    public $name_test;
    public $questions;

    /**
     * Create a new message instance.
     */
    public function __construct($id,$email,$category,$name_test,$questions)
    {
        $this->id = $id;
        $this->email = $email;
        $this->category = $category;
        $this->name_test = $name_test;
        $this->questions = $questions;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("konigwolf@mail.ru", 'Тестирование'),
            subject: 'Обновлен тест пользователем',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.mailMessage.createTest',
            with: [
                'id' => $this->id,
                'email' => $this->email,
                'category' => $this->category,
                'name_test' =>$this->name_test,
                'questions' => $this->questions
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
        return [];
    }
}
