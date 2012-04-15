<!-- MRKelly 2004 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<?  
    require('conf.inc.php');
?>
<HTML><HEAD>
<TITLE>The Song Database</TITLE></HEAD>

<!-- frames -->
<frameset rows="130,*" border="0">
    <frame name="title" src="<? echo $server; ?>title.php" marginwidth="10" marginheight="10" scrolling="no" frameborder="no">
    <frameset  cols="33%,*">
        <frame name="songlist" src="<? echo $server; ?>blank.html" marginwidth="10" marginheight="10" scrolling="auto" frameborder="no">
        <frame name="details" src="<? echo $server; ?>blank.html" marginwidth="0" marginheight="10" scrolling="yes" frameborder="no">
    </frameset>
</frameset>

</td></table></BODY></HTML>
