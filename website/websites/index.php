<?php
ob_start('ob_gzhandler');
$s = time();
$baseUrl = 'http://localhost/benchmarksgame/website/websites';

// REVISED - don't have all pages expire at the same time!
// EXPIRE pages 31 hours after they are visited.
header("Pragma: public");
header("Cache-Control: maxage=".(31*3600).",public");
header("Expires: " . gmdate("D, d M Y H:i:s", $s + (31*3600)) . " GMT");
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<meta name="robots" content="index,follow,archive" /><meta name="revisit" content="14 days" />

<meta name="description" content="Compare the time and memory use of programs written in ~24 programming languages to solve ~12 simple benchmark tasks. Contribute your own programs." />

<meta name="HandheldFriendly" content="false" />
<meta name="google-site-verification" content="y9GFMJuxj7Ou4xK9YRagz9hCBfn1lyKcHQakWgkE7gg" />

<title>Computer Language Benchmarks Game</title>
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/benchmark_css_8oct2012.php" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/nohint_css_26jan2011.php" media="screen,print,projection"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>/hint_css_26jan2011.php" media="handheld,aural,braille"/>
<link rel="shortcut icon" href="<?php echo $baseUrl ?>/favicon_ico_11dec2009.php" />
</head>

<body id="core">

<table class="banner"><tr>
<td><h1><a>The&nbsp;Computer&nbsp;<strong>Language</strong>&nbsp; <br/><strong>Benchmarks</strong>&nbsp;Game</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $baseUrl ?>/play.php" title="How programs were measured. FAQs. How to contribute programs.">[[ Play ]]</a></h1></td>
</tr></table>

<div id="sitemap">

<p><i>"After all, facts are facts, and although we may quote one to another with a chuckle the words of the Wise Statesman, 'Lies--damned lies--and statistics,' still there are some easy figures the simplest must understand, and the astutest cannot wriggle out of."</i> <span class="smaller">Leonard Henry Courtney, 1895</span></p>

<p><g:plusone annotation="none"></g:plusone></p>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<p><strong>tl;dr</strong></p>

<p><strong>Measurement is highly specific</strong> -- the time taken for this <a href="<?php echo $baseUrl ?>/u32/performance.php?test=nbody#about" title="Read the task description">benchmark task</a>, by this <a href="<?php echo $baseUrl ?>/u32/program.php?test=nbody&amp;lang=gcc&amp;id=1#sourcecode" title="Read the program source code">toy program</a>, with this <a href="<?php echo $baseUrl ?>/u32/program.php?test=nbody&amp;lang=gcc&amp;id=1#about"  title="Check the version information">programming language implementation</a>, with these <a href="<?php echo $baseUrl ?>/u32/program.php?test=nbody&amp;lang=gcc&amp;id=1#log" title="Check the compiler flags and runtime options">options</a>, on this <a href="<?php echo $baseUrl ?>/more.php#machine" title="What hardware and OS do you measure the programs on?">computer</a>, with these <a href="<?php echo $baseUrl ?>/u32/program.php?test=nbody&amp;lang=gcc&amp;id=1#measurements" title="">workloads</a>.</p>

<p>Same toy program, same computer, same workload -- but <a href="<?php echo $baseUrl ?>/u32/program.php?test=nbody&amp;lang=cint&amp;id=1#measurements" title="">much slower</a>.</p>

<p>Measurement is not prophesy.</p>


<table>
<?php
$sites = array('u64q');

function PrintHeaders(){
   echo '<tr><th>&nbsp;</th><th></th><th></th><th></th></tr>';
   echo '<tr>';
   echo '<th class="u64q">&nbsp;x64&nbsp;Arch Linux&#8482; Intel&#174;&nbsp;Q6600&#174; quad-core&nbsp;</th>';
   echo '</tr>';
   echo '<tr><th>&nbsp;</th><th></th><th></th><th></th></tr>';
}


PrintHeaders();

$allsites = array('u64q');

