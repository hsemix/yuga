<?php
namespace Yuga\Views;
use Exception;
use Yuga\Session\Session;
use Yuga\Http\Request;
use Yuga\Views\Inheritance\View;
use Yuga\Validate\Message;
class SmxViewOld extends View
{
    private $hax = '.hax.php';
    
    public function __construct($template_dir = NULL) 
    {
        if ($template_dir) {
            $this->template_dir = $template_dir;
        }
        $this->vars['session'] = \App::make('session');
        $this->vars['request'] = new Request;
        $this->vars['errors'] = new Message;
        if ($this->session->exists('errors')) {
            $this->vars['errors'] = $this->session->get('errors');
        }
    }
    
    
    public function display($temp, $data = false)
    {
        if(file_exists($this->template_dir.$temp.$this->hax)){
           echo $this->renderHaxTemplate($temp);
        }else{
            if($data) {
                echo $this->render($temp, $data);
            }else{
                echo $this->render($temp);
            }
        }
	
    }
    
    
    public function renderHaxTemplate($templateName) 
    {
        $templateName = $templateName.$this->hax;
        if(!file_exists($this->template_cache_dir)){
			mkdir($this->template_cache_dir, 0777, true);
		}
        $templateLocation = $this->template_dir.$templateName;
        $cacheLocation    = $this->template_cache_dir.$templateName;
        if(strstr($templateName, '/')){
            $ffs = explode("/", $templateName);
            $cacheLocation = $this->template_cache_dir.end($ffs);
        }
            
        if (file_exists($this->template_dir.$templateName)) {
            if (!file_exists($cacheLocation) || filemtime($cacheLocation) < filemtime($templateLocation)) { 
                $code = file_get_contents($templateLocation);
                if(strstr($code, "<?php") || strstr($code, "<?") || strstr($code, "<?=") || strstr($code, "?>")){
                    try{
                        throw new Exception("php tags detected in $templateLocation, use {% } instead <br />");
                    }catch(Exception $e){
                        echo $e->getMessage();
                    }
                }

                if(preg_match("~@extends(.*)~", $code, $matches)){
                    
                    $master = preg_replace("~\(\'~", '', $matches[1]); 
                    $master = preg_replace("~\'\)~", '', $master); 
                    $master = preg_replace("~\s+~", '', $master);

                    $master = preg_replace('~\(\"~', '', $master); 
                    $master = preg_replace('~\"\)~', '', $master); 
                    $master = preg_replace("~\s+~", '', $master); 
                    $masterFile = str_replace('.', '/', $master);
                    $file = $masterFile.".hax.php";

                    $masterLocation = $this->template_dir.$file;
                    if(strstr($file, '/')){
                        $fs = explode('/', $file);
                        $file = end($fs);
                    }

                    
                    
                    $masterCacheLocations = $this->template_cache_dir.$file;
                    
                    if (file_exists($masterLocation)) {
                        if (!file_exists($masterCacheLocations) || filemtime($masterCacheLocations) < filemtime($masterCacheLocations)) {
                            $masterContents = file_get_contents($masterLocation);
                            $masterContents = preg_replace('~@yield(.*)~', '<?php  $this->emptySection $1; ?>', $masterContents);
                            $masterContents = preg_replace('~@section(.*)~', '<?php  $this->section $1; ?>', $masterContents);
                            $masterContents = preg_replace('~@endsection(.*)~', '<?php  $this->endSection(); ?>', $masterContents);
                            
                            file_put_contents($masterCacheLocations, $masterContents);
                        }
                    }
                }
                if (isset($file)) {
                    $code = preg_replace('~@extends(.*)~', '<?php  include_once("'.$file.'"); ?>', $code);
                }
                
                $code = preg_replace('~@section(.*)~', '<?php  $this->section $1; ?>', $code);
                $code = preg_replace('~@parent~', '<?php  $this->parentSection(); ?>', $code);
                $code = preg_replace('~@endsection(.*)~', '<?php  $this->endSection(); ?>', $code);
                $code = preg_replace('~\{%\s*(.+?)\s*\}~', '<?php $1 ?>', $code); // single line php code
                $code = preg_replace('~\{%~', '<?php', $code); // start php block
                $code = preg_replace('~\{{\s*(.+?)\s*\}}~', '<?php echo htmlspecialchars($1, ENT_QUOTES) ?>', $code);
                $code = preg_replace('~\{{!\s!\s*(.+?)\s*\}}~', '<?php echo $1 ?>', $code);
                $code = preg_replace('~\%}~', '?>', $code); // end php block
                $code = preg_replace('~@if(.*)~', '<?php  if $1: ?>', $code); // php if
                $code = preg_replace('~@elseif(.*)~', '<?php  elseif $1: ?>', $code);
                $code = preg_replace('~@else~', '<?php  else: ?>', $code);
                $code = preg_replace('~@endif~', '<?php  endif; ?>', $code);
                $code = preg_replace('~@foreach(.*)~', '<?php  foreach $1: ?>', $code);
                $code = preg_replace('~@endforeach~', '<?php  endforeach; ?>', $code);
                $code = preg_replace('~@for(.*)~', '<?php  for $1: ?>', $code);
                $code = preg_replace('~@endfor~', '<?php  endfor; ?>', $code);
                file_put_contents($cacheLocation, $code);
            }
            extract($this->vars, EXTR_SKIP);
            include_once $cacheLocation;

            unlink($cacheLocation);
            if (isset($file)) {
                if (file_exists($this->template_cache_dir.$file))
                    unlink($this->template_cache_dir.$file);
            }
            rmdir($this->template_cache_dir);
        }else{
            die('no template file ' . $templateName.$this->hax . ' present in directory ' . $this->template_dir);
        }
    }
    public function displayArr ($fileName, $dataAr) 
    { 
        $rendered = "";
        if(count($dataAr && is_array($dataAr))) {
            foreach($dataAr AS $data) {
                $rendered.= $this->display($fileName, $data);
            }
        }
        return $rendered;
    
    }
}