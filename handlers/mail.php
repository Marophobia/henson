<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer (ensure the path matches your project setup)
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Sends an email using PHPMailer.
 *
 * @param string $recipientEmail The recipient's email address.
 * @param string $recipientName The recipient's name.
 * @param string $subject The subject of the email.
 * @param string $body The HTML body of the email.
 * @param string $altBody The plain text version of the email (optional).
 * @return bool|string Returns true if the email was sent successfully, otherwise returns the error message.
 */

function sendMail($recipientEmail, $recipientName, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'hensonschools.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hello@hensonschools.com';
        $mail->Password = 'Z0RA3hRz.gsm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('hello@hensonschools.com', 'Henson Demonstration Schools');
        $mail->addAddress($recipientEmail, $recipientName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log($mail->ErrorInfo);
        return "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}


/**
 * Generates an HTML email body.
 *
 * @param string $name The recipient's name.
 * @param string $message The main message for the email.
 * @return string Returns the formatted HTML email body.
 */
function generateEmailBody($name, $message)
{
    return <<<HTML
    <!DOCTYPE html>
    <div class="col-12">
    <table class="body-wrap"
        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: transparent; margin: 0;">
        <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
            <td style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
                valign="top"></td>
            <td class="container" width="600"
                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
                valign="top">
                <div class="content"
                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope
                        itemtype="http://schema.org/ConfirmAction"
                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;">
                        <tr style="font-family: 'Roboto', sans-serif; font-size: 14px; margin: 0;">
                            <td class="content-wrap"
                                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; color: #495057; font-size: 14px; vertical-align: top; margin: 0;padding: 30px; box-shadow: 0 3px 15px rgba(30,32,37,.06); ;border-radius: 7px; background-color: #fff;"
                                valign="top">
                                <meta itemprop="name" content="Confirm Email"
                                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />
                                <table width="100%" cellpadding="0" cellspacing="0"
                                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <tr
                                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <td class="content-block"
                                            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                            valign="top">
                                            <div style="margin-bottom: 15px;">
                                                <img src="https://hensonschools.com/assets/img/logo/logo.png"
                                                    alt="" height="23">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr
                                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <td class="content-block"
                                            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 20px; line-height: 1.5; font-weight: 500; vertical-align: top; margin: 0; padding: 0 0 10px;"
                                            valign="top">
                                            Hi, {$name}
                                        </td>
                                    </tr>
                                    <tr
                                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <td class="content-block"
                                            style="font-family: 'Roboto', sans-serif; color: #878a99; box-sizing: border-box; line-height: 1.5; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 10px;"
                                            valign="top">
                                            {$message}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div
                        style="text-align: center; margin: 0 auto; font-family: 'Roboto', sans-serif; width: fit-content;">
                        <table style="margin: 25px auto;">
                            <tr style="text-align: center;">
                                <td style="padding: 10px;">
                                    <a href="https://hensonschools.com/contact.php" style="color: #495057; text-decoration: none;">Contact Us</a>
                                </td>
                                <td style="padding: 10px;">
                                    <a href="https://hensonschools.com/blog.php" style="color: #495057; text-decoration: none;">Latest News</a>
                                </td>
                                <td style="padding: 10px;">
                                    <a href="#" style="color: #495057; text-decoration: none;">Privacy Policy</a>
                                </td>
                            </tr>
                        </table>
                        <p style="font-size: 14px; color: #98a6ad; margin: 0;">2025 Henson Demonstration Schools</p>
                    </div>
                </div>
            </td>
        </tr>
    </table>                                 
</div>
HTML;
}

?>