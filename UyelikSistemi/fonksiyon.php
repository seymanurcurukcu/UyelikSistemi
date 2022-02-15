<?php

try  {
	$baglanti = new PDO("mysql:host=localhost;dbname=pdodersler;charset=utf8", "root","");
	$baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
} catch (PDOException $e) {
	die($e->getMessege());
}

class uye{
function guncelle($baglanti){
	@$buton=$_POST["button"];
    @$uyeid=$_GET["id"];
	if (@$buton) {
		
		$id=htmlspecialchars($_POST["id"]);
	   $ad=htmlspecialchars($_POST["ad"]);
	   $soyad=htmlspecialchars($_POST["soyad"]);
	   $yas=htmlspecialchars($_POST["yas"]);
	   $aidat=htmlspecialchars($_POST["aidat"]);
		if (empty($ad) || empty($soyad) || empty($yas) || empty($aidat)) {
			echo "boş alan bırakmayınız.";
		}
		else {
			$ekleme=$baglanti->prepare("UPDATE uyeler set ad=?,soyad=?,yas=?,aidat=? where id=$id");
			$ekleme->bindParam(1,$ad,PDO::PARAM_STR);
			$ekleme->bindParam(2,$soyad,PDO::PARAM_STR);
			$ekleme->bindParam(3,$yas,PDO::PARAM_STR);
			$ekleme->bindParam(4,$aidat,PDO::PARAM_INT);
			$ekleme->execute();
			echo "üye güncelleme başarılı";
			header("refresh:2, url=index.php");
		}
	}
	else {
		
		echo' <table class="table table-bordered table-striped text-center bg-white">
		<thead>
		<tr>
		<th colspan="6">ÜYE GÜNCELLEME</th>       
		</tr>
		</thead>
		<tbody>
		<td colspan="6">
		<form action="index.php?islem=uyeguncelle" method="post">';
        $sorgum=$baglanti->prepare("select * from uyeler where id=$uyeid");
		$sorgum->execute();

		$sorguson=$sorgum->fetch();

		echo '<input type="text" name="ad" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["ad"].'">
		<input type="text" name="soyad" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["soyad"].'">
		<input type="text" name="yas" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["yas"].'">
		<input type="text" name="aidat" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["aidat"].'">
		<input type="hidden" name="id" class="form-control mx-auto col-md-3 mt-2" value="'.$sorguson["id"].'">
		<input type="submit" name="button" class="btn btn-success" value="GUNCELLE">
		</form>
		</td>
		</tr>
		</tbody>
		</table>';
	}

   


}



function sil($baglanti){
    $uyeid=$_GET["id"];
    if (empty($uyeid)) {
		echo "hata var";
	}
	else {
		$sil=$baglanti->prepare("delete from uyeler where id=$uyeid");
		$sil->execute();
		echo "silme işlemi başarılı";
		header("refresh:2, url=index.php");
	}

}

 function ekle($baglanti){
	 @$buton=$_POST["button"];
	
	 if (@$buton) {
		$ad=htmlspecialchars($_POST["ad"]);
		$soyad=htmlspecialchars($_POST["soyad"]);
		$yas=htmlspecialchars($_POST["yas"]);
		$aidat=htmlspecialchars($_POST["aidat"]);
		 if (empty($ad) || empty($soyad) || empty($yas) || empty($aidat)) {
			 echo "boş alan bırakmayınız.";
		 }
		 else {
			 $ekleme=$baglanti->prepare("insert into uyeler(ad,soyad,yas,aidat) values (?,?,?,?)");
			 $ekleme->bindParam(1,$ad,PDO::PARAM_STR);
			 $ekleme->bindParam(2,$soyad,PDO::PARAM_STR);
			 $ekleme->bindParam(3,$yas,PDO::PARAM_STR);
			 $ekleme->bindParam(4,$aidat,PDO::PARAM_INT);
			 $ekleme->execute();
			 echo "üye ekleme başarılı";
			 header("refresh:2, url=index.php");
		 }
	 }
	 
  echo' <table class="table table-bordered table-striped text-center bg-white">
  <thead>
  <tr>
  <th colspan="6">ÜYE EKLEME</th>       
  </tr>
  </thead>
  <tbody>
  <td colspan="6">
<form action="index.php?islem=ekle" method="post">
<input type="text" name="ad" class="form-control mx-auto col-md-3 mt-2" placeholder="ad yaz">
<input type="text" name="soyad" class="form-control mx-auto col-md-3 mt-2" placeholder="soyad yaz">
<input type="text" name="yas" class="form-control mx-auto col-md-3 mt-2" placeholder="yas yaz">
<input type="text" name="aidat" class="form-control mx-auto col-md-3 mt-2" placeholder="aidat yaz">
<input type="submit" name="button" class="btn btn-success" value="EKLE">
</form>
</td>
</tr>
</tbody>
</table>';


	

 }

function listele($baglanti,$sec){
  
	if ($sec==0) {
		$sorgu=$baglanti->prepare("select * from uyeler");
	}
	elseif ($sec==1) {
		$sorgu=$baglanti->prepare("select * from uyeler order by yas desc");
	}
	elseif ($sec==2) {
		$sorgu=$baglanti->prepare("select * from uyeler order by yas asc");
	}
	elseif ($sec==3) {
		$sorgu=$baglanti->prepare("select * from uyeler order by aidat desc");
	}
	elseif ($sec==4) {
		$sorgu=$baglanti->prepare("select * from uyeler order by aidat asc");
	}


  $sorgu->execute();
  if ($sorgu->rowCount()==0) {
	echo ' <tr>
	<td colspan="6">Kayıtlı Üye Yok</td>
	</tr>';

  }
  else {
	  while ($cikti=$sorgu->fetch(PDO::FETCH_ASSOC)) {
		 echo ' <tr>
		 <td>'.$cikti["ad"].'</td>
		 <td>'.$cikti["soyad"].'</td>
		 <td>'.$cikti["yas"].'</td>
		 <td>'.$cikti["aidat"].'</td>
		 <td><a href="index.php?islem=uyeguncelle&id='.$cikti["id"].'" class="btn btn-warning">Güncelle</a></td>
		 <td><a href="index.php?islem=uyesil&id='.$cikti["id"].'" class="btn btn-danger">Sil</a></td>           
		 </tr>';
	  }
  }

}


}




?>