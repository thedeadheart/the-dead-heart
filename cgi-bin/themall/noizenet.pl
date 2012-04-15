#!/usr/bin/perl -w

$catalog = `lynx -dump -width=2000 http://www.noizenet.com.au/cgi-bin/search/csvgenerator.pl?aid=2365`;
#$catalog = `lynx -dump http://chatswood/midnight.txt`;
$file = "/home/httpd/html/deadheart/media/store/noizenet.html";
#$file = "/users/mkelly/www/media/store/noizenet.html";

$catalog =~ s/^\s{1,3}//;

@lines = split(/\n/, $catalog);

$into_album = 0;
$into_singles = 0;
$into_videos = 0;
$into_related = 0;

$albums_1 = "";
$singles_1 = "";
$videos_1 = "";
$related_1 = "";

foreach(@lines) {
	if ($into_album == 1) {
		if (/\[END ALBUMS\]/) {
			$into_album = 0;
			next;
		}
		$_ =~ /ARTIST=(.*)\*\*TITLE=(.*)\*\*COVER=(.*)\*\*FORMAT=(.*)\*\*RELEASED=(.*)\*\*COMPANY=(.*)\*\*SOURCE=(.*)\*\*AUSPRICE=(.*)\*\*USPRICE=(.*)\*\*UKPRICE=(.*)\*\*ID=(.*)\s*/;
		$artist = $1;
		$title = $2;
		$cover_url = $3;
		$format = $4;
		$released = $5;
		$company = $6;
		$source = $7;
		$ausprice = $8;
		$usprice = $9;
		$ukprice = $10;
		$id = $11;
		$albums_1 = $albums_1."<tr><td><a href=\"http://www.noizenet.com.au/cgi-bin/search/productview.pl?ID=$id\">$title</a></td><td>".$format."</td><td>".$source."</td><td bgcolor=\"#eead8e\">".$ausprice."</td><td bgcolor=\"#eead8e\">".$usprice."</td><td bgcolor=\"#eead8e\">".$ukprice."</td></tr>\n";
	}
	if (/\[BEGIN ALBUMS\]/) {
		$albums_1 = $albums_1."<tr><td colspan=6><b>Albums</b></td></tr>\n";
		$into_album = 1;
	}

	if ($into_singles == 1) {
		if (/\[END SINGLES\]/) { 
			$into_singles = 0;
			next;
		}
		$_ =~ /ARTIST=(.*)\*\*TITLE=(.*)\*\*COVER=(.*)\*\*FORMAT=(.*)\*\*RELEASED=(.*)\*\*COMPANY=(.*)\*\*SOURCE=(.*)\*\*AUSPRICE=(.*)\*\*USPRICE=(.*)\*\*UKPRICE=(.*)\*\*ID=(.*)\s*/;
		$artist = $1;
		$title = $2;
		$cover_url = $3;
		$format = $4;
		$released = $5;
		$company = $6;
		$source = $7;
		$ausprice = $8;
		$usprice = $9;
		$ukprice = $10;
		$id = $11;
		$singles_1 = $singles_1."<tr><td><a href=\"http://www.noizenet.com.au/cgi-bin/search/productview.pl?ID=$id\">$title</a></td><td>".$format."</td><td>".$source."</td><td bgcolor=\"#eead8e\">".$ausprice."</td><td bgcolor=\"#eead8e\">".$usprice."</td><td bgcolor=\"#eead8e\">".$ukprice."</td></tr>\n";
	}
	if (/\[BEGIN SINGLES\]/) {
		$singles_1 = $singles_1."<tr><td colspan=6><b>Singles</b></td></tr>\n";
		$into_singles = 1;
	}

	if ($into_videos == 1) {
		if (/\[END VIDEOS\]/) { 
			$into_videos = 0;
			next;
		}
		$_ =~ /ARTIST=(.*)\*\*TITLE=(.*)\*\*COVER=(.*)\*\*FORMAT=(.*)\*\*RELEASED=(.*)\*\*COMPANY=(.*)\*\*SOURCE=(.*)\*\*AUSPRICE=(.*)\*\*USPRICE=(.*)\*\*UKPRICE=(.*)\*\*ID=(.*)\s*/;
		$artist = $1;
		$title = $2;
		$cover_url = $3;
		$format = $4;
		$released = $5;
		$company = $6;
		$source = $7;
		$ausprice = $8;
		$usprice = $9;
		$ukprice = $10;
		$id = $11;
		$videos_1 = $videos_1."<tr><td><a href=\"http://www.noizenet.com.au/cgi-bin/search/productview.pl?ID=$id\">$title</a></td><td>".$format."</td><td>".$source."</td><td bgcolor=\"#eead8e\">".$ausprice."</td><td bgcolor=\"#eead8e\">".$usprice."</td><td bgcolor=\"#eead8e\">".$ukprice."</td></tr>\n";
	}
	if (/\[BEGIN VIDEOS\]/) {
		$videos_1 = $videos_1."<tr><td colspan=6><b>Videos</b></td></tr>\n";
		$into_videos = 1;
	}

	if ($into_related == 1) {
		if (/\[END RELATED\]/) { 
			$into_related = 0;
			next;
		}
		$_ =~ /ARTIST=(.*)\*\*TITLE=(.*)\*\*COVER=(.*)\*\*FORMAT=(.*)\*\*RELEASED=(.*)\*\*COMPANY=(.*)\*\*SOURCE=(.*)\*\*AUSPRICE=(.*)\*\*USPRICE=(.*)\*\*UKPRICE=(.*)\*\*ID=(.*)\s*/;
		$artist = $1;
		$title = $2;
		$cover_url = $3;
		$format = $4;
		$released = $5;
		$company = $6;
		$source = $7;
		$ausprice = $8;
		$usprice = $9;
		$ukprice = $10;
		$id = $11;
		$related_1 = $related_1."<tr><td><a href=\"http://www.noizenet.com.au/cgi-bin/search/productview.pl?ID=$id\">$title</a></td><td>".$format."</td><td>".$source."</td><td bgcolor=\"#eead8e\">".$ausprice."</td><td bgcolor=\"#eead8e\">".$usprice."</td><td bgcolor=\"#eead8e\">".$ukprice."</td></tr>\n";
	}
	if (/\[BEGIN RELATED\]/) {
		$related_1 = $related_1."<tr><td colspan=6><b>Related</b></td></tr>\n";
		$into_related = 1;
	}
}

