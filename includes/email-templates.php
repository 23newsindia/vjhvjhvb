<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Professional Email Template System - Optimized for Deliverability
 */
class WNS_Email_Templates {
    
    public static function get_email_wrapper($content, $title = '') {
        $site_name = get_bloginfo('name');
        $site_url = home_url();
        
        // Use the specific logo URL provided
        $logo_url = 'https://aistudynow.com/wp-content/uploads/2022/11/LOGO-1.png';
        
        return '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . esc_html($title ?: $site_name) . '</title>
</head>
<body style="margin: 0; padding: 0; background-color: #ffffff; font-family: Arial, Helvetica, sans-serif; line-height: 1.4; color: #333333;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border: 1px solid #dddddd;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #eeeeee;">
                            <img src="' . esc_url($logo_url) . '" alt="' . esc_attr($site_name) . '" style="max-width: 150px; height: auto; display: block;">
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            ' . $content . '
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px; background-color: #f8f8f8; border-top: 1px solid #eeeeee; text-align: center;">
                            <p style="margin: 0 0 10px 0; font-size: 14px; color: #666666;">
                                You received this because you subscribed to our newsletter.
                            </p>
                            <p style="margin: 0; font-size: 14px; color: #666666;">
                                <a href="{unsubscribe_link}" style="color: #0066cc; text-decoration: underline;">Unsubscribe</a> | 
                                <a href="' . esc_url($site_url) . '" style="color: #0066cc; text-decoration: underline;">Visit Website</a>
                            </p>
                            <p style="margin: 10px 0 0 0; font-size: 12px; color: #999999;">
                                ' . esc_html($site_name) . '
                            </p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
    }
    
    public static function get_verification_template($verify_link) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            Email Verification Required
        </h2>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            Thank you for subscribing to our newsletter. To complete your subscription, please verify your email address.
        </p>
        
        <table cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
            <tr>
                <td style="background-color: #0066cc; padding: 12px 24px; border-radius: 4px;">
                    <a href="' . esc_url($verify_link) . '" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; display: block;">
                        Verify Email Address
                    </a>
                </td>
            </tr>
        </table>
        
        <p style="color: #666666; font-size: 14px; margin: 20px 0 0 0; font-family: Arial, sans-serif; line-height: 1.5;">
            If the button above does not work, copy and paste this link into your browser:
        </p>
        <p style="color: #0066cc; font-size: 14px; margin: 5px 0 0 0; font-family: Arial, sans-serif; word-break: break-all;">
            ' . esc_url($verify_link) . '
        </p>
        
        <p style="color: #999999; font-size: 12px; margin: 30px 0 0 0; font-family: Arial, sans-serif;">
            This verification link will expire in 24 hours.
        </p>';
        
        return self::get_email_wrapper($content, 'Verify Your Email - ' . $site_name);
    }
    
    public static function get_welcome_template($email) {
        $site_name = get_bloginfo('name');
        
        $content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            Welcome to Our Newsletter
        </h2>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            Thank you for subscribing to our newsletter. We are pleased to have you as part of our community.
        </p>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 20px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            You will receive updates about our latest content and news directly in your inbox.
        </p>
        
        <table cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
            <tr>
                <td style="background-color: #0066cc; padding: 12px 24px; border-radius: 4px;">
                    <a href="' . esc_url(home_url()) . '" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; display: block;">
                        Visit Our Website
                    </a>
                </td>
            </tr>
        </table>
        
        <p style="color: #666666; font-size: 14px; margin: 20px 0 0 0; font-family: Arial, sans-serif; line-height: 1.5;">
            If you have any questions, please feel free to contact us.
        </p>';
        
        return self::get_email_wrapper($content, 'Welcome to ' . $site_name);
    }
    
    public static function get_new_post_template($post) {
        $post_title = get_the_title($post->ID);
        $post_url = get_permalink($post->ID);
        $post_excerpt = has_excerpt($post->ID) ? get_the_excerpt($post->ID) : wp_trim_words(strip_tags($post->post_content), 30);
        $post_date = get_the_date('F j, Y', $post->ID);
        
        $content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            New Post Published
        </h2>
        
        <h3 style="color: #333333; font-size: 20px; margin: 0 0 15px 0; font-family: Arial, sans-serif;">
            ' . esc_html($post_title) . '
        </h3>
        
        <p style="color: #666666; font-size: 14px; margin: 0 0 15px 0; font-family: Arial, sans-serif;">
            Published on ' . esc_html($post_date) . '
        </p>
        
        <p style="color: #333333; font-size: 16px; margin: 0 0 25px 0; font-family: Arial, sans-serif; line-height: 1.5;">
            ' . esc_html($post_excerpt) . '
        </p>
        
        <table cellpadding="0" cellspacing="0" border="0" style="margin: 30px 0;">
            <tr>
                <td style="background-color: #0066cc; padding: 12px 24px; border-radius: 4px;">
                    <a href="' . esc_url($post_url) . '" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif; display: block;">
                        Read Full Article
                    </a>
                </td>
            </tr>
        </table>';
        
        return self::get_email_wrapper($content, 'New Post: ' . $post_title);
    }
    
    public static function get_newsletter_template($subject, $content) {
        $formatted_content = '
        <h2 style="color: #333333; font-size: 24px; margin: 0 0 20px 0; font-family: Arial, sans-serif;">
            ' . esc_html($subject) . '
        </h2>
        
        <div style="color: #333333; font-size: 16px; font-family: Arial, sans-serif; line-height: 1.5;">
            ' . wp_kses_post($content) . '
        </div>';
        
        return self::get_email_wrapper($formatted_content, $subject);
    }
}