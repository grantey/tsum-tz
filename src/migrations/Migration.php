<?php

namespace App\Migrations;

class Migration {

    /**
     * @access private
     * @var string dbhost database host
     */
    private $dbhost;

    /**
     * @access private
     * @var string dbuser database user
     */
    private $dbuser;

    /**
     * @access private
     * @var string dbuser database password
     */
    private $dbpassword;

    /**
     * @access private
     * @var string dbuser database name
     */
    private $dbname;

    /**
     * @access private
     * @var mysqli object
     */
    private $conn;

    /**
     * @param array $config database connection config
     */
    public function __construct($config) {
        $errorMessage = 'Database connection error';

        $this->dbhost = $config['host'];
        $this->dbuser = $config['user'];
        $this->dbpassword = $config['password'];
        $this->dbname = $config['name'];

        if (empty($config) || !($this->conn = new \mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname))) {
            throw new Exception($errorMessage);
        } else {
            $query = $this->conn->query('set names utf8');
            if (!$query) {                
                throw new Exception($errorMessage);
            }
        }
    }

    /**
     * Get migrations file
     * @access private
     */
    private function getMigrationFiles() {

        $sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . '/sql/');        
        $allFiles = glob($sqlFolder . '*.sql');

        $query = sprintf('show tables from `%s` like "%s"', $this->dbname, 'migrations');
        $data = $this->conn->query($query);

        $firstMigration = !$data->num_rows;
        
        if ($firstMigration) {
            return $allFiles;
        }

        $versionsFiles = array();
        $query = sprintf('select `name` from `%s`', 'migrations');
        $data = $this->conn->query($query)->fetch_all(MYSQLI_ASSOC);

        foreach ($data as $row) {
            array_push($versionsFiles, $sqlFolder . $row['name']);
        }

        return array_diff($allFiles, $versionsFiles);
    }  

    /**
     * Execute migrations
     * @access public
     */
    public function migrate() {
        
        $files = $this->getMigrationFiles();
        if (empty($files)) {
            echo 'Actual state';
        } else {
            foreach ($files as $file) {        
                $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', $this->dbuser, $this->dbpassword, $this->dbhost, $this->dbname, $file);                    
                shell_exec($command);

                $baseName = basename($file);                
                $query = sprintf('insert into `%s` (`name`) values("%s")', 'migrations', $baseName);
                $this->conn->query($query);                
                echo basename($file) . '...<br />';                
            }
            echo 'Migrate complete.';
        }
    }
}