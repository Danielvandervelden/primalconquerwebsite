<?php
/** 
 * @author 42functions | Ferdy Perdaan
 * @version 1.0
 */

class XLII_FixUrls
{
	private $_replace;
	private $_notice;
	
	const LIMIT = 2500;
	
	/**
	 * Setup an default fixurls object.
	 */
	public function __construct()
	{
		$this->_replace = array(
			'search' => array(),
			'replace' => array(),
			'pattern' => ''
		);
		$this->_notice = array();
	}
	
	/**
	 * Append a replacement to fixurls.
	 * 
	 * @param	string $search The content to search for.
	 * @param	string $replace The content to replace the matches by.
	 * @return 	XLII_FixUrls
	 */
	public function addReplacement($search, $replace)
	{
		$search = strtolower($search);
		$replace = strtolower($replace);
		
		if($search == $replace || in_array($search, $this->_replace['search']))
			return $this;
	
		$this->_replace['search'][] = $search;
		$this->_replace['replace'][] = $replace;
		
		
		// -- resport array to prevent duplicate replacement patterns
		{
			uasort($this->_replace['search'], array($this, '_sort'));
		
			$replace = array();
		
			foreach($this->_replace['search'] as $key => $void)
				$replace[$key] = $this->_replace['replace'][$key];
		
			$this->_replace['replace'] = array_values($replace);
			$this->_replace['search'] = array_values($this->_replace['search']);
		}
	
		// -- generate pattern
		$pattern = implode('%SEP%', $this->_replace['search']);
		$pattern = preg_quote($pattern, '/');
		$pattern = str_replace(preg_quote('%SEP%', '/'), '|', $pattern);
		
		$this->_replace['pattern'] = '/(@?(' . $pattern . ')\/?)/i';
		
		return $this;
	}
	
	/**
	 * Reset all response notices.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function clearNotice()
	{
		$this->_notice = array();
		
		return $this;
	}
	
	/**
	 * Extract the configuration from the WP config file.
	 * 
	 * @param	string $base = null The ABSPATH location.
	 * @return	array|false
	 */
	private function _config($base = null)
	{
		$base = $base ? $base : $this->locate();
		
		foreach(array('wp-config.dev.php', 'wp-config.acc.php', 'wp-config.php', 'wp-config.live.php') as $file)
		{
			if(!file_exists($base . '/' . $file) || !$content = file_get_contents($base . '/' . $file))
				continue;
			
			$config = array();
			if(preg_match_all('/define[\s]*\([\s]*("|\')(MULTISITE|DB.+)\\1[\s]*,[\s]*([^\;]+)\)/i', $content, $match))
			{
				foreach($match[2] as $key => $const)
				{
					$value = $match[3][$key];
					$value = $value[0] == '"' || $value[0] === '\'' ? substr($value, 1, -1) : $value;
					
					$config[$const] = $value;
				}
			}
				
			if(!isset($config['DB_NAME']) || !isset($config['DB_USER']) || !isset($config['DB_PASSWORD']))
				continue;
				
			if(strpos($config['DB_NAME'], 'isset') !== false && $name = @eval('return ' . $config['DB_NAME'] . ';'))
				$config['DB_NAME'] = $name;
				
			if(isset($config['DB_HOST']) && strpos($config['DB_HOST'], ':') !== false)
			{
				$config['DB_HOST'] = explode(':', $config['DB_HOST']);
				$config['DB_SOCKET'] = $config['DB_HOST'][1];
				$config['DB_HOST'] = $config['DB_HOST'][0];
			}
				
			if(preg_match('/\$table_prefix[\s]*=[\s]*[\'"]([^\'\"]+)/', $content, $match))
				$config['TABLE_PREFIX'] = $match[1];
			else
				$config['TABLE_PREFIX'] = 'wp_';
				
			// Cast values
			foreach($config as &$val)
			{
				if($val === 'true')
					$val = true;
				else if($val === 'false')
					$val = false;
				else if(is_numeric($val))
					$val = (float)$val;
			}
			
			return $config;
		}
		
		return false;
	}
	
