<?php

class Email extends Model
{
    var $to;
    var $cc;
    var $bcc;
    var $subject;
    var $from;
    var $headers;
    var $html;
    var $body;

    function email() 
    {
        $this->to       = NULL;
        $this->cc       = NULL;
        $this->bcc      = NULL;
        $this->subject  = NULL;
        $this->from     = NULL;
        $this->headers  = NULL;  
        $this->html     = NULL;
		$this->body     = NULL;
    }

    function getParams($params) 
    {
        $i = 0;
        foreach ($params as $key => $value) {
            switch($key) {
                case 'to':
                    $this->to       = $value;
                break;
                case 'cc':
                    $this->cc       = $value;
                break;
                case 'bcc':
                    $this->bcc       = $value;
                break;
                case 'subject':
                    $this->subject  = $value;
                break;
                case 'from':
                    $this->from     = $value;
                break;
                case 'submitted':
                    NULL;
                break;
                default:
                    $this->body[$i]["key"]     = str_replace("_", " ", ucWords(strToLower($key)));
                    $this->body[$i++]["value"] = $value;
            }
        }
		return $this;
    }

    function setHeaders() 
    {
        $this->headers = "From: $this->from\r\n";
        if($this->html === TRUE) {
            $this->headers.= "MIME-Version: 1.0\r\n";
            $this->headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
        }
        if(!empty($this->cc))  $this->headers.= "Cc: $this->cc\r\n";
        if(!empty($this->bcc)) $this->headers.= "Bcc: $this->bcc\r\n";
		return $this;
    }

