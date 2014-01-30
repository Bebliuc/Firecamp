<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Daily Website Statistics - Firecamp</title>
<style type="text/css">
a:hover { color: #4e3227 !important; text-decoration: underline !important; }
</style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #fdfcf9; background-image: url('<?php echo $url; ?>body-bg.jpg'); background-repeat: repeat;" bgcolor="#FFFFFF" leftmargin="0">
<!--100% body table-->
<table cellspacing="0" background="<?php echo $url; ?>body-bg.jpg" border="0" cellpadding="0" width="100%" bgcolor="#fdfcf9">
    <tr>
        <td>
            <!--email container-->
            <table cellspacing="0" border="0" align="center" cellpadding="0" width="740">
                <tr>
                    <td>
                        <!--top-->
                        <table cellspacing="0" border="0" cellpadding="0" width="740">
                            <tr>
                                <td height="50" valign="middle">
                                    <p style="color: #b2b2b2; margin: 0px; font-size: 12px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;">Is this email not displaying correctly?
                                        <webversion style="color: #f0727b; font-size: 12px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; text-decoration: underline;"> Check the statistics in your <a href="http://login.bebliuc.ro" style="color:#990000">administration panel</a></webversion>
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <!--/top-->
                        <!--email content-->
                        <table cellspacing="0" border="0" style="border: solid 1px #e3e3e3;" bgcolor="#FFFFFF" cellpadding="0" width="740">
                            <tr>
                                <td>
                                    <!--intro-->
                                    <table cellspacing="0" border="0" cellpadding="0" width="740" style="background: url(<?php echo $url; ?>dash.jpg) top repeat-x;">
                                        <tr>
                                            <td height="150" valign="top" width="502">
                                                <table cellspacing="0" border="0" cellpadding="0" width="100%">
                                                    <tr>
                                                        <td height="150">
                                                            <table width="470" border="0" align="left" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td>
                                                                       <img src="<?php echo $url; ?>header.png" width="400" height="66" />
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td valign="top" width="174">
                                                <table cellspacing="0" border="0" cellpadding="0" width="143">
                                                    <tr>
                                                        <td background="<?php echo $url; ?>date-bg.jpg" height="126" valign="bottom" style="background-image: url(<?php echo $url; ?>date-bg.jpg); background-repeat: no-repeat; background-position: bottom; background-color: #b8cfc8;" bgcolor="#b8cfc8">
                                                            <table cellspacing="0" border="0" cellpadding="0" width="100%">
                                                                <tr>
                                                                    <td align="center" height="125">
                                                                        <h2 style="font-size: 22px; font-family: Georgia, 'Times New Roman', Times, serif; color: #ffffff; margin: 0px;">
																			30 November
                                                                        </h2>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table cellspacing="0" border="0" cellpadding="0" width="740">
										<tr>
                                            <td valign="top" style="background-color: #DFDFDF" bgcolor="#DFDFDF">
                                                <table cellspacing="0" border="0" cellpadding="30" width="740">
                                                    <tr>
                                                        <td>
                                                             <img src="<?php echo $url; ?>top5referals.png" height="17" width="242" alt="Top 5 referals / today statistics"/>
															 <table cellspacing="0" border="0" width="450" style="table-layout:fixed; width:450px">
																<?php foreach($popularPages as $page): ?>
																<tr>
																	<td width="150" style="width:150px;"><span style="text-align:left; display:block; height: 20px; width:150px; background-color:#0488C1; font-family:Helvetica Neue, Helvetica; padding-left:5px; font-weight:lighter; color:#FFFFFF; font-size:12px; padding-top:2px"><?php echo page::getPageTitleById($page->page_id); ?></span></td>
																	<td width="300" style="overflow:visible;"><span style="text-align:center; display:block; height: 20px; width:<?php echo $page->visits*10; ?>px; background-color:#9FCC35; font-family:Helvetica Neue, Helvetica; font-weight:lighter; color:#4E3227; font-size:12px; padding-top:2px; border-right:2px solid #BFBFBF;"><?php echo $page->visits; ?></span></td>
																</tr>
																<?php endforeach; ?>
															 </table>
                                                        </td>
														<td><h4 style="font-size:34px; text-align:center; font-weight:lighter;color:#9FCC35; padding:0px; margin:0px; font-family:Helvetica Neue, Helvetica, Georgeia, 'Times New Roman', Times, serif;"><?php echo $today_hits; ?></h4><h4 style="font-size:20px; font-weight:lighter;color:#AFAFAF; padding:0px; margin:0px; font-family:Helvetica Neue, Helvetica, Georgeia, 'Times New Roman', Times, serif;">visits today</h4></td>
                                                    </tr>
                                                </table>
                                                <!--/intro-->
                                            </td>
                                        </tr>
                                        <tr>
											<td valign="top" style="background-color: #990000; background-image: url(<?php echo $url; ?>firecamp.png)" bgcolor="#990000">
                                                <table cellspacing="0" border="0" cellpadding="30" width="740">
                                                    <tr>
                                                        <td>
														<img src="<?php echo $url; ?>website_unique_total_visits.png" alt="Website Unique / Total visits" height="17" width="203" />
														<img src="<?php echo $days_statistics; ?>" alt="Statistics" width="675" height="250" style="padding:0px" />
														</td>
													</tr>
												</table>
											</td>
                                        </tr>
                                    </table>
                                    <table cellspacing="0" border="0" cellpadding="25" width="740">
                                        <tr>
                                            <td>
                                                <!--line break-->
                                                <table cellspacing="0" border="0" cellpadding="0" width="100%">
                                                    <tr>
                                                        <td height="40" valign="middle"><img src="<?php echo $url; ?>line-break.jpg" height="10" width="626" /></td>
                                                    </tr>
                                                </table>
                                                <!--/line break-->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!--/email content-->
                        <!--footer-->
                        <table cellspacing="0" id="footer" border="0" width="100%" cellpadding="20">
                            <tr>
                                <td valign="top" width="600">
                                    <p style="color: #b2b2b2; margin: 0px 0px 12px; font-size: 13px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;">You’re receiving this newsletter because you are a Firecamp client.
                                        <unsubscribe style="color: #f0727b; text-decoration: underline; font-size: 13px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;" href="#">Unsubscribe instantly.</unsubscribe>
                                    </p>
                                </td>
                                <td valign="top" width="300">
                                    <table cellspacing="0" border="0" width="220" cellpadding="0">
                                        <tr>
                                            <td valign="top" align="right"></td>
                                            <td align="right">
                                                <p style="color: #b2b2b2; margin: 0px 2px 12px; font-size: 13px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;">Bebliuc, Firecamp<br />
                                                    All rights reserved<br />
                                                    </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!--/footer-->
                    </td>
                </tr>
            </table>
            <!--/email container-->
        </td>
    </tr>
</table>
<!--/100% body table-->
</body>
</html>