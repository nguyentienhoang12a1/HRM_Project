<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * OtpMail: Dịch vụ gửi mã OTP qua Email nhân viên.
 */
class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otpCode;
    public string $employeeName;

    public function __construct(string $otpCode, string $employeeName)
    {
        $this->otpCode = $otpCode;
        $this->employeeName = $employeeName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[HRM System] Mã xác thực đăng nhập OTP của bạn',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
        );
    }
}