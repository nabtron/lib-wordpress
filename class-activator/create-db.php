<?php 

    /**
     *
     * an example class that creates a db upon activation
     *
     * call it by:
     * 
     * function activate_stations_bookings() {
     *     require_once STATIONS_BOOKINGS_DIR_PATH . 'inc/common/class-activator.php';
     *     Stations_Bookings_Activator::activate();
     * }
     *
     * and the define constants:
     *
     * define( 'STATIONS_BOOKINGS_DIR_PATH', plugin_dir_path( __FILE__ ) );
     * define( 'STATIONS_BOOKINGS_TABLENAME', $wpdb->prefix.'stations_bookings' );
     *
     */
    class Stations_Bookings_Activator {

        //public $ksb_db_version = '0.0.1';

        public function activate() {
            self::ksb_install();
        }

        public function ksb_install() {
            global $wpdb;
            global $ksb_db_version;
            $ksb_db_version = '0.0.1';

            $table_name = $wpdb->prefix . 'stations_bookings';
            
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                `ID` bigint(20) NOT NULL AUTO_INCREMENT,
                `firstname` varchar(255) NOT NULL,
                `lastname` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `number` varchar(255) NOT NULL,
                `date` date NOT NULL,
                `time` time NOT NULL,
                `type` varchar(255) NOT NULL,
                `status` varchar(255) NOT NULL,
                PRIMARY KEY id (`ID`)
            ) $charset_collate;
            ";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_option( 'ksb_db_version', $ksb_db_version );
        }

    }
