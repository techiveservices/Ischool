<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Library</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    @media only screen and (min-width: 768px) and (max-width: 1168px) { 
 
}
@media only screen and (min-width: 768px) and (max-width: 999px) {
 
}

@media only screen and (min-width: 480px) and (max-width: 767px) {  

}
@media only screen and (max-width: 479px) {
.mob{ display: block !important; }
input{ width: 50% !important; }
}
  </style>
</head>
<body style="background-color: #999;">
  <div style=" max-width: 1170px; width: 100%; padding:15px; background-color: #00004d; margin: 15px auto; text-align: center; color: #fff; ">
    <h2 style="margin: 0; padding: 0;">Pragati Prakashan</h2>
    <p style="margin: 0; padding: 0;"><small style="margin: 0; padding: 0;">Pragati.. means progress </small></p>
    <div style=" padding: 30px; background-color: #fff ; margin-top: 15px; color: #000; text-align:left;">
      <p style=""><strong>Dear Reader,</strong></p>
      <div class="mob" style=" display: flex; flex-basis: 0; flex-grow: 1; max-width: 100%;">
        <p style="color: #000; text-align: left;">
          Your Otp is <?php  echo $otp;  ?>

        </p>
        <img style="margin-left:auto;" height="200" src="{{asset('/images/techive.png')}}"/>
      </div>
      <div style="width: 100%; text-align: center;">
        <input type="submit" name="Join_Us" value="Join Us" style="background-color: #00004d; color: #fff; width: 20%; height: 40px; font-size: 18px; margin-top: 15px;">
      </div>
    </div>
    <div style="text-align: left;">
      <p style="margin-bottom: 0; padding-bottom: 0"><strong style="margin-bottom: 0; padding-bottom: 0">PRAGATI PRAKASHAN </strong></p> 
      <p style="margin: 0; padding: 0;"><small style="margin: 0; padding: 0;">Support (Address: Pragati Bhawan, 240 Western Kutchery Road, Meerut, Uttar Pradesh - 250001)</small></p>
      <a href="#" style="margin: 0; padding: 0; color: #fff;"><small style="margin: 0; padding: 0;">support@pragatiprakashan.in</small></a>
    </div>
  </div>
</body>
</html>
