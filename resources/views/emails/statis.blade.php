<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    @include('template.style')
    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #e6f0eb;">
	<div style="width: 100%; background-color: #e6f0eb;">
        <table width="50%" border="0" cellpadding="0" cellspacing="0" bgcolor="#e6f0eb" style="margin-left: auto;margin-right: auto;" >
            <tr>
               <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        @include('template.header')
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding:30px 30px 20px">
                                    <h5 style="margin-bottom:24px;color:#526484;font-size:20px;font-weight:400;line-height:28px">Dear PROJECT1</h5>
                                    <p style="margin-bottom:15px;color:#526484;font-size:16px">Please Approve Variation Order with : </p>
                                    <table>
                                        <tbody><tr>
                                            <td>Variation Order No : </td>
                                            <td>Maria Anders</td>
                                        </tr>
                                        <tr>
                                            <td>Submission Amount : </td>
                                            <td>Francisco Chang</td>
                                        </tr>
                                        <tr>
                                            <td>From PO Number : </td>
                                            <td>Roland Mendel</td>
                                        </tr>
                                        <tr>
                                            <td>Contract No : </td>
                                            <td>Helen Bennett</td>
                                        </tr>
                                        <tr>
                                            <td>Item Code : </td>
                                            <td>Yoshi Tannamuri</td>
                                        </tr>
                                        <tr>
                                            <td>In Entity : </td>
                                            <td>Giovanni Rovelli</td>
                                        </tr>
                                    </tbody></table>
                                    <a href="http://dev.ifca.co.id:8080/sendmailapi/api/cmvo/003/AA/VO23070015/3-000196/A/1/MGR/PROJECT1/M" style="background-color:#1ee0ac;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform:uppercase;padding:0px 40px;margin:10px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://dev.ifca.co.id:8080/sendmailapi/api/cmvo/003/AA/VO23070015/3-000196/A/1/MGR/PROJECT1/M&amp;source=gmail&amp;ust=1692675776199000&amp;usg=AOvVaw3yRuo2VY4RvvTMKKkDuwzW">Approve</a>
                                    <a href="http://dev.ifca.co.id:8080/sendmailapi/api/cmvo/003/AA/VO23070015/3-000196/R/1/MGR/PROJECT1/M" style="background-color:#f4bd0e;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform:uppercase;padding:0px 40px;margin:10px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://dev.ifca.co.id:8080/sendmailapi/api/cmvo/003/AA/VO23070015/3-000196/R/1/MGR/PROJECT1/M&amp;source=gmail&amp;ust=1692675776199000&amp;usg=AOvVaw2M-tWYQ660t6eKMSVsQdh9">Revise</a>
                                    <a href="http://dev.ifca.co.id:8080/sendmailapi/api/cmvo/003/AA/VO23070015/3-000196/C/1/MGR/PROJECT1/M" style="background-color:#e85347;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform:uppercase;padding:0px 40px;margin:10px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://dev.ifca.co.id:8080/sendmailapi/api/cmvo/003/AA/VO23070015/3-000196/C/1/MGR/PROJECT1/M&amp;source=gmail&amp;ust=1692675776199000&amp;usg=AOvVaw2nrTAOF2DjjgaocEScgVPD">Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        @include('template.footer')
                    </table>
               </td>
            </tr>
        </table>
    </div>
</body>
</html>