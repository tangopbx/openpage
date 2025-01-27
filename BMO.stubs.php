<?php

namespace FreePBX {
	#[\AllowDynamicProperties]
	class Cache
	{
		public function __construct($freepbx = null)
		{
		}
		public function __clone()
		{
		}
		/**
		 * Fetches an entry from the cache.
		 *
		 * @param string $id The id of the cache entry to fetch.
		 *
		 * @return mixed The cached data or FALSE, if no cache entry exists for the given id.
		 */
		public function fetch($id)
		{
		}
		/**
		 * Tests if an entry exists in the cache.
		 *
		 * @param string $id The cache id of the entry to check for.
		 *
		 * @return bool TRUE if a cache entry exists for the given cache id, FALSE otherwise.
		 */
		public function contains($id)
		{
		}
		/**
		 * Puts data into the cache.
		 *
		 * If a cache entry with the given id already exists, its data will be replaced.
		 *
		 * @param string $id       The cache id.
		 * @param mixed  $data     The cache entry/data.
		 * @param int    $lifeTime The lifetime in number of seconds for this cache entry.
		 *                         If zero (the default), the entry never expires (although it may be deleted from the cache
		 *                         to make place for other entries).
		 *
		 * @return bool TRUE if the entry was successfully stored in the cache, FALSE otherwise.
		 */
		public function save($id, $data, $lifeTime = 300)
		{
		}
		/**
		 * Deletes a cache entry.
		 *
		 * @param string $id The cache id.
		 *
		 * @return bool TRUE if the cache entry was successfully deleted, FALSE otherwise.
		 *              Deleting a non-existing entry is considered successful.
		 */
		public function delete($id)
		{
		}
		/**
		 * Retrieves cached information from the data store.
		 *
		 * The server's statistics array has the following values:
		 *
		 * - <b>hits</b>
		 * Number of keys that have been requested and found present.
		 *
		 * - <b>misses</b>
		 * Number of items that have been requested and not found.
		 *
		 * - <b>uptime</b>
		 * Time that the server is running.
		 *
		 * - <b>memory_usage</b>
		 * Memory used by this server to store items.
		 *
		 * - <b>memory_available</b>
		 * Memory allowed to use for storage.
		 *
		 * @return array|null An associative array with server's statistics if available, NULL otherwise.
		 */
		public function getStats()
		{
		}
		/**
		 * Returns an associative array of values for keys is found in cache.
		 *
		 * @param string[] $keys Array of keys to retrieve from cache
		 *
		 * @return mixed[] Array of retrieved values, indexed by the specified keys.
		 *                 Values that couldn't be retrieved are not contained in this array.
		 */
		public function fetchMultiple(array $keys)
		{
		}
		/**
		 * Returns a boolean value indicating if the operation succeeded.
		 *
		 * @param array $keysAndValues Array of keys and values to save in cache
		 * @param int   $lifetime      The lifetime. If != 0, sets a specific lifetime for these
		 *                             cache entries (0 => infinite lifeTime).
		 *
		 * @return bool TRUE if the operation was successful, FALSE if it wasn't.
		 */
		public function saveMultiple(array $keysAndValues, $lifetime = 0)
		{
		}
		/**
		 * Deletes several cache entries.
		 *
		 * @param string[] $keys Array of keys to delete from cache
		 *
		 * @return bool TRUE if the operation was successful, FALSE if it wasn't.
		 */
		public function deleteMultiple(array $keys)
		{
		}
		/**
		 * Set Namespace and clone this class
		 * This prevents issues where the namespace is not properly reset
		 * @method cloneByNamespace
		 * @param  [type]            $namespace [description]
		 */
		public function cloneByNamespace($namespace, $persistent = true)
		{
		}
		/**
		 * Sets the namespace to prefix all cache ids with.
		 *
		 * @param string $namespace
		 *
		 * @return void
		 */
		public function setNamespace($namespace)
		{
		}
		/**
		 * Retrieves the namespace that prefixes all cache ids.
		 *
		 * @return string
		 */
		public function getNamespace()
		{
		}
		/**
		 * Flushes all cache entries, globally.
		 *
		 * @return bool TRUE if the cache entries were successfully flushed, FALSE otherwise.
		 */
		public function flushAll()
		{
		}
		/**
		 *  Deletes all cache entries in the current cache namespace.
		 *
		 * @return bool TRUE if the cache entries were successfully deleted, FALSE otherwise.
		 */
		public function deleteAll()
		{
		}
	}
	#[\AllowDynamicProperties]
	class Codecs
	{
		public function __construct($freepbx = null)
		{
		}
		/**
		 * Get all Avalible Codecs
		 * @return array Array of usable Codecs
		 */
		public function getAll()
		{
		}
		/**
		 * Get all usable Video Codecs
		 * @param {bool} $defaults = false Whether to define the initial default ordering
		 */
		public function getVideo($defaults = false)
		{
		}
		/**
		 * Get all usable Audio Codecs
		 * @param {bool} $defaults = false Whether to define the initial default ordering
		 */
		public function getAudio($defaults = false)
		{
		}
		/**
		 * Get all usable Text Codecs
		 * @param {bool} $defaults = false Whether to define the initial default ordering
		 */
		public function getText($defaults = false)
		{
		}
		/**
		 * Get all usable Image Codecs
		 * @param {bool} $defaults = false Whether to define the initial default ordering
		 */
		public function getImage($defaults = false)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Mail
	{
		public function __construct($freepbx)
		{
		}
		public function __get($var)
		{
		}
		/**
		 * Reset Message
		 *
		 * @return void
		 */
		public function resetMessage()
		{
		}
		public function setFrom($email, $name)
		{
		}
		//5 = lowest, 4 = low, 3 = Normal, 2 = High, 1 = Highest
		public function setPriority($priority)
		{
		}
		public function setSubject($subject)
		{
		}
		public function setTo($recipientArray)
		{
		}
		public function setBody($body)
		{
		}
		public function addAttachment($path)
		{
		}
		public function setMultipart($text, $html)
		{
		}
		public function addHeader($header, $value)
		{
		}
		public function send()
		{
		}
		public function getMessage()
		{
		}
		public function getMailer()
		{
		}
		/**
		 * Function to get mail template form
		 * @param Array $templateData is an array of array which consists of form field data.  
		 */
		public function getEmailTemplateForm($templateData)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Destinations
	{
		public function __construct($freepbx = null)
		{
		}
		/**
		 * Get All destinations and popovers for all modules
		 *
		 * @method getAll
		 * @param  string            $index the destination set number (used when drawing multiple destination sets in a single form ie: digital receptionist)
		 * @return array Array of modules and destinations
		 */
		public function getAll($index = '')
		{
		}
		/**
		 * Check if a specific destination is being used, or get a list of all destinations that are being used
		 *
		 * Upon passing in an array of destinations, this api will query all modules to determine if any
		 * are using that destination. If so, it will return an array with the usage information
		 * as described below, otherwise an empty array. If passed boolean true, it will return an array
		 * of the same format with all destinations on the system that are being used.
		 *
		 * @method getAllInUseDestinations
		 * @param  boolean                 $destination an array of destinations to check against, or if boolean true then return list of all destinations in use
		 * @return array                               returns an empty array if destination not in use, or any array with usage info, or of all usage if dest is boolean true
		 * @example                               $dest_usage[$module][]['dest']        // The destination being used
		 *                                        ['description'] // Description of who is using it
		 *                                        ['edit_url']    // a url that could be invoked to edit the using entity
		 */
		public function getAllInUseDestinations($destination = true)
		{
		}
		/**
		 * Get Popovers by Module
		 * @method getPopoversByModule
		 * @param  string              $rawname The module rawname
		 * @return array                       Array of modules
		 */
		public function getPopoversByModule($rawname)
		{
		}
		/**
		 * Get all destinations from all modules
		 * @method getAllDestinations
		 * @param  string            $index the destination set number (used when drawing multiple destination sets in a single form ie: digital receptionist)
		 * @return array             Array of destinations
		 */
		public function getAllDestinations($index = '')
		{
		}
		/**
		 * Get All Destinations by Module Name
		 * @method getDestinationsByModule
		 * @param  string                  $rawname The module rawname
		 * @param  string                  $index   Goto Index
		 * @return array                           Array of destinations
		 */
		public function getDestinationsByModule($rawname, $index = '')
		{
		}
		/**
		 * Get information about a destination from its module
		 * @method getDestinationInfoByModule
		 * @param  string                     $destination The destination context,ext,pri
		 * @param  string                     $rawname     The module rawname to query
		 * @return array                                  Destination Information
		 */
		public function getDestinationInfoByModule($destination, $rawname)
		{
		}
		/**
		 * Check if a specific destination is being used, or get a list of all destinations that are being used
		 *
		 * This is called to generate a label and tooltip which summarized the usage of this
		 * destination and a tooltip listing all the places that use it
		 *
		 * @method destinationUsageArray
		 * @param  mixed                $dest        an array of destinations to check against
		 * @return array                             array with a message and tooltip to display usage of this destination
		 */
		public function destinationUsageArray($dest)
		{
		}
		/**
		 * Check if a specific destination is being used, or get a list of all destinations that are being used
		 *
		 * has each module replace their destination information with another one, used if you are
		 * assigning a new number to something such as a conference room that may be used as a destination
		 *
		 * @method changeDestination
		 * @param  string            $old_dest    the old destination that is being changed
		 * @param  string            $new_dest    the new destination that is replacing the old
		 * @return integer                         returns the number of records that were updated
		 */
		public function changeDestination($old_dest, $new_dest)
		{
		}
		/**
		 * Determines which module a list of destinations belongs to, and if the destination object exists
		 *
		 * Mainly used by framework_list_problem_destinations. This function will find the module
		 * that a destination belongs to and determine if the object still exits. This allow it to
		 * either obtain the identify, identify it as an object that has been deleted, or identify
		 * it as an unknown destination, usually a custom destination.
		 *
		 * @method identifyDestinations
		 * @param  mixed               $dest        an array of destinations to check against
		 * @return array                            an array structure with informaiton about the destinations (see code)
		 */
		public function identifyDestinations($dest)
		{
		}
		public function getDestination($destination)
		{
		}
		/**
		 * Create a comprehensive list of all destinations that are problematic
		 *
		 * This function will scan the entire system and identify destinations
		 * that are problematic. Either empty, orphaned or an unknow custom
		 * destinations. An orphaned destination is one that should belong
		 * to a module but the object it would have pointed to does not exist
		 * because it was probably deleted.
		 *
		 * @method listProblemDestinations
		 * @param  boolean                 $ignore_custom set to true if custom (unknown) destinations should be reported
		 * @return array                                 an array of the destinations that are empty, orphaned or custom
		 */
		public function listProblemDestinations($ignore_custom = false)
		{
		}
		//$rawname.'_destinations'
		public function getModuleDestinations($module, $index = '')
		{
		}
		//$rawname.'_destination_popovers'
		public function getModuleDestinationPopovers($module)
		{
		}
		//$rawname."_check_destinations";
		public function getModuleCheckDestinations($destination)
		{
		}
		//$rawname.'_getdestinfo'
		public function getModuleDestinationInfo($module, $destination)
		{
		}
		//$rawname."_change_destination";
		public function changeModuleDestination($old_dest, $new_dest)
		{
		}
	}
	#[\AllowDynamicProperties]
	class WriteConfig
	{
		/**
		 * Header gets added to every generated file
		 */
		const HEADER = ";--------------------------------------------------------------------------------;\n;          Do NOT edit this file as it is auto-generated by FreePBX.             ;\n;--------------------------------------------------------------------------------;\n; For information on adding additional paramaters to this file, please visit the ;\n; FreePBX.org wiki page, or ask on IRC. This file was created by the new FreePBX ;\n; BMO - Big Module Object. Any similarity in naming with BMO from Adventure Time ;\n; is totally deliberate.                                                         ;\n;--------------------------------------------------------------------------------;\n";
		/**
		 * __construct function
		 *
		 * @param object $freepbx The FreePBX BMO Object
		 * @param array $array of files to write out with data
		 * Such as : array('modules.conf' => 'string')
		 * or array('modules.conf' => array('line','line','line'))
		 */
		public function __construct($freepbx = null, $array = null)
		{
		}
		public function writeCustomFile($array, $generateHeader = false)
		{
		}
		/**
		 * Write single configuration file
		 *
		 * Simply builds an array and passes it to writeConfigs()
		 * @param string $filename File to write
		 * @param mixed $contents What should be written to the file
		 * @param bool $generateHeader Backward compatibility to generate FreePBX header or not
		 */
		public function writeConfig($filename = null, $contents = '', $generateHeader = true)
		{
		}
		/**
		 * Write multiple configuration files.
		 * This is the public call to write configuration files.
		 * @param array $array An array of [filename]=>array(line, line, line), or [filename]=>string
		 * @param bool $generateHeader Backward compatibility to generate FreePBX header or not
		 */
		public function writeConfigs($array, $generateHeader = true)
		{
		}
		/**
		 * Return the static header, as a function.
		 * @return string Header
		 */
		public function getHeader()
		{
		}
	}
	#[\AllowDynamicProperties]
	class DB_Helper
	{
		/* Allow overriding of class detection */
		public $classOverride = false;
		/** Don't new DB_Helper */
		public function __construct()
		{
		}
		/**
		 * Return the name of the table we're using.
		 *
		 * Will be 'kvstore_modulename'.  Backslashes, if the module is namespaced,
		 * will be converted to underscores.
		 *
		 * @param $self object the '$this' object used in $this->getConfig or setConfig
		 * @returns string database name
		 */
		public static function getTableName($self)
		{
		}
		/**
		 * Create the kvstore table for this module
		 *
		 * @param $tablename Table to create
		 */
		public static function createTable($tablename)
		{
		}
		/**
		 * Requests a var previously stored
		 *
		 * getConfig requests the variable stored with the key $var, and returns it.
		 * Note that it will return an array or a StdObject if it was handed an array
		 * or object, respectively.
		 *
		 * The optional second parameter allows you to specify a sub-grouping - if
		 * you setConfig('foo', 'bar'), then getConfig('foo') == 'bar'. However,
		 * if you getConfig('foo', 1), that will return (bool) false.
		 *
		 * @param string $var Key to request (not null)
		 * @param string $id Optional sub-group ID.
		 * @return bool|string|array|StdObject Returns what was handed to setConfig, or bool false if it doesn't exist
		 */
		public function getConfig($var = null, $id = "noid")
		{
		}
		/**
		 * Store a variable, array or object.
		 *
		 * setConfig stores $val against $key, in a format that will return
		 * it almost identically when returned by getConfig.
		 *
		 * The optional third parameter allows you to specify a sub-grouping - if
		 * you setConfig('foo', 'bar'), then getConfig('foo') == 'bar'. However,
		 * getConfig('foo', 1) === (bool) false.
		 *
		 * @param string $key Key to set $var to (not null)
		 * @param string $var Value to set $key to. Can be (bool) false, which will delete the key.
		 * @param string $id Optional sub-group ID.
		 * @return true
		 */
		public function setConfig($key = null, $val = false, $id = "noid")
		{
		}
		/**
		 * Alias function to delete
		 * @param {string} $key = null The key name
		 * @param string $id Optional sub-group ID.
		 */
		public function delConfig($key = null, $id = "noid")
		{
		}
		/**
		 * Store multiple variables, arrays or objects.
		 *
		 * setMultiConfig is the same as setConfig, except it uses an associative array,
		 * and uses a transaction to speed up the commit.
		 *
		 * @param array $keyval
		 * @param string $id Optional sub-group ID.
		 * @return true
		 */
		public function setMultiConfig($keyval = false, $id = "noid")
		{
		}
		/**
		 * Returns an associative array of all key=>value pairs referenced by $id
		 *
		 * If no $id was provided, return all pairs that weren't set with an $id.
		 * Returns an ordered list from however MySQL orders it (order by `key`)
		 *
		 * If null $id was provided then return every single entry
		 *
		 * @param string $id Optional sub-group ID.
		 * @return array
		 */
		public function getAll($id = "noid")
		{
		}
		/**
		 * Delete All Keys from module, and drop the table
		 *
		 * Used when uninstalling a module.
		 */
		public function deleteAll()
		{
		}
		/**
		 * Returns an array of all keys referenced by $id
		 *
		 * If no $id was provided, return all pairs that weren't set with an $id.
		 * Returns an ordered list from however MySQL orders it (order by `key`)
		 *
		 * @param string $id Optional sub-group ID.
		 * @return array
		 */
		public function getAllKeys($id = "noid")
		{
		}
		/**
		 * Returns a standard array of all IDs, excluding 'noid'.
		 *
		 * Due to font ambiguity (with LL in lower case and I in upper
		 * case looking identical in some situations) this uses 'ids' in
		 * lower case.
		 *
		 * @return array
		 */
		public function getAllids()
		{
		}
		/**
		 * Delete all entries that match the ID specified
		 *
		 * This normally is used to remove an item.
		 *
		 * @param string $id Optional sub-group ID.
		 * @return void
		 */
		public function delById($id = null)
		{
		}
		/**
		 * Return the FIRST ordered entry with this id
		 *
		 * Useful with timestamps?
		 *
		 * @param string $id Required grouping ID.
		 * @return array
		 */
		public function getFirst($id = null)
		{
		}
		/**
		 * Return the LAST ordered entry with this id
		 *
		 * @param string $id Required grouping ID.
		 * @return array
		 */
		public function getLast($id = null)
		{
		}
		/**
		 * Check for exceptions when PDO does things, and try to auto-heal them
		 *
		 */
		public static function checkException($e)
		{
		}
		/**
		 * Blob handling - Set
		 *
		 * If the value handed to setConfig is longer than 4kb, then a link
		 * to this table is created instead. A UUID is generated, the value
		 * is inserted, and that uuid is returned
		 *
		 * @param $uuid The uuid used for updating, if not set will generate a uuid
		 * @param $value The contents of the blob
		 * @param $type Hint to decode the blob when handed back
		 * @return $uuid
		 */
		public function insertBlob($uuid = null, $val = false, $type = "raw")
		{
		}
		/**
		 * Blob handling - Get
		 *
		 * Return the blob as it was handed to it, with the type
		 * to assist in decoding. If the uuid doesn't exist,
		 * type is set to (bool) false, and content is an empty
		 * string.
		 *
		 * @param $uuid
		 * @return array("content" => $value, "type" => as set)
		 */
		public function getBlob($uuid = false)
		{
		}
		/**
		 * Blob handling - Delete
		 *
		 * Deletes the blob, if it exists.
		 *
		 * @param $uuid
		 */
		public function deleteBlob($uuid = false)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Self_Helper extends \FreePBX\DB_Helper
	{
		public function __construct($freepbx = null)
		{
		}
		/**
		 * PHP Magic __get - runs AutoLoader if BMO doesn't already have the object.
		 *
		 * @param $var Class Name
		 * @return object New Object
		 */
		public function __get($var)
		{
		}
		/**
		 * PHP Magic __call - runs AutoLoader
		 *
		 * Note that this DELIBERATELY doesn't look at the BMO cache for $obj.
		 * This is used when you need to pass params to an object on creation,
		 * which means they may be different each time. Note that autoLoad DOES
		 * save it as FreePBX::$var, so it will continue to be used there.
		 *
		 * @param $var Class Name
		 * @param $args Any params to be passed to the new object
		 * @return object New Object
		 */
		public function __call($var, $args)
		{
		}
		/**
		 * Used to inject a new class into the BMO construct
		 * @param {string} $classname The class name
		 * @param {string} $hint Where to find the class (directory)
		 */
		public function injectClass($classname, $hint = null)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Request_Helper extends \FreePBX\Self_Helper
	{
		public $classOverride = false;
		/**
		 * Processes $_REQUEST and imports the useful things to the KVstore.
		 *
		 * This loads everything provided in the GET/POST into the Key Value store.
		 * As this is implicitly safe, there is no need for extra sanity checking,
		 * and makes coding a pile easier.
		 * This does NOT use any of the Override features provided by
		 * getReq and setReq.
		 *
		 * @param array $ignoreVars Array of variables to not process.
		 * @param string $ignoreRgexp Regular expression to match exclusions against.
		 * @param string $id ID to store the contents against.
		 *
		 * @return array Returns any _REQUEST variables that haven't been processed.
		 */
		public function importRequest($ignoreVars = null, $ignoreRegexp = null, $id = "noid")
		{
		}
		/**
		 * Get individual $_REQUEST variables, unsafely.
		 *
		 * @param string $var $_REQUEST variable to get
		 * @param bool|string $def Default to return if unset, bool false to not return defaults
		 *
		 * @return bool|string Returns the variable, or false if unset
		 */
		public function getReqUnsafe($var = null, $def = true)
		{
		}
		/**
		 * Get individual $_REQUEST variables, safely.
		 *
		 * @param string $var $_REQUEST variable to get
		 * @param bool|string $def Default to return if unset, bool false to not return defaults
		 *
		 * @return bool|string Returns the safe, processed variable, or false if unset
		 */
		public function getReq($var = null, $def = true)
		{
		}
		/**
		 * Overrides or adds to whatever's in $_REQUEST
		 *
		 * This is used for backwards compatibility with previous modules, which used to
		 * add to $_REQUEST. This is a Read-Only variable in PHP 5.5 and higher, so we
		 * needed a way to replace it in the interim.  This is that way.  If you want to
		 * remove an override, set it to null. To delete a $_REQUEST variable, set it to
		 * (bool) false.
		 *
		 * @param string $var $_REQUEST variable to add/update
		 * @param bool|string $val value to set it to.
		 *
		 * @return void
		 */
		public function setReq($var = null, $val = null)
		{
		}
		/**
		 * Get $_REQUEST sanitized through filter_input_array
		 *
		 * @method getSanitizedRequest
		 * @return array              $_REQUEST, sanitized
		 */
		public function getSanitizedRequest($definition = FILTER_SANITIZE_FULL_SPECIAL_CHARS, $add_empty = true)
		{
		}
	}
	// Do not randomly add helpers because you think it MAY be used
	// in SOME module. A Helper should only be added if you're
	// sure it's going to be used in EVERY module.  Otherwise,
	// add them as a normal module.
	// Note that we have to build the helpers manually. This DOES
	// work with Eclipse, PHPStorm, etc.  Doing it programatically
	// at runtime doesn't. I may change this, because this is awful.
	// Also, before you tell me that this is a terrible way of doing
	// multiple inheritances, please tell me a better way. 8-(  --Rob
	// (Note: Traits in 5.4 fixes this)
	class FreePBX_Helpers extends \FreePBX\Request_Helper
	{
	}
	class Ajax extends \FreePBX\FreePBX_Helpers
	{
		public $storage = 'null';
		public $settings = array("authenticate" => true, "allowremote" => false, "changesession" => false);
		public function __construct($freepbx = null)
		{
		}
		public function init()
		{
		}
		/**
		 * Perform AJAX Request
		 *
		 * Perform the Ajax Request
		 *
		 * @param $module The module name
		 * @param $command The command to execute
		 */
		public function doRequest($module = null, $command = null)
		{
		}
		/**
		 * Generate Ajax Error
		 *
		 * Generates an Ajax Error (lower/less than fatal)
		 *
		 * @param $errnum The Error Number from addHeader()
		 * @param $message The message to display
		 */
		public function ajaxError($errnum, $message = 'Unknown Error')
		{
		}
		/**
		 * Prepare headers to be returned
		 *
		 * Note: if just type is set, it will be assumed to be a value
		 *
		 * @param mixed $type type of header to be returned
		 * @param mixed $value value header should be set to
		 * @return $object New Object
		 */
		public function addHeader($type, $value = '')
		{
		}
	}
	#[\AllowDynamicProperties]
	class Cron
	{
		/**
		 * Constructor for Cron Tab Manager Class
		 *
		 * This allows either Cron($freepbxobject, $username) or Cron($username),
		 * which is why it looks slightly confusing below.
		 *
		 * @param  {mixed} $var1 = 'asterisk' Can either be a FreePBX object or just a username to manage crons for
		 * @param  {string} $var2 = 'asterisk' Username to manage crons for
		 */
		public function __construct($var1 = false, $var2 = false)
		{
		}
		/**
		 * Returns an array of all the lines for the user
		 * @return array Crontab lines for user
		 */
		public function getAll()
		{
		}
		/**
		 * Checks if the line exists exactly as is in this users crontab
		 * @param {string} $line Line to check
		 * @return {bool} True or false if the line exists
		 */
		public function checkLine($line = null)
		{
		}
		/**
		 * Add the line given to this users crontab
		 * @param {string} $line The line to add
		 * @return {bool} Return true if the line was added
		 */
		public function addLine($line)
		{
		}
		/**
		 * Alias of the function below, removing a line
		 * @param {string} $line The line to remove
		 * @return {bool} True, if removed, false if not found
		 */
		public function removeLine($line)
		{
		}
		/**
		 * Remove the line given (if it exists) from this users cronttab.
		 * Note: this will only remove the first if there's a duplicate.
		 * @param  {string} $line The line to remove
		 * @return {bool} True if removed, false if not found
		 */
		public function remove($line)
		{
		}
		/**
		 * Add an entry to Cron. Takes either a direct string, or an array of the following options:
		 * Either (a string):
		 *   * * * * * /bin/command/to/run
		 * or
		 *  array (
		 *    array("command" => "/bin/command/to/run",  "minute" => "1"), // Runs command at 1 minute past the hour, every hour
		 *    array("command" => "/bin/command/to/run", "magic" => "@hourly"), // Runs it hourly
		 *    "* * * * * /bin/command/to/run",
		 *    array("@monthly /bin/command/to/run"), // Runs it monhtly
		 *  )
		 *
		 * See the end of 'man 5 crontab' for the extension commands you can use.
		 * crontab does sanity checking when importing a crontab. If this is throwing an exception
		 * about being unable to add an entry,check the error file /tmp/cron.error for reasons.
		 */
		public function add()
		{
		}
		/**
		 * Removes all reference of $cmd in cron
		 * @param {string} $cmd The command to remove
		 */
		public function removeAll($cmd)
		{
		}
	}
	/**
	 * This is part of the FreePBX Big Module Object.
	 *
	 * License for all code of this FreePBX module can be found in the license file inside the module directory
	 * Copyright 2006-2015 Sangoma Technologies
	 */
	/**
	 * This controls the realtime parts of Asterisk. At the moment,
	 * the only thing that FreePBX tries to modify is the queue log,
	 * but this may expand in the future.
	 */
	#[\AllowDynamicProperties]
	class Realtime extends \FreePBX\FreePBX_Helpers
	{
		public function enableQueueLog($driver = 'odbc', $dbname = 'asteriskcdrdb', $table = 'queuelog')
		{
		}
		public function disableQueueLog()
		{
		}
		public function queueLogEnabled()
		{
		}
		public function write()
		{
		}
	}
}
namespace {
	// vim: set ai ts=4 sw=4 ft=php:
	/**
	 * This is part of the FreePBX Big Module Object.
	 *
	 * License for all code of this FreePBX module can be found in the license file inside the module directory
	 * Copyright 2006-2015 Sangoma Technologies
	 */
	#[\AllowDynamicProperties]
	class OOBE extends \FreePBX_Helpers
	{
		// Is the out of box experience complete?
		public function isComplete($type = "auth")
		{
		}
		// Which modules have pending OOBE pages to show?
		public function getPendingModules($type = "auth")
		{
		}
		// Which modules are providing OOBE pages?
		public function getOOBEModules()
		{
		}
		// Call a module's OOBE Hook
		public function runModulesOOBE($modname = \false)
		{
		}
		public function showOOBE($auth = "auth")
		{
		}
	}
}
namespace FreePBX {
	interface BMO
	{
		// ///////////////////////////////// //
		// Installing/Upgrading/Uninstalling //
		// ///////////////////////////////// //
		//
		// Process to run when you're installed.
		public function install();
		// Note that __construct will be called with ($BMO, true) before install is to be run.
		// If an exception is thrown in here, the module will NOT be marked as installed, and
		// won't be accessable.
		//
		// Process to run when you're being uninstalled.
		public function uninstall();
		// If an exception is thrown in here, the module WILL BE marked as uninstalled, but a
		// warning will be displayed to the end user with the text of the Exception.
		//
		// Optional  /// UNIMPLEMENTED //
		// public function upgrade()
		// Is called when an Upgrade is run on the module. If this doesn't exist, install()
		// will be called.
		// ////////////////// //
		// Backup and Restore //
		// ////////////////// //
		//These methods have been removed. They will be implemented differently than
		//the original concept. Modification of the abstract now would cause the universe
		// to implode and noone wants that.
		// ////////////// //
		// FreePBX Search //
		// ////////////// //
		// public function search($request, &$results);
		// This function needs to append (or possibly alter?) $result, which is an array
		// that is handed back to the search box.
		// ////////// //
		// FreePBX UI //
		// ////////// //
		// This is called from config.php?display=thismodulename and the entire $_REQUEST is
		// passed to it. For compatibility, you can print/echo things here, and they will
		// appear in the right place, however, it should be returning an array, or an Object.
		// public function showPage($request);
		// ////////// //
		// AJAX Calls //
		// ////////// //
		//
		// These are called from ajax.php.
		// public function ajaxCall($_REQUEST);
		// ////////////////////////// //
		// Hooking into other modules //
		// ////////////////////////// //
		//
		// public function getPageHooks();
		// public function getConfigHooks();
		//
		// public function pageHook($page);
		// public function configHook($module, $config);
		// ////////////////////// //
		// Dialplan Modifications //
		// ////////////////////// //
		// //////////////////////////// //
		// Asterisk Configuration Files //
		// //////////////////////////// //
		// When the 'reload' button is clicked, genConfig will be called, the output will
		// be given to any modules that requested it, and what they return will then be
		// given to writeConfig.
		// public function genConfig();
		//
		// writeConfig should use $this->FreePBX->WriteConfig($config) which will do all
		// the actual writing of files for it.
		// See BMO/WriteConfig.class.php
		// public function writeConfig($config);
	}
	#[\AllowDynamicProperties]
	class Framework extends \FreePBX\FreePBX_Helpers implements \FreePBX\BMO
	{
		public function __construct($freepbx = null)
		{
		}
		/** BMO Required Interfaces */
		public function install()
		{
		}
		public function uninstall()
		{
		}
		public function backup()
		{
		}
		public function restore($backup)
		{
		}
		public function runTests($db)
		{
		}
		public function doConfigPageInit()
		{
		}
		public function ajaxRequest($req, &$setting)
		{
		}
		/**
		 * setSystemObj
		 *
		 * @param  mixed $obj
		 * @return void
		 */
		public function setSystemObj($obj)
		{
		}
		/**
		 * getSystemObj
		 *
		 * @return void
		 */
		public function getSystemObj()
		{
		}
		public function ajaxHandler()
		{
		}
		public function doReload($passthru = false)
		{
		}
		/**
		 * Update AMI credentials in manager.conf
		 *
		 * @author Philippe Lindheimer
		 * @pram mixed $user false means don't change
		 * @pram mixed $pass password false means don't change
		 * @pram mixed $writetimeout false means don't change
		 * @returns boolean
		 *
		 * allows FreePBX to update the manager credentials primarily used by Advanced Settings and Backup and Restore.
		 */
		function amiUpdate($user = false, $pass = false, $writetimeout = false)
		{
		}
		/**
		 * getMonitoringObj
		 *
		 * @return void
		 */
		public function getMonitoringObj()
		{
		}
		/**
		 * setMonitoringObj
		 *
		 * @param  mixed $obj
		 * @return void
		 */
		public function setMonitoringObj($obj)
		{
		}
		/**
		 * checkBackUpAndRestoreProgressStatus
		 *
		 * @return void
		 */
		public function checkBackUpAndRestoreProgressStatus()
		{
		}
		/**
		 * getInstalledModulesList
		 *
		 * @return array
		 */
		public function getInstalledModulesList()
		{
		}
	}
	//custom entry select
	#[\AllowDynamicProperties]
	class Config
	{
		const CONF_TYPE_BOOL = 'bool';
		const CONF_TYPE_TEXTAREA = 'textarea';
		const CONF_TYPE_TEXT = 'text';
		const CONF_TYPE_DIR = 'dir';
		const CONF_TYPE_INT = 'int';
		const CONF_TYPE_SELECT = 'select';
		const CONF_TYPE_FSELECT = 'fselect';
		const CONF_TYPE_CSELECT = 'cselect';
		/**
		 * simple key => value store for settings. Also augmented with boostrap settings
		 * if provided which are not included in db_conf_store.
		 * Note: this is referenced in modulefunctions.class.php in _ampconf_string_replace
		 * so it needs to remain public
		 */
		public $conf = array();
		/**
		 * freepbx_conf constructor
		 * The class when initialized is filled populated from the SQL store
		 * along with some level of validation in case corrupted data has
		 * been put into the store form outside sources. It does not write back
		 * upon detecting corrupted data though.
		 *
		 * Along with populating the db_conf_store hash, it also populates the
		 * key => value conf hash by reference so that changes to db_conf_store
		 * will be reflected. (Since $amp_conf should be assigned as a reference
		 * to the conf hash).
		 */
		public function __construct($freepbx = null)
		{
		}
		public function exists($keyword)
		{
		}
		public function set($keyword, $value, $commit = true, $override_readonly = true)
		{
		}
		public function update($keyword, $value, $commit = true, $override_readonly = true)
		{
		}
		public function get($keyword, $passthru = false)
		{
		}
		public function conf_setting($keyword)
		{
		}
		/**
		 * Generate an amportal.conf file from the db_conf_store settings loaded.
		 *
		 * @param bool    true if a verbose file should be written that includes some documentation.
		 * @return string returns the amportal.conf text that can be written out to a file.
		 */
		public function amportal_generate($verbose = true)
		{
		}
		public function get_asterisk_conf()
		{
		}
		public function amportal_canwrite()
		{
		}
		/**
		 * Parse AMPORTAL.conf file
		 *
		 * Legacy, dont really parse it, its read only
		 *
		 * @param string $filename
		 * @param array $bootstrap_conf
		 * @param boolean $file_is_authority
		 * @return void
		 */
		public function parse_amportal_conf($filename, $bootstrap_conf = array(), $file_is_authority = false)
		{
		}
		/**
		 * Returns a hash of the full $db_conf_store, getter for that object.
		 *
		 * @return array   a copy of the db_conf_store
		 */
		public function get_conf_settings()
		{
		}
		/**
		 * Determines if a setting exists in the configuration database.
		 *
		 * @return bool   True if the setting exists.
		 */
		public function conf_setting_exists($keyword)
		{
		}
		/**
		 * Get's the current value of a configuration setting from the database store.
		 *
		 * @param string  The setting to fetch.
		 * @param boolean Optional forces the actual database variable to be fetched
		 * @return mixed  returns the value of the setting, or boolean false if the
		 *                setting does not exist. Since configuration booleans are
		 *                returned as '0' and '1', they can be differentiated by a
		 *                true boolean false (use === operator) if a setting does
		 *                not exist.
		 */
		public function get_conf_setting($keyword, $passthru = false)
		{
		}
		/** Get's the default value of a configuration setting from the database store.
		 *
		 * @param string  The setting to fetch.
		 * @return mixed  returns the default of the setting, or boolean false if the
		 *                setting does not exist. Since configuration booleans are
		 *                returned as '0' and '1', they can be differentiated by a
		 *                true boolean false (use === operator) if a setting does
		 *                not exist.
		 */
		public function get_conf_default_setting($keyword)
		{
		}
		/** Reset all conf settings specified int the passed in array to their defaults.
		 *
		 * @param array   An array of the settings that should be reset.
		 * @param array   Boolean set to true if the db_conf_store should be commited to
		 *                the database after reseting it.
		 * @return int    returns the number of settings that differed from the current
		 *                values.
		 */
		public function reset_conf_settings($settings, $commit = false)
		{
		}
		/** Set's configuration store values with an option to commit and an option to
		 * override readonly settings.
		 *
		 * @param array   A hash of key/value settings to update.
		 * @param bool    Boolean set to true if the db_conf_store should be commited to
		 *                the database after reseting it.
		 * @param bool    Boolean set to true if readonly settings should be allowed
		 *                to be changed.
		 * @return int    returns the number of settings that differed from the current
		 *                values and are marked dirty unless written out.
		 */
		public function set_conf_values($update_arr, $commit = false, $override_readonly = false)
		{
		}
		/**
		 * Get's the results of the last update and can be used to get errors,
		 * values if settings were altered from validation, etc.
		 *
		 * @return array  returns the last_update_status hash
		 */
		public function get_last_update_status()
		{
		}
		// TODO should I remove (or ignore) need for value. Or should I provide the option
		//      of setting the current and default values different as there are some migration
		//      scenarios that would support this?
		/**
		 * used to insert or update an existing setting such as in an install
		 * script. $vars will include some required fields and we are strict
		 * with a die_freebpx() if they are missing.
		 *
		 * the value parameter will not be altered in memory or in the database if
		 * the setting has already been defined, but most of the other settings can
		 * be changed with the exception of the type setting which must be the same
		 * once created, or you must remove the setting entirely if the type is to
		 * be changed.
		 *
		 * @param string  the setting keyword
		 * @param array   a parameter array with all the settings
		 *                [value]       required, value of the setting
		 *                [name]        required, Friendly Short Description
		 *                [level]       optional, default 0, level of setting
		 *                [description] required, long description for tooltip
		 *                [type]        required, type of setting
		 *                [options]     conditional, required for selects, optional
		 *                              for others. For INT a 2 place array
		 *                              indicates the allowed range, for others
		 *                              it is a REGEX validation, for BOOL, nothing
		 *                [emptyok]     optional, default true, if setting can be blank
		 *                [defaultval]  required and same as value
		 *                [readonly]    optional, default false, if readonly
		 *                [hidden]      optional, default false, if hidden
		 *                [category]    required, category of the setting
		 *                [module]      optional, module name that owns the setting
		 *                              and if the setting should only exist when
		 *                              the module is installed. If set, uninstalling
		 *                              the module will automatically remove this.
		 *                [sortorder]   'primary' sort order key for presentation
		 * @param bool    set to true if a commit back to the database should be done
		 */
		public function define_conf_setting($keyword, $vars, $commit = false)
		{
		}
		/**
		 * Removes a set of settings from the db_conf_store, used in functions like
		 * uninstall scripts if settings are no longer needed.
		 *
		 * @param  array  array of settings to be removed
		 */
		public function remove_conf_settings($settings)
		{
		}
		/**
		 * Commit back to database all in memory settings that have been marked as modified.
		 *
		 * @return int    The number of modified settings it committed back.
		 */
		public function commit_conf_settings()
		{
		}
		/**
		 * Remove all settings with the indicated module ownership, used
		 * during functions like uninstalling modules.
		 *
		 * @param  array  array of settings to be removed
		 */
		public function remove_module_settings($module)
		{
		}
		/**
		 * Exact same as remove_conf_setting() method, either can be
		 * used since they both detect a single or multiple settings.
		 *
		 * @param  array  array of settings to be removed
		 */
		public function remove_conf_setting($setting)
		{
		}
		/**
		 * Reset all the db_conf_store settings to their defaults and
		 * optionally commit them back to the database.
		 *
		 * @param bool    Resets all the settings to their default values.
		 */
		public function reset_all_conf_settings($commit = false)
		{
		}
	}
	#[\AllowDynamicProperties]
	class ModulesConf
	{
		public $ProcessedConfig;
		public function __construct()
		{
		}
		public function noload($module = null)
		{
		}
		public function removenoload($module = null)
		{
		}
		public function preload($module = null)
		{
		}
		public function removepreload($module = null)
		{
		}
		public function load($module = null)
		{
		}
		public function removeload($module = null)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Performance
	{
		/**
		 * Turn Performance Logging on
		 */
		public function On($mode = 'print', $lasttick = null)
		{
		}
		/**
		 * Turn Performance logging off
		 */
		public function Off()
		{
		}
		/**
		 * Generate a stamp to the output
		 *
		 * Prints out microtime and memory usage from PHP
		 * Note that the PHP Compiler optimizes this specific code
		 * extremely well. Don't stress about adding lots of calls
		 * to Performace->Stamp(), it won't cause any issues if
		 * $this->doperf is false.
		 *
		 * @param {string} $str The stamp send out
		 * @example "PERF/$str/".microtime()."/".memory_get_usage()."\n"
		 */
		public function Stamp($str, $type = "PERF", $from = false)
		{
		}
		/**
		 * Start a performance counter
		 *
		 * Prints a timestamp, and records the start time and memory use.
		 */
		public function Start($str = false)
		{
		}
		/**
		 * Stop a performance counter
		 *
		 * Prints a timestamp, and the difference between when it was started and now.
		 * Note that time is not automatically calculated if php-bcmath is not installed,
		 * and will need to be done manually.
		 */
		public function Stop($str = false)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Logger
	{
		const DEBUG = 100;
		const INFO = 200;
		const NOTICE = 250;
		const WARNING = 300;
		const ERROR = 400;
		const CRITICAL = 500;
		const ALERT = 550;
		const EMERGENCY = 600;
		public function __construct($freepbx = null)
		{
		}
		/**
		 * Mapping for old freepbx_log calls
		 *
		 * @param [type] The level/severity of the error. Valid levels use constants:
		 *               FPBX_LOG_FATAL, FPBX_LOG_CRITICAL, FPBX_LOG_SECURITY, FPBX_LOG_UPDATE,
		 *               FPBX_LOG_ERROR, FPBX_LOG_WARNING, FPBX_LOG_NOTICE, FPBX_LOG_INFO.
		 * @param [type] $message The message
		 * @return void
		 */
		public function log($level, $message)
		{
		}
		/**
		 * Write to freepbx.log as channel PBX
		 *
		 * @param string $message $message to log
		 * @param string $logLevel Level to log at
		 * @return void
		 */
		public function logWrite($message = '', array $context = array(), $logLevel = self::DEBUG)
		{
		}
		/**
		 * Write to freepbx.log as channel $channel
		 *
		 * @param string $channel channel to log to
		 * @param string $message $message to log
		 * @param string $logLevel Level to log at
		 * @return void
		 */
		public function channelLogWrite($channel, $message = '', array $context = array(), $logLevel = self::DEBUG)
		{
		}
		/**
		 * Write to $driver.log
		 *
		 * @param string $driver Driver to log to
		 * @param string $message $message to log
		 * @param string $logLevel Level to log at
		 * @return void
		 */
		public function driverLogWrite($driver, $message = '', array $context = array(), $logLevel = self::DEBUG)
		{
		}
		/**
		 * Write to $driver.log as channel $channel
		 *
		 * @param string $driver
		 * @param string $channel
		 * @param string $message
		 * @param string $logLevel
		 * @return void
		 */
		public function driverChannelLogWrite($driver, $channel = '', $message = '', array $context = array(), $logLevel = self::DEBUG)
		{
		}
		/**
		 * Create a log driver that will log to $driver.log in the default log path
		 *
		 * @param string $driver
		 * @param string $path
		 * @param constant $minLogLevel
		 * @return object
		 */
		public function createLogDriver($driver, $path = '', $minLogLevel = self::DEBUG, $allowInlineLineBreaks = false)
		{
		}
		/**
		 * Get the Monologger driver object
		 *
		 * @param string $driver
		 * @return object
		 */
		public function getDriver($driver)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Media extends \FreePBX\DB_Helper
	{
		public function __construct($freepbx = null, $track = null)
		{
		}
		/**
		 * Return the array of all HTML5 formats. Formats are returned in order from
		 * most preferred to least preferred.
		 *
		 * @return array Array of HTML5 format strings
		 */
		public function getAllHTML5Formats()
		{
		}
		/**
		 * Get supported HTML5 formats. Formats are returned in order from most
		 * preferred to least preferred.
		 * @param boolean Return all supports formats or just the first one
		 * @param array $forceFormats If non-empty, the list of formats to use instead
		 *                            of determining formats based on user-agent header.
		 * @return array Return array of formats
		 */
		public function getSupportedHTML5Formats($returnAll = false, $forceFormats = array())
		{
		}
		/**
		 * Get all supported formats
		 * @return array Array of all supported formats
		 */
		public function getSupportedFormats()
		{
		}
		/**
		 * Load file
		 * @param  string $filename Full path to audio file
		 */
		public function load($filename)
		{
		}
		/**
		 * Generate an image from this audio file
		 * @param  string $image Full path to image
		 */
		public function generateImage($image)
		{
		}
		/**
		 * Convert a file to another format
		 * @param  string $newFilename The full path to the new file
		 */
		public function convert($newFilename)
		{
		}
		/**
		 * Convert one file into multiple formats
		 * @param  string $newFilename The new file name (extension will be replaced)
		 * @param  array  $formats      Array of supported formats
		 */
		public function convertMultiple($newFilename, $formats = array())
		{
		}
		/**
		 * Forcefully generate formats supports by the system to later use
		 *
		 * @param array $forceFormats The formats to support
		 * @return array Array of converted formats
		 */
		public function generateHTML5Formats($forceFormats)
		{
		}
		/**
		 * Generate HTML5 formats
		 * @param  string $dir Directory to output to, if not set will use default
		 * @param  boolean $multiple Generate multiple files
		 * @return array      Array of converted files
		 */
		public function generateHTML5($dir = '', $multiple = false, $forceFormats = array())
		{
		}
		/**
		 * Stream HTML5 compatible file
		 * @param  string $filename The file name (relative)
		 * @param  boolean $download Whether to stream or download
		 */
		public function getHTML5File($filename, $download = false)
		{
		}
		public function getMIMEtype($file)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Job
	{
		public function __construct($freepbx = null)
		{
		}
		/**
		 * Get all Jobs
		 *
		 * @return array
		 */
		public function getAll()
		{
		}
		/**
		 * Get all enabled jobs
		 *
		 * @return array
		 */
		public function getAllEnabled()
		{
		}
		/**
		 * Add Job Command
		 *
		 * Add a job that will launch a command
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @param string $jobname The job name
		 * @param string $command The command to run
		 * @param string $schedule The Cron Expression when to run
		 * @param integer $max_runtime The max run time in seconds
		 * @param boolean $enabled Whether this job is enabled or not
		 * @return void
		 */
		public function addCommand($modulename, $jobname, $command, $schedule, $max_runtime = 30, $enabled = true, $execution_order = 100)
		{
		}
		/**
		 * Add Job Class
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @param string $jobname The job name
		 * @param string $class The class to run. Must implement https://github.com/FreePBX/framework/blob/feature/newcrons/amp_conf/htdocs/admin/libraries/BMO/Job/Job.php
		 * @param string $schedule The Cron Expression when to run
		 * @param integer $max_runtime The max run time in seconds
		 * @param boolean $enabled Whether this job is enabled or not
		 * @return void
		 */
		public function addClass($modulename, $jobname, $class, $schedule, $max_runtime = 30, $enabled = true, $execution_order = 100)
		{
		}
		/**
		 * Add a Job
		 *
		 * If the job already exists update everything *except* enabled value!
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @param string $jobname The job name
		 * @param string $command The command to run
		 * @param string $class The class to run. Must implement https://github.com/FreePBX/framework/blob/feature/newcrons/amp_conf/htdocs/admin/libraries/BMO/Job/Job.php
		 * @param string $schedule The Cron Expression when to run
		 * @param integer $max_runtime The max run time in seconds
		 * @param boolean $enabled Whether this job is enabled or not
		 * @return void
		 */
		public function add($modulename, $jobname, $command, $class, $schedule, $max_runtime = 30, $enabled = true, $execution_order = 100)
		{
		}
		/**
		 * Remove a job by modulename and jobname
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @param string $jobname The job name
		 * @return void
		 */
		public function remove($modulename, $jobname)
		{
		}
		/**
		 * Update a job
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @param string $jobname The job name
		 * @param string $command The command to run
		 * @param string $class The class to run. Must implement https://github.com/FreePBX/framework/blob/feature/newcrons/amp_conf/htdocs/admin/libraries/BMO/Job/Job.php
		 * @param string $schedule The Cron Expression when to run
		 * @param integer $max_runtime The max run time in seconds
		 * @param boolean $enabled Whether this job is enabled or not
		 * @return void
		 */
		public function update($modulename, $jobname, $command, $class, $schedule, $max_runtime = 30, $enabled = true, $execution_order = 100)
		{
		}
		/**
		 * Remove all jobs
		 *
		 * @return void
		 */
		public function removeAll()
		{
		}
		/**
		 * Remove all jobs by module name
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @return void
		 */
		public function removeAllByModule($modulename)
		{
		}
		/**
		 * Toggle Enabled on a job
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @param string $jobname The job name
		 * @param boolean $enabled Whether this job is enabled or not
		 * @return void
		 */
		public function setEnabled($modulename, $jobname, $enabled = true)
		{
		}
		/**
		 * Set Enabled by Module Rawname
		 *
		 * @param string $modulename
		 * @param boolean $enabled
		 * @return void
		 */
		public function setEnabledByModule($modulename, $enabled = true)
		{
		}
		/**
		 * Update schedule of a job
		 *
		 * @param string $modulename The module rawname (used for uninstalling)
		 * @param string $jobname The job name
		 * @param string $schedule The Cron Expression when to run
		 * @return void
		 */
		public function updateSchedule($modulename, $jobname, $schedule)
		{
		}
		/**
		 * Initialize the crontab to run the jobs
		 *
		 * @return void
		 */
		public function init()
		{
		}
	}
	#[\AllowDynamicProperties]
	class Curl
	{
		public $requestshandles = array();
		public $pesthandles = array();
		public function __construct($freepbx = null)
		{
		}
		public function getProxySettings()
		{
		}
		/**
		 * Get Proxy based PEST object
		 * @param  string $url The URL to pass
		 * @return object     PEST object supporting proxy
		 */
		public function pest($url)
		{
		}
		/**
		 * Get Proxy based Requests object
		 * @param  string $url The URL to pass
		 * @return object     PEST object supporting proxy
		 */
		public function requests($url)
		{
		}
		public function get($url, $data = array())
		{
		}
		public function head($url)
		{
		}
		public function delete($url)
		{
		}
		public function post($url, $data = array())
		{
		}
		public function put($url, $data = array())
		{
		}
		public function patch($url, $data = array())
		{
		}
		public function progressCallback($method)
		{
		}
		public function addHook($name, $data)
		{
		}
		public function addHeader($key, $value)
		{
		}
		public function addOption($key, $value)
		{
		}
		public function reset()
		{
		}
		public function setEnvVariables()
		{
		}
	}
	#[\AllowDynamicProperties]
	class Modules extends \FreePBX\DB_Helper
	{
		public $active_modules;
		public function __construct($freepbx = null)
		{
		}
		/**
		 * Primarily used by unit tests to reset the loaded class counter.
		 */
		public static function reset()
		{
		}
		/**
		 * Get all active modules
		 * @method getActiveModules
		 * @param  boolean          $cached Whether to cache the results.
		 * @return array                   array of active modules
		 */
		public function getActiveModules($cached = true)
		{
		}
		/**
		 * Get destinations of every module
		 * This function might be slow, but it works from within bmo
		 * @return array Array of destinations
		 */
		public function getDestinations()
		{
		}
		/**
		 * Load all Function.inc.php files into FreePBX
		 */
		public function loadAllFunctionsInc()
		{
		}
		/**
		 * Try to load a functions.inc.php if not previously loaded
		 * @param  string $module The module rawname
		 */
		public function loadFunctionsInc($module)
		{
		}
		/**
		 * Check to make sure we have a valid license on the system if it's needed
		 * This is so that commercial modules wont crash the system
		 * @return boolean True if we can load the file, false otherwise
		 */
		public function loadLicensedFileCheck()
		{
		}
		/**
		 * Get Signature
		 * @param string $modulename The raw module name
		 * @param bool $cached     Get cached data or update the signature
		 */
		public function getSignature($modulename, $cached = true)
		{
		}
		/**
		 * String invalid characters from a class name
		 * @param string $module The raw module name.
		 * @param bool $fixcase If true (default), fix the case of the module to be Xyyyy
		 */
		public function cleanModuleName($module, $fixcase = true)
		{
		}
		/**
		 * Check to see if said module has method and is publicly callable
		 * @param {string} $module The raw module name
		 * @param {string} $method The method name
		 */
		public function moduleHasMethod($module, $method)
		{
		}
		/**
		 * Get All Modules by module status
		 * @method getModulesByStatus
		 * @param  mixed            $status Can be: false, single status or arry of statuses
		 * @return array                     Array of modules
		 */
		public function getModulesByStatus($status = false)
		{
		}
		/**
		 * Get all modules that have said method
		 * @param {string} $method The method name to look for
		 */
		public function getModulesByMethod($method)
		{
		}
		/**
		 * Search through all active modules for a function that ends in $func.
		 * Pass it $opts and return whatever is returned in to an array with the
		 * retuning module name as the key
		 * Takes:
		 * @func variable	the function name that we are searching for. The module name
		 * 					will be appened to this
		 * @opts mixed		a variable or array that will be passed to the function being
		 * 					called , if its found
		 *
		 */
		public function functionIterator($func, &$opts = '')
		{
		}
		/**
		 * Return the BMO Class name for the page that has been requested
		 *
		 * This is used for GUI Hooks - for example, when a page is requested like
		 * 'config.php?display=pjsip&action=foo&other=wibble', this returns the class
		 * that generated the display 'pjsip'.
		 *
		 * This means that even if your module is called CamelCaseName, the class file
		 * must be called Camelcasename.class.php
		 *
		 * @param $page Page name
		 * @return bool|string Class name, or false
		 */
		public function getClassName($page = null)
		{
		}
		/**
		 * Pass-through to modules_class->getinfo
		 */
		public function getInfo($modname = false, $status = false, $forceload = false)
		{
		}
		/**
		 * Boolean return for checking a module's status
		 * @param {string} $modname Module Raw Name
		 * @param {constant} $status  Integer/Constant, status to compare to
		 */
		public function checkStatus($modname, $status = MODULE_STATUS_ENABLED)
		{
		}
		/**
		 * Parse a modules XML from filesystem
		 *
		 * This function loads a modules xml file from the filesystem, and return
		 * a simpleXML object.  This explicitly does NOT care about the active or
		 * inactive state of the module. It also caches the object, so this can
		 * be called multiple times without re-reading and re-generating the XML.
		 *
		 * @param (string) $modname Raw module name
		 * @returns (object) SimpleXML Object.
		 *
		 * @throws Exception if module does not exist
		 * @throws Exception if module xml file is not parseable
		 */
		public function getXML($modname)
		{
		}
		/**
		 * Get the CACHED data from the last online check
		 *
		 * This will never request an update, no matter what.
		 *
		 * @return array
		 */
		public function getCachedOnlineData()
		{
		}
		/**
		 * Get List of upgradable modules
		 * @method getUpgradeableModules
		 * @param  [type]                $onlinemodules [description]
		 * @return [type]                               [description]
		 */
		public function getUpgradeableModules($onlinemodules)
		{
		}
		/**
		 * Announce that the calling function is deprecated
		 * @method deprecatedFunction
		 * @param  integer            $pos Position in the stack to start at
		 */
		public function deprecatedFunction($pos = 1)
		{
		}
		function isAssoc(array $arr)
		{
		}
		/**
		 * Check Conflicts of said module
		 *
		 * @param string $module The name of the module, or the modulexml Array
		 * @return void
		 */
		public function checkConflicts($module = false)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Hooks extends \FreePBX\DB_Helper
	{
		public function __construct($freepbx = null)
		{
		}
		/**
		 * Get all cached hooks
		 */
		public function getAllHooks()
		{
		}
		/**
		 * Update all cached hooks
		 */
		public function updateBMOHooks()
		{
		}
		/**
		 * Get priority sorted hook for a class and method
		 * @param  string $class  The class
		 * @param  string $method The method
		 * @return array         Sorted hooks
		 */
		public function returnHooksByClassMethod($class, $method)
		{
		}
		/**
		 * Call a hook from another method
		 * @param  string $class  The class name
		 * @param  string $method The method name
		 * @param  array $args   Args to pass to the function
		 */
		public function processHooksByClassMethod($class, $method, $args = array())
		{
		}
		/**
		 * Return all of the hooks sorted as an array
		 * @param integer $level Level of backtrace to do to discover the calling module
		 */
		public function returnHooks($level = 1)
		{
		}
		/**
		 * Process all cached hooks
		 */
		public function processHooks()
		{
		}
		/**
		 * Process all cached hooks
		 */
		public function processHooksByModule()
		{
		}
		/**
		 * To execute the module specific hooks 
		 */
		public function runModuleSystemHook($moduleName, $hookname, $params = false)
		{
		}
	}
	#[\AllowDynamicProperties]
	class LoadConfig
	{
		public $PlainConfig;
		public $BaseConfig;
		public $ProcessedConfig;
		/**
		 * Setup the call to load config, same as loadConfig() method below
		 * just more direct
		 *
		 * @param object $freepbx the FreePBX BMO Object
		 * @param string $file The basename of the file to load
		 * @param string $hint The directory where the file lives
		 */
		public function __construct($freepbx = null, $file = null, $hint = "")
		{
		}
		/**
		 * Loads and Processes a Configuration in the Asterisk Format
		 *
		 * This will attempt to load a file and then parse it
		 * the file must be in the asterisk configuration file format!
		 *
		 * Note: this function does not return said file!
		 *
		 * @param string $file The basename of the file to load
		 * @param string $hint The directory where the file lives
		 * @return bool True if pass
		 */
		public function loadConfig($file = null, $hint = "")
		{
		}
		/**
		 * Get Raw Contents of a Configuration File
		 *
		 * This will get the raw unprocessed contents of a configuration file
		 *
		 * Note: This will only work AFTER loadConfig has run
		 *
		 * @param string $file The basename of the file to load
		 * @return string Raw Contents of said file
		 */
		public function getRaw($file = null)
		{
		}
		/**
		 * Get The Processed Contents of a Configuration File
		 *
		 * This will process and return a configuration file in the Asterisk Configuration
		 * file format in a hashed format for processing
		 *
		 * @param string $file The basename of the file to load
		 * @param string $hint The directory where the file lives
		 * @param string $context The specific context to return, if not set then return all
		 * @return array The hashed configuration file
		 */
		public function getConfig($file = null, $hint = "", $context = null)
		{
		}
	}
}
namespace {
	/**
	 * This is the FreePBX Big Module Object.
	 *
	 * License for all code of this FreePBX module can be found in the license file inside the module directory
	 * Copyright 2006-2014 Schmooze Com Inc.
	 */
	#[\AllowDynamicProperties]
	class FreePBX extends \FreePBX\FreePBX_Helpers
	{
		public static $conf;
		/**
		 * Constructor
		 *
		 * This Preloads the default libraries into the class. There should be
		 * very few of these, as they will normally get instantiated when
		 * they're asked for the first time.
		 * Currently this is only "Config".
		 *
		 * @return void
		 * @access public
		 */
		public function __construct(&$conf = \null)
		{
		}
		/**
		 * Alternative Constructor
		 *
		 * This allows the Current BMO to be referenced from anywhere, without
		 * needing to instantiate a new one. Calling $x = FreePBX::create() will
		 * create a new BMO if one has not already beeen created (unlikely!), or
		 * return a reference to the current one.
		 *
		 * @return object FreePBX BMO Object
		 */
		public static function create()
		{
		}
		/**
		 * Reset loaded dependencies
		 * 
		 * Primarily used in unit testis to reset the loaded dependencies
		 */
		public static function reset()
		{
		}
		/**
		 * Shortcut to create
		 *
		 * Simplifies access to BMO by not requiring create() when a module is
		 * requested, by assuming that any static request to the FreePBX parent
		 * object is going to only be for a module.
		 * @return object FreePBX BMO Object
		 */
		public static function __callStatic($name, $var)
		{
		}
		/**
		 * Check for hooks in the current Dialplan function
		 */
		public function doDialplanHooks($request = \null)
		{
		}
	}
}
namespace FreePBX {
	#[\AllowDynamicProperties]
	class Less extends \Less_Parser
	{
		public function __construct($freepbx = null, $env = null)
		{
		}
		/**
		 * Generate all FreePBX Main Style Sheets
		 * @param {array} $variables = array() Array of variables to override
		 */
		public function generateMainStyles($variables = array())
		{
		}
		/**
		 * Generate Individual Module Style Sheets
		 * @param {string} $module    The module name
		 * @param {array} $variables =             array() Array of variables to override
		 */
		public function generateModuleStyles($module, $pagename = '', $variables = array())
		{
		}
		/**
		 * Parse a Directory to find the appropriate less files
		 *
		 * If a bootstrap.less file exists then parse that only (looking for imports)
		 * Otherwise just find the files to parse at the same time. This will return
		 * the generated CSS however it's highly advisable you end up using getCacheFile
		 *
		 * @param string $dir The directory housing the less files
		 * @param string $uri_root The uri root of the web request
		 * @return string The CSS file output
		 */
		public function parseDir($dir, $uri_root = '')
		{
		}
		/**
		 * Generates and Gets the Cached files
		 *
		 * This will generated a compiled less file into css format
		 * but it will cache it so that it doesnt happen unless the file has changed
		 *
		 * @param string $dir The directory housing the less files
		 * @param string $uri_root The uri root of the web request
		 * @param array $variables Array of variables to override
		 * @return string the CSS filename
		 */
		public function getCachedFile($dir, $uri_root = '', $variables = array())
		{
		}
	}
	#[\AllowDynamicProperties]
	class GuiHooks
	{
		public function __construct($freepbx = null)
		{
		}
		public function getConfigPageInit($module, $request, $currentcomponent)
		{
		}
		public function getPreDisplay($module, $request)
		{
		}
		public function getPostDisplay($module, $request)
		{
		}
		public function getHooks($currentModule, $pageName = null)
		{
		}
		/**
		 * Check for hooks for the current GUI function
		 */
		public function doGUIHooks($thispage, &$currentcomponent)
		{
		}
		public function doHook($moduleToCall, &$currentcomponent, $thispage)
		{
		}
		public function needsIntercept($module, $filename)
		{
		}
		public function doIntercept($moduleToCall, $filename)
		{
		}
		public function doConfigPageInits($display = null)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Installer
	{
		public function __construct($test = false)
		{
		}
		public function getDestination($modulename = false, $src = false, $validation = false)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Extensions
	{
		public function __construct($freepbx = null)
		{
		}
		/**
		 * Check if a specific extension is being used, or get a list of all
		 * extensions that are being used
		 *
		 * Upon passing in an array of extension numbers, this api will query all
		 * modules to determine if any are using those extension numbers. If so,
		 * it will return an array with the usage information as described below,
		 * otherwise an empty array. If passed boolean true, it will return an array
		 * of the same format with all extensions on the system that are being used.
		 *
		 * @method checkUsage
		 * @param  mixed      $exten            an array of extension numbers to
		 * check against, or if boolean true then return list of all extensions
		 * @param  array      $report_conflicts [description]
		 * @return array                        returns an empty array if exten not
		 * in use, or any array with usage info, or of all usage if exten is boolean true
		 *
		 * @example $exten_usage[$module][$exten]['description'] // description of the extension
		 *                                               ['edit_url']    // a url that could be invoked to edit extension
		 *                                               ['status']      // Status: INUSE, RESERVED, RESTRICTED
		 */
		public function checkUsage($exten = true, $report_conflicts = true)
		{
		}
		/**
		 * Returns a hash of all extensions used on the system
		 *
		 * returns a full extension map where the index is the extension number and the
		 * value is what extension is using it. If there are duplicates defined, it will
		 * only show one of the extensions as duplicates is an unacceptable error condition
		 *
		 * @method getExtmap
		 * @param  boolean      $force  Force extension checking
		 * @return array                returns a hash of all extensions on system as array
		 */
		public function getExtmap($force = false)
		{
		}
		/**
		 * Creates the extmap and puts it into the db
		 *
		 * this calculates the extension map and stores it into the database, primarily
		 * used by retrieve_conf
		 *
		 * @method setExtmap
		 */
		public function setExtmap()
		{
		}
		/**
		 * Create a comprehensive list of all extensions conflicts
		 *
		 * This returns an array structure with information about all
		 * extension numbers that are in conflict. This means the same number
		 * is being used by 2 or more modules and the results will be ambiguous
		 * which one will be ignored when dialed. See the code for the
		 * structure of the retured array.
		 *
		 * @method listExtensionConflicts
		 * @param  boolean  $module_hash   a hash of module names to search for callbacks
		 * @return array                   an array of the destinations that are empty, orphaned or custom
		 */
		public function listExtensionConflicts()
		{
		}
	}
	#[\AllowDynamicProperties]
	class ConfigFile
	{
		public $config;
		/**
		 * ConfigFile Constructor.
		 * @param  {object} $freepbx = null The FreePBX Object
		 * @param  {string} $file    = null filename to load
		 */
		public function __construct($freepbx = null, $file = null)
		{
		}
		/**
		 * Add Entry to Configuration file that has been loaded
		 * @param {string} $section The section we are adding the value to
		 * @param {mixed} $entry = null The value, can be array or string
		 */
		public function addEntry($section, $entry = null)
		{
		}
		/**
		 * Remove an entry from the write buffer
		 * @param {string} $section The section we are removing the value from
		 * @param {string} $key     The key we are looking for
		 * @param {string} $val = null The value we are looking to remove, if blank then remove it regardless of value
		 */
		public function removeEntry($section, $key, $val = null)
		{
		}
	}
	#[\AllowDynamicProperties]
	class DialplanHooks
	{
		public function __construct($freepbx = null)
		{
		}
		public function getAllHooks($active_modules = null)
		{
		}
		public function processHooks($engine, $hooks = null)
		{
		}
		public function getBMOHooks()
		{
		}
	}
	#[\AllowDynamicProperties]
	class Monitoring
	{
		protected static $status = array(0 => "OK", 1 => "WARNING", 2 => "CRITICAL");
		const OK = 0;
		const WARNING = 1;
		const CRITICAL = 2;
		/**
		 * Gets a textual representation of the status from an integer
		 * @param integer $level
		 * @return string
		 */
		public static function getStatus($level = 0)
		{
		}
		/**
		 * Generate a report for sensu
		 * @param array $output
		 * @param integer $level
		 */
		public static function report($output, $level = 0)
		{
		}
		/**
		 * asteriskInfo
		 *
		 * @return void
		 */
		public function asteriskInfo()
		{
		}
		/**
		 * asteriskRunning
		 *
		 * @return void
		 */
		public function asteriskRunning()
		{
		}
		/**
		 * astmanInfo
		 *
		 * @return void
		 */
		public function astmanInfo($freepbx)
		{
		}
		/**
		 * dbStatus
		 *
		 * @return void
		 */
		public function dbStatus()
		{
		}
		/**
		 * GUIMode
		 *
		 * @param  mixed $freepbx
		 * @return void
		 */
		public function GUIMode($freepbx)
		{
		}
		/**
		 * setupWizardDetails
		 *
		 * @param  mixed $freepbx
		 * @return void
		 */
		public function setupWizardDetails($freepbx)
		{
		}
		/**
		 * autoUpdateDetails
		 *
		 * @return void
		 */
		public function autoUpdateDetails()
		{
		}
	}
	#[\AllowDynamicProperties]
	class Modulelist
	{
		public function __construct($freepbx = null)
		{
		}
		public function is_loaded()
		{
		}
		public function initialize($module_list)
		{
		}
		public function invalidate()
		{
		}
		public function get()
		{
		}
		public function __get($var)
		{
		}
	}
}
namespace FreePBX\Database {
	class PDOStatement extends \PDOStatement
	{
		protected function __construct($dbh)
		{
		}
		public function execute($input_parameters = null)
		{
		}
	}
}
namespace FreePBX\Database\DBAL {
	/**
	 * The synchronizer knows how to synchronize a schema with the configured
	 * database.
	 *
	 * @deprecated
	 */
	interface SchemaSynchronizer
	{
		/**
		 * Gets the SQL statements that can be executed to create the schema.
		 *
		 * @return string[]
		 */
		public function getCreateSchema(\Doctrine\DBAL\Schema\Schema $createSchema);
		/**
		 * Gets the SQL Statements to update given schema with the underlying db.
		 *
		 * @param bool $noDrops
		 *
		 * @return string[]
		 */
		public function getUpdateSchema(\Doctrine\DBAL\Schema\Schema $toSchema, $noDrops = false);
		/**
		 * Gets the SQL Statements to drop the given schema from underlying db.
		 *
		 * @return string[]
		 */
		public function getDropSchema(\Doctrine\DBAL\Schema\Schema $dropSchema);
		/**
		 * Gets the SQL statements to drop all schema assets from underlying db.
		 *
		 * @return string[]
		 */
		public function getDropAllSchema();
		/**
		 * Creates the Schema.
		 *
		 * @return void
		 */
		public function createSchema(\Doctrine\DBAL\Schema\Schema $createSchema);
		/**
		 * Updates the Schema to new schema version.
		 *
		 * @param bool $noDrops
		 *
		 * @return void
		 */
		public function updateSchema(\Doctrine\DBAL\Schema\Schema $toSchema, $noDrops = false);
		/**
		 * Drops the given database schema from the underlying db.
		 *
		 * @return void
		 */
		public function dropSchema(\Doctrine\DBAL\Schema\Schema $dropSchema);
		/**
		 * Drops all assets from the underlying db.
		 *
		 * @return void
		 */
		public function dropAllSchema();
	}
	/**
	 * Abstract schema synchronizer with methods for executing batches of SQL.
	 *
	 * @deprecated
	 */
	abstract class AbstractSchemaSynchronizer implements \FreePBX\Database\DBAL\SchemaSynchronizer
	{
		/** @var Connection */
		protected $conn;
		public function __construct(\Doctrine\DBAL\Connection $conn)
		{
		}
		/**
		 * @param string[] $sql
		 *
		 * @return void
		 */
		protected function processSqlSafely(array $sql)
		{
		}
		/**
		 * @param string[] $sql
		 *
		 * @return void
		 *
		 * @throws DBALException
		 */
		protected function processSql(array $sql)
		{
		}
	}
	/**
	 * Schema Synchronizer for Default DBAL Connection.
	 *
	 * @deprecated
	 */
	class SingleDatabaseSynchronizer extends \FreePBX\Database\DBAL\AbstractSchemaSynchronizer
	{
		public function __construct(\Doctrine\DBAL\Connection $conn)
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function getCreateSchema(\Doctrine\DBAL\Schema\Schema $createSchema)
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function getUpdateSchema(\Doctrine\DBAL\Schema\Schema $toSchema, $noDrops = false)
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function getDropSchema(\Doctrine\DBAL\Schema\Schema $dropSchema)
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function getDropAllSchema()
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function createSchema(\Doctrine\DBAL\Schema\Schema $createSchema)
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function updateSchema(\Doctrine\DBAL\Schema\Schema $toSchema, $noDrops = false)
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function dropSchema(\Doctrine\DBAL\Schema\Schema $dropSchema)
		{
		}
		/**
		 * {@inheritdoc}
		 */
		public function dropAllSchema()
		{
		}
	}
}
namespace FreePBX\Database {
	class Migration
	{
		public function __construct($conn, $version, $driverName)
		{
		}
		public function setTable($table)
		{
		}
		/**
		 * Generate Update Array used to create or update tables
		 * @method generateUpdateArray
		 * @return array              Array of table
		 */
		public function generateUpdateArray()
		{
		}
		/**
		 * Modify Multiple Tables
		 * @method modify
		 * @param  array  $tables  The tables to update
		 * @param  bool   $dryrun  If set to true dont execute just return the sql modification string
		 * @return mixed
		 */
		public function modifyMultiple($tables = array(), $dryrun = false)
		{
		}
		/**
		 * Modify Single Table
		 * @method modify
		 * @param  array  $columns Columns to update
		 * @param  array  $indexes Indexes to update
		 * @param  bool   $dryrun  If set to true dont execute just return the sql modification string
		 * @return mixed
		 */
		public function modify($columns = array(), $indexes = array(), $dryrun = false)
		{
		}
	}
}
namespace FreePBX {
	#[\AllowDynamicProperties]
	class Freepbx_conf
	{
		public $freepbx_conf;
		public function __construct()
		{
		}
		public static function create()
		{
		}
		public function __get($var)
		{
		}
		public function __call($var, $args)
		{
		}
		public static function __callStatic($var, $args)
		{
		}
	}
}
namespace FreePBX\Job {
	/**
	 * The format that we'll expect all of our Tasks to follow.
	 */
	interface TaskInterface
	{
		/**
		 * When called, should run the specified task. Returns true on success
		 * or false on failure.
		 *
		 * @return bool
		 */
		public static function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output);
	}
}
namespace FreePBX {
	#[\AllowDynamicProperties]
	class Notifications
	{
		const TYPE_CRITICAL = 100;
		const TYPE_SECURITY = 200;
		const TYPE_SIGNATURE_UNSIGNED = 250;
		const TYPE_UPDATE = 300;
		const TYPE_ERROR = 400;
		const TYPE_WARNING = 500;
		const TYPE_NOTICE = 600;
		public function __construct($freepbx)
		{
		}
		// Legacy pre-BMO Hooks
		public static function create()
		{
		}
		/**
		 * Check to see if Notification Already exists
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @return int Returns the number of notifications per module & id
		 */
		public function exists($module, $id)
		{
		}
		/**
		 * Add a Critical Notification Message
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @param string $display_text The text that will be displayed as the subject/header of the message
		 * @param string $extended_text The extended text of the notification when it is expanded
		 * @param string $link The link that is set to the notification
		 * @param bool $reset Reset notification on module update
		 * @param bool $candelete If the notification can be deleted by the user on the notifications display page
		 * @return int Returns the number of notifications per module & id
		 */
		public function add_critical($module, $id, $display_text, $extended_text = "", $link = "", $reset = true, $candelete = false)
		{
		}
		/**
		 * Add a Security Notification Message
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @param string $display_text The text that will be displayed as the subject/header of the message
		 * @param string $extended_text The extended text of the notification when it is expanded
		 * @param string $link The link that is set to the notification
		 * @param bool $reset Reset notification on module update
		 * @param bool $candelete If the notification can be deleted by the user on the notifications display page
		 * @return int Returns the number of notifications per module & id
		 */
		public function add_security($module, $id, $display_text, $extended_text = "", $link = "", $reset = true, $candelete = false)
		{
		}
		/**
		 * Add a Unsigned Modules Notification Message
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @param string $display_text The text that will be displayed as the subject/header of the message
		 * @param string $extended_text The extended text of the notification when it is expanded
		 * @param string $link The link that is set to the notification
		 * @param bool $reset Reset notification on module update
		 * @param bool $candelete If the notification can be deleted by the user on the notifications display page
		 * @return int Returns the number of notifications per module & id
		 */
		public function add_signature_unsigned($module, $id, $display_text, $extended_text = "", $link = "", $reset = true, $candelete = false)
		{
		}
		/**
		 * Add an Update Notification Message
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @param string $display_text The text that will be displayed as the subject/header of the message
		 * @param string $extended_text The extended text of the notification when it is expanded
		 * @param string $link The link that is set to the notification
		 * @param bool $reset Reset notification on module update
		 * @param bool $candelete If the notification can be deleted by the user on the notifications display page
		 * @return int Returns the number of notifications per module & id
		 */
		public function add_update($module, $id, $display_text, $extended_text = "", $link = "", $reset = false, $candelete = false)
		{
		}
		/**
		 * Add an Error Notification Message
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @param string $display_text The text that will be displayed as the subject/header of the message
		 * @param string $extended_text The extended text of the notification when it is expanded
		 * @param string $link The link that is set to the notification
		 * @param bool $reset Reset notification on module update
		 * @param bool $candelete If the notification can be deleted by the user on the notifications display page
		 * @return int Returns the number of notifications per module & id
		 */
		public function add_error($module, $id, $display_text, $extended_text = "", $link = "", $reset = false, $candelete = false)
		{
		}
		/**
		 * Add a Warning Notification Message
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @param string $display_text The text that will be displayed as the subject/header of the message
		 * @param string $extended_text The extended text of the notification when it is expanded
		 * @param string $link The link that is set to the notification
		 * @param bool $reset Reset notification on module update
		 * @param bool $candelete If the notification can be deleted by the user on the notifications display page
		 * @return int Returns the number of notifications per module & id
		 */
		public function add_warning($module, $id, $display_text, $extended_text = "", $link = "", $reset = false, $candelete = false)
		{
		}
		/**
		 * Add a Notice Notification Message
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 * @param string $display_text The text that will be displayed as the subject/header of the message
		 * @param string $extended_text The extended text of the notification when it is expanded
		 * @param string $link The link that is set to the notification
		 * @param bool $reset Reset notification on module update
		 * @param bool $candelete If the notification can be deleted by the user on the notifications display page
		 * @return int Returns the number of notifications per module & id
		 */
		public function add_notice($module, $id, $display_text, $extended_text = "", $link = "", $reset = false, $candelete = true)
		{
		}
		/**
		 * List all Critical Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_critical($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * List all Unsigned Module Notification Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_signature_unsigned($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * List all Security Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_security($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * List all Update Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_update($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * List all Error Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_error($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * List all Warning Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_warning($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * List all Notice Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_notice($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * List all Messages
		 *
		 * @param bool $show_reset Show resettable messages
		 * @param bool $allow_filtering Allow us to filter results
		 * @return array Returns the list of Messages
		 */
		public function list_all($show_reset = false, $allow_filtering = true)
		{
		}
		/**
		 * Reset the status (hidden/shown) notifications of module & id
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 */
		public function reset($module, $id)
		{
		}
		/**
		 * Forcefully Delete notifications of all specified level
		 *
		 * @param NOTIFICAION LEVEL or blank for ALL levels
		 */
		public function delete_level($level = "")
		{
		}
		/**
		 * Forcefully Delete notifications of module & id
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 */
		public function delete($module, $id)
		{
		}
		/**
		 * Delete notifications of module & id if it is allowed by `candelete`
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 */
		public function safe_delete($module, $id)
		{
		}
		/**
		 * Ignore all future notifications for this type and delete
		 * if there are currently any
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 */
		public function ignore_forever($module, $id)
		{
		}
		/**
		 * Start paying attention to this notification type again
		 *
		 * Undoes the effect of method ignore_forever
		 *
		 * @param string $module Raw name of the module requesting
		 * @param string $id ID of the notification
		 */
		public function undo_ignore_forever($module, $id)
		{
		}
		/**
		 * Returns the number of active notifications
		 *
		 * @return int Number of active Notifications
		 */
		public function get_num_active()
		{
		}
		/**
		 * Filter our notifications based on process hooks
		 * @param  array $list An array of notifications
		 * @param  array $filter=array() A white list of notifications to allow
		 *         Example: array('sipsettings' => array('BINDPORT'))
		 * @return array
		 */
		public function filterByWhitelist($list, $filter = array())
		{
		}
	}
	#[\AllowDynamicProperties]
	class GPG
	{
		// Statuses:
		// Valid signature.
		const STATE_GOOD = 1;
		// File has been tampered
		const STATE_TAMPERED = 2;
		// File is signed, but, not by a valid signature
		const STATE_INVALID = 4;
		// File is unsigned.
		const STATE_UNSIGNED = 8;
		// This is in an unsupported state
		const STATE_UNSUPPORTED = 16;
		// Signature has expired
		const STATE_EXPIRED = 32;
		// Signature has been explicitly revoked
		const STATE_REVOKED = 64;
		// Signature is Trusted by GPG
		const STATE_TRUSTED = 128;
		// Yes. sks is there twice.
		// This is how long we should wait for GPG to run a command.
		// This may need to be tuned on things like the pi.
		public $timeout = 6;
		// Manually loaded keys are here (This gets initialized in
		// __construct, below, because PHP)
		public $keydir;
		// Constructor, to provide some per-OS values
		// Fail if gpg isn't in an expected place
		public function __construct()
		{
		}
		/**
		 * Validate a file using WoT
		 * @param string $file Filename (explicit or relative path)
		 * @return bool returns true or false
		 */
		public function verifyFile($filename, $retry = true)
		{
		}
		/**
		 * Check the module.sig file against the contents of the
		 * directory
		 *
		 * @param string Module name
		 * @return array (status => GPG::STATE_whatever, details => array (details, details))
		 */
		public function verifyModule($modulename = null)
		{
		}
		/**
		 * getKey function to download and install a specified key
		 *
		 * If no key is provided, install the FreePBX key.
		 * Throws an \Exception if unable to find the key requested
		 * @param string $key The key to get?
		 */
		public function getKey($key = null)
		{
		}
		/**
		 * trustFreePBX function
		 *
		 * Specifically marks the FreePBX Key and other known-trusted keys as ultimately trusted
		 */
		public function trustFreePBX()
		{
		}
		/**
		 * Strips signature from .gpg file
		 *
		 * This saves the file, minus the .gpg extension, to the same directory
		 * the .gpg file is in. It returns the filename of the output file if
		 * valid, throws an \Exception if unable to validate
		 * @param string $filename The filename to check
		 */
		public function getFile($filename)
		{
		}
		/**
		 * Actually run GPG
		 * @param string Params to pass to gpg
		 * @param fd File Descriptor to feed to stdin of gpg
		 * @return array returns assoc array consisting of (array)status, (string)stdout, (string)stderr and (int)exitcode
		 */
		public function runGPG($params, $stdin = null)
		{
		}
		/**
		 * Return array of all of my private keys
		 */
		public function getMyKeys()
		{
		}
		/**
		 * Generate list of hashes to validate
		 * @param string $dir the directory
		 */
		public function getHashes($dir)
		{
		}
		/**
		 * Refresh all stored keys
		 */
		public function refreshKeys()
		{
		}
		/**
		 * Check the module.sig file
		 *
		 * If it's valid, return the processed contents of the sig file.
		 * If it's not valid, return false.
		 * @param string $sigfile The signature file we will check against
		 */
		public function checkSig($sigfile)
		{
		}
		public function getGpgLocation()
		{
		}
	}
	#[\AllowDynamicProperties]
	class View
	{
		public function __construct($freepbx = null)
		{
		}
		public function getScripts()
		{
		}
		/**
		 * This is a replace of the old redirect standard.
		 * It emulates the same functionality but instead using HTML5 pushState
		 * The javascript part of the code is in footer.php
		 * @url https://developer.mozilla.org/en-US/docs/Web/Guide/API/DOM/Manipulating_the_browser_history
		 * @return bool True if the URL will be replaced, false if the URL won't be changed
		 */
		public function redirect_standard()
		{
		}
		/**
		 * To run the javascript or not? A simple method to check the state
		 */
		public function replaceState()
		{
		}
		/**
		 * Get the finalized Query String for replacement
		 */
		public function getQueryString()
		{
		}
		/**
		 * Get Moment Date/Time Format
		 *
		 * Tests the format before returning it
		 *
		 * @return string Format
		 */
		public function getDateTimeFormat()
		{
		}
		/**
		 * Get Moment Date/Time Format
		 *
		 * Tests the format before returning it
		 *
		 * @return string Format
		 */
		public function getTimeFormat()
		{
		}
		/**
		 * Get Moment Date/Time Format
		 *
		 * Tests the format before returning it
		 *
		 * @return string Format
		 */
		public function getDateFormat()
		{
		}
		/**
		 * Set Date/Time Format
		 * @param string $format The Format to use
		 */
		public function setDateTimeFormat($format)
		{
		}
		/**
		 * Set Date/Time Format
		 * @param string $format The Format to use
		 */
		public function setTimeFormat($format)
		{
		}
		/**
		 * Set Date/Time Format
		 * @param string $format The Format to use
		 */
		public function setDateFormat($format)
		{
		}
		/**
		 * Set System Timezone
		 */
		public function setTimezone($timezone = null)
		{
		}
		/**
		 * Get User or System Timezone
		 * @param  int $userid The User Manager ID, if not supplied try to infere it
		 * @return string         The Timezone
		 */
		public function getTimezone()
		{
		}
		/**
		 * Get Formatted Date String
		 * @param  integer $timestamp Unix Timestamp, if empty then NOW
		 * @return string            The date string
		 */
		public function getDate($timestamp = null)
		{
		}
		/**
		 * Get Formatted Time String
		 * @param  integer $timestamp Unix Timestamp, if empty then NOW
		 * @return string            The time string
		 */
		public function getTime($timestamp = null)
		{
		}
		/**
		 * Get Formatted Date/Time String
		 * @param  integer $timestamp Unix Timestamp, if empty then NOW
		 * @return string            The formatted date/time string
		 */
		public function getDateTime($timestamp = null)
		{
		}
		/**
		 * Get the moment object at time
		 * @param  integer $timestamp Unix Timestamp, if empty then NOW
		 * @return object            The moment object
		 */
		public function getMoment($timestamp = null)
		{
		}
		/**
		 * Get Locale
		 * @return string            The locale  (en_US)
		 */
		public function getLocale()
		{
		}
		/**
		 * Set System Language
		 * @param boolean $details If we should return details or just the name
		 */
		public function setLanguage($language = null, $details = false)
		{
		}
		/**
		 * Set Locales for the Admin interface
		 */
		public function setAdminLocales()
		{
		}
		/**
		 * Alert Info Hookable Draw Select
		 * @param  sting $id        The id of the select box and javascripts
		 * @param  string $value     The selected value
		 * @param  string $class     Additional classes to add
		 * @param  bool $allowNone Allow none to be a selectable item
		 * @param  bool $disable   Disable the element
		 * @param  bool $required  Is this a required element
		 */
		public function alertInfoDrawSelect($id, $value = '', $class = '', $allowNone = true, $disable = false, $required = false)
		{
		}
		public function mediaControls($id, $title = '', $class = '', $hidden = false, $record = false)
		{
		}
		/**
		 * This is used to generate a timezone select field using the timezones available
		 * on the system. This will only show PHP supported timezones.
		 * @param  string $id   The name and id of the form field
		 * @param  string $value   The current value
		 * @param  string $nonelabel  What you want shown if nothing is chosen
		 * @return html input containing timezones
		 */
		function timezoneDrawSelect($id, $value = '', $nonelabel = '')
		{
		}
		/**
		 * This is used to generate a timezone select field using the timezones available
		 * on the system. This will only show PHP supported timezones.
		 * @param  string $id   The name and id of the form field
		 * @param  string $value   The current value
		 * @param  string $nonelabel  What you want shown if nothing is chosen
		 * @return html input containing timezones
		 */
		function languageDrawSelect($id, $value = '', $nonelabel = '')
		{
		}
		/**
		 * Destination drawselects.
		 *
		 * This is where the magic happens. Query all modules for valid destinations
		 * Then build a javascript based multi-select box.
		 * Hide the second select box until the first is selected.
		 * Auto-populate the second based on the first.
		 *
		 * The first is almost always a module name, though it can be custom as well.
		 * The second is the actually destination
		 *
		 * @param  string $goto             The current goto destination setting. EG: ext-local,2000,1
		 * @param  int $i                   the destination set number (used when drawing multiple destination sets in a single form ie: digital receptionist)
		 * @param  array $restrict_modules  Array of modules or array of modules with ids to restrict getting destinations from
		 * @param  bool $table              Wrap this in a table row using <tr> and <td> (deprecated should not be used in 13+)
		 * @param  string $nodest_msg       No Destination selected message
		 * @param  bool $required           Whether the destination is required to be set
		 * @param  bool $output_array       Output an array instead of html (you will need to make sure the html is correct later on for the functionality of this to work correctly)
		 * @param  bool $reset              Reset the drawselect_* globals (useful when using multiple destination dropdowns on a page, each with their own restricted modules)
		 * @param  bool $disable            Set html element to disabled on creation
		 * @param  string $class            String of classes to add to to the html element (class="<string>")
		 * @return mixed                    Array if $output_array is true otherwise a string of html
		 */
		public function destinationDrawSelect($goto, $i, $restrict_modules = false, $table = true, $nodest_msg = '', $required = false, $output_array = false, $reset = false, $disable = false, $class = '')
		{
		}
		/**
		 * Draw a clock on the page
		 * @method drawClock
		 * @param  [type]    $time     [description]
		 * @param  [type]    $tz       [description]
		 * @param  [type]    $id       [description]
		 * @param  [type]    $label    [description]
		 * @param  [type]    $errormsg [description]
		 * @return [type]              [description]
		 */
		public function drawClock($time = null, $tz = null, $id = null, $label = null, $errormsg = null)
		{
		}
		/**
		 * Send this function a timestamp and it will generate:
		 * 		5 months ago
		 * @method humanDiff
		 * @param  string    $timestamp String timestamp
		 * @return string               The date. Ago or before
		 */
		public function humanDiff($timestamp)
		{
		}
		/**
		 * Send this function a DateTime Object and it will generate:
		 * 		5 months ago
		 * @method humanDiff
		 * @param  object    $ts        DateTime Object
		 * @return string               The date. Ago.
		 */
		public function humanDiffObject(\DateTime $dt)
		{
		}
		/**
		 * Generate Destination Usage Panel
		 * @method destinationUsage
		 * @param  mixed           $dest         an array of destinations to check against, or if boolean true then return list of all destinations in use
		 * @param  boolean          $module_hash a hash of module names to search for callbacks, otherwise global $active_modules is used
		 * @return string                        The finalized HTML
		 */
		public function destinationUsage(mixed $dest)
		{
		}
		/** provide optional alert() box and formatted url info for extension conflicts
		 * @param array     an array of extensions that are in conflict obtained from framework_check_extension_usage
		 * @param boolean   default false. True if url and descriptions should be split, false to combine (see return)
		 * @param boolean   default true. True to echo an alert() box, false to bypass the alert box
		 * @return array    returns an array of formatted URLs with descriptions. If $split is true, retuns an array
		 *                  of the URLs with each element an array in the format of array('label' => 'description, 'url' => 'a url')
		 * @description     This is used upon detecting conflicting extension numbers to provide an optional alert box of the issue
		 *                  by a module which should abort the attempt to create the extension. It also returns an array of
		 *                  URLs that can be displayed by the module to show the conflicting extension(s) and links to edit
		 *                  them or further interogate. The resulting URLs are returned in an array either formatted for immediate
		 *                  display or split into a description and the raw URL to provide more fine grained control (or use with guielements).
		 */
		public function displayExtensionUsageAlert($usage_arr = [], $split = false, $alert = true)
		{
		}
		/**
		 * returns a list of URLs that represent a conflict with the past in extension or null if none
		 * @param string  extension number to check for conflicts
		 * @return mixed  returns a string with one or more URLs to the conflicting extesion(s) or null
		 */
		public function getConflictUrlHelper($account)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Unlock extends \FreePBX\FreePBX_Helpers
	{
		public function __construct($freepbx = null, $var = null)
		{
		}
		/**
		 * Generate a new unlock key and store it in the database
		 * @return {string} The new key
		 */
		public function genUnlockKey()
		{
		}
		/**
		 * Check the passed key to see if its valid,
		 * if it's valid then run unlockSession()
		 *
		 * @param {string} $key The passed key to check
		 * @return {bool} return status from unlockSession
		 */
		public function checkUnlock($key = null)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Database extends \PDO
	{
		//driver version
		/**
		 * Connecting to the Database object
		 * If you pass nothing to this it will assume the default database
		 *
		 * Otherwise you can send it parameters that match PDO parameter settings:
		 * PDO::__construct ( string $dsn [, string $username [, string $password [, array $options ]]] )
		 *
		 * You will then be returned a PDO Database object that you can work with
		 * to manipulate databases outside of FreePBX, a good example of this is with
		 * CDRs where the module has to connect to the external CDR Database
		 */
		public function __construct()
		{
		}
		/**
		 * Fetch the mysql command to use with required parameters
		 * @param string cmdName = mysql or mysqldump
		 */
		public function fetchSqlCommand($mysqlCmd = 'mysql')
		{
		}
		public function migrateMultipleXML(\SimpleXMLElement $XMLtables, $dryrun = false)
		{
		}
		/**
		 * Executes an SQL statement, returning the results
		 *
		 * @param string|null $query The SQL statement to prepare and execute.
		 * @param int|null $fetchMode The fetch mode must be one of the
		 *   PDO::FETCH_* constants.
		 * @param mixed|null $fetchModeArgs Column number, class name or object.
		 * @return Statement
		 */
		public function query(?string $query = null, ?int $fetchMode = null, mixed ...$fetchModeArgs) : \PDOStatement|false
		{
		}
		public function migrate($table)
		{
		}
		public function getDoctrineConnection()
		{
		}
		/**
		 * COMPAT: Queries Database using PDO
		 *
		 * This is a FreePBX Compatibility hook for the global 'sql' function that
		 * previously used PEAR::DB
		 *
		 * @param $sql string SQL String to run
		 * @param $type string Type of query
		 * @param $fetchmode int One of the PDO::FETCH_ methos (see http://www.php.net/manual/en/pdo.constants.php for info)
		 */
		public function sql($sql = null, $type = "query", $fetchmode = \PDO::FETCH_BOTH)
		{
		}
		/**
		 * COMPAT: getMessage - returns an error message
		 *
		 * This will throw an exception, as it shouldn't be used and is a holdover from the PEAR $db object.
		 */
		public function getMessage()
		{
		}
		/**
		 * COMPAT: isError - checks if the last query was successfull.
		 *
		 * This will throw an exception, as it shouldn't be used and is a holdover from the PEAR $db object.
		 */
		public function isError($result)
		{
		}
		/**
		 * COMPAT: escapeSimple - Wraps the supplied string in quotes.
		 *
		 * This wraps the requested string in quotes, and returns it. It's a bad idea. You should be using
		 * prepared queries for this. At some point this will be deprecated and removed.
		 */
		public function escapeSimple($str = null)
		{
		}
		/**
		 * HELPER: getOne - Returns first result
		 *
		 * Returns the first result of the first row of the query. Handy shortcut when you're doing
		 * a query that only needs one item returned.
		 */
		public function getOne($sql = null)
		{
		}
		/**
		 * Parses DSN string in to an array
		 * @param  string $dsn a formatted DSN string.
		 * @return array  Returns an array containing the parsed DSN
		 */
		public function dsnToArray($dsn)
		{
		}
	}
	#[\AllowDynamicProperties]
	class FileHooks
	{
		public function __construct($freepbx = null)
		{
		}
		public function processFileHooks($active_modules = null)
		{
		}
	}
	#[\AllowDynamicProperties]
	class Search extends \FreePBX\FreePBX_Helpers
	{
		public function ajaxRequest($cmd, &$settings)
		{
		}
		public function ajaxHandler()
		{
		}
		public function globalSearch()
		{
		}
		public function moduleSearch()
		{
		}
	}
	#[\AllowDynamicProperties]
	class PKCS
	{
		// Key location, overrideable by setKeyLocation()
		public $keylocation = false;
		// This is how long we should wait for OpenSSL to run a command.
		// This may need to be tuned on things like the pi.
		public $timeout = 120;
		//TODO first element that comes in here is the freepbx object yikes
		public function __construct($debug = 0)
		{
		}
		// Ensure that permissions are correct in teardown
		public function __destruct()
		{
		}
		/**
		 * Create a global configuration file for use
		 * when generating more base certificates
		 * @param {string} $cn The Common Name, usually a FQDN
		 * @param {string} $o  The organization name
		 */
		public function createConfig($base = false, $cn = false, $o = false, $force = false)
		{
		}
		/**
		 * Create a Certificate Authority. If the CA already exists don't recreate it
		 * or we will end up invalidating all certificates we've already generated
		 * (at some point it would/will happen). Alternatively you can pass the force
		 * option and it will overwrite
		 * @param {string} $base The Certificate authority basename
		 * @param {string} $passphrase  The passphrase used to encrypt the key file
		 * @param {bool} $force=false Whether to force recreation if already exists
		 */
		public function createCA($base = false, $passphrase = false, $force = false)
		{
		}
		/**
		 * Create a Certificate from the provided basename
		 * @param {string} $base       The basename
		 * @param {string} $cabase     The Certificate Authority Base name to reference
		 * @param {string} $passphrase The CA key passphrase
		 */
		public function createCert($base, $cabase, $passphrase)
		{
		}
		/**
		 * Create Certificate Signing Request
		 * @param  string $name   The basename of the CSR (File System)
		 * @param  array $params Variables for the CSR. Must have at least 'OU' and 'CN'
		 * @param  bool $regen  Whether to regenerate the CSR if it already exists
		 * @return bool
		 */
		public function createCSR($name = false, $params = array(), $regen = false)
		{
		}
		/**
		 * Create a secure key.
		 *
		 * Will not overwrite an existing key.
		 *
		 * @param string Name of the key
		 * @param string Password (null/blank/false gives no key)
		 * @param int Size of key (defaults to 2048)
		 * @return bool true/false if the key was created.
		 */
		public function generateKey($name, $password = false, $bits = 2048)
		{
		}
		/**
		 * Extract the public key from the private key
		 * @method extractPublicKey
		 * @param  string           $name The private key name
		 */
		public function extractPublicKey($name)
		{
		}
		/**
		 * Sign the key that's been generated with our own CA
		 *
		 * @param string Name of the key to sign
		 * @param string Name of the CA to use to sign the key
		 * @param string Password (if any) of the CA
		 * @param int Serial number (default = 0001)
		 */
		public function selfSignCert($name, $caname = "ca", $password = false, $serial = "0001")
		{
		}
		/**
		 * Actually run OpenSSL
		 * @param string Params to pass to OpenSSL
		 * @param string String to pass into OpenSSL (used to pass passphrases around)
		 * @return array returns assoc array consisting of (array)status, (string)stdout, (string)stderr and (int)exitcode
		 */
		public function runOpenSSL($params, $stdin = null)
		{
		}
		/**
		 * Return a list of all Certificates from the key folder
		 * @return array
		 */
		public function getAllCertificates()
		{
		}
		/**
		 * Set the location of the keys.
		 *
		 * This is normally auto-detected. You don't need to use this.
		 * In fact, you don't want to use this unless you're extremely
		 * sure you know what you're doing. No sanity checks are done.
		 *
		 * @param string The location of the key folder
		 */
		public function setKeysLocation($loc)
		{
		}
		/**
		 * Get the Asterisk Key Folder Location
		 * @return string The location of the key folder
		 */
		public function getKeysLocation()
		{
		}
		/**
		 * Get list of files in a directory
		 * @param string $dir The directory to get the file list of/from
		 */
		public function getFileList($dir)
		{
		}
		/**
		 * Figure out the 'correct' hostname for this machine.
		 *
		 * Sometimes, 'hostname -f', which doesn't do any DNS lookups (which
		 * is what we want) errors.
		 *
		 * @return string Best guess at hostname
		 */
		public function getHostname()
		{
		}
		//Old functions for backwards compatibility with old certman
		/**
		 * DEPRECIATED FUNCTION
		 * @return [type] [description]
		 */
		public function getAllAuthorityFiles()
		{
		}
		/**
		 * DEPRECIATED FUNCTION
		 * @return [type] [description]
		 */
		public function removeCert($base)
		{
		}
		/**
		 * DEPRECIATED FUNCTION
		 * @return [type] [description]
		 */
		public function removeCA()
		{
		}
		/**
		 * DEPRECIATED FUNCTION
		 * @return [type] [description]
		 */
		public function removeConfig()
		{
		}
		/**
		 * certObj
		 *
		 * @return void
		 */
		public function certObj($freepbx)
		{
		}
		/**
		 * setcertObj
		 *
		 * @param  mixed $obj
		 * @return void
		 */
		public function setcertObj($obj)
		{
		}
		/**
		 * fileStoreObj
		 *
		 * @param  mixed $freepbx
		 * @return void
		 */
		public function fileStoreObj($freepbx)
		{
		}
		/**
		 * setFileStoreObj
		 *
		 * @param  mixed $obj
		 * @return void
		 */
		public function setFileStoreObj($obj)
		{
		}
	}
}
// vim: set ai ts=4 sw=4 ft=php:
/**
 * This is the FreePBX Big Module Object.
 *
 * License for all code of this FreePBX module can be found in the license file inside the module directory
 * Copyright 2006-2014 Schmooze Com Inc.
 */
namespace FreePBX {
	//Legacy calls
	define("CONF_TYPE_BOOL", 'bool');
	define("CONF_TYPE_TEXTAREA", 'textarea');
	define("CONF_TYPE_TEXT", 'text');
	define("CONF_TYPE_DIR", 'dir');
	define("CONF_TYPE_INT", 'int');
	define("CONF_TYPE_SELECT", 'select');
	define("CONF_TYPE_FSELECT", 'fselect');
	define("CONF_TYPE_CSELECT", 'cselect');
}
// vim: set ai ts=4 sw=4 ft=php:
/**
 * Notification Class
 *
 * Adds or Remove Notifications to and from the FreePBX Dashboard/Email
 *
 * License for all code of this FreePBX module can be found in the license file inside the module directory
 * Copyright 2006-2014 Schmooze Com Inc.
 */
namespace FreePBX {
	define("NOTIFICATION_TYPE_CRITICAL", 100);
	define("NOTIFICATION_TYPE_SECURITY", 200);
	define("NOTIFICATION_TYPE_SIGNATURE_UNSIGNED", 250);
	define("NOTIFICATION_TYPE_UPDATE", 300);
	define("NOTIFICATION_TYPE_ERROR", 400);
	define("NOTIFICATION_TYPE_WARNING", 500);
	define("NOTIFICATION_TYPE_NOTICE", 600);
}