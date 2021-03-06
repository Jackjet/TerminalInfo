<?php
/**
 * @Author: pizepei
 * @Date:   2018-08-10 15:20:07
 * @Last Modified by:   pizepei
 * @Last Modified time: 2018-08-10 15:28:58
 */
namespace pizepei\terminalInfo;

class UpdateQqwry{


    public function getQqwry()
    {
      /*
            纯真数据库自动更新原理实现__FILE__
            www.shuax.com 2014.03.27
        */
        $copywrite = file_get_contents("http://update.cz88.net/ip/copywrite.rar");
        $qqwry = file_get_contents("http://update.cz88.net/ip/qqwry.rar");
        //函数从二进制字符串对数据进行解包。
        $key = unpack("V6", $copywrite)[6];
        for($i=0; $i<0x200; $i++)
        {
            $key *= 0x805;
            $key ++;
            $key = $key & 0xFF;
            $qqwry[$i] = chr( ord($qqwry[$i]) ^ $key );
        }
        //此函数解压缩压缩字符串。
        $qqwry = gzuncompress($qqwry);
        /**
         * 当前php文件同级创建qqwry.dat
         * [$fp description]
         * @var [type]
         */
        $fp = fopen(dirname(__FILE__).DIRECTORY_SEPARATOR."qqwry.dat", "wb");
        // var_dump($fp);
        if($fp)
        {
            /**
             * 函数写入文件（可安全用于二进制文件）。
             */
            fwrite($fp, $qqwry);
            /**
             * fclose() 函数关闭一个打开文件。
             */
            fclose($fp);
        }

    }



}

 