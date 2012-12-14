<?php

/**
 * Jared Rosenberg 2012/12/11
 * jared@shortlinedesign.com
 *  
 * Timer class for easily timing scripts
 * 
 */

class Timer{

	// keep records
	static $records = array( 'start'=>array(), 'stop'=>array() );
	// keep track of runs
	static $runs = array( 'all'=>array(), 'running'=>array() );


	/**
	 * @param string $bookmark, name of this timer
	 */
	public static function start( $bookmark, $as_float = true )
	{
		// keep track of bookmark names used
		self::$runs['all'][] = $bookmark;
		// keep track of what runs we have started
		array_push(self::$runs['running'], $bookmark);

		self::$records['start'][$bookmark]['value'] = microtime($as_float);
		self::$records['start'][$bookmark]['debug'] = debug_backtrace();
	}

	/**
	 * Stop the timer named $bookmark
	 * 
	 * @param string $bookmark
	 */
	public static function stop( $bookmark, $as_float = true )
	{

		self::$records['stop'][$bookmark]['value'] = microtime($as_float);
		self::$records['stop'][$bookmark]['debug'] = debug_backtrace();

		// key we are looking for
		$key = array_search( $bookmark, self::$runs['running'] );
		// get rid of this run's bookmark
		unset(self::$runs['running'][$key]);
	}

	/**
	 * display runs, formatted
	 */
	public static function showRuns()
	{
		if( count(self::$runs['running']) )
		{
			$still_running = implode(', ', self::$runs['running']);
			die('ERROR: Timer(s) still running: '.$still_running);
		}
		else{
			foreach( self::$records['start'] as $mark=>$value )
			{
				$elapsed = self::$records['stop'][$mark]['value'] - self::$records['start'][$mark]['value'];
				$out[$mark]['start'] = self::$records['start'][$mark]['value'];
				$out[$mark]['stop'] = self::$records['stop'][$mark]['value'];
				$out[$mark]['elapsed'] = $elapsed;
				$out[$mark]['linestart'] = self::$records['start'][$mark]['debug'][0]['line'];
				$out[$mark]['linestop'] = self::$records['stop'][$mark]['debug'][0]['line'];
			}
			foreach( $out as $mark=>$values)
			{
				echo PHP_EOL."$mark({$values['linestart']} - {$values['linestop']}): {$values['elapsed']}s";
			}
		}
	}
}

?>