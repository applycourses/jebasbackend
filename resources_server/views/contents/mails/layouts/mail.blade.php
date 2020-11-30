<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Applycourses</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Roboto:300,400,500,700);
        /*Calling our web font*/
        /* Some resets and issue fixes */
        
        #outlook a {
            padding: 0;
        }
        
        body {
            width: 100% !important;
            -webkit-text;
            size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        
        .ReadMsgBody {
            width: 100%;
        }
        
        .ExternalClass {
            width: 100%;
        }
        
        .backgroundTable {
            margin: 0 auto;
            padding: 0;
            width: 100%;
            !important;
        }
        
        table td {
            border-collapse: collapse;
        }
        
        .ExternalClass * {
            line-height: 115%;
        }
        /* End reset */
        /* These are our tablet/medium screen media queries */
        
        @media screen and (max-width: 630px) {
            /* Display block allows us to stack elements */
            *[class="mobile-column"] {
                display: block;
            }
            /* Some more stacking elements */
            *[class="mob-column"] {
                float: none !important;
                width: 100% !important;
            }
            /* Hide stuff */
            *[class="hide"] {
                display: none !important;
            }
            /* This sets elements to 100% width and fixes the height issues too, a god send */
            *[class="100p"] {
                width: 100% !important;
                height: auto !important;
            }
            /* For the 2x2 stack */
            *[class="condensed"] {
                padding-bottom: 40px !important;
                display: block;
            }
            /* Centers content on mobile */
            *[class="center"] {
                text-align: center !important;
                width: 100% !important;
                height: auto !important;
            }
            /* 100percent width section with 20px padding */
            *[class="100pad"] {
                width: 100% !important;
                padding: 20px;
            }
            /* 100percent width section with 20px padding left & right */
            *[class="100padleftright"] {
                width: 100% !important;
                padding: 0 20px 0 20px;
            }
            /* 100percent width section with 20px padding top & bottom */
            *[class="100padtopbottom"] {
                width: 100% !important;
                padding: 20px 0px 20px 0px;
            }
        }
        
        span {
            line-height: 20px;
            font-size: 13px;
            display: block;
        }
        
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <table width="100%" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="100p">
        <tr>
            <td valign="top" class="100p">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="100p">
                    <tr>
                        <td valign="top">
                            <table border="0" cellspacing="0" cellpadding="20" width="100%" class="100p" style="border: 1px solid #e2e2e2; border-bottom: none;">
                                <tr>
                                    <td align="left" width="50%">
                                        <img src="http://cdn.applycourse.in/mail/logo.png" alt="Applycourses Logo" border="0" style="display:block" />
                                    </td>
                                    <td width="50%" align="right" style="font-size:11px; color:#4c4c4c;">
                                        <font face="'Roboto', Arial, sans-serif">
                                            <a target="_blank" href="http://applycourse.in/register" style="color:#4c4c4c; text-decoration:none;">REGISTER</a>
                                            &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp;
                                            <a target="_blank" href="http://applycourse.in/login" style="color:#4c4c4c; text-decoration:none;">LOGIN</a>
                                        </font>
                                    </td>
                                </tr>
                            </table>
                            <table align="center" border="0" cellspacing="0" cellpadding="30" bgcolor="#e2e2e2" width="100%" class="100p">
                                <tbody>
                                    <tr>
                                        <td style=" font-size:24px;">
                                            <table align="center" cellspacing="0" cellpadding="30" width="100%" border="0" bgcolor="#ffffff">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <font face="'Roboto', Arial, sans-serif">
                                                                <!-- CONTENT INSIDE -->
                                                               			@yield('contents')
                                                                <!-- CONTENT INSIDE -->
                                                            </font>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="20" class="100p" bgcolor="#009fe3">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" class="100padtopbottom" width="600">
                    <tr>
                        <td align="left" class="condensed" valign="top">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" class="mob-column" width="290">
                                <tr>
                                    <td valign="top" align="center">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td valign="top" align="center" class="100padleftright">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="135" align="center">
                                                                <a href="tel:+919800897000"><img src="http://cdn.applycourse.in/mail/phone.png" border="0" style="display:block;" /></a>
                                                            </td>
                                                            <td width="20"></td>
                                                            <td width="135" align="center">
                                                                <a href="mailto:info@applycourses.com"><img src="http://cdn.applycourse.in/mail/envelope.png" border="0" style="display:block;" /></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="10"></td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="100padleftright" align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td valign="top" width="135" align="center" style="font-size:16px; color:#ffffff;">
                                                                <font face="'Roboto', Arial, sans-serif">
                                                                    <a href="tel:+919800897000" style="color: #ffffff; display: block; font-size: 12px; padding-top: 5px">+91 9800 897 000</a>
                                                                </font>
                                                            </td>
                                                            <td width="20"></td>
                                                            <td valign="top" width="135" align="center" style="font-size:16px; color:#ffffff;">
                                                                <font face="'Roboto', Arial, sans-serif">
                                                                    <a href="mailto:info@applycourses.com" style="color: #ffffff; display: block; font-size: 12px; padding-top: 5px">info@applycourses.com</a>
                                                                </font>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="20" class="hide"></td>
                        <td align="left" class="condensed" valign="top">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" class="mob-column" width="290">
                                <tr>
                                    <td valign="top" align="center">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td valign="top" align="center" class="100padleftright">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="135" align="center">
                                                                <a target="_blank" href="http://applycourse.in/faq"><img src="http://cdn.applycourse.in/mail/question.png" border="0" style="display:block;" /></a>
                                                            </td>
                                                            <td width="20"></td>
                                                            <td width="135" align="center">
                                                                <a target="_blank" href="http://www.applycourses.com/"><img src="http://cdn.applycourse.in/mail/globe.png" border="0" style="display:block;" /></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="10"></td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="100padleftright" align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td valign="top" width="135" align="center" style="font-size:16px; color:#ffffff;">
                                                                <font face="'Roboto', Arial, sans-serif">
                                                                    <a target="_blank" href="http://applycourse.in/faq" style="color: #ffffff; display: block; font-size: 12px; padding-top: 5px">FAQs</a>
                                                                </font>
                                                            </td>
                                                            <td width="20"></td>
                                                            <td valign="top" width="135" align="center" style="font-size:16px; color:#ffffff;">
                                                                <font face="'Roboto', Arial, sans-serif">
                                                                 <a target="_blank" href="http://www.applycourses.com/" style="color: #ffffff; display: block; font-size: 12px; padding-top: 5px">applycourses.com</a>
                                                             </font>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="20" bgcolor="#036590" class="100p">
        <tr>
            <td align="left">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20" align="center">
                            <a target="_blank" href="https://www.facebook.com/applycourses.c0m"><img src="http://cdn.applycourse.in/mail/facebook.png" border="0" style="display:block;" /></a>
                        </td>
                        <td width="5"></td>
                        <td width="20" align="center">
                            <a target="_blank" href="https://twitter.com/applycourses"><img src="http://cdn.applycourse.in/mail/twitter.png" border="0" style="display:block;" /></a>
                        </td>
                        <td width="5"></td>
                        <td width="20" align="center">
                            <a target="_blank" href="https://www.instagram.com/applycourses/"><img src="http://cdn.applycourse.in/mail/instagram.png" border="0" style="display:block;" /></a>
                        </td>
                        <td width="5"></td>
                        <td width="20" align="center">
                            <a target="_blank" href="https://www.linkedin.com/company/applycourses-com"><img src="http://cdn.applycourse.in/mail/linkedin.png" border="0" style="display:block;" /></a>
                        </td>
                        <td width="5"></td>
                        <td width="20" align="center">
                            <a target="_blank" href="https://plus.google.com/104372841943449141851"><img src="http://cdn.applycourse.in/mail/google_plus.png" border="0" style="display:block;" /></a>
                        </td>
                    </tr>
                </table>
            </td>
            <td align="right">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="color: #ffffff">
                            <font face="'Roboto', Arial, sans-serif"><a href="##" style="color:#ffffff; font-size: 12px; text-decoration:none;">Report spam</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="##" style="color:#ffffff; font-size: 12px; text-decoration:none;">Unsubscribe</a></font>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>