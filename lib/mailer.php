<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\Exception as MailException;
use PHPMailer\PHPMailer\PHPMailer;

require_once APP_ROOT . '/phpmailer/autoload.php';

function make_mailer(): PHPMailer
{
    $mailer = new PHPMailer(true);
    $mailer->isSMTP();
    $mailer->Host = (string) setting('smtp_host', 'smtp.gmail.com');
    $mailer->SMTPAuth = true;
    $mailer->Username = (string) setting('smtp_username');
    $mailer->Password = decrypt_secret((string) setting('smtp_password_enc'));
    $mailer->Port = (int) setting('smtp_port', '587');
    $encryption = (string) setting('smtp_encryption', 'tls');
    $mailer->SMTPSecure = $encryption === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
    $mailer->CharSet = 'UTF-8';
    $mailer->Timeout = 20;
    $mailer->setFrom((string) setting('smtp_from_email'), (string) setting('smtp_from_name', setting('site_name', 'JG Cleaning Services')));
    $mailer->isHTML(true);
    return $mailer;
}

function mail_template(string $heading, string $intro, string $body, string $buttonLabel = '', string $buttonUrl = ''): string
{
    $siteName = e((string) setting('site_name', 'JG Cleaning Services'));
    $logoUrl = asset((string) setting('logo_main', 'assets/images/main-logo.png'));
    $button = $buttonLabel && $buttonUrl
        ? '<p style="margin:30px 0"><a href="' . e($buttonUrl) . '" style="display:inline-block;padding:14px 23px;border-radius:10px;background:#10137e;color:#fff;text-decoration:none;font-weight:700">' . e($buttonLabel) . '</a></p>'
        : '';
    return '<!doctype html><html><body style="margin:0;background:#eef3f8;font-family:Arial,sans-serif;color:#182033"><table role="presentation" width="100%" cellspacing="0" cellpadding="0"><tr><td align="center" style="padding:35px 15px"><table role="presentation" width="640" cellspacing="0" cellpadding="0" style="max-width:640px;background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 14px 45px rgba(16,19,126,.12)"><tr><td style="height:8px;background:linear-gradient(90deg,#10137e,#06a2c7)"></td></tr><tr><td style="padding:30px 42px;border-bottom:1px solid #e9edf3"><img src="' . e($logoUrl) . '" alt="' . $siteName . '" style="max-width:250px;height:auto"></td></tr><tr><td style="padding:42px"><div style="display:inline-block;margin-bottom:15px;padding:6px 10px;border-radius:20px;background:#dff8fd;color:#067f9c;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase">Professional cleaning enquiry</div><h1 style="margin:0 0 18px;color:#10137e;font-size:31px;line-height:1.2">' . e($heading) . '</h1><p style="margin:0 0 24px;color:#596273;font-size:16px;line-height:1.7">' . e($intro) . '</p>' . $body . $button . '<p style="margin:32px 0 0;padding-top:24px;border-top:1px solid #e9edf3;color:#8a92a0;font-size:12px;line-height:1.6">' . $siteName . '<br>' . e((string) setting('phone_1')) . ' &nbsp;•&nbsp; ' . e((string) setting('email_1')) . '</p></td></tr></table></td></tr></table></body></html>';
}

function send_enquiry_emails(int $enquiryId): bool
{
    $statement = db()->prepare('SELECT e.*, s.title AS service_title FROM enquiries e LEFT JOIN services s ON s.id = e.service_id WHERE e.id = ?');
    $statement->execute([$enquiryId]);
    $enquiry = $statement->fetch();
    if (!$enquiry) {
        return false;
    }

    $rows = [
        'Name' => $enquiry['name'],
        'Phone' => $enquiry['phone'],
        'Email' => $enquiry['email'] ?: 'Not provided',
        'Suburb' => $enquiry['suburb'] ?: 'Not provided',
        'Service' => $enquiry['service_title'] ?: 'General enquiry',
        'Message' => $enquiry['message'] ?: 'No additional message',
    ];
    $details = '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">';
    foreach ($rows as $label => $value) {
        $details .= '<tr><td style="padding:11px 12px;border-bottom:1px solid #edf0f4;color:#737c8c;font-size:13px;width:120px">' . e($label) . '</td><td style="padding:11px 12px;border-bottom:1px solid #edf0f4;color:#1c2534;font-size:14px">' . nl2br(e((string) $value)) . '</td></tr>';
    }
    $details .= '</table>';

    $admin = make_mailer();
    $admin->addAddress((string) setting('admin_email'));
    if (!empty($enquiry['email'])) {
        $admin->addReplyTo((string) $enquiry['email'], (string) $enquiry['name']);
    }
    $admin->Subject = 'New website enquiry from ' . $enquiry['name'];
    $admin->Body = mail_template('A new cleaning enquiry has arrived', 'The complete enquiry details are below.', $details, 'Open Admin Enquiries', url('admin/enquiries.php'));
    $admin->AltBody = "New website enquiry\nName: {$enquiry['name']}\nPhone: {$enquiry['phone']}\nEmail: {$enquiry['email']}\nService: {$enquiry['service_title']}\nMessage: {$enquiry['message']}";
    $admin->send();

    if (!empty($enquiry['email'])) {
        $customer = make_mailer();
        $customer->addAddress((string) $enquiry['email'], (string) $enquiry['name']);
        $customer->addReplyTo((string) setting('email_1'), (string) setting('site_name'));
        $customer->Subject = 'We received your JG Cleaning Services enquiry';
        $summary = '<div style="padding:18px;border-radius:12px;background:#f5f8fb;color:#4f5868;font-size:14px;line-height:1.7"><strong style="color:#10137e">Requested service:</strong> ' . e((string) ($enquiry['service_title'] ?: 'General cleaning enquiry')) . '<br><strong style="color:#10137e">Best contact number:</strong> ' . e((string) $enquiry['phone']) . '</div>';
        $customer->Body = mail_template('Thanks, ' . (string) $enquiry['name'] . '!', 'Your request has reached our team. We will review the details and contact you as soon as possible.', $summary, 'Visit Our Website', url());
        $customer->AltBody = 'Thank you for contacting JG Cleaning Services. We received your enquiry and will contact you shortly.';
        $customer->send();
    }
    return true;
}