	/**
	 * Flush the WP cache
	 * 
	 */ 
	public function flushCache()
	{
		wp_cache_flush();
		
		if( file_exists( $path = WP_CONTENT_DIR . '/cache/' ))
			$this->_rmdir( $path );
		
		if( file_exists( $path = WP_CONTENT_DIR . '/uploads/cache/' ))
			$this->_rmdir( $path );
			
		if( file_exists( $path = WP_CONTENT_DIR . '/uploads/et_temp/' ))
			$this->_rmdir( $path );
			
	}
	
	/**
	 * Recursively remove directory / file (or at least try)
	 * 
	 * @param	string $path The path of the directory / file to remove
	 * @return	bool
	 */ 
	private function _rmdir( $path )
	{
		if( !file_exists( $path ) )
			return true;
			
		if( !is_dir( $path ) )
			return @unlink( $path );
			
		foreach( scandir ( $path = rtrim( $path, '/' ) . '/' ) as $file )
		{
			if( $file != '.' && $file != '..' )
				$this->_rmdir( $path . $file );
		}
		
		return @rmdir( $path );
	}
	
	/**
	 * Try and detect the multisite host for automatic mapping.
	 * 
	 * @param	string $base = null The ABSPATH location.
	 * @return	string
	 */
	public function detectHost($base = null)
	{
		$host = $_SERVER['HTTP_HOST'];
		
		if($config = $this->_config($base))
		{
			if(empty($config['MULTISITE']))
				return $host;
				
			try
			{
				$db = new PDO(
							'mysql:dbname=' . $config['DB_NAME'] . ';' .
								  'host=' . (isset($config['DB_HOST']) ? $config['DB_HOST'] : 'localhost'). ';' .
								  (!empty($config['DB_SOCKET']) ? 'unix_socket=' . $config['DB_SOCKET'] : ''), 
							$config['DB_USER'], $config['DB_PASSWORD']
						);
					
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				
				$site = $db->prepare('SELECT domain FROM ' . $config['TABLE_PREFIX'] . 'blogs LIMIT 1');
				$site->execute();
				
				$site = $site->fetchColumn();
				
				if($site)
					return $site;
			}
			catch(Exception $e)
			{ 
			}
		}
		
		return $host;
	}
	
	
	/**
	 * Enable or disable indexing for the active blog.
	 * 
	 * @param	bool $enabled Set wether to enable or disable indexing.
	 * @return 	XLII_FixUrls
	 */
	public function enableSEO($enabled)
	{
		update_option('blog_public', (int)$enabled);
		
		$this->notice('Search Engine indexing is %s', $enabled ? 'allowed' : 'disallowed');
		
		return $this;
	}
	
	/**
	 * Return all the response notices.
	 * 
	 * @return 	array
	 */
	public function getNotices()
	{
		return $this->_notice;
	}
	
	/**
	 * Return a listing of all sites.
	 * 
	 * @return	array
	 */
	public function getSites()
	{
		if(!$this->isMultiSite())
			return $this->_getSites();
			
		$sites = array();
		
		foreach(get_sites() as $site)
		{
			switch_to_blog($site->id);
		
			$sites = array_merge($sites, $this->_getSites());
			
			
			restore_current_blog();
		}
		
		return array_unique($sites);
	}
	
	/**
	 * Return all sites registered for the specified subsite
	 * 
	 * @return	array
	 */
	protected function _getSites()
	{
		$list = array();
		$list[] = home_url();
		
		if($opt = get_option('icl_sitepress_settings'))
		{
			if(!empty($opt['language_domains']))
			{
				foreach($opt['language_domains'] as $url)
				{
					$url = strtolower($url);
					$url = strpos($url, 'http') !== 0 ? 'http://' . $url : $url;
					
					$list[] = $url;
				}
			}
		}
		
		foreach($list as &$url)
			$url = parse_url($url, PHP_URL_HOST);
		
		return array_unique($list);
	}
	
	/**
	 * Return the common sequence between the two strings.
	 * 
	 * @param	string $string_1 The primary string
	 * @param	string $string_2 The secondairy string used in the comparrison
	 * @return	string
	 */
	public function getCommonSequence($string_1, $string_2)
	{
		$string_1 = array_filter(preg_split('/\b/', $string_1));
		$string_2 = array_filter(preg_split('/\b/', $string_2));
	
		$common = '';
	
		foreach($string_1 as $key => $val)
		{
			if(!isset($string_2[$key]) || $string_2[$key] != $val)
				return $common;
			
			$common .= $val;
		}
	
		return $common;
	}
	