    function parseBody() 
    {
    	$content = <<<CONTENT
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Flavius-Eurosound.de</title>
			<body style="background-color:#ffffff;background-image:none;background-repeat:no-repeat repeat-y;background-position:top left;background-attachment:scroll;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
			<table width="100%" cellspacing="10" cellpadding="0">
				<tr>
					<td align="center" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0" class="main" style="background-color:#ffffff;font-family:'Helvetica Neue Lt Std', 'Helvetica Neue', Helvetica, Arial, Sans;" >
							<tr>
								<td height="90" valign="bottom" align="left" class="header" style="padding-top:0;padding-bottom:2px;padding-right:0;padding-left:0;text-align:center;" ><h1 style="font-size:35px;line-height:35px;font-weight:bold;color:#666666;margin-top:0;margin-bottom:0;margin-right:0;margin-left:10px;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;display:inline;" ><img src="http://flavius-eurosound.de/flavius_mail_header.gif" width="580" height="262" alt="Flavius Teodosiu" class="headline" style="text-align:center;" /></h1></td>
							</tr>
							<tr>
							
										
			</html>


CONTENT;
        
		$count = count($this->body);
		$ctnt;
        for($i = 0; $i < $count; $i++) {
				
			
			$ctnt = nl2br($this->body[$i]["value"])."\n";
			$key = $this->body[$i]["key"];
            $content .= <<<CONTENT
			<tr align="left" valign="top">
				<td width="580" valign="top" class="body" align="left">
					<h2 style="font-size:16px;font-weight:bold;color:#6ac4ec;margin-top:0;margin-bottom:0;margin-right:0;margin-left:20pt;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >$key</h2>
								<p style="font-size:14px;line-height:22px;font-weight:normal;color:#555555;margin-top:14px;margin-bottom:0;margin-right:0;margin-left:20pt;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
								$ctnt
								</p>
								<p></p>
						</tr>
						<tr>
							<td class="center" style="text-align:center;" ><img src="http://flavius-eurosound.de/hr_fish_01_1.gif" width="580" height="20" alt="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -" /></td>
						</tr>
CONTENT;
           
        }
		$content .= <<<CONTENT
									
									</table></td>
							</tr>

							<tr>
								<td align="center" class="footer" style="padding-top:10px;padding-bottom:10px;padding-right:0;padding-left:0;" >
									<img src="http://flavius-eurosound.de/footer_7.gif" width="580" height="130" alt="- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -" />
									<p style="font-size:11px;font-weight:normal;color:#333333;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >Copyright &copy; 2010 Flavius-eurosound.de. All rights reserved.</p>
									<p style="font-size:11px;font-weight:normal;color:#333333;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >If you believe you have received this email in error or no longer wish to receive future emails from us, please reply to this mail suggesting your disagreement.</td>
							</tr>

						</table></td>
				</tr>
			</table>
			</body>
CONTENT;
        if($this->html) {
            $content = "
            <style>
               body {
				background: #ffffff;
				background-repeat: no-repeat repeat-y;
				margin: 0;
				padding: 0;
			}
			a img {
				border: none;
			}
			table.main {
				background-color: #ffffff;
				font-family: 'Helvetica Neue Lt Std', 'Helvetica Neue', Helvetica, Arial, Sans;
			}
			td.help {
				padding: 10px 0 10px 0;
			}
			td.help p {
				font-size: 11px;
				font-weight: normal;
				color: #333333;
				margin: 0;
				padding: 0;
			}
			td.help p a {
				font-size: 11px;
				font-weight: normal;
				color: #333333;
			}
			td.header {
				padding: 0 0 2px 0;
				text-align: center;
			}
			td.header h1 {
				font-size: 35px;
				line-height: 35px;
				font-weight: bold;
				color: #666666;
				margin: 0 0 0 10px;
				padding: 0;
				display: inline;
			}
			td.header h1 img {
				text-align: center;
			}
			td.date {
				padding: 8px 0 8px 0;
			}
			td.date p {
				font-size: 12px;
				font-weight: normal;
				color: #666666;
				margin: 0;
				padding: 0;
			}
			td.intro p.intro {
				line-height: 22px;
				font-weight: normal;
				color: #4c4c4c;
				margin: 30px 0 5px 0;
				padding: 0 0 0 0;
				font-size: 16px;
				font-weight: bold;
			}
			td.body h2 {
				font-size: 16px;
				font-weight: bold;
				color: #6ac4ec;
				margin: 0;
				padding: 0;
			}
			td.body h2 a {
				font-size: 18px;
				font-weight: bold;
				color: #ffffff;
				text-decoration: none;
			}
			td.body p {
				font-size: 14px;
				line-height: 22px;
				font-weight: normal;
				color: #555555;
				margin: 14px 0 0 0;
				padding: 0;
			}
			td.body p a {
				font-size: 14px;
				font-weight: bold;
				color: #6cb9ce;
			}
			td.body p.last {
				padding: 0;
			}
			td.body p.name {
				margin: 0;
			}
			td.body q, td.body cite {
				font-family: Georgia, serif;
				font-size: 14px;
				line-height: 22px;
				font-weight: normal;
				font-style: italic;
				margin: 14px 0 0 0;
				padding: 0;
				color: #777777;
			}
			td.body cite {
				margin-left: 30px;	
			}
			td.body q {
				quotes: none;	
			}
			td.body p img {
				border-bottom: 4px solid #edc913;
			}
			td.body img#signature {
				margin-left: 30px;
			}
			td.body blockquote {
				font-family: Georgia, serif;
				font-size: 16px;
				line-height: 22px;
				font-weight: normal;
				font-style: italic;
				color: #777777;
				margin: 14px 0 0 0;
				padding: 0 30px 0 30px;
			}
			td.body ul {
				font-size: 12px;
				font-weight: normal;
				color: #4c4c4c;
				margin: 10px 0 10px 0;
				padding: 0;
				list-style-position: inside;
			}
			td.footer {
				padding: 10px 0 10px 0;
			}
			td.footer p {
				font-size: 11px;
				font-weight: normal;
				color: #333333;
				margin: 0;
				padding: 0;
			}
			td.footer p a:link, td.footer p a:visited  {
				text-decoration: underline;
				color: #6ac4ec;
			}
			td.footer p a:hover  {
				text-decoration: underline;
				color: #333333;
			}
			td.center {
				text-align: center;
			}
            </style>
            ".$content;
        }
        $this->body = $content;
    }

    function send() 
    {
        if(mail($this->to, $this->subject, $this->body, $this->headers)) return TRUE;
        else return FALSE;
    }

    function set($key, $value) 
    {
        if($value) $this->$key = $value;
        else unset($this->$key);
		return $this;
    }
}