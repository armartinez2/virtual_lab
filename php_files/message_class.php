<html>
<?php

class NiceSSH{
        private $ssh_host='192.168.7.176';
        private $ssh_port = 22;
        private $ssh_server_fp='b1:e2:27:9f:98:96:d9:3c:0c:c2:ef:0c:c2:70:1a:04';
        private $ssh_auth_user='root';
        private $ssh_auth_priv='/home/username/.ssh/id_rsa';
        private $ssh_auth_pub='/home/username/.ssh/id_rsa.pub';
        private $ssh_auth_pass='_One1Won_';
        private $connection;

public function connect(){
        if (!($this->connection = ssh2_connect($this->ssh_host, $this->ssh_port))){
                throw new Exception('cannot connect to server');
        }
        $fingerprint = ssh2_fingerprint($this->connection, SSH2_FINGERPRINT_MD5 | SSH2_FINGERPRINT_HEX);
        if (strcmp($this->ssh_server_fp, $fingerprint) !== 0){
                throw new Exception('unable to verify the server id');
        }
        if (!ssh2_auth_pubkey_file($this->connection, $this->ssh_auth_user, $this->ssh_auth_pub, $this->ssh_auth_priv, $this->ssh_auth_pass)){
                throw new Exception('Authentiaction rejected by server');
        }
}

public function exec($cmd){
        if(!($stream = ssh2_exec($this->connection, $cmd))){
                throw newException('ssh command failed');
        }
        stream_set_blocking($stream, true);
        $data="";
        while($buf = fread(Stream,4096)){
                $data .= $buf;
        }
        fclose($stream);
        return $data;
}

public function disconnect(){
        $this->exec('echo "EXITING" && exit;' );
        $this->connection = null;
}

public function __destruct(){
        $this->disconnect();
}

}
?>
</html>

