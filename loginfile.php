<?php

    //Html dosyasının içerisindeki, form sayesinde istekte bulunup, bir çağrıda bulunuyoruz.
    //Burada ise, php bizim için veritabanı arasında bir bağlantı oluşturup, html tarafından gelen verileri
    //tutup, bu verileri işleyip, bir sonuç döndürüyor.

    if($_SERVER["REQUEST_METHOD"]== "POST" )
    {
        //Form'dan gelen verilerin değişken olarak tutulması
        $username = $_POST['username'];
        $password = $_POST['password'];
    }


            // Veritabanı bağlantısı : Veritabanına bağlanmamız için gerekli oturum bilgilerini girmek.

            $serverhost = "localhost";
            $databaseusername = "root";
            $databasepassword = "";
            $databasename = "userlogindb";

            $baglantiDizesi = new mysqli($serverhost,$databaseusername,$databasepassword,$databasename);


    if($baglantiDizesi->connect_error)
    {
        die("Bağlantı başarısız: ".$baglantiDizesi->connect_error);
    }     
    
    $veritabanısorgu = "SELECT *FROM users WHERE username='$username' AND password='$password'";
    
    $sonuc = $baglantiDizesi->query($veritabanısorgu);
    
    if($sonuc->num_rows == 1)
    {
        //Giriş başarılı!
        header("Location: basarili.html");
        exit();
    }else
    {
        //Giriş başarısız!
        header("Location: basarisiz.html");
        exit();        
    }
    $baglantiDizesi->close();
?>