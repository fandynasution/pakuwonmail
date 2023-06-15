<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0," />
    <title>SSI</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' rel='stylesheet' type='text/css' />

    <link href='https://fonts.googleapis.com/css?family=Bitter:400,400italic,700' rel='stylesheet' type='text/css' />

    <style type="text/css">
        html {
            width: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        img {
            display: block !important;
            border: 0;
            -ms-interpolation-mode: bicubic;
        }
        .ReadMsgBody {
            width: 100%;
        }
        .ExternalClass {
            width: 100%;
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }
        .images {
            display: block !important;
            width: 100% !important;
        }
        .heading {
            font-family: 'Bitter', Arial, Helvetica Neue, Helvetica, sans-serif !important;
        }
        .MsoNormal {
            font-family: 'Open Sans', Arial, Helvetica Neue, Helvetica, sans-serif !important;
        }
        p, div {
            margin: 0 !important;
            padding: 0 !important;
        }
        a {
            font-family: 'Open Sans', Arial, Helvetica Neue, Helvetica, sans-serif !important;
        }
        .button td,
        .button a {
            font-family: 'Open Sans', Arial, Helvetica Neue, Helvetica, sans-serif !important;
        }
        .button a:hover {
            text-decoration: none !important;
        }
        input[type=button], input[type=submit], input[type=reset] {
            background-color: #1ec6bc;
            border: none;
            color: white;
            padding: 15px 15px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            text-transform:uppercase;
        }
        /* MEDIA QUIRES */
        
        @media only screen and (max-width: 640px) {
            body {
                width: auto !important;
            }
            table[class=display-width], table[class="mcbc-Online-bgcolor"], table[class="mcbc-Menu-bgcolor"], table[class="mcbc-White-bgcolor"], table[class="mcbc-Light-bgcolor"], table[class="mcbc-Dark-bgcolor"], table[class="mcbc-Footer-bgcolor"], table[class="mcbi-header-bgimage"], table[class="mcbi-Design-bgimage"], table[class="mcbi-Download-bgimage"]{
                width: 320px !important;
                margin: auto;
            }
            table[class="display-width"] table, table[class="mcbc-Online-bgcolor"] table, table[class="mcbc-Menu-bgcolor"] table, table[class="mcbc-White-bgcolor"] table,  table[class="mcbc-Light-bgcolor"] table, table[class="mcbc-Dark-bgcolor"] table, table[class="mcbc-Footer-bgcolor"] table, table[class="mcbi-header-bgimage"] table, table[class="mcbi-Design-bgimage"] table, table[class="mcbi-Download-bgimage"] table {
                width: 100% !important;
            }
            table[class=display-width] .button-width .button {
                width: auto !important;
            }
            td[class="lrpadding"] {
                padding: 0 15px;
            }
			.responsive-pad
			{
			padding:0px 30px;
			}
			.auto-pad {
                padding: 0 15px !important;
            }
			.auto-hide
			{
			display:none;
			}
        }
        @media only screen and (max-width: 320px) {
            table[class=display-width], table[class="mcbc-Online-bgcolor"], table[class="mcbc-Menu-bgcolor"], table[class="mcbc-White-bgcolor"], table[class="mcbc-Light-bgcolor"], table[class="mcbc-Dark-bgcolor"], table[class="mcbc-Footer-bgcolor"], table[class="mcbi-header-bgimage"], table[class="mcbi-Design-bgimage"], table[class="mcbi-Download-bgimage"] {
                width: 100% !important;
            }
            td[class="lrpadding"], .auto-pad {
                padding: 0 15px;
            }
			.auto-heading
			{
			font-size:46px !important;
			}
        }
			
			/*
			@tab Main BG Color
			@tip Main BG Color
			*/
			.mcbc-Body-bgcolor{/*@editable*/background-color:#eeeeee !important;}
		
			
			
			/*
			@tab White BG Color
			@tip White BG Color
			*/
			.mcbc-White-bgcolor{/*@editable*/background-color:#ffffff !important;}
			
			/*
			@tab Light BG Color
			@tip Light BG Color
			*/
			.mcbc-Light-bgcolor{/*@editable*/background-color:#f5f5f5 !important;}
			
			/*
			@tab Dark BG Color
			@tip Dark BG Color
			*/
			.mcbc-Dark-bgcolor{/*@editable*/background-color:#1ec6bc !important;}
			
			
			
			/*
			@tab Skill Bar Outer BG Color
			@tip Skill Bar Outer BG Color
			*/
			.mcbc-Outer-Skill-bgcolor{/*@editable*/background-color:#f5f5f5 !important;}
			
			/*
			@tab User Experience Skill Bar BG Color
			@tip User Experience Skill Bar BG Color
			*/
			.mcbc-User-Skill-bgcolor{/*@editable*/background-color:#3abbdb !important;}
			
			/*
			@tab HTML Skill Bar BG Color
			@tip HTML Skill Bar BG Color
			*/
			.mcbc-HTML-Skill-bgcolor{/*@editable*/background-color:#ff6d85 !important;}
			
			/*
			@tab Jquery Skill Bar BG Color
			@tip Jquery Skill Bar BG Color
			*/
			.mcbc-Jquery-Skill-bgcolor{/*@editable*/background-color:#1ec6bc !important;}
			
			/*
			@tab Header Button BG Color
			@tip Header Button BG Color
			*/
			.mcbc-Header-Button-bgcolor{/*@editable*/background-color:#ffffff !important;}
			
			/*
			@tab Popular Category Button BG Color
			@tip Popular Category Button BG Color
			*/
			.mcbc-Popular-Button-bgcolor{/*@editable*/background-color:#ffffff !important;}
			
			/*
			@tab All Button BG Color
			@tip All Button BG Color
			*/
			.mcbc-All-Button-bgcolor{/*@editable*/background-color:#1ec6bc !important;}
			
			/*
			@tab Header BG Image
			@tip Header BG Image
			*/
			.mcbi-header-bgimage{
			/*@editable*/background-image:url(http://www.pennyblacktemplates.com/demo/twenty20/images/700x600.jpg) !important;
			/*@editable*/background-position:center !important;
			/*@editable*/background-repeat:no-repeat !important;}
			
			/*
			@tab Design BG Image
			@tip Design BG Image
			*/
			.mcbi-Design-bgimage{
			/*@editable*/background-image:url(http://www.pennyblacktemplates.com/demo/twenty20/images/700x307x1.jpg) !important;
			/*@editable*/background-position:center !important;
			/*@editable*/background-repeat:no-repeat !important;}
			
			/*
			@tab Download BG Image
			@tip Download BG Image
			*/
			.mcbi-Download-bgimage{
			/*@editable*/background-image:url(http://www.pennyblacktemplates.com/demo/twenty20/images/700x307x2.jpg) !important;
			/*@editable*/background-position:center !important;
			/*@editable*/background-repeat:no-repeat !important;}
			
			/*
			@tab Section Separater Color
			@tip Section Separater Color
			*/
			.mcbr-Separater{/*@editable*/border-bottom:1px solid #dddddd !important;}
			
			
    </style>
</head>

<body>

	<!-- LOGO SECTION STARTS -->
    <table align="center" bgcolor="#eeeeee" class="mcbc-Body-bgcolor" border="0" cellpadding="0" cellspacing="0" width="100%" mc:repeatable="2">
        <tbody>
            <tr>
                <td align="center">
                    <!--SECTION TABLE-600-->
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="700">
                        <tbody>
                            <tr>
                                <td height="30"></td>
                            </tr>
							<tr>
							    <td>
							        <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="600">
                                        <tbody>
                                            <tr>
                                                <td align="center" class="lrpadding">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <!--TABLE LEFT-->
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="18%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; width:auto;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" valign="middle" style="color:#ffffff; padding-top:5px;">
                                                                                    <a href="#" style="color:#ffffff; text-decoration:none;">
                                                                                    <img src="http://dev.ifca.co.id:8080/sendmailapi/public/images/header.png" alt="124x24" width="124" height="60" mc:edit="LOGO1"/>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <!--TABLE MIDDLE-->
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="1" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="1" height="30"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
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
                            <tr>
                                <td height="30"></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--SECTION TABLE-600 ENDS-->
                </td>
            </tr>
        </tbody>
    </table>
    <!-- LOGO SECTION ENDS -->