$update = localtime;
$update =~ /\w*\s(.*)\s(\d*)\s(\d*):(\d*):\d*\s(\d*)/;
$new_update = "$3:$4, $2 $1 $5";

open OUTPUT, ">$file" or die "$!";

print OUTPUT <<EOTEXT;
<!-- Maurice R. Kelly 2000 -->
<!-- The Deart Heart www.deadheart.org.uk -->

<html><head><title>"The Mall" - NoizeNet</title>
<link rel=stylesheet href="mall.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" topmargin=2 leftmargin=2 marginwidth=2 marginheight=1>

<table align="right" border=0 width="110" height="145" cellspacing=0 cellpadding=0>
	<tr>
		<td align="middle" valign="middle" height=79 background="mall_top_nologo.gif">
			<a href="./"><img src="the_mall_logo-sm.gif" width=95 height=38 border=0 alt="The Mall"></a>
		</td>
	</tr>
	<tr>
		<td background="mall_bot.gif" height=66 align="middle">
			<a href="/main_page.php" class="backlink">tdh</a><br>
			<a href="/media/" class="backlink">media</a>
		</td>
	</tr>
</table>

<p><img src="the_mall_logo.gif" alt="The Mall" width=255 height=78 border=0></p>
<p><a href="http://www.noizenet.com.au/"><img src="noizenet_hub.gif" alt="NoizeNet" width=216 height=91 border=0></a></p>

<p>NoizeNet have been very kind and have provided The Dead Heart with a way to grab it's Midnight Oil catalogue directly from their site. Below you'll find the entire Oils catalogue from NoizeNet - just click on the item's title to go to the product information page.</p>

<p>NoizeNet's generosity does not end at supplying the details in an easy to read form - <a href="http://www.deadheart.org.uk/">The Dead Heart</a> has joined NoizeNet's Fund Raising Affiliate Program. When you buy from NoizeNet having come through this page, 10% of the price of the itmes you buy will be donated to an organisation of The Dead Heart's choice. We decided to direct these funds to the <a href="http://www.acfonline.org.au/">Australian Conservation Foundation</a>, an organisation whose current president is none other than Peter Garrett.</p>

<p>This page will be updated every week and was last updated on $new_update</p>

<table border=1>
	<tr>
		<td bgcolor=\"#eead8e\"><b>Title</b></td>
		<td bgcolor=\"#eead8e\"><b>Format</b></td>
		<td bgcolor=\"#eead8e\"><b>Source</b></td>
		<td bgcolor=\"#ff8d8e\"><b>Price: AUD</b></td>
		<td bgcolor=\"#ff8d8e\"><b>Price: USD</b></td>
		<td bgcolor=\"#ff8d8e\"><b>Price: UKP</b></td>
	</tr>
EOTEXT

print OUTPUT $albums_1;
print OUTPUT $singles_1;
print OUTPUT $videos_1;
print OUTPUT $related_1;
print OUTPUT "</table>";

print OUTPUT "</body></html>\n";
