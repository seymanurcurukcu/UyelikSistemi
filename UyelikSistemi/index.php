<?php include("fonksiyon.php"); $uye=new uye; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDO ÜYELİK SİSTEMİ</title>
</head>
<body>

<div class="container-fluid">
	<div class="row">
   
            
    
    	<div class="col-md-6 mx-auto mt-4" >
          <?php 
          @$islem=$_GET["islem"];
          switch ($islem) {
               case 'ekle':
                  $uye->ekle($baglanti);
                  break;
              case 'uyeguncelle':
                $uye->guncelle($baglanti);
                  break;
              case 'uyesil':
                  $uye->sil($baglanti);
                  break;
                 
              default:
                 
              ?>
         
          
          
         
        	<table class="table table-bordered table-striped text-center bg-white">
            <thead>
            <tr>
            <th colspan="6"><a href="index.php?islem=ekle" class="btn btn-success">ÜYE EKLE</a></th>
            
            </tr>
            </thead>
        	<thead>
            <tr>
            <th class="font-weight-bold">AD</th>
            <th class="font-weight-bold">SOYAD</th>
            <th class="font-weight-bold"><a href="index.php?sec=p1">+</a> YAŞ <a href="index.php?sec=p2">-</a> </th>
            <th class="font-weight-bold"><a href="index.php?sec=p3">+</a> AİDAT <a href="index.php?sec=p4">-</a> </th>
            <th class="font-weight-bold">GÜNCELLE</th>
            <th class="font-weight-bold">SİL</th>            
            </tr>
            </thead>
            <tbody>
                <?php
                @$sec=$_GET["sec"];
                switch ($sec) {
                    case 'p1':
                        $uye->listele($baglanti,1);
                        break;
                    case 'p2':
                        $uye->listele($baglanti,2);
                        break;
                    case 'p3':
                        $uye->listele($baglanti,3);
                        break;
                    case 'p4':
                        $uye->listele($baglanti,4);
                        break;
                            
                    default:
                    $uye->listele($baglanti,0);
                        break;
                }
              
           
            ?>
            </tbody>
        	
            </table>
            <?php
             }
            ?>
          
        
        </div>
    
    
    </div>	
</div>

</body>
</html>