$langs = array(
   array('php','PHP 5.6','php',$allsites),
   array('ruby','Ruby','ruby',$allsites),
   array('python','Python 2','python',$allsites),
   array('pypy','PyPy 2','pypy',$allsites),
   array('python3','Python 3','python3',$allsites),
   array('pypy3','PyPy 3','pypy3',$allsites),
   );


$tag = array(
   'u64q' =>'on multi core 64 bit Linux'
   );

foreach($langs as $lang){
   printf('<tr>');
   $name = $lang[1];
   $langsites = $lang[3];
   foreach($sites as $s){
      if (in_array($s,$langsites)){
         if (!empty($lang[2])){
            printf('<td><a href="' . $baseUrl . '/%s/%s.php" title="Compare %s program performance %s">%s</a></td>', $s, $lang[2], $name, $tag[$s], $name );
         } else {
            printf('<td><a href="' . $baseUrl . '/%s/compare.php?lang=%s" title="Compare %s program performance %s">%s</a></td>', $s, $lang[0], $name, $tag[$s], $name );
         }
      }
      else {
         printf('<td>&nbsp;</td>');
      }
   }
   printf('</tr>');
}


PrintHeaders();

$tests = array(
   array('nbody','n-body','Perform an N-body simulation of the Jovian planets')
   ,array('fannkuchredux','fannkuch-redux','Repeatedly access a tiny integer-sequence')
   ,array('meteor','meteor-contest','Search for solutions to shape packing puzzle')
   ,array('fasta','fasta','Generate and write random DNA sequences')
   ,array('spectralnorm','spectral-norm','Calculate an eigenvalue using the power method')
   ,array('revcomp','reverse-complement','Read DNA sequences and write their reverse-complement')
   ,array('mandelbrot','mandelbrot','Generate a Mandelbrot set and write a portable bitmap')
   ,array('knucleotide','k-nucleotide','Repeatedly update hashtables and k-nucleotide strings')
   ,array('regexdna','regex-dna','Match DNA 8-mers and substitute nucleotides for IUB code')
   ,array('pidigits','pidigits','Calculate the digits of Pi with streaming arbitrary-precision arithmetic')
   ,array('chameneosredux','chameneos-redux','Repeatedly perform symmetrical thread rendezvous requests')
   ,array('threadring','thread-ring','Repeatedly switch from thread to thread passing one token')
   ,array('binarytrees','binary-trees','Allocate and deallocate many many binary trees')
   );

foreach($tests as $t){
   printf('<tr>');
   foreach($sites as $s){
      if ($s=='u64q'){
         printf('<td><a href="' . $baseUrl . '/%s/performance.php?test=%s">%s</a></td>', $s, $t[0], $t[2] );
      } else {
         printf('<td><a href="' . $baseUrl . '/%s/performance.php?test=%s" title="%s">%s</a></td>', $s, $t[0], $t[2], $t[1] );
      }
   }
   printf('</tr>');
}

PrintHeaders();

$page = array(
    array('which-programs-are-fastest.php','Which programs are fastest?','Which of these language implementations have the fastest benchmark programs?')
   );

foreach($page as $p){
   printf('<tr>');
   foreach($sites as $s){
      printf('<td><a href="' . $baseUrl . '/%s/%s" title="%s">%s</a></td>', $s, $p[0], $p[2], $p[1] );
   }
   echo "</tr>";
}

?>

</table>


<p class="imgfooter">&nbsp; <a href="<?php echo $baseUrl ?>/mobile/index.php" title="Handheld Friendly website">Mobile</a> &nbsp; <a href="<?php echo $baseUrl ?>/dont-jump-to-conclusions.php">Conclusions</a> &nbsp; <a href="<?php echo $baseUrl ?>/license.php">License</a> &nbsp; <a href="<?php echo $baseUrl ?>/play.php">Play</a> &nbsp;</p>

</div>


<?php include_once("analyticstracking.php") ?>
</body>
</html>
