<?php


function get_nilai_timbangan($option)

{

     $portName = $option['portName'];
    $baudRate = $option['baudRate'];
    $bits = $option['bits'];
    $spotBit = $option['spotBit'];


        if(!extension_loaded('dio'))
    {
        return ( "PHP Direct IO does not appear to be installed for more info see: http://www.php.net/manual/en/book.dio.php" );
        exit;
    }

    try 
    {
        //the serial port resource
        $bbSerialPort;
        
        
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
        { 
            $bbSerialPort = dio_open($portName, O_RDONLY );
            //we're on windows configure com port from command line
            exec("mode {$portName} baud={$baudRate} data={$bits} stop={$spotBit} parity=n xon=on");
        } 
        else //'nix
        {
            $bbSerialPort = dio_open($portName, O_RDWR | O_NOCTTY | O_NONBLOCK );
            dio_fcntl($bbSerialPort, F_SETFL, O_SYNC);
            //we're on 'nix configure com from php direct io function
            dio_tcsetattr($bbSerialPort, array(
                'baud' => $baudRate,
                'bits' => $bits,
                'stop'  => $spotBit,
                'parity' => 0
            ));
        }
        
        if(!$bbSerialPort)
        {
            return ( "Could not open Serial port {$portName} ");
            exit;
        }
        
            sleep(3);
            $data = dio_read($bbSerialPort, 256); //this is a blocking call
            if ($data) {
                return  $data ;
            }	
        dio_close($bbSerialPort);

    } 
    catch (Exception $e) 
    {
        exit(1);
    } 

}
