#!/usr/bin/perl -w

$catalog = `lynx -dump http://eil.com/eil/midnight.txt`;
#$catalog = `lynx -dump http://chatswood/midnight.txt`;
#$file = "/home/httpd/html/deadheart/media/store/esprit.html";
$file = "/users/mkelly/www/media/store/esprit.html";

@lines = split(/\n/, $catalog);

$oil_line_flag = 0;

foreach (@lines) {
	if ($oil_line_flag == 0 and /^MIDNIGHT OIL/) {
		$oil_line_flag = 1;
	}
	if ($oil_line_flag == 1) {
		$_ = $_."\n";
		push @lines2, $_;
	}
}


foreach (@lines2) {
	unless (/^\n$/ or /^------E/) { push @lines3,$_ };
}

$lines4 = "";
foreach (@lines3) {
	chomp($_);
	if (/^MIDNIGHT/) {
		$lines4 = $lines4."\n".$_;
	}
	else {
		$lines4 = $lines4.$_;
	}
}
$lines4 = $lines4."\n";

@lines4 = split(/\n/, $lines4);

foreach (@lines4) {
        unless (/^$/ or /^------E/) { push @lines5,$_."\n" };
}

foreach (@lines5) {
	chomp($_);
	$templine="";
	/^.*OIL\s(.*)\s\(/;
	$templine = $templine.$1."@@";
	/\((.*)\)/;
	$templine = $templine.$1."@@";
	/\£\s*(\d*\.\d*)\s*\//;
	$templine = $templine.$1."@@";
	/\/\s*\$\s*(\d*.\d*)$/;
	$templine = $templine.$1."\n";
	push @lines6, $templine;
}

$update = localtime;
$update =~ /\w*\s(.*)\s(\d*)\s(\d*):(\d*):\d*\s(\d*)/;
$new_update = "$3:$4, $2 $1 $5";

open OUTPUT, ">$file" or die "$!";

print OUTPUT <<EOTEXT;
<!-- Maurice R. Kelly 2000 -->
<!-- The Deart Heart www.deadheart.org.uk -->

<html><head><title>"The Mall" - Esprit International</title>
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
<h1>Esprit International</h1>

<p>On a regular basis, the Dead Heart grabs a snapshot of what rareties dealer Esprit International has on offer. You can also visit their <a href="http://eil.com/shop/ShowStockLink.asp?Searchby=artist&Sortby=title&SearchText=Midnight+Oil&Latest=&InStock=&CDs=&Vinyl=&Video=&Cass=&Promo=&picsleeve=&vDelItem=&BoxSet=&Memorabilia=">Midnight Oil</a> page directly if you wish. Note that the above link is not quite the same as the information below - what you see on this page is exactly what is in stock. The above link is a page which also shows out of stock items (and how much you can expect to pay next time they come in).</p>

<p>Currently this page is updated every two hours - if Esprit object to this, polling may be reduced to a less frequent rate.<br>
Last Updated:- $new_update</p>

<table border=1>
	<tr>
		<td bgcolor=\"#eead8e\"><b>Title</b></td>
		<td bgcolor=\"#eead8e\"><b>Description</b></td>
		<td bgcolor=\"#ff8d8e\"><b>Price: UKP</b></td>
		<td bgcolor=\"#ff8d8e\"><b>Price: USD</b></td>
	</tr>
EOTEXT

$tot_price_ukp = 0;
$tot_price_usd = 0;

foreach (@lines6) {
	chomp;
	($title, $description, $pounds, $dollars) = split /@@/;
	print OUTPUT "\t<tr>";
	print OUTPUT "<td>".$title."</td>";
	print OUTPUT "<td>".$description."</td>";
	print OUTPUT "<td bgcolor=\"#eead8e\">".$pounds."</td>";
	print OUTPUT "<td bgcolor=\"#eead8e\">".$dollars."</td>";
	print OUTPUT "</tr>\n";
	$tot_price_ukp = $tot_price_ukp + $pounds;
	$tot_price_usd = $tot_price_usd + $dollars;
}
print OUTPUT "	<tr>
		<td colspan=2><b>Total value of all items</b></td>
		<td bgcolor=\"#ff8d8e\"><b>&pound;$tot_price_ukp</b></td>
		<td bgcolor=\"#ff8d8e\"><b>\$$tot_price_usd</b></td>
	</tr>\n";
print OUTPUT "</table>\n";

print OUTPUT <<EOFOOTER;
<h3>Postage Rates</h3>
<p><b>UK</b><br>
7", CD, Cassette, Press Packs, Fanzines - £1.25 and 50p each after.<br>
12", T-shirts, Videos, Small Posters, Small Displays - £2.00 and 50p each after.<br>
Optional Insurance £4.00 per order. Citylink Courier Service £11.00 for next day delivery (£26.00 for a Saturday delivery)</p>

<p><b>Europe, Norway & Switzerland</b><br>
7", CD, Cassette, Press Packs, Fanzines - £3.00 and £1.00 each after.<br>
12", T-shirts, Videos, Small Posters, Small Displays - £4.25 and £1.25 each after.<br>
Optional insurance £5.00 per order.</p>

<p><b>United States, Canada, Singapore</b><br>
7", CD, Cassette, Press Packs, Fanzines - £3.50 and £1.00 each after.<br>
12", T-shirts, Videos, Small Posters, Small Displays - £6.00 and £1.50 each after.<br>
Optional Insurance £5.00 per order for Singapore and £10.00 per order for US & Canada.</p>

<p><b>Rest of the World including Japan, Australia, New Zealand</b><br>
7", CD, Cassette, Press Packs, Fanzines - £4.00 and £1.25 each after.<br>
12", T--shirts, Videos, Small Posters, Small Displays - £6.00 and £2.00 each after.<br>
Optional insurance £5.00 per order.</p>

<p>Unusual sized items will be priced on a cost basis - please contact us for an individual quote.</p>

<p>Because of a history of missing & damaged parcels to Argentina, Brazil, Chile, Mexico and Indonesia, orders over £75.00 to these countries must have compulsory insurance added to normal postal rates above at the following rates<br>
Brazil, Mexico & Indonesia £10.00.<br>
Argentina, Chile £5.00</p>


</body></html>

EOFOOTER

