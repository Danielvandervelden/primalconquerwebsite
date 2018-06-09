<?php

set_time_limit(0);
ini_set('memory_limit', '512M');

define('WP_INSTALLING', true);
define('FIXURLS_BATCH_SIZE', 5000);

require_once 'fixurls.class.php';

$manager = new XLII_FixUrls();


// Include wp load
if($base = $manager->locate())
{
	if(file_exists($config = $base . '/wp-load.php') || file_exists($config = $base . '/core/wp-load.php'))
	{
		// -- Try and detect/replace multisite host
		$_host = $_SERVER['HTTP_HOST'];
		$_SERVER['HTTP_HOST'] = $manager->detectHost($base);
		
		require_once $config;
		
		$_SERVER['HTTP_HOST'] = $_host;
	}
}

if(!defined('ABSPATH'))
  die('wp-load.php could not be found, please edit this file (<em>' . __FILE__ . '</em>) and specify the location.');

ini_set('display_errors', true);
error_reporting(E_ALL);

$form = array(
	'development' => $manager->isDevelopment(),
	'module' => array(
		'multisite' => $manager->isMultiSite(),
		'buddypress' => $manager->isBuddyPress(),
		'https' => $manager->isSSL()
	)
);

// Add site replacements

{
	$form['search'] = $form['replace'] = array();

	// Setup initial search/replace - extract diff if possible
	foreach($manager->getSites() as $i => $site)
	{
		$search = preg_replace('/^https?:\/\//', '', $site);
		$search = explode('/', $search);
		$search = array_shift($search);
	
		$replace = $_SERVER['HTTP_HOST'];
	
		if(!isset($diffSearch) && $common = $manager->getCommonSequence($search, $replace))
		{
			$diffSearch = substr($search, strlen($common));
			$diffReplace = substr($replace, strlen($common)); 
		}
	
		$form['search'][] = $search;
		$form['replace'][] = $replace;
	}

	// dereference variables
	unset($search, $replace);

	$form['search'] = array_unique($form['search']);

	if(count($form['search']) > 1)
	{
		// Include smart replacement
		foreach($form['replace'] as $key => &$replace)
		{
			$search = &$form['search'][$key];
	
			if(isset($diffSearch))
			{
				$replace = $diffSearch ? str_replace($diffSearch, $diffReplace, $search) : $search . $diffReplace;
			}
			else if($manager->isDevelopment() && $i !== 0 && strpos($search, $replace) === false)
			{	
				$pos = stripos($_SERVER['HTTP_HOST'], '.test');
				$replace =  $search . ($pos === false ? '.local' : substr($_SERVER['HTTP_HOST'], $pos));
			}
		
			if($manager->isDevelopment())
				$replace = str_replace('www.', '', $replace);
		}

		// dereference variables
		unset($search, $replace);
	}
}	

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$form = $_POST;
	$form['response'] = array();
	
	foreach($form['search'] as $key => $search)
	{
		if(empty($search) || empty($form['replace'][$key]))
			continue;
		
		if(empty($form['module']['https']))
			$manager->addReplacement('https://' . $search, 'http://' . $form['replace'][$key]);
		else
			$manager->addReplacement('http://' . $search, 'https://' . $form['replace'][$key]);
			
	
		$manager->addReplacement($search, $form['replace'][$key]);
	}
	
	if(empty($form['password']) || $form['password'] != DB_PASSWORD)
		$form['response'][] = 'Sorry, but the <span>database password</span> you provided dit not match the password in your wp-config.';
	
	if(!empty($form['module']['multisite']))
	{
		if($manager->isMultiSite())
		{
			$blogs = $wpdb->get_results('SELECT blog_id, domain, path FROM '.$wpdb->blogs);
			if(!$blogs || !count($blogs))
				$form['response'][] = 'Sorry, but we couldn\'t find any blogs. <span>Are you sure this is a WPMU-install</span> and that it has at least 1 blog?';
		}
		else
		{
			$form['response'][] = 'WordPress doesn\'t seem to agree that you\'re running a multisite, make sure your config is up to date.';
		}
	}
	
	if(!count($form['response']))
	{		
		//manager->repairUsers();
		
		if(!empty($form['module']['buddypress']))
			$manager->repairBuddyPress();
			
		if(!empty($form['module']['multisite']))
		{
			foreach ($blogs as $blog )
			{
				$manager->notice('"<span>'.$blog->domain.$blog->path.'</span>" - Switched to blog');
				
				switch_to_blog( $blog->blog_id );
				
				$manager->enableSEO(empty($form['development']))
					 	->repairOptions()
			 		 	->repairPosts()
						->repairTerms()
						->repairComments();
			}
			
			$manager->repairMultiSite();
		}
		else
		{
			$manager->enableSEO(empty($form['development']))
					->repairOptions()
					->repairPosts()
					->repairTerms()
					->repairComments();
		}
		
		// Remove cache
		$manager->flushCache();
		
		$form['response'] = '<ul class = "response success"><li>'.implode('</li><li>', $manager->getNotices()).'</li></ul>';
	}
	else
	{
		$form['response'] = '<ul class = "response error"><li>'.implode('</li><li>', $form['response']).'</li></ul>';
	}
}

require_once 'view.phtml';