	/**
	 * Create a like statement for the given column.
	 *
	 * @param	string $column The colum to do the search on. 	 
	 * @return 	string
	 */
	protected function _like($column)
	{
		$sql = array();
		foreach($this->_replace['search'] as $content)
			$sql[] = $column . ' LIKE "%' . esc_sql($content) . '%"';
		
		return ' (' . implode(' OR ', $sql) . ')';
	}
	
	/**
	 * Return the path to the base WP directory.
	 * 
	 * @return	string
	 */
	public function locate()
	{
		$base = dirname(__FILE__);
	
		do
		{
			if(!file_exists($path = $base . '/wp-load.php'))
			{
				$path = $base . '/core/wp-load.php';
			}
	
			if(file_exists($path))
				break;
	
			$base = substr($base, 0, strrpos($base, '/'));

		} while($base);
			
		return $base ? $base : false;
	}
	
	/**
	 * Append an additional notice.
	 * 
	 * @param	string $content The content of the notice.
	 * @param	void* $arg Additional arguments to sprintf into the notice.
	 * @return 	XLII_FixUrls
	 */
	public function notice($content)
	{
		$args = func_get_args();
		$args = array_slice($args, 1);
		
		if(count($args))
			$content = vsprintf($content, $args);
			
		$this->_notice[] = $content;
		return $this;
	}
	
	/**
	 * Returns wether buddypress is enabled on this installation.
	 * 
	 * @return 	bool
	 */
	public function isBuddyPress()
	{
		return defined('BP_VERSION');
	}
	
	/**
	 * Returns wether this installation is considered as a development server.
	 * 
	 * @return 	bool
	 */
	public function isDevelopment()
	{
		if(defined('ENV'))
			return ENV != 'live';
		else
			return stripos($_SERVER['HTTP_HOST'], 'localhost') !== false || stripos($_SERVER['HTTP_HOST'], '.dev') !== false || stripos($_SERVER['HTTP_HOST'], '.test') !== false;
	}
	
	/**
	 * Returns wether buddypress is enabled on this installation.
	 * 
	 * @return 	bool
	 */
	public function isMultiSite()
	{
		return is_multisite();
	}

	/**
	 * Returns wether buddypress is enabled on this installation.
	 * 
	 * @return 	bool
	 */
	public function isSSL()
	{
		return is_ssl();
	}
	
	/**
	 * Global repair loop.
	 * 
	 * @param	string $label The label used for the repair action.
	 * @param	string $select The query used to select all entities that match the search.
	 * @param	string $update The query used for updating a matching entity.
	 * @return 	XLII_FixUrls
	 */
	public function _repair($label, $select, $update)
	{
		global $wpdb;
		
		$count = $wpdb->get_var(preg_replace('/^SELECT.*?FROM/i', 'SELECT COUNT(1) FROM', $select));
		$offset = 0;
		
		if(!$count)
			return $this;
		
		while($count > $offset)
		{
			$results = $wpdb->get_results($select . ' LIMIT ' . $offset . ',' . self::LIMIT, ARRAY_N);
			$offset += self::LIMIT;
			
			foreach($results as &$entity)
			{
				list($id, $val) = $entity;
			
				if(($serialized = maybe_unserialize($val)) != $val)
				{
					$val = $serialized; 
					if(!$val || $val instanceof __PHP_Incomplete_Class || is_string($val))
					{
						$this->notice('Unable to replace ' . $label . ' "' . $id . '"');
						continue;
					}
					
					$val = maybe_serialize($this->_replace($val));
				}
				else
				{
					$val = $this->_replace($val);
				}
				
				$wpdb->query($wpdb->prepare($update, $val, $id));
			}
		}
		
		return $this->notice('%d ' . $label . ($count > 1 ? 's' : '') . ' replaced', $count);
	}
	
