<?php

class Logger{

        /**
         * Sample Log level you can use to Specify Log levels of severity
         * log level Error
         * log level Warn
         * log level Info
         * log level Debug
         * 
         * logging status  on || off
         * log_level sets the directory for logging
         * 
         * @param String log_level 
         * 
        */

    public $LOG_FILE = 'logs.txt';
    public $DIR = '\PHP-Logger.class/';


    function __construct( $log_level = 'error' ){

        if(!file_exists($_SERVER['APPDATA'].$this->DIR.'logs/' . $log_level . '/'. $this->LOG_FILE)){
            
            // create the directory

            mkdir($_SERVER['APPDATA'].$this->DIR.'logs/'.$log_level, 0777, true);

            // create and or open the file

            fopen($_SERVER['APPDATA'].$this->DIR.'logs/' . $log_level . '/'. $this->LOG_FILE, 'x' );
        }
        else{
            // create and or open the file

            fopen($_SERVER['APPDATA'].$this->DIR.'logs/' . $log_level . '/'. $this->LOG_FILE, 'x' );
        }
       
    }

    /**
    *   write data to log file
    *
    *   log_file = directory to the log level and file 
    *
    *   @param string log_level
    *
    *   @param string log_data
    */

    function log($log_level, $log_data ){
        /*
            set the log level and the log file as directory
        */
        $log_level_log_file = $_SERVER['APPDATA'].$this->DIR.'logs/' . $log_level . '/'. $this->LOG_FILE;
        
        /**
        *  add logging time to log data 
        *   and skip to next line
        */

        $log_data = date('D, d M Y H:i:s', time()) .': '. $log_data.PHP_EOL;

        //write log to file
        try {

            file_put_contents($log_level_log_file, $log_data, FILE_APPEND | LOCK_EX);

        } catch ( \Throwable $e ) {

            var_export( $e );

        }
       

    }

}

$logger = new Logger('info');

$logger->log( 'info', 'this is the test log y\'all have been waiting for' );
