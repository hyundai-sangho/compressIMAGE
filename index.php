<?php

/* $input_image = "sample.jpg";
$output_image = "output.jpg";

$img = imagecreatefromjpeg($input_image);
imagejpeg($img, $output_image, 10); */


// Fatal error: Uncaught Error: Call to undefined function imagecreatefrompng() 에러 발생시
// php.ini 파일에 들어가서 ;extension=gd 앞부분의 ; 세미콜론 부분을 제거해주면 gd가 활성화된다.

if (isset($_POST['submit'])) {
  $info = getimagesize($_FILES['image']['tmp_name']);

  if (isset($info['mime'])) {
    if ($info['mime'] == "image/jpeg") {
      $img = imagecreatefromjpeg($_FILES['image']['tmp_name']);
    } else if ($info['mime'] == "image/png") {
      $img = imagecreatefrompng($_FILES['image']['tmp_name']);
    } else {
      echo "JPG 또는 PNG 이미지만 선택하십시오.";
    }

    if (isset($img)) {
      $output_image = date("Y_m_d_H_i_s", time()) . '.jpg';
      imagejpeg($img, $output_image, 40);
      echo "처리 완료";
      echo "<img src='$output_image'/>";
    }
  } else {
    echo "이미지 파일이 아니에요.";
  }
}

?>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="image" required>
  <input type="submit" name="submit">
</form>