	/**
	 * Repair the BuddyPress on the current site.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function repairBuddyPress()
	{
		global $wpdb;

		foreach($wpdb->get_results('SELECT id, action, primary_link FROM ' . $wpdb->prefix . 'bp_activity') as $entity)
		{
			$wpdb->query( 
				$wpdb->prepare(
					'UPDATE ' . $wpdb->prefix . 'bp_activity SET action = %s, primary_link = %s WHERE id = %d', 
					$this->_replace($entity->action),
					$this->_replace($entity->primary_link), 
					$entity->id
				)
			);
		}
		
		$this->notice('BuddyPress repaired');
	}
	
	/**
	 * Repair the comments for the current site.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function repairComments()
	{
		global $wpdb;
		
		// Update comments
		$count = $wpdb->get_var('SELECT COUNT(1) FROM ' . $wpdb->comments);
    	$affected = $offset = 0;
		
		while($count > $offset)
		{
			$results = $wpdb->get_results('SELECT comment_ID, comment_author_url, comment_content FROM ' . $wpdb->comments . ' LIMIT ' . $offset . ',' . self::LIMIT);
			$offset += self::LIMIT;

			foreach($results as &$entity)
			{
				$affected += $wpdb->query($wpdb->prepare(
					'UPDATE ' . $wpdb->comments . ' SET comment_author_url = %s, comment_content = %s WHERE comment_ID = %d', 
					$this->_replace($entity->comment_author_url), 
					$this->_replace($entity->comment_content),
					$entity->comment_ID
				));
			}
			
			wp_cache_flush();
		}
		
		$this->notice('%d comments updated', $affected);
		
		// Update commentmeta
		return $this->_repair(
			'comment option',
			'SELECT comment_id, meta_value FROM ' . $wpdb->commentmeta . ' WHERE ' . $this->_like('meta_value'),
			'UPDATE ' . $wpdb->commentmeta . ' SET meta_value = %s WHERE comment_id = %d'
		);
	}
	
	/**
	 * Repair the multisite options.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function repairMultiSite()
	{
		global $wpdb;

		// Repair sites
		foreach($wpdb->get_results('SELECT id, domain FROM ' . $wpdb->site) as $entity)
		{
			$wpdb->query( 
				$wpdb->prepare(
					'UPDATE ' . $wpdb->site . ' SET domain = %s WHERE id = %d', 
					$this->_replace($entity->domain),
					$entity->id
				)
			);
		}
		
		// Repair blogs
		foreach($wpdb->get_results('SELECT blog_id, domain FROM ' . $wpdb->blogs) as $entity)
		{
			$wpdb->query( 
				$wpdb->prepare(
					'UPDATE ' . $wpdb->blogs . ' SET domain = %s WHERE blog_id = %d', 
					$this->_replace($entity->domain),
					$entity->blog_id
				)
			);
		}
		
		// Update site meta
		$this->_repair(
			'site option',
			'SELECT meta_id, meta_value FROM ' . $wpdb->sitemeta . ' WHERE ' . $this->_like('meta_value'),
			'UPDATE ' . $wpdb->sitemeta . ' SET meta_value = %s WHERE meta_id = %d'
		);
		
		return $this->notice('MultiSite updated');
	}
	
	/**
	 * Repair the options for the current site.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function repairOptions()
	{
		// Update site wide options
		return $this->_repair(
			'system wide option',
			'SELECT option_id, option_value FROM ' . $GLOBALS['wpdb']->options . ' WHERE (option_name NOT LIKE "_wc_session_%" AND option_name NOT LIKE "_wp_session_%") AND ' . $this->_like('option_value'),
			'UPDATE ' . $GLOBALS['wpdb']->options . ' SET option_value = %s WHERE option_id = %d'
		);
	}
	
	/**
	 * Repair the posts for the current site.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function repairPosts()
	{
		global $wpdb;
		
		// Update posts
		$count = $wpdb->get_var('SELECT COUNT(1) FROM ' . $wpdb->posts);
    	$affected = $offset = 0;
		
		while($count > $offset)
		{
			$results = $wpdb->get_results('SELECT ID, post_content, post_excerpt, guid FROM ' . $wpdb->posts . ' LIMIT ' . $offset . ',' . self::LIMIT);
			$offset += self::LIMIT;

			foreach($results as &$entity)
			{
				$affected += $wpdb->query($wpdb->prepare(
					'UPDATE ' . $wpdb->posts . ' SET post_content = %s, post_excerpt = %s, guid = %s WHERE ID = %d', 
					$this->_replace($entity->post_content), 
					$this->_replace($entity->post_excerpt),
					$this->_replace($entity->guid),
					$entity->ID
				));
			}
			
			wp_cache_flush();
		}
		
		$this->notice('%d posts updated', $affected);
		
		// Update postmeta
		return $this->_repair(
			'post option',
			'SELECT meta_id, meta_value FROM ' . $wpdb->postmeta . ' WHERE meta_key NOT IN ("_kraked_thumbs", "_kraken_size", "_wp_attached_file", "_wp_attachment_metadata") AND ' . $this->_like('meta_value'),
			'UPDATE ' . $wpdb->postmeta . ' SET meta_value = %s WHERE meta_id = %d'
		);
	}
	
	/**
	 * Repair the termmeta.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function repairTerms()
	{
		if(!isset($GLOBALS['wpdb']->termmeta))
			return $this;
			
		// Update termmeta
		return $this->_repair(
			'user option',
			'SELECT umeta_id, meta_value FROM ' . $GLOBALS['wpdb']->termmeta . ' WHERE ' . $this->_like('meta_value'),
			'UPDATE ' . $GLOBALS['wpdb']->termmeta . ' SET meta_value = %s WHERE umeta_id = %d'
		);
	}
	
	/**
	 * Repair the users within the current installation.
	 * 
	 * @return 	XLII_FixUrls
	 */
	public function repairUsers()
	{
		global $wpdb;
		
		// Update author url (sometimes seem to contain development urls)
		$count = $wpdb->get_var('SELECT COUNT(1) FROM ' . $wpdb->users . ' WHERE ' . $this->_like('user_url'));
    	$affected = $offset = 0;

		while($count > $offset)
		{
			$results = $wpdb->get_results('SELECT ID, user_url FROM ' . $wpdb->users . ' WHERE ' . $this->_like('user_url') . ' LIMIT ' . $offset . ',' . self::LIMIT);
			$offset += self::LIMIT;

			foreach($results as &$entity)
			{
				$affected += $wpdb->query($wpdb->prepare(
					'UPDATE ' . $wpdb->users . ' SET user_url = %s WHERE ID = %d', 
					$this->_replace($entity->user_url), 
					$entity->ID
				));
			}
		}
		
		$this->notice('%d users updated', $affected);
		
		// Update usermeta
		return $this->_repair(
			'user option',
			'SELECT umeta_id, meta_value FROM ' . $GLOBALS['wpdb']->usermeta . ' WHERE ' . $this->_like('meta_value'),
			'UPDATE ' . $GLOBALS['wpdb']->usermeta . ' SET meta_value = %s WHERE umeta_id = %d'
		);
	}
	
