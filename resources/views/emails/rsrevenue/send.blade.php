<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    
    <style>
        html, body {
            width: 100%;
        }
        table {
            margin: 50 auto;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #e6f0eb;">
	<div style="width: 100%; background-color: #e6f0eb;">
        <table width="80%" border="0" cellpadding="0" cellspacing="0" bgcolor="#e6f0eb" style="margin-left: auto;margin-right: auto;" >
            <tr>
               <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:800px;margin:0 auto;">
                        @include('template.header')
                    </table>
                    <table class="no-spacing" cellspacing="0" style="width:100%;max-width:800px;margin:0 auto;background-color:#ffffff;">
                        <tr>
                            <td style="text-align:center;padding: 0px 30px 0px 20px">
                                <h5 style="text-align:left;color: #526484; font-size: 20px; font-weight: 400; line-height: 28px;">Dear Mr./Mrs. {{ $data['user_name'] }}</h5>
                                <p style="text-align:left;color: #526484; font-size: 16px;">Please Approve Revenue Sharing with details :</p>
                                <table style="text-align:left; ">
                                    <tr>
                                        <td>Document No. </td>
                                        <td> : </td>
                                        <td> {{ $data['pgs_doc_no'] }} </td>
                                    </tr>
                                    <tr>
                                        <td>Customer Name </td>
                                        <td> : </td>
                                        <td> {{ $data['debtor_name'] }} </td>
                                    </tr>
                                    <tr>
                                        <td>Currency Code</td>
                                        <td> : </td>
                                        <td> IDR </td>
                                    </tr>
                                    <tr>
                                        <td>Total Sales</td>
                                        <td>:</td>
                                        <td>{{ $data['total_sales'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tarif (%)</td>
                                        <td>:</td>
                                        <td>{{ $data['tariff_percent'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Base Amount</td>
                                        <td>:</td>
                                        <td>{{ $data['tariff_amt'] }} </td>
                                    </tr>
                                    <tr>
                                        <td>Tax Amount</td>
                                        <td>:</td>
                                        <td>{{ $data['tax_amt'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>:</td>
                                        <td>{{ $data['net_amt'] }} </td>
                                    </tr>
                                </table>
                                <br>
                                <a href="{{ url('api') }}/{{ $data['link'] }}/{{ $data['entity_cd'] }}/{{ $data['project_no'] }}/{{ $data['doc_no'] }}/{{ $data['trx_type'] }}/{{ $data['doc_date'] }}/{{ $data['ref_no'] }}/A/{{ $data['level_no'] }}/{{ $data['usergroup'] }}/{{ $data['user_id'] }}/{{ $data['supervisor'] }}" style="background-color:#1ee0ac;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0px 40px;margin: 10px">Approve</a>
                                <a href="{{ url('api') }}/{{ $data['link'] }}/{{ $data['entity_cd'] }}/{{ $data['project_no'] }}/{{ $data['doc_no'] }}/{{ $data['trx_type'] }}/{{ $data['doc_date'] }}/{{ $data['ref_no'] }}/R/{{ $data['level_no'] }}/{{ $data['usergroup'] }}/{{ $data['user_id'] }}/{{ $data['supervisor'] }}" style="background-color:#f4bd0e;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0px 40px;margin: 10px">Revise</a>
                                <a href="{{ url('api') }}/{{ $data['link'] }}/{{ $data['entity_cd'] }}/{{ $data['project_no'] }}/{{ $data['doc_no'] }}/{{ $data['trx_type'] }}/{{ $data['doc_date'] }}/{{ $data['ref_no'] }}/C/{{ $data['level_no'] }}/{{ $data['usergroup'] }}/{{ $data['user_id'] }}/{{ $data['supervisor'] }}" style="background-color:#e85347;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0px 40px;margin: 10px">Cancel</a>
                                <br>
                                @if ($data['url_link'] != 'empty')
                                <p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 16px">
                                    <b style="font-style:italic;">To view the attachment, please click the link below : </b><br>
                                    
                                    @if ( is_array($data['url_link']) || is_object($data['url_link']) )
                                        @foreach ($data['url_link'] as $tampil)
                                            <a href={{ $tampil }} target="_blank">{{ trim(str_replace('%20', ' ',substr($tampil, strrpos($tampil, '/') + 1))) }}</a><br><br>
                                        @endforeach
                                    @else
                                        <a href={{ $data['url_link'] }} target="_blank">{{ trim(str_replace('%20', ' ',substr($data['url_link'], strrpos($data['url_link'], '/') + 1))) }}</a><br><br>
                                    @endif
                                </p>
                                @endif
                            </td>
                        </tr>
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