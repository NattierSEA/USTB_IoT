<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        // 向当前client_id发送数据 
        //Gateway::sendToClient($client_id, "Hello $client_id\r\n");
        // 向所有人发送
        //Gateway::sendToAll("$client_id login\r\n");
		echo $client_id." login at ".date("Y-m-d H:i:s")."\n";
		echo "    from ".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']."\r\n";
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {
	   //$mysqli = mysqli_connect("localhost", "root", "root", "mysql");
	   $res = false;
	   $mysqli = mysqli_connect("localhost", "root", "root", "tp5");
	    if (mysqli_connect_errno()) {
	    //printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
        } else {
			
			if(strlen($message) == 17 && substr($message, 0, 1) == 'r')//注册消息
			{
				$key = substr($message, 1, 8);
				$serial = substr($message, 9, 8);
				$sql = "SELECT * FROM qs_experiment_device WHERE dserial LIKE \"".$serial."\" ORDER BY id DESC LIMIT 1";
		        $res = mysqli_query($mysqli, $sql);
		        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$tid = $newArray['tid'];
				$aid = $newArray['aid'];
				
				$sql = "SELECT * FROM qs_experiment_application WHERE id=".$aid;
		        $res = mysqli_query($mysqli, $sql);
		        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
				if( $key == $newArray['key'])
				{
					$sql = "INSERT INTO qs_client (serial, number) VALUES ('".$serial."','$client_id')";
					$res = mysqli_query($mysqli, $sql);
					echo $client_id." registered as ".$serial."\r\n";
				    echo "    from ".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']."\r\n";
				}
			}
			
			if(strlen($message) >= 17 && substr($message, 0, 1) == 'd')//数据消息
			{
				$key = substr($message, 1, 8);
				$serial = substr($message, 9, 8);
				$sql = "SELECT * FROM qs_experiment_device WHERE dserial LIKE \"".$serial."\" ORDER BY id DESC LIMIT 1";
		        $res = mysqli_query($mysqli, $sql);
		        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
				$tid = $newArray['tid'];
				$aid = $newArray['aid'];
				
				$sql = "SELECT * FROM qs_experiment_application WHERE id=".$aid;
		        $res = mysqli_query($mysqli, $sql);
		        $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
				if( $key == $newArray['key'])
				{
					echo("sensordata receive success\n");
					switch($tid)
					{
						//温湿度
						case 3: $sql = "INSERT INTO qs_tempandhum (serial,temp,hum,msgtype,time)
						VALUES ('$serial','$message[17]'*10+'$message[18]'+'$message[19]'/10,'$message[20]'*10+'$message[21]'+'$message[22]'/10,'TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//温度	例28.9℃-->3个字节2 8 9，最后一位为小数
						case 5: $sql = "INSERT INTO qs_wendu (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*10+'$message[18]'+'$message[19]'/10,'TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//湿度	例50%RH-->3个字节0 5 0，没小数部分
						case 6: $sql = "INSERT INTO qs_shidu (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//红外测距 例120mm---->3个字节1 2 0，没小数部分
						case 7: $sql = "INSERT INTO qs_hongwaiceju (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//光照度 例1234lx------>5个字节0 1 2 3 4，没小数部分
						case 8: $sql = "INSERT INTO qs_guangzhaodu (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*10000+'$message[18]'*1000+'$message[19]'*100+'$message[20]'*10+'$message[21]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//人体脉搏 例65次/min-->3个字节0 6 5，没小数部分
						case 9: $sql = "INSERT INTO qs_rentimaibo (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//线性霍尔
						case 10: $sql = "INSERT INTO qs_xianxinghuoer (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*10000+'$message[18]'*1000+'$message[19]'*100+'$message[20]'*10+'$message[21]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//超声波传感器 例123mm-->3个字节1 2 3，没小数部分
						case 11: $sql = "INSERT INTO qs_chaoshengbo (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//电子罗盘 例73°------>3个字节0 7 3，没有小数部分
						case 12: $sql = "INSERT INTO qs_dianziluopan (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//加速度
						case 13: break;
						//陀螺仪
						case 14: break;
						//气压 例1000.0kPa-->6个字节0 1 0 0 0 0，最后一位小数
						case 15: $sql = "INSERT INTO qs_qiya (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*10000+'$message[18]'*1000+'$message[19]'*100+'$message[20]'*10+'$message[21]'+'$message[22]'/10,'TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//PM2.5 例240ug/m3-->3个字节2 4 0，没有小数
						case 16: $sql = "INSERT INTO qs_pm (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//气敏
						case 17: $sql = "INSERT INTO qs_qimin (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*1000000+'$message[18]'*100000+'$message[19]'*10000+'$message[20]'*1000+'$message[21]'*100+'$message[22]'*10+'$message[23]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//压力 例40.3g-->4个节点0 4 0 3、最后一位为小数
						case 18: $sql = "INSERT INTO qs_yali (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]'+'$message[19]'/10,'TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//磁角度 例360°-->3个字节3 6 0、没有小数部分
						case 19: $sql = "INSERT INTO qs_cijiaodu (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*100+'$message[18]'*10+'$message[19]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//电压 例1.27V-->3个字节1 2 7 、后两位为小数部分
						case 20: $sql = "INSERT INTO qs_dianya (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'+'$message[18]'/10+'$message[19]'/100,'TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//电流 例100mA-->4个字节0 1 0 0、没有小数部分
						case 21: $sql = "INSERT INTO qs_dianliu (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*1000+'$message[18]'*100+'$message[19]'*10+'$message[20]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//紫外线
						case 22: $sql = "INSERT INTO qs_ziwaixian (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]'*10000+'$message[18]'*1000+'$message[19]'*100+'$message[20]'*10+'$message[21]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//火焰（开关型）：	例0-->1个字节，0表示开，1表示关
						case 24: $sql = "INSERT INTO qs_huoyan (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//红外热释电（开关型）：	例0-->1个字节，0表示开，1表示关
						case 25: $sql = "INSERT INTO qs_hongwaireshidian (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//振动（开关型）：	例0-->1个字节，0表示开，1表示关
						case 26: $sql = "INSERT INTO qs_zhendong (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//开关霍尔（开关型）：	例0-->1个字节，0表示开，1表示关
						case 27: $sql = "INSERT INTO qs_kaiguanhuoer (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//声音检测（开关型）：	例0-->1个字节，0表示开，1表示关
						case 28: $sql = "INSERT INTO qs_shengyinjiance (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//干簧管（开关型）：	例0-->1个字节，0表示开，1表示关
						case 29: $sql = "INSERT INTO qs_ganhuangguan (serial,data,msgtype,time)
						VALUES ('$serial','$message[17]','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
						//工业环境传感器：	例3字节pm2.5 3字节温度 3字节湿度 3字节雨量  用12字节长的字符串存储
						case 37: $datastr = substr($message, 17, 12);
						$sql = "INSERT INTO qs_gongyehuanjing (serial,data,msgtype,time)
						VALUES ('$serial','$datastr','TCP',NOW())";
						$res = mysqli_query($mysqli, $sql);break;
					}
				}
				echo $serial." send: ".$message." from ".$client_id."\r\n";
				echo "    from ".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']."\r\n";
			}

	    if ($res == TRUE) {
	   	//echo "A record has been inserted.\n";
	    } 
		else {
			echo $client_id." send wrong message at ".date("Y-m-d H:i:s").":\n";
			if(substr($message,0,3)=="GET")
				echo "Visit the web site.\n";
			else
				echo $message."\n";
	    }
		//$sql = "SELECT * FROM testTable WHERE id=1 ORDER BY id DESC LIMIT 1";
		//$res = mysqli_query($mysqli, $sql);
		//$newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
		//print_r($newArray);
		
		
	    mysqli_close($mysqli);}
		
	   //Gateway::sendToClient($client_id, "$message\r\n");
	   //echo $client_id." send: ".$message."\r\n";
        // 向所有人发送 
        //Gateway::sendToAll("$client_id said $message\r\n");
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
	    $mysqli = mysqli_connect("localhost", "root", "root", "tp5");
	    if (mysqli_connect_errno()) {
	    exit();
        } else {
	    $sql = "delete from qs_client where number = '".$client_id."'";
		$res = mysqli_query($mysqli, $sql);
			}

	    if ($res === TRUE) {
	    } else {
	    }
	    mysqli_close($mysqli);
		echo $client_id." logout at ".date("Y-m-d H:i:s")."\n";
		echo "    from ".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']."\r\n";
   }
}
