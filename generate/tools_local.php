<?

require_once('../config.php');
require_once('lib/Translation.class.php');
$benchmark_start = microtime_float();

// arguments
$lang = isset($_POST['lang']) ? $_POST['lang'] : 'en';
//$tools_dir = 'reference/'.($lang != 'en' ? "$lang/" : '').'tools';
$tools_dir = DISTDIR.'tools';

// get translation file
//$translation = new Translation($lang);

// get tools index
$index = CONTENTDIR."api_en/tools/index.html";
//$page = new Page('Tools', 'Tools');
$page = new LocalPage('Tools', 'Tools', 'Tools', '../');
$page->content(file_get_contents($index));
//make_necessary_directories(BASEDIR.$tools_dir.'/images/include.php');
writeFile('distribution/tools/index.html', $page->out());

//if (!is_dir(DISTDIR.'tools/images')) { 
rmdir(DISTDIR.'tools/images');
mkdir(DISTDIR.'tools/images', '0751'); 
//}
copydirr(CONTENTDIR."api_$lang/tools/images", DISTDIR.'tools/images');

// copy over the files for the contributed libraries
copy(CONTENTDIR."static/tools.html", DISTDIR.'tools/tools.html');
//copy(CONTENTDIR."static/tools.html", BASEDIR.$tools_dir.'/tools.html');
//copydirr(CONTENTDIR.$source.'/images', DISTDIR.$destination.'/images');


$benchmark_end = microtime_float();
$execution_time = round($benchmark_end - $benchmark_start, 4);

?>

<h2>Tool Generation Successful</h2>
<p>Generated files in <?=$execution_time?> seconds.</p>