	/**
	 * Replaces the old urls by the new urls.
	 * 
	 * @param	void &$value The value to replace the urls in.
	 * @return 	string
	 */
	protected function _replace(&$value)
	{
		if($value instanceof __PHP_Incomplete_Class)
			return $value;
		
		if(is_array($value) || is_a($value, 'stdClass') || $value instanceof Traversable)
		{
			foreach($value as $key => &$val)
				$val = $this->_replace($val);
				
			return $value;
		}
		else if(is_string($value) && ($tmp = maybe_unserialize($value)) != $value)
		{
			return ($value = serialize($this->_replace($tmp)));
		}
		
		if(!is_string($value))
			return $value;
		
		return preg_replace_callback($this->_replace['pattern'], array(&$this, '_replaceCallback'), $value);
	}
	
	
	/**
	 * Callback method user for the _replace method.
	 * 
	 * @access	private
	 * @param	array $match The callback match.
	 * @return 	string
	 */
	public function _replaceCallback($match)
	{
		if($match[0][0] != '@')
		{
			$index = array_search($match[1], $this->_replace['search']);
			$index = $index === false ? array_search(trim($match[1], '/'), $this->_replace['search']) : $index;
			
			if($index !== false)
			{
				$match[0] = str_replace($this->_replace['search'][$index], $this->_replace['replace'][$index], $match[0]);
				$match[0] = preg_replace('#(?<!:)//#', '/', $match[0]);
			}
			else
			{	
				$match[0] = str_replace($this->_replace['search'], $this->_replace['replace'], $match[0]);
				$match[0] = str_replace('#(?<!:)//#', '/', $match[0]);
			}
		}
		
		return $match[0];
	}
	
	/**
	 * Sort the replacement pattern to ensure no duplicates are replaced
	 * 
	 * @access	private
	 * @param	string $a The primary url
	 * @return	string $b The secondairy url 
	 */
	private function _sort($a, $b)
	{
		if(strpos($a, $b) === false)
			return 1;
		else
			return -1;
	}
}